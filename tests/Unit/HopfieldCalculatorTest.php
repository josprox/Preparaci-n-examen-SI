<?php

use App\Calculators\HopfieldCalculator;

it('matches Hopfield 3 neurons training calculations', function () {
    $calculator = new HopfieldCalculator();

    $config = [
        'patterns' => [
            [1, -1, 1]
        ],
        'test_pattern' => [1, 1, 1],
        'update_mode' => 'async'
    ];

    $results = $calculator->compute($config);

    // Matrix with diagonal set to 0:
    // [0, -1, 1]
    // [-1, 0, -1]
    // [1, -1, 0]
    $expectedWeights = [
        [0, -1, 1],
        [-1, 0, -1],
        [1, -1, 0]
    ];

    expect($results['weights'])->toEqual($expectedWeights);

    // Initial state: [1, 1, 1]
    // Asynchronous update:
    // Neuron 1: h1 = -1(1) + 1(1) = 0 -> keeps state -> 1
    // Neuron 2: h2 = -1(1) - 1(1) = -2 -> sign(-2) = -1
    // Neuron 3: h3 = 1(1) - 1(-1) = 2 -> sign(2) = 1
    // Stable state: [1, -1, 1]
    expect($results['final_state'])->toEqual([1, -1, 1])
        ->and($results['stable'])->toBeTrue();
});

it('resolves exam question 38 stability correctly', function () {
    $calculator = new HopfieldCalculator();

    $config = [
        'patterns' => [
            [1, 1, 1, -1]
        ],
        'test_pattern' => [1, 1, -1, -1],
        'update_mode' => 'async'
    ];

    $results = $calculator->compute($config);

    // Memorized pattern P = [1, 1, 1, -1]
    // Test pattern S = [1, 1, -1, -1]
    // Let's compute weights:
    // W = pT x p
    // p = [1, 1, 1, -1]
    // W = [
    //  [0, 1, 1, -1],
    //  [1, 0, 1, -1],
    //  [1, 1, 0, -1],
    //  [-1, -1, -1, 0]
    // ]
    // Testing S = [1, 1, -1, -1]:
    // Asynchronous update:
    // Neuron 1: h1 = w12*s2 + w13*s3 + w14*s4 = (1)(1) + (1)(-1) + (-1)(-1) = 1 - 1 + 1 = 1 -> sign(1) = 1
    // Neuron 2: h2 = w21*s1 + w22*s2... = (1)(1) + (1)(-1) + (-1)(-1) = 1 - 1 + 1 = 1 -> sign(1) = 1
    // Neuron 3: h3 = w31*s1 + w32*s2 + w34*s4 = (1)(1) + (1)(1) + (-1)(-1) = 1 + 1 + 1 = 3 -> sign(3) = 1 (State changes from -1 to 1)
    // Neuron 4: h4 = w41*s1 + w42*s2 + w43*s3 = (-1)(1) + (-1)(1) + (-1)(1) = -3 -> sign(-3) = -1
    // State becomes: [1, 1, 1, -1] which is the original memorized pattern, and is stable!
    
    expect($results['final_state'])->toEqual([1, 1, 1, -1])
        ->and($results['stable'])->toBeTrue()
        ->and($results['matched_pattern_index'])->toEqual(0);
});
