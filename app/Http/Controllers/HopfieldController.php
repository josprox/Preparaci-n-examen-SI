<?php

namespace App\Http\Controllers;

use App\Calculators\HopfieldCalculator;
use App\Services\ExerciseHistoryService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HopfieldController extends Controller
{
    public function __construct(
        protected HopfieldCalculator $calculator,
        protected ExerciseHistoryService $historyService
    ) {}

    public function index(Request $request): View
    {
        $repeatId = $request->query('repeat');
        $inputs = null;

        if ($repeatId) {
            $exercise = $this->historyService->find((int) $repeatId);
            if ($exercise && $exercise->type === 'hopfield') {
                $inputs = $exercise->inputs;
            }
        }

        // Define default values
        if (!$inputs) {
            $inputs = [
                'hopfield_mode' => 'matlab',
                'patterns_raw' => "1, 1, 1, -1",
                'matlab_p' => "[1, -1, 1, -1]",
                'matlab_pt' => "[1; -1; 1; 1]",
                'test_pattern_raw' => "[1; 1; 1; -1]",
                'update_mode' => 'sync',
                'max_iterations' => 1
            ];
        }

        return view('hopfield.index', compact('inputs'));
    }

    public function solve(Request $request)
    {
        $request->validate([
            'hopfield_mode' => 'required|string|in:standard,matlab',
            'test_pattern_raw' => 'required|string',
        ]);

        $hopfieldMode = $request->input('hopfield_mode');
        $testPatternRaw = $request->input('test_pattern_raw');

        // Parse test pattern S using our robust parser
        $testPattern = $this->parseVector($testPatternRaw);
        $n = count($testPattern);

        if ($n === 0) {
            return back()->withInput()->with('error', 'El vector de prueba S no tiene un formato válido.');
        }

        // Validate values in test pattern (only 1, -1, 0 are allowed)
        foreach ($testPattern as $val) {
            if ($val != 1.0 && $val != -1.0 && $val != 0.0) {
                return back()->withInput()->with('error', 'Revisa tus datos: En el vector S solo se permiten valores discretos de 1, -1, y 0.');
            }
        }

        $patterns = [];
        $matlabP = [];
        $matlabPt = [];
        $updateMode = 'sync';
        $maxIterations = 1;

        if ($hopfieldMode === 'matlab') {
            $request->validate([
                'matlab_p' => 'required|string',
                'matlab_pt' => 'required|string',
            ]);

            $pRaw = $request->input('matlab_p');
            $ptRaw = $request->input('matlab_pt');

            // Parse p (Fila) and Pt (Columna) using our robust parser
            $matlabP = $this->parseVector($pRaw);
            $matlabPt = $this->parseVector($ptRaw);

            if (count($matlabP) !== $n) {
                return back()->withInput()->with('error', sprintf('El vector p tiene %d elementos, pero S tiene %d. Deben ser de igual tamaño.', count($matlabP), $n));
            }
            if (count($matlabPt) !== $n) {
                return back()->withInput()->with('error', sprintf('El vector Pt tiene %d elementos, pero S tiene %d. Deben ser de igual tamaño.', count($matlabPt), $n));
            }

            // Validate values
            foreach ($matlabP as $val) {
                if ($val != 1.0 && $val != -1.0 && $val != 0.0) {
                    return back()->withInput()->with('error', 'En el vector p solo se permiten valores de 1, -1, y 0.');
                }
            }
            foreach ($matlabPt as $val) {
                if ($val != 1.0 && $val != -1.0 && $val != 0.0) {
                    return back()->withInput()->with('error', 'En el vector Pt solo se permiten valores de 1, -1, y 0.');
                }
            }

            $patterns = [$matlabPt];
            $updateMode = 'sync'; // Matlab mode is always synchronous single step
            $maxIterations = 1;
        } else {
            $request->validate([
                'update_mode' => 'required|string|in:sync,async',
                'max_iterations' => 'required|integer|min:1|max:100',
            ]);

            $updateMode = $request->input('update_mode');
            $maxIterations = (int) $request->input('max_iterations');

            $patternsRaw = $request->input('patterns_raw');
            $lines = explode("\n", str_replace("\r", "", $patternsRaw));

            foreach ($lines as $lineIndex => $line) {
                $line = trim($line);
                if ($line === '') {
                    continue;
                }

                $parts = $this->parseVector($line);

                if (count($parts) !== $n) {
                    return back()->withInput()->with('error', sprintf(
                        'Revisa tus datos: El Patrón %d tiene %d elementos, pero el patrón de prueba S tiene %d. Todos los patrones deben tener el mismo tamaño.',
                        $lineIndex + 1,
                        count($parts),
                        $n
                    ));
                }

                foreach ($parts as $val) {
                    if ($val != 1.0 && $val != -1.0 && $val != 0.0) {
                        return back()->withInput()->with('error', sprintf('Revisa tus datos: En el Patrón %d ingresaste un valor inválido (%s). Solo se permiten 1, -1, y 0.', $lineIndex + 1, $val));
                    }
                }

                $patterns[] = $parts;
            }

            if (empty($patterns)) {
                return back()->withInput()->with('error', 'Revisa tus datos: Debes ingresar al menos un patrón de entrenamiento a memorizar.');
            }
        }

        $config = [
            'custom_mode' => $hopfieldMode,
            'matlab_p' => $matlabP,
            'matlab_pt' => $matlabPt,
            'patterns' => $patterns,
            'test_pattern' => $testPattern,
            'update_mode' => $updateMode,
            'max_iterations' => $maxIterations
        ];

        // Compute Hopfield Network transitions
        $results = $this->calculator->compute($config);

        $formInputs = [
            'hopfield_mode' => $hopfieldMode,
            'patterns_raw' => $request->input('patterns_raw', ''),
            'matlab_p' => $request->input('matlab_p', ''),
            'matlab_pt' => $request->input('matlab_pt', ''),
            'test_pattern_raw' => $testPatternRaw,
            'update_mode' => $updateMode,
            'max_iterations' => $maxIterations
        ];

        // Save exercise to history
        $this->historyService->create(
            'hopfield',
            $formInputs,
            [
                'stable' => $results['stable'],
                'final_state' => $results['final_state'],
                'matched_pattern_index' => $results['matched_pattern_index']
            ],
            $request->input('notes'),
            $results['stable']
        );

        return view('hopfield.index', [
            'inputs' => $formInputs,
            'results' => $results,
            'notes' => $request->input('notes')
        ]);
    }

    /**
     * Robust vector parsing helper supporting commas, semicolons, brackets, spaces, and newlines.
     */
    private function parseVector(string $raw): array
    {
        $clean = trim($raw);
        if (str_starts_with($clean, '[')) {
            $clean = substr($clean, 1);
        }
        if (str_ends_with($clean, ']')) {
            $clean = substr($clean, 0, -1);
        }

        // Replace separators (;, newline, comma) with a single space
        $clean = str_replace([';', ',', "\r", "\n"], ' ', $clean);

        // Explode by spaces and filter empty parts
        $parts = array_filter(explode(' ', $clean), fn($v) => trim($v) !== '');

        return array_map('floatval', array_values($parts));
    }
}
