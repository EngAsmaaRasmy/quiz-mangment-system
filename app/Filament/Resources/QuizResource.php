<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuizResource\Pages;
use App\Filament\Resources\QuizResource\RelationManagers;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\Quizzes\App\Models\Quiz;

class QuizResource extends Resource
{
    protected static ?string $model = Quiz::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Quiz Details')
                ->schema([
                    TextInput::make('title')
                        ->required()
                        ->columnSpan('full'),
        
                    RichEditor::make('description')
                        ->toolbarButtons(['bold', 'italic', 'underline', 'strike', 'link', 'bulletList', 'orderedList'])
                        ->columnSpan('full')
                        ->required(),
                ]),

                Repeater::make('questions')
                ->relationship('questions')
                ->schema([
                    TextInput::make('question_text')->label('Question')->required(),

                    Repeater::make('answers')
                    ->relationship('answers')
                        ->schema([
                            TextInput::make('answer_text')->label('Option')->required(),
                            Checkbox::make('is_correct')->label('Correct Answer'),
                        ])
                        ->minItems(2)
                        ->maxItems(4)
                        ->required(),
                ])
                ->minItems(1)
                ->required(),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->sortable()->searchable(),
                // TextColumn::make('description'),
                TextColumn::make('questions_count')->label('Questions')->counts('questions'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListQuizzes::route('/'),
            'create' => Pages\CreateQuiz::route('/create'),
            'edit' => Pages\EditQuiz::route('/{record}/edit'),
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
