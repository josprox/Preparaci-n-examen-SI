<?php

namespace App\Http\Controllers;

use App\Calculators\BackPropagationCalculator;
use App\Services\ExerciseHistoryService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BackpropController extends Controller
{
    public function __construct(
        protected BackPropagationCalculator $calculator,
        protected ExerciseHistoryService $historyService
    ) {}

    public function index(Request $request): View
    {
        $repeatId = $request->query('repeat');
        $inputs = null;

        if ($repeatId) {
            $exercise = $this->historyService->find((int) $repeatId);
            if ($exercise && $exercise->type === 'backpropagation') {
                $inputs = $exercise->inputs;
            }
        }

        // Set default values if no history repeat is loaded
        if (!$inputs) {
            $inputs = [
                'mode' => 'single', // 'single' | 'mlp'
                // Single Neuron defaults
                'x1' => 1.0,
                'x2' => 1.0,
                'y' => 1.0,
                'w1' => 0.5,
                'w2' => 0.5,
                'b' => -0.7,
                'eta' => 0.1,
                'epochs' => 1,
                // MLP defaults
                'mlp_x1' => 1.0,
                'mlp_x2' => 1.0,
                'mlp_y' => 1.0,
                'mlp_w11' => 0.5,
                'mlp_w12' => 0.5,
                'mlp_w21' => 0.5,
                'mlp_w22' => 0.5,
                'mlp_v1' => 0.5,
                'mlp_v2' => 0.5,
                'mlp_b1' => -0.7,
                'mlp_b2' => -0.7,
                'mlp_b0' => -0.7,
                'mlp_eta' => 0.1
            ];
        }

        return view('backprop.index', compact('inputs'));
    }

    public function solve(Request $request)
    {
        $mode = $request->input('mode', 'single');

        if ($mode === 'single') {
            $request->validate([
                'x1' => 'required|numeric',
                'x2' => 'required|numeric',
                'y' => 'required|numeric',
                'w1' => 'required|numeric',
                'w2' => 'required|numeric',
                'b' => 'required|numeric',
                'eta' => 'required|numeric|min:0.0001|max:10',
                'epochs' => 'required|integer|min:1|max:100',
            ]);

            $config = [
                'x1' => (float) $request->input('x1'),
                'x2' => (float) $request->input('x2'),
                'y' => (float) $request->input('y'),
                'w1' => (float) $request->input('w1'),
                'w2' => (float) $request->input('w2'),
                'b' => (float) $request->input('b'),
                'eta' => (float) $request->input('eta'),
                'epochs' => (int) $request->input('epochs')
            ];

            $results = $this->calculator->computeSingleNeuron($config);

            $formInputs = array_merge($request->all(), [
                'mode' => 'single'
            ]);

            // Save history
            $this->historyService->create(
                'backpropagation',
                $formInputs,
                [
                    'mode' => 'single',
                    'final_w1' => $results['final_w1'],
                    'final_w2' => $results['final_w2'],
                    'final_b' => $results['final_b'],
                    'last_error' => end($results['epochs_details'])['error']
                ],
                $request->input('notes'),
                true
            );
        } else {
            // MLP Mode
            $request->validate([
                'mlp_x1' => 'required|numeric',
                'mlp_x2' => 'required|numeric',
                'mlp_y' => 'required|numeric',
                'mlp_w11' => 'required|numeric',
                'mlp_w12' => 'required|numeric',
                'mlp_w21' => 'required|numeric',
                'mlp_w22' => 'required|numeric',
                'mlp_v1' => 'required|numeric',
                'mlp_v2' => 'required|numeric',
                'mlp_b1' => 'required|numeric',
                'mlp_b2' => 'required|numeric',
                'mlp_b0' => 'required|numeric',
                'mlp_eta' => 'required|numeric|min:0.0001|max:10',
            ]);

            $config = [
                'x1' => (float) $request->input('mlp_x1'),
                'x2' => (float) $request->input('mlp_x2'),
                'y' => (float) $request->input('mlp_y'),
                'w11' => (float) $request->input('mlp_w11'),
                'w12' => (float) $request->input('mlp_w12'),
                'w21' => (float) $request->input('mlp_w21'),
                'w22' => (float) $request->input('mlp_w22'),
                'v1' => (float) $request->input('mlp_v1'),
                'v2' => (float) $request->input('mlp_v2'),
                'b1' => (float) $request->input('mlp_b1'),
                'b2' => (float) $request->input('mlp_b2'),
                'b0' => (float) $request->input('mlp_b0'),
                'eta' => (float) $request->input('mlp_eta'),
            ];

            $results = $this->calculator->computeMLP($config);

            $formInputs = array_merge($request->all(), [
                'mode' => 'mlp'
            ]);

            // Save history
            $this->historyService->create(
                'backpropagation',
                $formInputs,
                [
                    'mode' => 'mlp',
                    'new_weights_hidden' => $results['new_weights_hidden'],
                    'new_weights_output' => $results['new_weights_output'],
                    'new_biases' => $results['new_biases'],
                    'error' => $results['error']
                ],
                $request->input('notes'),
                true
            );
        }

        return view('backprop.index', [
            'inputs' => $formInputs,
            'results' => $results,
            'notes' => $request->input('notes')
        ]);
    }
}
