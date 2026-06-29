<?php

namespace App\Http\Controllers;

use App\Calculators\PerceptronCalculator;
use App\Services\ExerciseHistoryService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PerceptronController extends Controller
{
    public function __construct(
        protected PerceptronCalculator $calculator,
        protected ExerciseHistoryService $historyService
    ) {}

    public function index(Request $request): View
    {
        $repeatId = $request->query('repeat');
        $inputs = null;

        if ($repeatId) {
            $exercise = $this->historyService->find((int) $repeatId);
            if ($exercise && $exercise->type === 'perceptron') {
                $inputs = $exercise->inputs;
            }
        }

        // Define default example (OR gate) if no repeat is requested
        if (!$inputs) {
            $inputs = [
                'num_inputs' => 2,
                'initial_weights' => '0.7, 0.1',
                'bias' => -0.9,
                'learning_rate' => 0.4,
                'epochs' => 10,
                'activation_fn' => 'step',
                'threshold' => 0.0,
                'training_data_raw' => "0\t0\t0\n0\t1\t1\n1\t0\t1\n1\t1\t1"
            ];
        }

        return view('perceptron.index', compact('inputs'));
    }

    public function solve(Request $request)
    {
        $request->validate([
            'num_inputs' => 'required|integer|min:1|max:10',
            'initial_weights' => 'required|string',
            'bias' => 'required|numeric',
            'learning_rate' => 'required|numeric|min:0.0001|max:10',
            'epochs' => 'required|integer|min:1|max:100',
            'activation_fn' => 'required|string|in:step,sign,sigmoid',
            'threshold' => 'nullable|numeric',
            'training_data_raw' => 'required|string',
        ]);

        $numInputs = (int) $request->input('num_inputs');
        $bias = (float) $request->input('bias');
        $learningRate = (float) $request->input('learning_rate');
        $epochs = (int) $request->input('epochs');
        $activationFn = $request->input('activation_fn');
        $threshold = $request->filled('threshold') ? (float) $request->input('threshold') : 0.0;

        // Parse weights
        $weightsRaw = str_replace(['[', ']', ' '], '', $request->input('initial_weights'));
        $weights = array_map('floatval', explode(',', $weightsRaw));

        // Validation: weights size must match num_inputs
        if (count($weights) !== $numInputs) {
            return back()->withInput()->with('error', sprintf('Revisa tus datos: tienes %d entradas, pero escribiste %d pesos iniciales.', $numInputs, count($weights)));
        }

        // Parse training data rows
        $lines = explode("\n", str_replace("\r", "", $request->input('training_data_raw')));
        $trainingData = [];

        foreach ($lines as $lineIndex => $line) {
            $line = trim($line);
            if ($line === '') {
                continue;
            }

            // Split by whitespace or tabs
            $parts = preg_split('/\s+/', $line);
            $parts = array_map('floatval', $parts);

            if (count($parts) !== ($numInputs + 1)) {
                return back()->withInput()->with('error', sprintf(
                    'Revisa tus datos: En la fila %d ingresaste %d columnas, pero se esperaban %d (entradas + salida esperada).',
                    $lineIndex + 1,
                    count($parts),
                    $numInputs + 1
                ));
            }

            $trainingData[] = $parts;
        }

        if (empty($trainingData)) {
            return back()->withInput()->with('error', 'Revisa tus datos: La tabla de entrenamiento no contiene ninguna muestra válida.');
        }

        $config = [
            'num_inputs' => $numInputs,
            'training_data' => $trainingData,
            'initial_weights' => $weights,
            'bias' => $bias,
            'learning_rate' => $learningRate,
            'epochs' => $epochs,
            'activation_fn' => $activationFn,
            'threshold' => $threshold
        ];

        // Perform simulation
        $results = $this->calculator->train($config);

        // Store inputs for rendering back the form
        $formInputs = [
            'num_inputs' => $numInputs,
            'initial_weights' => $request->input('initial_weights'),
            'bias' => $bias,
            'learning_rate' => $learningRate,
            'epochs' => $epochs,
            'activation_fn' => $activationFn,
            'threshold' => $threshold,
            'training_data_raw' => $request->input('training_data_raw')
        ];

        // Save exercise to history
        $this->historyService->create(
            'perceptron',
            $formInputs,
            [
                'converged' => $results['converged'],
                'epochs_run' => $results['epochs_run'],
                'final_weights' => $results['final_weights'],
                'final_bias' => $results['final_bias']
            ],
            $request->input('notes'),
            $results['converged']
        );

        return view('perceptron.index', [
            'inputs' => $formInputs,
            'results' => $results,
            'notes' => $request->input('notes')
        ]);
    }
}
