<?php

namespace App\Filament\Resources\MemberResource\Pages;

use App\Filament\Resources\MemberResource;
use Filament\Resources\Pages\Page;
use Modules\Quizzes\App\Models\Quiz;

class MemberDashboard extends Page
{
    protected static string $resource = MemberResource::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-check';

    protected static string $view = 'filament.resources.member-resource.pages.member-dashboard';

    public $quizzes;
    
    public function mount()
    {
        $this->quizzes = Quiz::with(['results' => function ($query) {
            $query->where('user_id', auth()->id());
        }])->withCount('questions')->get();
    }
}
