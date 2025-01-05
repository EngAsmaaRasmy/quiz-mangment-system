<x-filament::page>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-extrabold text-gray-100">Available Quizzes</h2>
    </div>

    @if ($quizzes->isEmpty())
        <div class="p-6 text-center text-gray-400 border border-dashed border-gray-600 rounded-lg">
            <h3 class="text-lg font-semibold">No quizzes available</h3>
            <p>Please check back later.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($quizzes as $quiz)
                <div class="relative p-6 bg-gray-800 border border-gray-700 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                    <div class="absolute top-1 right-4 bg-blue-600 text-white text-xs font-medium px-3 py-1 rounded-full">
                        {{ $quiz->questions_count }} Questions
                    </div>
                    <h3 class="text-lg font-bold text-white mt-2">{{ $quiz->title }}</h3>
                    <p class="mt-2 text-sm text-gray-400 line-clamp-3">{!! $quiz->description !!}</p>


                    @if ($quiz->results->isNotEmpty())
                    <div class="mt-5">
                        <p class="text-green-400 font-semibold">Your Score: {{ $quiz->results->first()->score }}%</p>
                        <p class="text-sm text-gray-400">You have already submitted this quiz.</p>
                    </div>
                    @else
                    <div class="mt-5">
                        <a href="{{ route('filament.admin.resources.members.solveQuiz', $quiz) }}"
                           class="relative inline-flex items-center justify-center w-full px-6 py-3 text-sm font-semibold text-white bg-gradient-to-r from-blue-500 to-blue-700 rounded-lg shadow-lg hover:shadow-xl hover:from-blue-600 hover:to-blue-800 transition-all duration-300 ease-in-out overflow-hidden">
                            <span class="absolute inset-0 bg-blue-700 opacity-0 hover:opacity-10 transition-opacity duration-300"></span>
                            <span class="relative z-10">Start Quiz</span>
                            <svg class="w-5 h-5 ml-2 relative z-10" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</x-filament::page>
