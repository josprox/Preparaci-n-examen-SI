<?php

namespace App\Http\Controllers;

use App\Calculators\ForwardPropagationCalculator;
use App\Services\ExerciseHistoryService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ForwardController extends Controller
{
    public function __construct(
        protected ForwardPropagationCalculator $calculator,
        protected ExerciseHistoryService $historyService
    ) {}

    public function index(Request $request): View
    {
        $repeatId = $request->query('repeat');
        $inputs = null;

        if ($repeatId) {
            $exercise = $this->historyService->find((int) $repeatId);
            if ($exercise && $exercise->type === 'forward_propagation') {
                $inputs = $exercise->inputs;
            }
        }

        // Define default MLP architecture (AND gate like setup or 2-2-1 network)
        if (!$inputs) {
            $inputs = [
                'num_inputs' => 2,
                'layer_sizes' => [2, 1],
                'inputs_data' => [1.0, 1.0],
                'weights' => [
                    0 => [ // Layer 1 (Hidden)
                        0 => [0.5, 0.5], // Neuron 1
                        1 => [0.5, 0.5], // Neuron 2
                    ],
                    1 => [ // Layer 2 (Output)
                        0 => [0.5, 0.5], // Neuron 1
                    ]
                ],
                'biases' => [
                    0 => [-0.7, -0.7], // Layer 1
                    1 => [-0.7]        // Layer 2
                ],
                'activation_fns' => ['sigmoid', 'sigmoid']
            ];
        }

        return view('forward.index', compact('inputs'));
    }

    public function solve(Request $request)
    {
        $request->validate([
            'num_inputs' => 'required|integer|min:1|max:10',
            'layer_sizes' => 'required|array',
            'layer_sizes.*' => 'required|integer|min:1|max:10',
            'inputs_data' => 'required|array',
            'inputs_data.*' => 'required|numeric',
            'weights' => 'required|array',
            'biases' => 'required|array',
            'activation_fns' => 'required|array',
            'activation_fns.*' => 'required|string|in:sigmoid,tanh,relu,step,linear',
        ]);

        $numInputs = (int) $request->input('num_inputs');
        $layerSizes = array_map('intval', $request->input('layer_sizes'));
        $inputsData = array_map('floatval', $request->input('inputs_data'));
        $weights = $request->input('weights');
        $biases = $request->input('biases');
        $activationFns = $request->input('activation_fns');

        // Convert string-nested numbers to floats in weights and biases
        $cleanWeights = [];
        $cleanBiases = [];

        foreach ($layerSizes as $layerIndex => $neuronsCount) {
            $cleanWeights[$layerIndex] = [];
            $cleanBiases[$layerIndex] = [];

            // Inputs count for this layer is numInputs for Layer 0, or previous layer size
            $prevLayerSize = $layerIndex === 0 ? $numInputs : $layerSizes[$layerIndex - 1];

            for ($neuronIndex = 0; $neuronIndex < $neuronsCount; $neuronIndex++) {
                $cleanBiases[$layerIndex][$neuronIndex] = (float) ($biases[$layerIndex][$neuronIndex] ?? 0.0);
                $cleanWeights[$layerIndex][$neuronIndex] = [];

                for ($inputIndex = 0; $inputIndex < $prevLayerSize; $inputIndex++) {
                    $cleanWeights[$layerIndex][$neuronIndex][$inputIndex] = (float) ($weights[$layerIndex][$neuronIndex][$inputIndex] ?? 0.0);
                }
            }
        }

        $config = [
            'num_inputs' => $numInputs,
            'layer_sizes' => $layerSizes,
            'weights' => $cleanWeights,
            'biases' => $cleanBiases,
            'activation_fns' => $activationFns,
            'inputs_data' => $inputsData
        ];

        // Perform calculation
        $results = $this->calculator->compute($config);

        // Store inputs for history and form re-filling
        $formInputs = [
            'num_inputs' => $numInputs,
            'layer_sizes' => $layerSizes,
            'inputs_data' => $inputsData,
            'weights' => $cleanWeights,
            'biases' => $cleanBiases,
            'activation_fns' => $activationFns
        ];

        // Save exercise to history
        $this->historyService->create(
            'forward_propagation',
            $formInputs,
            [
                'output' => $results['output'],
                'layer_outputs' => $results['layer_outputs']
            ],
            $request->input('notes'),
            true
        );

        return view('forward.index', [
            'inputs' => $formInputs,
            'results' => $results,
            'notes' => $request->input('notes')
        ]);
    }
}
