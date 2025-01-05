<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MemberResource\Pages;
use App\Filament\Resources\MemberResource\Pages\MemberDashboard;
use App\Filament\Resources\MemberResource\Pages\SolveQuiz;
use App\Filament\Resources\MemberResource\RelationManagers;
use App\Models\Member;
use App\Models\User;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MemberResource extends Resource
{

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $title = 'Memeber Dashboard';

    protected static ?string $navigationLabel = 'Memeber Dashboard';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                //
            ])
            ->bulkActions([
               //
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
            'index' => MemberDashboard::route('/'),
            'solveQuiz' => SolveQuiz::route('/solve-quiz/{quizId}'),
        ];
    }


     /**
     * Only register navigation if the user is a member.
     */
    public static function shouldRegisterNavigation(): bool
    {
        $user = Filament::auth()->user();

        // Show only if the user is a member
        return $user && $user->type === 'member';
    }
}
