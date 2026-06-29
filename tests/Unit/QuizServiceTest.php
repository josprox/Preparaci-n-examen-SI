<?php

use App\Services\QuizService;

it('loads questions database correctly', function () {
    $service = new QuizService();
    $questions = $service->getAllQuestions();

    expect($questions)->toBeArray()
        ->and(count($questions))->toBeGreaterThan(20);

    $q = $questions[0];
    expect($q)->toHaveKeys(['question', 'options', 'correctAnswer', 'explanation', 'topic', 'difficulty']);
});

it('shuffles quiz options and adjusts the correctAnswer index correctly', function () {
    $service = new QuizService();
    
    // Get raw questions
    $rawQuestions = $service->getAllQuestions();
    $firstRaw = $rawQuestions[0];
    $correctOptionText = $firstRaw['options'][$firstRaw['correctAnswer']];

    // Get shuffled questions
    $shuffled = $service->getRandomQuestions(5);
    
    if (count($shuffled) > 0) {
        foreach ($shuffled as $shuffledQ) {
            // Find corresponding original question
            $originalQ = collect($rawQuestions)->firstWhere('question', $shuffledQ['question']);
            expect($originalQ)->not->toBeNull();
            
            $originalCorrectText = $originalQ['options'][$originalQ['correctAnswer']];
            $shuffledCorrectText = $shuffledQ['options'][$shuffledQ['correctAnswer']];
            
            expect($shuffledCorrectText)->toEqual($originalCorrectText);
        }
    }
});
