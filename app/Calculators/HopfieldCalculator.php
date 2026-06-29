<?php

namespace App\Calculators;

class HopfieldCalculator
{
    /**
     * Train and test a Hopfield network.
     *
     * @param array{
     *     custom_mode?: string, // 'standard' | 'matlab'
     *     matlab_p?: array<float|int>,
     *     matlab_pt?: array<float|int>,
     *     patterns: array<array<float|int>>,
     *     test_pattern: array<float|int>,
     *     update_mode: string, // 'sync' | 'async'
     *     max_iterations?: int
     * } $config
     * @return array<string, mixed>
     */
    public function compute(array $config): array
    {
        $customMode = $config['custom_mode'] ?? 'standard';
        $patterns = $config['patterns'];
        $testPattern = array_map('intval', $config['test_pattern']);
        $updateMode = $config['update_mode'];
        $maxIterations = isset($config['max_iterations']) ? (int) $config['max_iterations'] : 10;

        $steps = [];
        $n = count($testPattern);

        $bipolarPatterns = [];
        $bipolarP = [];
        $bipolarPt = [];

        if ($customMode === 'matlab') {
            $p = $config['matlab_p'];
            $pt = $config['matlab_pt'];

            // Convert p (Fila) and Pt (Columna) to bipolar
            foreach ($p as $val) {
                $bipolarP[] = $val == 0 ? -1 : ($val > 0 ? 1 : -1);
            }
            foreach ($pt as $val) {
                $bipolarPt[] = $val == 0 ? -1 : ($val > 0 ? 1 : -1);
            }

            // Bipolar test pattern S
            $bipolarTestPattern = [];
            foreach ($testPattern as $val) {
                $bipolarTestPattern[] = $val == 0 ? -1 : ($val > 0 ? 1 : -1);
            }

            $steps[] = [
                'title' => 'Paso 1: Codificación Bipolar',
                'description' => 'Las redes Hopfield operan utilizando valores bipolares (1 y -1). Convertimos los valores 0 a -1 en tus vectores personalizados p (Fila), Pt (Columna) y el patrón de prueba S.',
                'formula' => '\\(f(x) = \\begin{cases} 1 & \\text{si } x > 0 \\\\ -1 & \\text{si } x \\le 0 \\end{cases}\\)',
                'substitution' => sprintf(
                    '\\(\\text{Fila } p: %s \\rightarrow %s \\quad | \\quad \\text{Columna } P_t: %s \\rightarrow %s \\quad | \\quad \\text{Prueba } S: %s \\rightarrow %s\\)',
                    $this->vectorToLatex($p), $this->vectorToLatex($bipolarP),
                    $this->vectorToLatexCol($pt), $this->vectorToLatexCol($bipolarPt),
                    $this->vectorToLatex($testPattern), $this->vectorToLatex($bipolarTestPattern)
                ),
                'result' => 'Codificación bipolar lista',
                'type' => 'input',
                'data' => [
                    'original_p' => $p,
                    'bipolar_p' => $bipolarP,
                    'original_pt' => $pt,
                    'bipolar_pt' => $bipolarPt,
                    'original_test_pattern' => $testPattern,
                    'bipolar_test_pattern' => $bipolarTestPattern
                ]
            ];

            // 2. Weight Matrix Training W = Pt * p
            $rawW = [];
            for ($i = 0; $i < $n; $i++) {
                $row = [];
                for ($j = 0; $j < $n; $j++) {
                    $row[] = $bipolarPt[$i] * $bipolarP[$j];
                }
                $rawW[] = $row;
            }

            $steps[] = [
                'title' => 'Paso 2: Regla de Hebb (Matriz H = Pt * p)',
                'description' => 'Calculamos la matriz de pesos inicial H multiplicando el vector columna Pt por el vector fila p (producto externo). En la fórmula, Pt es el patrón de respuesta (Columna) y p es el patrón almacenado (Fila).',
                'formula' => '\\(H = P_t \\times p\\)',
                'substitution' => '\\(H = ' . $this->vectorToLatexCol($bipolarPt) . ' \\times ' . $this->vectorToLatex($bipolarP) . ' = ' . $this->matrixToLatex($rawW) . '\\)',
                'result' => 'Matriz H calculada',
                'type' => 'matrix',
                'data' => [
                    'matrix' => $rawW
                ]
            ];

            $bipolarPatterns = [$bipolarPt]; // For stable checks, original is Pt
        } else {
            // Standard Autoassociative Mode
            // 1. Convert input patterns to bipolar (-1, 1) if they contain 0
            $conversionSteps = [];
            foreach ($patterns as $idx => $pattern) {
                $bipolarPattern = [];
                foreach ($pattern as $val) {
                    $bipolarPattern[] = $val == 0 ? -1 : ($val > 0 ? 1 : -1);
                }
                $bipolarPatterns[] = $bipolarPattern;
                $conversionSteps[] = sprintf('\\text{Patrón %d: } %s \\rightarrow %s', $idx + 1, $this->vectorToLatex($pattern), $this->vectorToLatex($bipolarPattern));
            }

            // Bipolar test pattern conversion
            $bipolarTestPattern = [];
            foreach ($testPattern as $val) {
                $bipolarTestPattern[] = $val == 0 ? -1 : ($val > 0 ? 1 : -1);
            }

            $testStep = sprintf('\\text{Prueba } S: %s \\rightarrow %s', $this->vectorToLatex($testPattern), $this->vectorToLatex($bipolarTestPattern));

            $steps[] = [
                'title' => 'Paso 1: Codificación Bipolar',
                'description' => 'Las redes Hopfield operan utilizando valores bipolares (1 y -1). Convertimos cualquier valor 0 a -1 en los patrones de entrenamiento y de prueba que ingresaste.',
                'formula' => '\\(f(x) = \\begin{cases} 1 & \\text{si } x > 0 \\\\ -1 & \\text{si } x \\le 0 \\end{cases}\\)',
                'substitution' => '\\(' . implode(' \\quad | \\quad ', $conversionSteps) . ' \\quad | \\quad ' . $testStep . '\\)',
                'result' => 'Codificación bipolar lista',
                'type' => 'input',
                'data' => [
                    'original_patterns' => $patterns,
                    'bipolar_patterns' => $bipolarPatterns,
                    'original_test_pattern' => $testPattern,
                    'bipolar_test_pattern' => $bipolarTestPattern
                ]
            ];

            // 2. Weight Matrix Training (Hebbian Learning): W = sum( pT * p )
            // Initialize N x N matrix with zeros
            $rawW = array_fill(0, $n, array_fill(0, $n, 0));
            $matrixTerms = [];

            foreach ($bipolarPatterns as $pIdx => $p) {
                $pMatrix = [];
                for ($i = 0; $i < $n; $i++) {
                    $row = [];
                    for ($j = 0; $j < $n; $j++) {
                        $val = $p[$i] * $p[$j];
                        $rawW[$i][$j] += $val;
                        $row[] = $val;
                    }
                    $pMatrix[] = $row;
                }
                $matrixTerms[] = $this->matrixToLatex($pMatrix);
            }

            // If only 1 pattern is provided, avoid showing A = A summation redundancy
            $substitutionStr = count($matrixTerms) > 1
                ? '\\(W = ' . implode(' + ', $matrixTerms) . ' = ' . $this->matrixToLatex($rawW) . '\\)'
                : '\\(W = ' . $matrixTerms[0] . '\\)';

            $steps[] = [
                'title' => 'Paso 2: Regla de Hebb (Matriz de Pesos Inicial)',
                'description' => 'Calculamos la matriz de pesos inicial multiplicando cada patrón por sí mismo. En la fórmula, \(p^{(m)}\) representa los patrones de entrenamiento que ingresaste, y \((p^{(m)})^T\) es su versión transpuesta (columna). Al multiplicar una columna por una fila (producto externo), obtenemos una matriz de pesos para cada patrón; luego sumamos todas las matrices de pesos individuales.',
                'formula' => '\\(W = \\sum (p^{(m)})^T \\times p^{(m)}\\)',
                'substitution' => $substitutionStr,
                'result' => 'Matriz inicial calculada',
                'type' => 'matrix',
                'data' => [
                    'matrix' => $rawW
                ]
            ];
        }

        // 3. Remove auto-connections (diagonal set to 0)
        $w = $rawW;
        for ($i = 0; $i < $n; $i++) {
            $w[$i][$i] = 0;
        }

        $steps[] = [
            'title' => 'Paso 3: Eliminar Auto-conexiones (Diagonal a Cero)',
            'description' => 'Puesto que una neurona no debe auto-influenciarse ni conectarse consigo misma, forzamos los valores de la diagonal principal de nuestra matriz a cero (es decir, \(w_{ii} = 0\)).',
            'formula' => '\\(w_{ii} = 0\\)',
            'substitution' => '\\(' . $this->matrixToLatex($rawW) . ' \\xrightarrow{w_{ii}=0} ' . $this->matrixToLatex($w) . '\\)',
            'result' => 'Matriz de pesos final lista',
            'type' => 'matrix',
            'data' => [
                'matrix_with_diagonal' => $rawW,
                'matrix_final' => $w
            ]
        ];

        // 4. Test pattern state updates
        $currentState = $bipolarTestPattern;
        $iterations = [];
        $stable = false;

        // Calculate initial energy
        $initialEnergy = $this->calculateEnergy($w, $currentState);
        $steps[] = [
            'title' => 'Paso 4: Estado Inicial y Energía',
            'description' => 'Evaluamos el patrón de prueba S actual y calculamos su nivel de energía inicial en la red. En la fórmula, \(w_{ij}\) representa los pesos de la matriz y \(s_i, s_j\) son los elementos del patrón de prueba.',
            'formula' => '\\(E = -\\frac{1}{2} \\sum_{i \\ne j} w_{ij} s_i s_j\\)',
            'substitution' => sprintf('\\(E = -0.5 \\cdot (%s)\\)', $this->getEnergySubstitutionStr($w, $currentState)),
            'result' => sprintf('\\(\\color{#8b5cf6}{E} = %s\\)', $this->format($initialEnergy)),
            'type' => 'final',
            'data' => [
                'state' => $currentState,
                'energy' => $initialEnergy
            ]
        ];

        $previousEnergy = $initialEnergy;

        for ($iter = 1; $iter <= $maxIterations; $iter++) {
            $stateBefore = $currentState;
            $updatedState = $currentState;
            $iterSteps = [];

            if ($updateMode === 'sync') {
                // Synchronous update: H = S * W, then S = sign(H)
                $h = array_fill(0, $n, 0);
                $substitutions = [];
                $outputs = [];

                for ($i = 0; $i < $n; $i++) {
                    $sum = 0;
                    $parts = [];
                    for ($j = 0; $j < $n; $j++) {
                        $sum += $currentState[$j] * $w[$i][$j];
                        $parts[] = sprintf("(%d)(%d)", $currentState[$j], $w[$i][$j]);
                    }
                    $h[$i] = $sum;
                    $substitutions[] = sprintf('h_%d = %s = %d', $i + 1, implode(' + ', $parts), $sum);

                    // Sign function (retains state if 0)
                    $sign = $sum > 0 ? 1 : ($sum < 0 ? -1 : $currentState[$i]);
                    $updatedState[$i] = $sign;
                    $outputs[] = sprintf('s_%d = \\text{sign}(%d) = %d', $i + 1, $sum, $sign);
                }

                $iterSteps[] = [
                    'title' => "Iteración $iter (Síncrona): Actualización General",
                    'description' => 'Multiplicamos el estado actual por la matriz de pesos completa y aplicamos la función de activación signo.',
                    'formula' => '\\(H = S \\cdot W \\quad | \\quad S_{nuevo} = \\text{sign}(H)\\)',
                    'substitution' => '\\(' . $this->vectorToLatex($currentState) . ' \\cdot ' . $this->matrixToLatex($w) . ' = ' . $this->vectorToLatex($h) . '\\)',
                    'result' => '\\(S_{nuevo} = \\text{sign}(' . $this->vectorToLatex($h) . ') = ' . $this->vectorToLatex($updatedState) . '\\)',
                    'type' => 'update',
                    'data' => [
                        'iteration' => $iter,
                        'state_before' => $stateBefore,
                        'h_values' => $h,
                        'state_after' => $updatedState
                    ]
                ];
            } else {
                // Asynchronous update: neuron by neuron sequentially
                for ($i = 0; $i < $n; $i++) {
                    $neuronBefore = $updatedState[$i];
                    $sum = 0;
                    $parts = [];
                    for ($j = 0; $j < $n; $j++) {
                        $sum += $updatedState[$j] * $w[$i][$j];
                        $parts[] = sprintf("(%d)(%d)", $updatedState[$j], $w[$i][$j]);
                    }
                    $sign = $sum > 0 ? 1 : ($sum < 0 ? -1 : $updatedState[$i]);
                    $updatedState[$i] = $sign;

                    $changedText = $neuronBefore === $sign ? 'No cambió' : sprintf('Cambió de %d a %d', $neuronBefore, $sign);

                    $iterSteps[] = [
                        'title' => "Iteración $iter (Asíncrona) - Neurona " . ($i + 1),
                        'description' => sprintf("Calculamos la entrada neta para la neurona %d usando los estados actuales de las demás neuronas y la actualizamos en el acto.", $i + 1),
                        'formula' => '\\(h_i = \\sum w_{ij} s_j \\quad | \\quad s_i = \\text{sign}(h_i)\\)',
                        'substitution' => sprintf('\\(h_%d = %s = %d \\rightarrow \\text{sign}(%d)\\)', $i + 1, implode(' + ', $parts), $sum, $sum),
                        'result' => sprintf('\\(s_%d = %d \\quad \\text{(%s)}\\)', $i + 1, $sign, $changedText),
                        'type' => 'update',
                        'data' => [
                            'iteration' => $iter,
                            'neuron' => $i + 1,
                            'sum' => $sum,
                            'value_before' => $neuronBefore,
                            'value_after' => $sign,
                            'state_current' => $updatedState
                        ]
                    ];
                }
            }

            $currentState = $updatedState;
            $energy = $this->calculateEnergy($w, $currentState);

            // Append iteration steps to main steps list
            foreach ($iterSteps as $st) {
                $steps[] = $st;
            }

            $energySubstitution = sprintf('\\(E = -0.5 \\cdot (%s)\\)', $this->getEnergySubstitutionStr($w, $currentState));
            $steps[] = [
                'title' => "Iteración $iter - Cálculo de Energía",
                'description' => sprintf("Calculamos la energía del estado en la iteración %d.", $iter),
                'formula' => '\\(E = -\\frac{1}{2} \\sum_{i \\ne j} w_{ij} s_i s_j\\)',
                'substitution' => $energySubstitution,
                'result' => sprintf('\\(\\color{#8b5cf6}{E} = %s\\)', $this->format($energy)),
                'type' => 'final',
                'data' => [
                    'iteration' => $iter,
                    'state' => $currentState,
                    'energy' => $energy
                ]
            ];

            $iterations[] = [
                'iteration' => $iter,
                'state_before' => $stateBefore,
                'state_after' => $currentState,
                'energy' => $energy
            ];

            // Check stability (if state did not change in this iteration)
            if ($currentState === $stateBefore) {
                $stable = true;
                $steps[] = [
                    'title' => "Convergencia Alcanzada",
                    'description' => sprintf("El estado no cambió durante la iteración %d. Por lo tanto, la red ha convergido a un estado estable (mínimo de energía).", $iter),
                    'formula' => '\\(S_{nuevo} = S_{anterior}\\)',
                    'substitution' => '',
                    'result' => 'Estado estable alcanzado',
                    'type' => 'final',
                    'data' => []
                ];
                break;
            }

            $previousEnergy = $energy;
        }

        // Determine if pattern matches one of the trained patterns
        $matchedPatternIndex = -1;
        $matchPercentage = 0.0;

        if ($customMode === 'matlab') {
            if ($currentState === $bipolarPt) {
                $matchedPatternIndex = 0;
            }
            $matches = 0;
            for ($i = 0; $i < $n; $i++) {
                if ($currentState[$i] === $bipolarPt[$i]) {
                    $matches++;
                }
            }
            $matchPercentage = ($matches / $n) * 100;
        } else {
            foreach ($bipolarPatterns as $idx => $bp) {
                if ($currentState === $bp) {
                    $matchedPatternIndex = $idx;
                    break;
                }
            }
            // Calculate matching percentage with the first training pattern (or the matched one)
            $comparePattern = $matchedPatternIndex !== -1 ? $bipolarPatterns[$matchedPatternIndex] : $bipolarPatterns[0];
            $matches = 0;
            for ($i = 0; $i < $n; $i++) {
                if ($currentState[$i] === $comparePattern[$i]) {
                    $matches++;
                }
            }
            $matchPercentage = ($matches / $n) * 100;
        }

        if ($customMode === 'matlab') {
            // Check if the final state is a fixed point (stable)
            $hFinal = array_fill(0, $n, 0);
            $signFinal = array_fill(0, $n, 0);
            for ($i = 0; $i < $n; $i++) {
                $sum = 0;
                for ($j = 0; $j < $n; $j++) {
                    $sum += $currentState[$j] * $w[$i][$j];
                }
                $signFinal[$i] = $sum > 0 ? 1 : ($sum < 0 ? -1 : $currentState[$i]);
            }
            $stable = ($currentState === $signFinal);

            $matchingText = sprintf(
                "Coincidencia con el patrón original Pt: %s%%. %s",
                $this->format($matchPercentage),
                $stable && $matchPercentage === 100.0 ? "✓ La red recuperó correctamente el patrón original." : "✗ La red NO recuperó completamente el patrón original."
            );
        } else {
            $matchingText = $matchedPatternIndex !== -1
                ? sprintf("¡El patrón final coincide perfectamente con el Patrón Entrenado %d!", $matchedPatternIndex + 1)
                : "El patrón final es un estado estable, pero no coincide con ninguno de los patrones originales entrenados (estado espurio).";
        }

        $steps[] = [
            'title' => 'Resumen y Estabilidad de Hopfield',
            'description' => sprintf("El entrenamiento de prueba ha concluido. El patrón final es %s. %s", $stable ? 'ESTABLE' : 'INESTABLE', $matchingText),
            'formula' => '',
            'substitution' => '',
            'result' => $stable ? 'Estable' : 'No converge',
            'type' => 'final',
            'data' => [
                'stable' => $stable,
                'matched_pattern_index' => $matchedPatternIndex,
                'final_state' => $currentState,
                'final_energy' => $this->calculateEnergy($w, $currentState)
            ]
        ];

        return [
            'weights' => $w,
            'stable' => $stable,
            'final_state' => $currentState,
            'matched_pattern_index' => $matchedPatternIndex,
            'steps' => $steps,
            'iterations' => $iterations
        ];
    }

    /**
     * Calculate network energy for a given state.
     * E = -0.5 * sum_{i != j} w_{ij} * s_i * s_j
     */
    private function calculateEnergy(array $w, array $s): float
    {
        $n = count($s);
        $sum = 0.0;
        for ($i = 0; $i < $n; $i++) {
            for ($j = 0; $j < $n; $j++) {
                if ($i !== $j) {
                    $sum += $w[$i][$j] * $s[$i] * $s[$j];
                }
            }
        }
        return -0.5 * $sum;
    }

    /**
     * Get a string showing substitution for energy calculation.
     */
    private function getEnergySubstitutionStr(array $w, array $s): string
    {
        $n = count($s);
        $terms = [];
        for ($i = 0; $i < $n; $i++) {
            for ($j = $i + 1; $j < $n; $j++) {
                $weight = $w[$i][$j];
                $terms[] = sprintf('2(%d)(%d)(%d)', $weight, $s[$i], $s[$j]);
            }
        }
        return implode(' + ', $terms);
    }

    /**
     * Convert a 2D array matrix to a LaTeX bmatrix string.
     */
    private function matrixToLatex(array $matrix): string
    {
        $rows = [];
        foreach ($matrix as $row) {
            $rows[] = implode(' & ', array_map(fn($val) => $this->format($val), $row));
        }
        return '\\begin{bmatrix} ' . implode(' \\\\ ', $rows) . ' \\end{bmatrix}';
    }

    /**
     * Convert a 1D array vector to a LaTeX bmatrix string (row vector).
     */
    private function vectorToLatex(array $vec): string
    {
        return '\\begin{bmatrix} ' . implode(' & ', array_map(fn($val) => $this->format($val), $vec)) . ' \\end{bmatrix}';
    }

    /**
     * Convert a 1D array vector to a LaTeX bmatrix string (column vector).
     */
    private function vectorToLatexCol(array $vec): string
    {
        return '\\begin{bmatrix} ' . implode(' \\\\ ', array_map(fn($val) => $this->format($val), $vec)) . ' \\end{bmatrix}';
    }

    /**
     * Format a float number to trim trailing zeros.
     * Max 4 decimal places.
     */
    private function format(float $val): string
    {
        $rounded = round($val, 4);
        if ($rounded == 0.0) {
            return '0';
        }
        return (string) (float) $rounded;
    }
}
