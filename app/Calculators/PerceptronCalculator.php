<?php

namespace App\Calculators;

class PerceptronCalculator
{
    /**
     * Train the perceptron and return detailed step-by-step calculations.
     *
     * @param array{
     *     num_inputs: int,
     *     training_data: array<array<float>>,
     *     initial_weights: array<float>,
     *     bias: float,
     *     learning_rate: float,
     *     epochs: int,
     *     activation_fn: string,
     *     threshold?: float
     * } $config
     * @return array<string, mixed>
     */
    public function train(array $config): array
    {
        $numInputs = (int) $config['num_inputs'];
        $trainingData = $config['training_data']; // List of [x1, x2, ..., y]
        $weights = array_map('floatval', $config['initial_weights']);
        $bias = (float) $config['bias'];
        $eta = (float) $config['learning_rate'];
        $maxEpochs = (int) $config['epochs'];
        $activationFn = $config['activation_fn'];
        $threshold = isset($config['threshold']) ? (float) $config['threshold'] : 0.0;

        $steps = [];
        $epochsDetails = [];
        $converged = false;
        $epochsRun = 0;

        // Log the initial state
        $initialWeightsStr = implode(', ', array_map(fn($w, $i) => "\\(\\color{#3b82f6}{w_" . ($i + 1) . "} = " . $this->format($w) . "\\)", $weights, array_keys($weights)));
        $steps[] = [
            'title' => 'Inicialización de Parámetros',
            'description' => 'Comenzamos inicializando la red con los datos provistos. El Perceptrón consta de entradas con sus respectivos pesos sinápticos, un sesgo (bias) que actúa como término constante, y una tasa de aprendizaje (\\(\\eta\\)) que controla el tamaño del ajuste en cada error.',
            'formula' => 'Variables: \\(\\color{#f97316}{x_i}\\) (entradas), \\(\\color{#3b82f6}{w_i}\\) (pesos), \\(\\color{#10b981}{w_0}\\) (sesgo), \\(\\color{#06b6d4}{\\eta}\\) (tasa de aprendizaje)',
            'substitution' => sprintf(
                'Entradas del sistema: %d <br> Pesos iniciales: %s <br> Sesgo (bias): \\(\\color{#10b981}{w_0} = %s\\) <br> Tasa de aprendizaje: \\(\\color{#06b6d4}{\\eta} = %s\\) <br> Límite de Épocas: %d <br> Función de activación: %s',
                $numInputs,
                $initialWeightsStr,
                $this->format($bias),
                $this->format($eta),
                $maxEpochs,
                ucfirst($activationFn)
            ),
            'result' => 'Inicialización completa',
            'type' => 'input',
            'data' => [
                'weights' => $weights,
                'bias' => $bias,
                'learning_rate' => $eta,
                'activation_function' => $activationFn,
                'threshold' => $threshold
            ]
        ];

        for ($epoch = 1; $epoch <= $maxEpochs; $epoch++) {
            $epochErrors = 0;
            $epochSamples = [];

            $steps[] = [
                'title' => "Inicio de Época $epoch",
                'description' => "Comenzamos la época $epoch procesando cada una de las muestras en la tabla de entrenamiento de forma secuencial.",
                'formula' => '',
                'substitution' => '',
                'result' => "Época $epoch",
                'type' => 'info',
                'data' => ['epoch' => $epoch]
            ];

            foreach ($trainingData as $sampleIndex => $sample) {
                // Extract inputs and expected output
                $x = array_slice($sample, 0, $numInputs);
                $expected = (float) end($sample);

                // 1. Calculate ponderated sum (z)
                // z = w0 + w1*x1 + w2*x2 + ...
                $sumTermParts = [];
                $sumTermValues = [];
                $ponderatedSum = $bias; // w0 * 1

                $sumTermParts[] = "\\color{#10b981}{w_0}";
                $sumTermValues[] = sprintf("\\color{#10b981}{%s}", $this->format($bias));

                for ($i = 0; $i < $numInputs; $i++) {
                    $w = $weights[$i];
                    $xi = $x[$i];
                    $ponderatedSum += $w * $xi;
                    
                    $sumTermParts[] = sprintf("\\color{#3b82f6}{w_%d} \\cdot \\color{#f97316}{x_%d}", $i + 1, $i + 1);
                    $sumTermValues[] = sprintf("(\\color{#3b82f6}{%s})(\\color{#f97316}{%s})", $this->format($w), $this->format($xi));
                }

                $formulaZ = "\\(\\color{#8b5cf6}{z} = " . implode(" + ", $sumTermParts) . "\\)";
                $substitutionZ = "\\(\\color{#8b5cf6}{z} = " . implode(" + ", $sumTermValues) . "\\)";
                
                // Detailed explanation of numbers and origins
                $explanationDetails = sprintf(
                    "Calculamos la entrada neta acumulada \\(\\color{#8b5cf6}{z}\\) de la neurona multiplicando cada entrada por su peso y sumando el sesgo inicial:<br>" .
                    "1. Partimos del **sesgo (bias)**: \\(\\color{#10b981}{w_0 = %s}\\).<br>" .
                    implode("<br>", array_map(function($i) use ($x, $weights) {
                        return sprintf(
                            "%d. Multiplicamos la entrada \\(\\color{#f97316}{x_%d = %s}\\) por su peso \\(\\color{#3b82f6}{w_%d = %s}\\), dando un aporte de \\(%s\\).",
                            $i + 2, $i + 1, $this->format($x[$i]), $i + 1, $this->format($weights[$i]), $this->format($x[$i] * $weights[$i])
                        );
                    }, array_keys($x))) . "<br>" .
                    "Al sumar todo, obtenemos el valor final de la entrada neta \\(\\color{#8b5cf6}{z = %s}\\).",
                    $this->format($bias),
                    $this->format($ponderatedSum)
                );

                $steps[] = [
                    'title' => "Época $epoch - Muestra " . ($sampleIndex + 1) . ": Suma Ponderada",
                    'description' => $explanationDetails,
                    'formula' => $formulaZ,
                    'substitution' => $substitutionZ,
                    'result' => sprintf("\\(\\color{#8b5cf6}{z} = %s\\)", $this->format($ponderatedSum)),
                    'type' => 'sum',
                    'data' => [
                        'epoch' => $epoch,
                        'sample' => $sampleIndex + 1,
                        'inputs' => $x,
                        'weights' => $weights,
                        'bias' => $bias,
                        'z' => $ponderatedSum
                    ]
                ];

                // 2. Activation function
                $activated = 0.0;
                $activationFormula = '';
                $activationSubstitution = '';
                $activationDescription = '';

                switch ($activationFn) {
                    case 'sign':
                        if ($ponderatedSum > 0) {
                            $activated = 1.0;
                        } elseif ($ponderatedSum < 0) {
                            $activated = -1.0;
                        } else {
                            $activated = 0.0;
                        }
                        $activationFormula = '\\(\\color{#8b5cf6}{ŷ} = \\text{sign}(z) = \\begin{cases} 1 & \\text{si } \\color{#8b5cf6}{z} > 0 \\\\ 0 & \\text{si } \\color{#8b5cf6}{z} = 0 \\\\ -1 & \\text{si } \\color{#8b5cf6}{z} < 0 \\end{cases}\\)';
                        $activationSubstitution = sprintf('\\(\\color{#8b5cf6}{ŷ} = \\text{sign}(\\color{#8b5cf6}{%s})\\)', $this->format($ponderatedSum));
                        $activationDescription = sprintf(
                            "Aplicamos la función de activación **Signo** sobre la entrada neta \\(\\color{#8b5cf6}{z = %s}\\). " .
                            "Como el valor es %s a cero, la salida calculada por la neurona es \\(\\color{#8b5cf6}{ŷ = %s}\\).",
                            $this->format($ponderatedSum),
                            $ponderatedSum > 0 ? "mayor" : ($ponderatedSum < 0 ? "menor" : "igual"),
                            $this->format($activated)
                        );
                        break;
                    case 'sigmoid':
                        $rawSigmoid = 1.0 / (1.0 + exp(-$ponderatedSum));
                        $activated = $rawSigmoid >= 0.5 ? 1.0 : 0.0;
                        $activationFormula = '\\(\\color{#8b5cf6}{ŷ} = \\sigma(\\color{#8b5cf6}{z}) = \\frac{1}{1 + e^{-\\color{#8b5cf6}{z}}} \\ge 0.5 \\Rightarrow 1\\)';
                        $activationSubstitution = sprintf('\\(\\sigma(%s) = \\frac{1}{1 + e^{-(%s)}} = %s\\)', $this->format($ponderatedSum), $this->format($ponderatedSum), $this->format($rawSigmoid));
                        $activationDescription = sprintf(
                            "Aplicamos la función de activación **Sigmoide**. Al pasar la entrada neta \\(\\color{#8b5cf6}{z = %s}\\) " .
                            "obtenemos el valor continuo \\(%s\\). Al aplicar el umbral de decisión estándar (\\(\\ge 0.5\\)), la salida " .
                            "calculada final (clase binaria) se activa como \\(\\color{#8b5cf6}{ŷ = %s}\\).",
                            $this->format($ponderatedSum),
                            $this->format($rawSigmoid),
                            $this->format($activated)
                        );
                        break;
                    case 'step':
                    default:
                        $activated = $ponderatedSum >= $threshold ? 1.0 : 0.0;
                        $activationFormula = sprintf('\\(\\color{#8b5cf6}{ŷ} = \\begin{cases} 1 & \\text{si } \\color{#8b5cf6}{z} \\ge \\color{#10b981}{\\theta} \\\\ 0 & \\text{si } \\color{#8b5cf6}{z} < \\color{#10b981}{\\theta} \\end{cases} \\quad (\\color{#10b981}{\\theta = %s})\\)', $this->format($threshold));
                        $activationSubstitution = sprintf('\\(\\color{#8b5cf6}{ŷ} = %s \\ge \\color{#10b981}{%s}\\)', $this->format($ponderatedSum), $this->format($threshold));
                        $activationDescription = sprintf(
                            "Aplicamos la función **Escalón Unitario** con un umbral \\(\\color{#10b981}{\\theta = %s}\\). " .
                            "Comparamos la entrada neta \\(\\color{#8b5cf6}{z = %s}\\) contra el umbral: " .
                            "como \\(z\\) es %s que el umbral, la neurona devuelve \\(\\color{#8b5cf6}{ŷ = %s}\\).",
                            $this->format($threshold),
                            $this->format($ponderatedSum),
                            $ponderatedSum >= $threshold ? "mayor o igual" : "menor",
                            $this->format($activated)
                        );
                        break;
                }

                $steps[] = [
                    'title' => "Época $epoch - Muestra " . ($sampleIndex + 1) . ": Función de Activación",
                    'description' => $activationDescription,
                    'formula' => $activationFormula,
                    'substitution' => $activationSubstitution,
                    'result' => sprintf("\\(\\color{#8b5cf6}{ŷ} = %s\\)", $this->format($activated)),
                    'type' => 'activation',
                    'data' => [
                        'epoch' => $epoch,
                        'sample' => $sampleIndex + 1,
                        'activated' => $activated,
                        'activation_function' => $activationFn
                    ]
                ];

                // 3. Calculate error
                // e = expected - activated
                $error = $expected - $activated;
                $errorDescription = sprintf(
                    "Comparamos la salida esperada o valor real (\\(\\color{#6366f1}{y = %s}\\)) con la salida calculada por la neurona " .
                    "(\\(\\color{#8b5cf6}{ŷ = %s}\\)). El error se obtiene restando la salida de la neurona al valor objetivo:<br>" .
                    "\\(\\color{#ef4444}{e} = \\color{#6366f1}{y} - \\color{#8b5cf6}{ŷ} = %s - %s = %s\\).<br>" .
                    ($error == 0 
                        ? "¡El error es cero! La neurona ha clasificado esta muestra de forma correcta, por lo tanto, no se alteran los pesos sinápticos."
                        : "Dado que el error es diferente de cero (\\(\\color{#ef4444}{e = %s}\\)), la neurona cometió una clasificación incorrecta y es necesario ajustar los pesos sinápticos y el sesgo para reducir el error."
                    ),
                    $this->format($expected),
                    $this->format($activated),
                    $this->format($expected),
                    $this->format($activated),
                    $this->format($error),
                    $this->format($error)
                );

                $steps[] = [
                    'title' => "Época $epoch - Muestra " . ($sampleIndex + 1) . ": Cálculo del Error",
                    'description' => $errorDescription,
                    'formula' => '\\(\\color{#ef4444}{e} = \\color{#6366f1}{y} - \\color{#8b5cf6}{ŷ}\\)',
                    'substitution' => sprintf('\\(\\color{#ef4444}{e} = \\color{#6366f1}{%s} - \\color{#8b5cf6}{%s}\\)', $this->format($expected), $this->format($activated)),
                    'result' => sprintf('\\(\\color{#ef4444}{e} = %s\\)', $this->format($error)),
                    'type' => 'error',
                    'data' => [
                        'epoch' => $epoch,
                        'sample' => $sampleIndex + 1,
                        'expected' => $expected,
                        'calculated' => $activated,
                        'error' => $error
                    ]
                ];

                $weightsBefore = $weights;
                $biasBefore = $bias;
                $weightsUpdated = false;

                if ($error != 0.0) {
                    $epochErrors++;
                    $weightsUpdated = true;

                    // 4. Update weights
                    // w_i = w_i + eta * e * x_i
                    $updateStepDetails = [];
                    for ($i = 0; $i < $numInputs; $i++) {
                        $deltaW = $eta * $error * $x[$i];
                        $oldW = $weights[$i];
                        $weights[$i] += $deltaW;
                        
                        $updateStepDetails[] = sprintf(
                            '\\(\\color{#3b82f6}{w_%d^{(nuevo)}} = \\color{#3b82f6}{%s} + (\\color{#06b6d4}{%s})(\\color{#ef4444}{%s})(\\color{#f97316}{%s}) = \\color{#3b82f6}{%s}\\)',
                            $i + 1,
                            $this->format($oldW),
                            $this->format($eta),
                            $this->format($error),
                            $this->format($x[$i]),
                            $this->format($weights[$i])
                        );
                    }

                    // Update bias: w0 = w0 + eta * e * 1
                    $oldBias = $bias;
                    $deltaBias = $eta * $error * 1.0;
                    $bias += $deltaBias;

                    $biasUpdateStr = sprintf(
                        '\\(\\color{#10b981}{w_0^{(nuevo)}} = \\color{#10b981}{%s} + (\\color{#06b6d4}{%s})(\\color{#ef4444}{%s})(1) = \\color{#10b981}{%s}\\)',
                        $this->format($oldBias),
                        $this->format($eta),
                        $this->format($error),
                        $this->format($bias)
                    );

                    $updateExplanation = sprintf(
                        "Para corregir el error (\\(\\color{#ef4444}{e = %s}\\)), aplicamos la regla de aprendizaje del Perceptrón. " .
                        "Ajustamos cada peso sumando la tasa de aprendizaje (\\(\\color{#06b6d4}{\\eta = %s}\\)) multiplicada por el error y la entrada correspondiente:<br>" .
                        implode("<br>", array_map(function($i) use ($x, $weightsBefore, $eta, $error) {
                            return sprintf(
                                "- Para \\(\\color{#3b82f6}{w_%d}\\): Peso anterior (\\(\\color{#3b82f6}{%s}\\)) + (Tasa \\(\\color{#06b6d4}{%s}\\) \\(\cdot\\) Error \\(\\color{#ef4444}{%s}\\) \\(\cdot\\) Entrada \\(\\color{#f97316}{x_%d = %s}\\)).",
                                $i + 1, $this->format($weightsBefore[$i]), $this->format($eta), $this->format($error), $i + 1, $this->format($x[$i])
                            );
                        }, array_keys($x))) . "<br>" .
                        "- Para el sesgo \\(\\color{#10b981}{w_0}\\): Sesgo anterior (\\(\\color{#10b981}{%s}\\)) + (Tasa \\(\\color{#06b6d4}{%s}\\) \\(\cdot\\) Error \\(\\color{#ef4444}{%s}\\) \\(\cdot\\) entrada implícita \\(1\\)).",
                        $this->format($error),
                        $this->format($eta),
                        $this->format($oldBias),
                        $this->format($eta),
                        $this->format($error)
                    );

                    $steps[] = [
                        'title' => "Época $epoch - Muestra " . ($sampleIndex + 1) . ": Actualización de Pesos",
                        'description' => $updateExplanation,
                        'formula' => '\\(\\color{#3b82f6}{w_i^{(nuevo)}} = \\color{#3b82f6}{w_i} + \\color{#06b6d4}{\\eta} \\cdot \\color{#ef4444}{e} \\cdot \\color{#f97316}{x_i}\\) &nbsp;&nbsp;y&nbsp;&nbsp; \\(\\color{#10b981}{w_0^{(nuevo)}} = \\color{#10b981}{w_0} + \\color{#06b6d4}{\\eta} \\cdot \\color{#ef4444}{e}\\)',
                        'substitution' => implode("<br>", $updateStepDetails) . "<br>" . $biasUpdateStr,
                        'result' => 'Pesos actualizados',
                        'type' => 'update',
                        'data' => [
                            'weights_before' => $weightsBefore,
                            'weights_after' => $weights,
                            'bias_before' => $biasBefore,
                            'bias_after' => $bias,
                            'error' => $error,
                            'learning_rate' => $eta
                        ]
                    ];
                } else {
                    $steps[] = [
                        'title' => "Época $epoch - Muestra " . ($sampleIndex + 1) . ": Sin Cambios",
                        'description' => "Como el error es cero, los pesos y el sesgo no requieren modificación en esta muestra, y se mantienen constantes para la siguiente iteración.",
                        'formula' => '',
                        'substitution' => '',
                        'result' => 'Se mantienen pesos',
                        'type' => 'neutral',
                        'data' => [
                            'weights' => $weights,
                            'bias' => $bias
                        ]
                    ];
                }

                $epochSamples[] = [
                    'sample_index' => $sampleIndex + 1,
                    'x' => $x,
                    'y' => $expected,
                    'z' => $ponderatedSum,
                    'y_calculated' => $activated,
                    'error' => $error,
                    'weights_before' => $weightsBefore,
                    'weights_after' => $weights,
                    'bias_before' => $biasBefore,
                    'bias_after' => $bias,
                    'weights_updated' => $weightsUpdated
                ];
            }

            $epochsDetails[] = [
                'epoch' => $epoch,
                'errors' => $epochErrors,
                'samples' => $epochSamples,
                'final_weights' => $weights,
                'final_bias' => $bias
            ];

            $steps[] = [
                'title' => "Fin de Época $epoch",
                'description' => sprintf("La época %d finalizó tras evaluar todo el conjunto de entrenamiento, reportando un total de %d errores de clasificación.", $epoch, $epochErrors),
                'formula' => '',
                'substitution' => '',
                'result' => sprintf("Errores en época: %d", $epochErrors),
                'type' => 'epoch_end',
                'data' => [
                    'epoch' => $epoch,
                    'errors' => $epochErrors,
                    'weights' => $weights,
                    'bias' => $bias
                ]
            ];

            if ($epochErrors === 0) {
                $converged = true;
                $epochsRun = $epoch;
                break;
            }
        }

        if ($epochsRun === 0) {
            $epochsRun = $maxEpochs;
        }

        // Add summary step
        $finalWeightsStr = implode(', ', array_map(fn($w, $i) => "\\(w_" . ($i + 1) . " = " . $this->format($w) . "\\)", $weights, array_keys($weights)));
        $steps[] = [
            'title' => 'Resumen del Entrenamiento',
            'description' => $converged 
                ? sprintf("¡El perceptrón se estabilizó exitosamente en la época %d! Todos los patrones de entrada se clasifican correctamente y la red ha aprendido su frontera de decisión.", $epochsRun)
                : sprintf("El perceptrón finalizó el entrenamiento tras alcanzar el límite de %d épocas, sin lograr la separabilidad lineal completa para este conjunto de datos.", $maxEpochs),
            'formula' => '\\(\\color{#8b5cf6}{z} = \\color{#10b981}{w_0} + \\color{#3b82f6}{w_1}\\color{#f97316}{x_1} + \\dots + \\color{#3b82f6}{w_n}\\color{#f97316}{x_n} \\ge \\color{#10b981}{\\theta} \\Rightarrow 1\\)',
            'substitution' => sprintf('Frontera final: \\(\\color{#8b5cf6}{z} = %s + %s\\)', $this->format($bias), implode(" + ", array_map(fn($w, $i) => sprintf("%s x_%d", $this->format($w), $i + 1), $weights, array_keys($weights)))),
            'result' => $converged ? 'Convergencia alcanzada' : 'Límite de épocas superado',
            'type' => 'final',
            'data' => [
                'converged' => $converged,
                'epochs_run' => $epochsRun,
                'final_weights' => $weights,
                'final_bias' => $bias,
                'weights_str' => $finalWeightsStr
            ]
        ];

        return [
            'converged' => $converged,
            'epochs_run' => $epochsRun,
            'final_weights' => $weights,
            'final_bias' => $bias,
            'steps' => $steps,
            'epochs_details' => $epochsDetails
        ];
    }

    private function format(float $val): string
    {
        $rounded = round($val, 4);
        if ($rounded == 0.0) {
            return '0';
        }
        return (string) (float) $rounded;
    }
}
