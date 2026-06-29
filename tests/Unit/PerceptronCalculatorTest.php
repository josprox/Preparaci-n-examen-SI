<?php

use App\Calculators\PerceptronCalculator;

it('can train a perceptron simple for OR gate', function () {
    $calculator = new PerceptronCalculator();
    
    $config = [
        'num_inputs' => 2,
        'training_data' => [
            [0, 0, 0],
            [0, 1, 1],
            [1, 0, 1],
            [1, 1, 1]
        ],
        'initial_weights' => [0.7, 0.1],
        'bias' => -0.9,
        'learning_rate' => 0.4,
        'epochs' => 10,
        'activation_fn' => 'step',
        'threshold' => 0.0
    ];

    $results = $calculator->train($config);

    expect($results['converged'])->toBeTrue()
        ->and($results['epochs_run'])->toBeLessThanOrEqual(10)
        ->and($results['final_weights'])->toBeArray();
});

it('can train a perceptron simple for AND gate', function () {
    $calculator = new PerceptronCalculator();

    $config = [
        'num_inputs' => 2,
        'training_data' => [
            [0, 0, 0],
            [0, 1, 0],
            [1, 0, 0],
            [1, 1, 1]
        ],
        'initial_weights' => [0.7, 0.2],
        'bias' => -0.5,
        'learning_rate' => 0.25,
        'epochs' => 10,
        'activation_fn' => 'step',
        'threshold' => 0.0
    ];

    $results = $calculator->train($config);

    expect($results['converged'])->toBeTrue()
        ->and($results['epochs_run'])->toBeLessThanOrEqual(10)
        ->and($results['final_weights'])->toBeArray();
});

it('matches the exam example epoch 1 updates', function () {
    $calculator = new PerceptronCalculator();

    $config = [
        'num_inputs' => 2,
        'training_data' => [
            [0, 0, 0],
            [0, 1, 1],
            [1, 0, 1],
            [1, 1, 1]
        ],
        'initial_weights' => [0.7, 0.1],
        'bias' => -0.9,
        'learning_rate' => 0.4,
        'epochs' => 1,
        'activation_fn' => 'step',
        'threshold' => 0.0
    ];

    $results = $calculator->train($config);

    // Let's trace sample-by-sample for epoch 1
    // Sample 1: (0,0) -> z = -0.9 + 0.7(0) + 0.1(0) = -0.9 -> y_calc = 0 -> error = 0 -> weights no change
    // Sample 2: (0,1) -> z = -0.9 + 0.7(0) + 0.1(1) = -0.8 -> y_calc = 0 -> expected = 1 -> error = 1 -> weights update:
    // w0 = -0.9 + 0.4(1) = -0.5
    // w1 = 0.7 + 0.4(1)(0) = 0.7
    // w2 = 0.1 + 0.4(1)(1) = 0.5
    // Sample 3: (1,0) -> z = -0.5 + 0.7(1) + 0.5(0) = 0.2 -> y_calc = 1 -> expected = 1 -> error = 0 -> no change
    // Sample 4: (1,1) -> z = -0.5 + 0.7(1) + 0.5(1) = 0.7 -> y_calc = 1 -> expected = 1 -> error = 0 -> no change
    
    $epoch1 = $results['epochs_details'][0];
    
    expect($epoch1['errors'])->toBe(1) // only Sample 2 has error
        ->and($epoch1['final_weights'][0])->toEqual(0.7)
        ->and($epoch1['final_weights'][1])->toEqual(0.5)
        ->and($epoch1['final_bias'])->toEqual(-0.5);
});
