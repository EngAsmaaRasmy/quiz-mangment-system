<x-filament::page>
    <div class="bg-gray-800 text-white p-8 rounded-lg shadow-lg">
        <!-- Quiz Title -->
        <h2 class="text-3xl font-extrabold text-blue-400 mb-4">{{ $quiz->title }}</h2>
        <p class="text-md text-gray-300 mb-8">{{ $quiz->description }}</p>

        <!-- Progress Bar -->
        <div class="w-full bg-gray-700 rounded-full h-3 mb-8">
            <div id="progress-bar" class="bg-green-500 h-3 rounded-full" style="width: 0%;"></div>
        </div>

        <!-- Quiz Form -->
        <form method="POST" action="{{ route('member.submit-quiz', $quiz->id) }}" id="quiz-form" class="space-y-10">
            @csrf
            @foreach ($quiz->questions as $question)
                <div class="p-6 bg-gray-900 rounded-lg shadow-sm">
                    <!-- Question Title -->
                    <h4 class="text-xl font-bold text-yellow-400 mb-4">{{ $loop->iteration }}. {{ $question->question_text }}</h4>

                    <!-- Answer Options -->
                    <div class="mt-3 space-y-4">
                        @foreach ($question->answers as $answer)
                            <div class="flex items-center space-x-3">
                                <input type="radio" id="answer-{{ $answer->id }}" name="answers[{{ $question->id }}]" value="{{ $answer->id }}" class="w-5 h-5 text-blue-500 border-gray-600 focus:ring-blue-500">
                                <label for="answer-{{ $answer->id }}" class="text-gray-300 cursor-pointer hover:text-white">{{ $answer->answer_text }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach

            <!-- Submit Button -->
            <div class="mt-12">
                <button type="submit" class="w-full px-8 py-4 text-lg font-semibold text-white bg-gradient-to-r from-green-500 to-green-700 rounded-lg hover:from-green-600 hover:to-green-800 focus:outline-none focus:ring-4 focus:ring-green-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition-all">
                    Submit Quiz
                </button>
            </div>
        </form>
    </div>

    <!-- JavaScript for Progress Bar -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('quiz-form');
            const inputs = form.querySelectorAll('input[type="radio"]');
            const progressBar = document.getElementById('progress-bar');
            const totalQuestions = {{ $quiz->questions->count() }};
            let answeredQuestions = 0;

            // Function to update progress bar
            function updateProgress() {
                answeredQuestions = [...form.querySelectorAll('input[type="radio"]:checked')].length;
                const progress = (answeredQuestions / totalQuestions) * 100;
                progressBar.style.width = progress + '%';
            }

            // Attach event listeners to all radio buttons
            inputs.forEach(input => {
                input.addEventListener('change', updateProgress);
            });
        });
    </script>
</x-filament::page>
