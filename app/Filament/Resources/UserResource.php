<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                ->required()
                ->maxLength(255),

            TextInput::make('email')
                ->email()
                ->required()
                ->maxLength(255)
                ->unique(ignoreRecord: true),

            TextInput::make('mobile')
                ->required()
                ->maxLength(20),

            TextInput::make('password')
                ->password()
                ->minLength(8)
                ->maxLength(255)
                ->dehydrateStateUsing(fn ($state) => $state ? Hash::make($state) : null)
                ->required(fn ($record) => $record === null)
                ->label(fn ($record) => $record ? 'Change Password' : 'Password'),

            Select::make('type')
                ->options([
                    'admin' => 'Admin',
                    'member' => 'Member',
                ])
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('email')->sortable()->searchable(),
                TextColumn::make('mobile'),

                // Display roles as badges
                BadgeColumn::make('type')
                ->label('User Type')
                ->colors([
                    'success' => 'admin',   
                    'warning' => 'member', 
                ])
                ->sortable()
                ->searchable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                ->label('Filter by Type')
                ->options([
                    'admin' => 'Admin',
                    'member' => 'Member',
                ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ])
            ->defaultSort('name');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    /**
     * Only register navigation if the user is an admin.
     */
    public static function shouldRegisterNavigation(): bool
    {
        $user = Filament::auth()->user();

        return $user && $user->type === 'admin';
    }
}
