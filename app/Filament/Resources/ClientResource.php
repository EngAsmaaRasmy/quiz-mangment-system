<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages;
use App\Filament\Resources\ClientResource\RelationManagers;
use App\Models\Client;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Clients\App\Models\Tenant;

class ClientResource extends Resource
{
    protected static ?string $model = Tenant::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function shouldRegisterNavigation(): bool
    {
        // Check if the current domain matches the central domain
        return request()->getHost() === config('app.central_domain');
    }
    
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('Client ID')->sortable(),
                TextColumn::make('name')->label('Client Name')->searchable(),
                TextColumn::make('email')->label('Client Email')->searchable(),
                BadgeColumn::make('domains.domain')->label('Domain')
                ->colors([
                    'primary',
                ])->sortable()->searchable(),
                TextColumn::make('created_at')->label('Created At')->dateTime()->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([

            ])
            ->bulkActions([

            ]);
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
            'index' => Pages\ListClients::route('/'),
        ];
    }
}
