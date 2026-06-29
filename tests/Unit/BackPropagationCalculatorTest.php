<?php

use App\Calculators\BackPropagationCalculator;

it('matches the course backpropagation example values', function () {
    $calculator = new BackPropagationCalculator();

    $config = [
        'x1' => 1.0,
        'x2' => 1.0,
        'y' => 1.0,
        'w1' => 0.5,
        'w2' => 0.5,
        'b' => -0.7,
        'eta' => 0.1,
        'epochs' => 1
    ];

    $results = $calculator->computeSingleNeuron($config);
    $epoch1 = $results['epochs_details'][0];

    // Mathematical values verification:
    // z = 0.5(1) + 0.5(1) - 0.7 = 0.3
    expect(round($epoch1['z'], 4))->toEqual(0.3000);

    // y_calc = 1 / (1 + e^-0.3) = 0.57444
    expect(round($epoch1['y_calculated'], 4))->toEqual(0.5744);

    // error = 1 - 0.5744 = 0.4256
    expect(round($epoch1['error'], 4))->toEqual(0.4256);

    // derivative = 0.57444 * (1 - 0.57444) = 0.24446 -> 0.2445
    expect(round($epoch1['delta'] / $epoch1['error'], 4))->toEqual(0.2445);

    // delta = 0.42556 * 0.24446 = 0.10403 -> 0.1040
    expect(round($epoch1['delta'], 4))->toEqual(0.1040);

    // w1_new = 0.5 - 0.1 * 0.10403 * 1 = 0.48959 -> 0.4896
    expect(round($epoch1['weights_after'][0], 4))->toEqual(0.4896);
    expect(round($epoch1['weights_after'][1], 4))->toEqual(0.4896);

    // b_new = -0.7 - 0.1 * 0.10403 = -0.7104
    expect(round($epoch1['bias_after'], 4))->toEqual(-0.7104);
});
