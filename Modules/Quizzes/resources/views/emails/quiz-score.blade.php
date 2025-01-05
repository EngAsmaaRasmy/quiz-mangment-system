@component('mail::message')
# Quiz Completed: {{ $quiz->title }}

Congratulations! You have completed the quiz.

Your score: **{{ $score }}%**

Thanks,<br>
{{ config('app.name') }}
@endcomponent
