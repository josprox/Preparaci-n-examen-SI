<?php

namespace App\Http\Controllers;

use App\Services\QuizService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class QuizController extends Controller
{
    public function __construct(
        protected QuizService $quizService
    ) {}

    public function index(): View
    {
        $topics = $this->quizService->getTopics();
        return view('quiz.index', compact('topics'));
    }

    public function play(Request $request): View
    {
        $topic = $request->query('topic');
        $count = (int) $request->query('count', 10);
        $mode = $request->query('mode', 'practice'); // 'practice' | 'exam'

        // If 'all' is selected for topic, treat it as null (to get questions from all topics)
        if ($topic === 'all') {
            $topic = null;
        }

        $questions = $this->quizService->getRandomQuestions($count, $topic);

        return view('quiz.play', compact('questions', 'mode', 'topic', 'count'));
    }
}
