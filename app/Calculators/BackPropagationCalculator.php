<?php

namespace App\Calculators;

class BackPropagationCalculator
{
    /**
     * Compute backpropagation for a single neuron (2 inputs) over multiple epochs.
     *
     * @param array{
     *     x1: float,
     *     x2: float,
     *     y: float,
     *     w1: float,
     *     w2: float,
     *     b: float,
     *     eta: float,
     *     epochs: int
     * } $config
     * @return array<string, mixed>
     */
    public function computeSingleNeuron(array $config): array
    {
        $x1 = (float) $config['x1'];
        $x2 = (float) $config['x2'];
        $y = (float) $config['y'];
        $w1 = (float) $config['w1'];
        $w2 = (float) $config['w2'];
        $b = (float) $config['b'];
        $eta = (float) $config['eta'];
        $epochs = (int) $config['epochs'];

        $steps = [];
        $epochsDetails = [];
        $currentW1 = $w1;
        $currentW2 = $w2;
        $currentB = $b;
        $errorTrend = []; // To check if error goes up or down

        $initialWeightsStr = implode(', ', array_map(fn($w, $i) => "\\(\\color{#3b82f6}{w_" . ($i + 1) . "} = " . $this->format($w) . "\\)", [$currentW1, $currentW2], array_keys([$currentW1, $currentW2])));
        $steps[] = [
            'title' => 'Inicialización de Backpropagation (Una Neurona)',
            'description' => 'Inicializamos la neurona con los datos que ingresaste. Aquí configuramos las entradas, el resultado que queremos predecir (objetivo \\(y\\)), los pesos de conexión iniciales (\\(w_1, w_2\\)), el sesgo inicial (\\(b\\)) y la velocidad de aprendizaje (tasa de aprendizaje \\(\\eta\\)).',
            'formula' => 'Datos: \\(\\color{#f97316}{x_1}\\), \\(\\color{#f97316}{x_2}\\), \\(\\color{#6366f1}{y}\\) (objetivo), \\(\\color{#3b82f6}{w_1}\\), \\(\\color{#3b82f6}{w_2}\\), \\(\\color{#10b981}{b}\\) (sesgo), \\(\\color{#06b6d4}{\\eta}\\) (aprendizaje)',
            'substitution' => sprintf(
                'Entradas: \\(\\color{#f97316}{x_1} = %s\\), \\(\\color{#f97316}{x_2} = %s\\) | Objetivo: \\(\\color{#6366f1}{y} = %s\\) | Pesos: %s | Sesgo: \\(\\color{#10b981}{b} = %s\\) | \\(\\color{#06b6d4}{\\eta} = %s\\) | Épocas = %d',
                $this->format($x1), $this->format($x2), $this->format($y), $initialWeightsStr, $this->format($currentB), $this->format($eta), $epochs
            ),
            'result' => 'Inicialización completa',
            'type' => 'input',
            'data' => [
                'x1' => $x1,
                'x2' => $x2,
                'y' => $y,
                'w1' => $w1,
                'w2' => $w2,
                'b' => $b,
                'eta' => $eta,
                'epochs' => $epochs
            ]
        ];

        for ($epoch = 1; $epoch <= $epochs; $epoch++) {
            $weightsBefore = [$currentW1, $currentW2];
            $biasBefore = $currentB;

            // 1. Forward propagation
            // z = w1*x1 + w2*x2 + b
            $z = ($currentW1 * $x1) + ($currentW2 * $x2) + $currentB;
            $steps[] = [
                'title' => "Época $epoch - Paso 1: Suma Ponderada (z)",
                'description' => sprintf(
                    "Calculamos la suma ponderada (\\(z\\)) multiplicando cada una de las entradas por sus pesos correspondientes y sumando el sesgo. Es decir, medimos cuánta señal llega a la neurona:<br>" .
                    "1. Partimos del **sesgo (bias)** inicial: \\(\\color{#10b981}{b = %s}\\).<br>" .
                    "2. Multiplicamos la entrada \\(\\color{#f97316}{x_1 = %s}\\) por su peso \\(\\color{#3b82f6}{w_1 = %s}\\), aportando \\(%s\\).<br>" .
                    "3. Multiplicamos la entrada \\(\\color{#f97316}{x_2 = %s}\\) por su peso \\(\\color{#3b82f6}{w_2 = %s}\\), aportando \\(%s\\).<br>" .
                    "Al sumar todo, obtenemos la señal neta de entrada de la neurona: \\(\\color{#8b5cf6}{z = %s}\\).",
                    $this->format($currentB),
                    $this->format($x1), $this->format($currentW1), $this->format($x1 * $currentW1),
                    $this->format($x2), $this->format($currentW2), $this->format($x2 * $currentW2),
                    $this->format($z)
                ),
                'formula' => '\\(\\color{#8b5cf6}{z} = \\color{#3b82f6}{w_1}\\color{#f97316}{x_1} + \\color{#3b82f6}{w_2}\\color{#f97316}{x_2} + \\color{#10b981}{b}\\)',
                'substitution' => sprintf('\\(\\color{#8b5cf6}{z} = (\\color{#3b82f6}{%s})(\\color{#f97316}{%s}) + (\\color{#3b82f6}{%s})(\\color{#f97316}{%s}) + \\color{#10b981}{%s}\\)', $this->format($currentW1), $this->format($x1), $this->format($currentW2), $this->format($x2), $this->format($currentB)),
                'result' => sprintf('\\(\\color{#8b5cf6}{z} = %s\\)', $this->format($z)),
                'type' => 'sum',
                'data' => [
                    'epoch' => $epoch,
                    'w1' => $currentW1,
                    'w2' => $currentW2,
                    'b' => $currentB,
                    'z' => $z
                ]
            ];

            // 2. Activation: y_calc = sigmoid(z)
            $yCalc = 1.0 / (1.0 + exp(-$z));
            $steps[] = [
                'title' => "Época $epoch - Paso 2: Activación Sigmoide (ŷ)",
                'description' => sprintf("Tomamos la señal recibida (\\(z = %s\\)) y la pasamos por la función Sigmoide. Esto convierte cualquier número en un valor de probabilidad entre 0 y 1, que representa nuestra salida calculada (\\(ŷ = %s\\)).", $this->format($z), $this->format($yCalc)),
                'formula' => '\\(\\color{#8b5cf6}{ŷ} = \\sigma(\\color{#8b5cf6}{z}) = \\frac{1}{1 + e^{-\\color{#8b5cf6}{z}}}\\)',
                'substitution' => sprintf('\\(\\color{#8b5cf6}{ŷ} = \\frac{1}{1 + e^{-(\\color{#8b5cf6}{%s})}}\\)', $this->format($z)),
                'result' => sprintf('\\(\\color{#8b5cf6}{ŷ} = %s\\)', $this->format($yCalc)),
                'type' => 'activation',
                'data' => [
                    'epoch' => $epoch,
                    'y_calculated' => $yCalc
                ]
            ];

            // 3. Calculate error
            $error = $y - $yCalc;
            $loss = 0.5 * pow($error, 2);
            $errorTrend[] = abs($error);

            $steps[] = [
                'title' => "Época $epoch - Paso 3: Cálculo del Error",
                'description' => sprintf("Medimos qué tan lejos estamos de la respuesta correcta. Restamos la salida calculada por la neurona (\\(ŷ = %s\\)) del valor real esperado (\\(y = %s\\)).", $this->format($yCalc), $this->format($y)),
                'formula' => '\\(\\color{#ef4444}{error} = \\color{#6366f1}{y} - \\color{#8b5cf6}{ŷ}\\)',
                'substitution' => sprintf('\\(\\color{#ef4444}{error} = \\color{#6366f1}{%s} - \\color{#8b5cf6}{%s}\\)', $this->format($y), $this->format($yCalc)),
                'result' => sprintf('\\(\\color{#ef4444}{error} = %s\\)', $this->format($error)),
                'type' => 'error',
                'data' => [
                    'epoch' => $epoch,
                    'error' => $error,
                    'loss' => $loss
                ]
            ];

            // 4. Derivative of sigmoid: s_prime = y_calc * (1 - y_calc)
            $sPrime = $yCalc * (1.0 - $yCalc);
            $steps[] = [
                'title' => "Época $epoch - Paso 4: Derivada de la Sigmoide",
                'description' => sprintf("Calculamos la sensibilidad o pendiente de la curva de activación (la derivada de la sigmoide) usando nuestra salida \\(ŷ = %s\\). Esto nos dice qué tan sensible es la neurona a pequeños cambios en su entrada.", $this->format($yCalc)),
                'formula' => "\\(\\sigma'(\\color{#8b5cf6}{z}) = \\color{#8b5cf6}{ŷ} (1 - \\color{#8b5cf6}{ŷ})\\)",
                'substitution' => sprintf("\\(\\sigma'(\\color{#8b5cf6}{z}) = \\color{#8b5cf6}{%s} (1 - \\color{#8b5cf6}{%s})\\)", $this->format($yCalc), $this->format($yCalc)),
                'result' => sprintf("\\(\\sigma'(\\color{#8b5cf6}{z}) = %s\\)", $this->format($sPrime)),
                'type' => 'activation',
                'data' => [
                    'epoch' => $epoch,
                    'derivative' => $sPrime
                ]
            ];

            // 5. Delta: delta = error * s_prime
            $delta = $error * $sPrime;
            $steps[] = [
                'title' => "Época $epoch - Paso 5: Cálculo de Delta (δ)",
                'description' => sprintf("Calculamos el factor de ajuste final o gradiente local (\\(\\delta\\)). Para ello, multiplicamos el error que cometimos (\\(e = %s\\)) por la sensibilidad de la sigmoide (\\(\\sigma' = %s\\)). Esto determina la magnitud del cambio que necesitamos hacer.", $this->format($error), $this->format($sPrime)),
                'formula' => '\\(\\delta = \\color{#ef4444}{error} \\cdot \\sigma\'(\\color{#8b5cf6}{z})\\)',
                'substitution' => sprintf('\\(\\delta = (\\color{#ef4444}{%s}) \\cdot (\\color{#8b5cf6}{%s})\\)', $this->format($error), $this->format($sPrime)),
                'result' => sprintf('\\(\\delta = %s\\)', $this->format($delta)),
                'type' => 'delta',
                'data' => [
                    'epoch' => $epoch,
                    'delta' => $delta
                ]
            ];

            // 6. Update weights and bias: w = w - eta * delta * x
            $oldW1 = $currentW1;
            $oldW2 = $currentW2;
            $oldB = $currentB;

            $currentW1 = $oldW1 - $eta * $delta * $x1;
            $currentW2 = $oldW2 - $eta * $delta * $x2;
            $currentB = $oldB - $eta * $delta;

            $comparisonText = '';
            if ($epoch > 1) {
                $prevError = $errorTrend[$epoch - 2];
                $currError = $errorTrend[$epoch - 1];
                if ($currError < $prevError) {
                    $comparisonText = sprintf('El valor absoluto del error bajó de %s a %s (¡El entrenamiento está funcionando!).', $this->format($prevError), $this->format($currError));
                } elseif ($currError > $prevError) {
                    $comparisonText = sprintf('El valor absoluto del error subió de %s a %s. Revisa el valor de la tasa de aprendizaje \\(\\eta\\).', $this->format($prevError), $this->format($currError));
                } else {
                    $comparisonText = 'El error se mantiene igual.';
                }
            } else {
                $comparisonText = 'Ésta es la primera época, el error inicial servirá de referencia.';
            }

            $steps[] = [
                'title' => "Época $epoch - Paso 6: Actualización de Pesos y Sesgo",
                'description' => "Ajustamos los pesos (\\(w_1, w_2\\)) y el sesgo (\\(b\\)) para reducir el error de predicción en el futuro. Multiplicamos la tasa de aprendizaje (\\(\\eta\\)) por el ajuste requerido (\\(\\delta\\)) y por la señal de entrada respectiva. " . $comparisonText,
                'formula' => '\\(\\color{#3b82f6}{w_i^{(nuevo)}} = \\color{#3b82f6}{w_i} - \\color{#06b6d4}{\\eta} \\cdot \\delta \\cdot \\color{#f97316}{x_i}\\) &nbsp;&nbsp;y&nbsp;&nbsp; \\(\\color{#10b981}{b^{(nuevo)}} = \\color{#10b981}{b} - \\color{#06b6d4}{\\eta} \\cdot \\delta\\)',
                'substitution' => sprintf(
                    'w1 = %s - (%s)(%s)(%s) = %s | w2 = %s - (%s)(%s)(%s) = %s | b = %s - (%s)(%s) = %s',
                    $this->format($oldW1), $this->format($eta), $this->format($delta), $this->format($x1), $this->format($currentW1),
                    $this->format($oldW2), $this->format($eta), $this->format($delta), $this->format($x2), $this->format($currentW2),
                    $this->format($oldB), $this->format($eta), $this->format($delta), $this->format($currentB)
                ),
                'result' => sprintf('\\(\\color{#3b82f6}{w_1} = %s, \\color{#3b82f6}{w_2} = %s, \\color{#10b981}{b} = %s\\)', $this->format($currentW1), $this->format($currentW2), $this->format($currentB)),
                'type' => 'update',
                'data' => [
                    'epoch' => $epoch,
                    'weights_before' => $weightsBefore,
                    'weights_after' => [$currentW1, $currentW2],
                    'bias_before' => $biasBefore,
                    'bias_after' => $currentB,
                    'error_comparison' => $comparisonText
                ]
            ];

            $epochsDetails[] = [
                'epoch' => $epoch,
                'z' => $z,
                'y_calculated' => $yCalc,
                'error' => $error,
                'loss' => $loss,
                'delta' => $delta,
                'weights_before' => $weightsBefore,
                'weights_after' => [$currentW1, $currentW2],
                'bias_before' => $biasBefore,
                'bias_after' => $currentB
            ];
        }

        $steps[] = [
            'title' => 'Resumen de Backpropagation (Una Neurona)',
            'description' => '¡El entrenamiento de la neurona simple ha concluido! Aquí puedes ver los pesos de conexión finales y el sesgo con los que la red aprendió a clasificar la muestra.',
            'formula' => '\\(\\color{#8b5cf6}{ŷ} = \\sigma(\\color{#3b82f6}{w_1}\\color{#f97316}{x_1} + \\color{#3b82f6}{w_2}\\color{#f97316}{x_2} + \\color{#10b981}{b})\\)',
            'substitution' => '',
            'result' => sprintf('\\(\\color{#3b82f6}{w_1} = %s, \\color{#3b82f6}{w_2} = %s, \\color{#10b981}{b} = %s\\) &nbsp;&nbsp;|&nbsp;&nbsp; \\(\\color{#ef4444}{Error} = %s\\)', $this->format($currentW1), $this->format($currentW2), $this->format($currentB), $this->format(end($epochsDetails)['error'])),
            'type' => 'final',
            'data' => [
                'final_w1' => $currentW1,
                'final_w2' => $currentW2,
                'final_b' => $currentB,
                'epochs_details' => $epochsDetails
            ]
        ];

        return [
            'final_w1' => $currentW1,
            'final_w2' => $currentW2,
            'final_b' => $currentB,
            'y_calculated' => end($epochsDetails)['y_calculated'],
            'error' => end($epochsDetails)['error'],
            'steps' => $steps,
            'epochs_details' => $epochsDetails
        ];
    }

    /**
     * Compute backpropagation for a Multi-Layer Perceptron (2 inputs, 2 hidden, 1 output) over 1 epoch.
     *
     * @param array{
     *     x1: float,
     *     x2: float,
     *     y: float,
     *     w11: float,
     *     w12: float,
     *     w21: float,
     *     w22: float,
     *     v1: float,
     *     v2: float,
     *     b1: float,
     *     b2: float,
     *     b0: float,
     *     eta: float
     * } $config
     * @return array<string, mixed>
     */
    public function computeMLP(array $config): array
    {
        $x1 = (float) $config['x1'];
        $x2 = (float) $config['x2'];
        $y = (float) $config['y'];

        // Hidden Layer weights (w11, w12 connect to h1; w21, w22 connect to h2)
        $w11 = (float) $config['w11'];
        $w12 = (float) $config['w12'];
        $w21 = (float) $config['w21'];
        $w22 = (float) $config['w22'];

        // Output Layer weights (v1, v2 connect h1, h2 to output)
        $v1 = (float) $config['v1'];
        $v2 = (float) $config['v2'];

        // Biases
        $b1 = (float) $config['b1']; // hidden neuron 1 bias
        $b2 = (float) $config['b2']; // hidden neuron 2 bias
        $b0 = (float) $config['b0']; // output neuron bias

        $eta = (float) $config['eta'];

        $steps = [];

        // Cast values for UI
        $steps[] = [
            'title' => 'Inicialización de Red Multicapa (2-2-1)',
            'description' => 'Inicializamos la red neuronal multicapa (MLP) con los datos ingresados. Esta red tiene una capa de entrada con 2 valores (\\(x_1, x_2\\)), una capa oculta con 2 neuronas (\\(h_1, h_2\\)) y una capa de salida con 1 neurona (\\(ŷ\\)).',
            'formula' => 'Modelo: Entrada \\rightarrow Capa Oculta \\rightarrow Capa de Salida',
            'substitution' => sprintf(
                'Entradas: \\(x_1 = %s, x_2 = %s\\) | Objetivo: \\(y = %s\\)<br>' .
                'Pesos Ocultos: \\(w_{11} = %s, w_{12} = %s, w_{21} = %s, w_{22} = %s\\)<br>' .
                'Pesos Salida: \\(v_1 = %s, v_2 = %s\\)<br>' .
                'Sesgos: \\(b_1 = %s, b_2 = %s, b_0 = %s\\) | Tasa de aprendizaje: \\(\\eta = %s\\)',
                $this->format($x1), $this->format($x2), $this->format($y),
                $this->format($w11), $this->format($w12), $this->format($w21), $this->format($w22),
                $this->format($v1), $this->format($v2),
                $this->format($b1), $this->format($b2), $this->format($b0),
                $this->format($eta)
            ),
            'result' => 'Inicialización completa',
            'type' => 'input',
            'data' => [
                'inputs' => ['x1' => $x1, 'x2' => $x2],
                'expected' => $y,
                'weights_hidden' => ['w11' => $w11, 'w12' => $w12, 'w21' => $w21, 'w22' => $w22],
                'weights_output' => ['v1' => $v1, 'v2' => $v2],
                'biases' => ['b1' => $b1, 'b2' => $b2, 'b0' => $b0],
                'learning_rate' => $eta
            ]
        ];

        // 1. Forward pass
        // Hidden Neuron 1
        $z1 = ($w11 * $x1) + ($w12 * $x2) + $b1;
        $h1 = 1.0 / (1.0 + exp(-$z1));
        $steps[] = [
            'title' => 'Paso 1.1: Activación Oculta h1',
            'description' => 'Calculamos el estado de la primera neurona oculta (\\(h_1\\)). Primero multiplicamos las entradas por sus pesos correspondientes y sumamos el sesgo (\\(b_1\\)) para obtener la señal neta (\\(z_1\\)). Luego aplicamos la función Sigmoide para obtener su activación final.',
            'formula' => '\\(\\color{#8b5cf6}{z_1} = \\color{#3b82f6}{w_{11}} \\color{#f97316}{x_1} + \\color{#3b82f6}{w_{12}} \\color{#f97316}{x_2} + \\color{#10b981}{b_1} \\quad | \\quad \\color{#6366f1}{h_1} = \\sigma(\\color{#8b5cf6}{z_1})\\)',
            'substitution' => sprintf('z1 = (\\color{#3b82f6}{%s})(\\color{#f97316}{%s}) + (\\color{#3b82f6}{%s})(\\color{#f97316}{%s}) + \\color{#10b981}{%s} = %s | h1 = \\frac{1}{1 + e^{-(%s)}}', $this->format($w11), $this->format($x1), $this->format($w12), $this->format($x2), $this->format($b1), $this->format($z1), $this->format($z1)),
            'result' => sprintf('h1 = %s', $this->format($h1)),
            'type' => 'sum',
            'data' => ['z1' => $z1, 'h1' => $h1]
        ];

        // Hidden Neuron 2
        $z2 = ($w21 * $x1) + ($w22 * $x2) + $b2;
        $h2 = 1.0 / (1.0 + exp(-$z2));
        $steps[] = [
            'title' => 'Paso 1.2: Activación Oculta h2',
            'description' => 'Calculamos el estado de la segunda neurona oculta (\\(h_2\\)) de forma idéntica, multiplicando las entradas por sus pesos sinápticos y sumando el sesgo (\\(b_2\\)) antes de aplicar la sigmoide.',
            'formula' => '\\(\\color{#8b5cf6}{z_2} = \\color{#3b82f6}{w_{21}} \\color{#f97316}{x_1} + \\color{#3b82f6}{w_{22}} \\color{#f97316}{x_2} + \\color{#10b981}{b_2} \\quad | \quad \\color{#6366f1}{h_2} = \\sigma(\\color{#8b5cf6}{z_2})\\)',
            'substitution' => sprintf('z2 = (\\color{#3b82f6}{%s})(\\color{#f97316}{%s}) + (\\color{#3b82f6}{%s})(\\color{#f97316}{%s}) + \\color{#10b981}{%s} = %s | h2 = \\frac{1}{1 + e^{-(%s)}}', $this->format($w21), $this->format($x1), $this->format($w22), $this->format($x2), $this->format($b2), $this->format($z2), $this->format($z2)),
            'result' => sprintf('h2 = %s', $this->format($h2)),
            'type' => 'sum',
            'data' => ['z2' => $z2, 'h2' => $h2]
        ];

        // Output Neuron
        $z0 = ($v1 * $h1) + ($v2 * $h2) + $b0;
        $yCalc = 1.0 / (1.0 + exp(-$z0));
        $steps[] = [
            'title' => 'Paso 1.3: Activación Salida ŷ',
            'description' => 'Calculamos el resultado final predicho por la red (\\(ŷ\\)). Usamos las salidas de las neuronas ocultas (\\(h_1, h_2\\)) como si fueran entradas, las multiplicamos por los pesos de salida (\\(v_1, v_2\\)), sumamos el sesgo de salida (\\(b_0\\)) para obtener \\(z_0\\), y aplicamos la sigmoide.',
            'formula' => '\\(\\color{#8b5cf6}{z_0} = \\color{#3b82f6}{v_1} \\color{#6366f1}{h_1} + \\color{#3b82f6}{v_2} \\color{#6366f1}{h_2} + \\color{#10b981}{b_0} \\quad | \quad \\color{#8b5cf6}{ŷ} = \\sigma(\\color{#8b5cf6}{z_0})\\)',
            'substitution' => sprintf('z0 = (\\color{#3b82f6}{%s})(\\color{#6366f1}{%s}) + (\\color{#3b82f6}{%s})(\\color{#6366f1}{%s}) + \\color{#10b981}{%s} = %s | ŷ = \\frac{1}{1 + e^{-(%s)}}', $this->format($v1), $this->format($h1), $this->format($v2), $this->format($h2), $this->format($b0), $this->format($z0), $this->format($z0)),
            'result' => sprintf('ŷ = %s', $this->format($yCalc)),
            'type' => 'activation',
            'data' => ['z0' => $z0, 'y_calculated' => $yCalc]
        ];

        // 2. Error calculation
        $error = $y - $yCalc;
        $steps[] = [
            'title' => 'Paso 2: Cálculo del Error',
            'description' => 'Calculamos el error de predicción en la capa de salida restando el valor calculado por la red (\\(ŷ\\)) del valor real esperado (\\(y\\)).',
            'formula' => '\\(\\color{#ef4444}{error} = \\color{#6366f1}{y} - \\color{#8b5cf6}{ŷ}\\)',
            'substitution' => sprintf('error = \\color{#6366f1}{%s} - \\color{#8b5cf6}{%s}', $this->format($y), $this->format($yCalc)),
            'result' => sprintf('error = %s', $this->format($error)),
            'type' => 'error',
            'data' => ['error' => $error]
        ];

        // 3. Backpropagation Pass
        // Output derivative and delta_0
        $sPrime0 = $yCalc * (1.0 - $yCalc);
        $delta0 = $error * $sPrime0;
        $steps[] = [
            'title' => 'Paso 3.1: Delta de Salida (δ0)',
            'description' => 'Calculamos el factor de ajuste (\\(\\delta_0\\)) para la capa de salida. Multiplicamos el error cometido por la derivada de la sigmoide en el valor predicho. Esto nos indica cuánto influyó la salida en el error total.',
            'formula' => "\\(\\sigma'(\\color{#8b5cf6}{z_0}) = \\color{#8b5cf6}{ŷ} (1 - \\color{#8b5cf6}{ŷ}) \\quad | \quad \\delta_0 = \\color{#ef4444}{error} \\cdot \\sigma'(\\color{#8b5cf6}{z_0})\\)",
            'substitution' => sprintf("\\sigma'(z0) = %s (1 - %s) = %s | \\delta0 = (%s)(%s)", $this->format($yCalc), $this->format($yCalc), $this->format($sPrime0), $this->format($error), $this->format($sPrime0)),
            'result' => sprintf('\\delta0 = %s', $this->format($delta0)),
            'type' => 'delta',
            'data' => ['s_prime0' => $sPrime0, 'delta0' => $delta0]
        ];

        // Hidden Layer derivatives and deltas
        $sPrime1 = $h1 * (1.0 - $h1);
        $delta1 = $delta0 * $v1 * $sPrime1;
        $steps[] = [
            'title' => 'Paso 3.2: Delta Oculto 1 (δ1)',
            'description' => 'Retropropagamos el error hacia la primera neurona oculta para calcular su factor de ajuste (\\(\\delta_1\\)). Multiplicamos el factor de ajuste de salida (\\(\\delta_0\\)) por el peso de conexión (\\(v_1\\)) y por la sensibilidad (derivada) de la activación de \\(h_1\\).',
            'formula' => "\\(\\sigma'(\\color{#8b5cf6}{z_1}) = \\color{#6366f1}{h_1} (1 - \\color{#6366f1}{h_1}) \\quad | \quad \\delta_1 = \\delta_0 \\cdot \\color{#3b82f6}{v_1} \\cdot \\sigma'(\\color{#8b5cf6}{z_1})\\)",
            'substitution' => sprintf("\\sigma'(z1) = %s (1 - %s) = %s | \\delta1 = (%s)(%s)(%s)", $this->format($h1), $this->format($h1), $this->format($sPrime1), $this->format($delta0), $this->format($v1), $this->format($sPrime1)),
            'result' => sprintf('\\delta1 = %s', $this->format($delta1)),
            'type' => 'delta',
            'data' => ['s_prime1' => $sPrime1, 'delta1' => $delta1]
        ];

        $sPrime2 = $h2 * (1.0 - $h2);
        $delta2 = $delta0 * $v2 * $sPrime2;
        $steps[] = [
            'title' => 'Paso 3.3: Delta Oculto 2 (δ2)',
            'description' => 'Retropropagamos el error hacia la segunda neurona oculta para calcular su factor de ajuste (\\(\\delta_2\\)) de la misma manera, multiplicando \\(\\delta_0\\) por el peso de salida (\\(v_2\\)) y por la derivada de \\(h_2\\).',
            'formula' => "\\(\\sigma'(\\color{#8b5cf6}{z_2}) = \\color{#6366f1}{h_2} (1 - \\color{#6366f1}{h_2}) \\quad | \quad \\delta_2 = \\delta_0 \\cdot \\color{#3b82f6}{v_2} \\cdot \\sigma'(\\color{#8b5cf6}{z_2})\\)",
            'substitution' => sprintf("\\sigma'(z2) = %s (1 - %s) = %s | \\delta2 = (%s)(%s)(%s)", $this->format($h2), $this->format($h2), $this->format($sPrime2), $this->format($delta0), $this->format($v2), $this->format($sPrime2)),
            'result' => sprintf('\\delta2 = %s', $this->format($delta2)),
            'type' => 'delta',
            'data' => ['s_prime2' => $sPrime2, 'delta2' => $delta2]
        ];

        // 4. Update Weights and Biases
        // Output Weights Update: v_i = v_i - eta * delta_0 * h_i
        $newV1 = $v1 - $eta * $delta0 * $h1;
        $newV2 = $v2 - $eta * $delta0 * $h2;
        $newB0 = $b0 - $eta * $delta0;

        $steps[] = [
            'title' => 'Paso 4.1: Actualización de Pesos de Salida (Capa Oculta a Salida)',
            'description' => 'Actualizamos los pesos de la capa de salida (\\(v_1, v_2\\)) y su sesgo (\\(b_0\\)). Multiplicamos la tasa de aprendizaje (\\(\\eta\\)) por el factor de ajuste de salida (\\(\\delta_0\\)) y por la activación de cada neurona oculta, y ajustamos los valores previos.',
            'formula' => '\\(\\color{#3b82f6}{v_i^{(nuevo)}} = \\color{#3b82f6}{v_i} - \\color{#06b6d4}{\\eta} \\cdot \\delta_0 \\cdot \\color{#6366f1}{h_i}\\) &nbsp;&nbsp;y&nbsp;&nbsp; \\(\\color{#10b981}{b_0^{(nuevo)}} = \\color{#10b981}{b_0} - \\color{#06b6d4}{\\eta} \\cdot \\delta_0\\)',
            'substitution' => sprintf(
                'v1 = %s - (%s)(%s)(%s) = %s | v2 = %s - (%s)(%s)(%s) = %s | b0 = %s - (%s)(%s) = %s',
                $this->format($v1), $this->format($eta), $this->format($delta0), $this->format($h1), $this->format($newV1),
                $this->format($v2), $this->format($eta), $this->format($delta0), $this->format($h2), $this->format($newV2),
                $this->format($b0), $this->format($eta), $this->format($delta0), $this->format($newB0)
            ),
            'result' => sprintf('\\(\\color{#3b82f6}{v_1} = %s, \\color{#3b82f6}{v_2} = %s, \\color{#10b981}{b_0} = %s\\)', $this->format($newV1), $this->format($newV2), $this->format($newB0)),
            'type' => 'update',
            'data' => [
                'v1_before' => $v1,
                'v1_after' => $newV1,
                'v2_before' => $v2,
                'v2_after' => $newV2,
                'b0_before' => $b0,
                'b0_after' => $newB0
            ]
        ];

        // Hidden Layer 1 Weights Update: w1i = w1i - eta * delta_1 * xi
        $newW11 = $w11 - $eta * $delta1 * $x1;
        $newW12 = $w12 - $eta * $delta1 * $x2;
        $newB1 = $b1 - $eta * $delta1;

        $steps[] = [
            'title' => 'Paso 4.2: Actualización de Pesos de h1 (Capa de Entrada a h1)',
            'description' => 'Actualizamos los pesos de entrada hacia la primera neurona oculta (\\(w_{11}, w_{12}\\)) y su sesgo (\\(b_1\\)). Multiplicamos la tasa de aprendizaje (\\(\\eta\\)) por el factor de ajuste (\\(\\delta_1\\)) y por los valores de entrada de la red, y modificamos los valores previos.',
            'formula' => '\\(\\color{#3b82f6}{w_{1i}^{(nuevo)}} = \\color{#3b82f6}{w_{1i}} - \\color{#06b6d4}{\\eta} \\cdot \\delta_1 \\cdot \\color{#f97316}{x_i}\\) &nbsp;&nbsp;y&nbsp;&nbsp; \\(\\color{#10b981}{b_1^{(nuevo)}} = \\color{#10b981}{b_1} - \\color{#06b6d4}{\\eta} \\cdot \\delta_1\\)',
            'substitution' => sprintf(
                'w11 = %s - (%s)(%s)(%s) = %s | w12 = %s - (%s)(%s)(%s) = %s | b1 = %s - (%s)(%s) = %s',
                $this->format($w11), $this->format($eta), $this->format($delta1), $this->format($x1), $this->format($newW11),
                $this->format($w12), $this->format($eta), $this->format($delta1), $this->format($x2), $this->format($newW12),
                $this->format($b1), $this->format($eta), $this->format($delta1), $this->format($newB1)
            ),
            'result' => sprintf('\\(\\color{#3b82f6}{w_{11}} = %s, \\color{#3b82f6}{w_{12}} = %s, \\color{#10b981}{b_1} = %s\\)', $this->format($newW11), $this->format($newW12), $this->format($newB1)),
            'type' => 'update',
            'data' => [
                'w11_before' => $w11,
                'w11_after' => $newW11,
                'w12_before' => $w12,
                'w12_after' => $newW12,
                'b1_before' => $b1,
                'b1_after' => $newB1
            ]
        ];

        // Hidden Layer 2 Weights Update: w2i = w2i - eta * delta_2 * xi
        $newW21 = $w21 - $eta * $delta2 * $x1;
        $newW22 = $w22 - $eta * $delta2 * $x2;
        $newB2 = $b2 - $eta * $delta2;

        $steps[] = [
            'title' => 'Paso 4.3: Actualización de Pesos de h2 (Capa de Entrada a h2)',
            'description' => 'Actualizamos los pesos de entrada hacia la segunda neurona oculta (\\(w_{21}, w_{22}\\)) y su sesgo (\\(b_2\\)) de forma idéntica, usando el factor de ajuste (\\(\\delta_2\\)) y las señales de entrada de la red.',
            'formula' => '\\(\\color{#3b82f6}{w_{2i}^{(nuevo)}} = \\color{#3b82f6}{w_{2i}} - \\color{#06b6d4}{\\eta} \\cdot \\delta_2 \\cdot \\color{#f97316}{x_i}\\) &nbsp;&nbsp;y&nbsp;&nbsp; \\(\\color{#10b981}{b_2^{(nuevo)}} = \\color{#10b981}{b_2} - \\color{#06b6d4}{\\eta} \\cdot \\delta_2\\)',
            'substitution' => sprintf(
                'w21 = %s - (%s)(%s)(%s) = %s | w22 = %s - (%s)(%s)(%s) = %s | b2 = %s - (%s)(%s) = %s',
                $this->format($w21), $this->format($eta), $this->format($delta2), $this->format($x1), $this->format($newW21),
                $this->format($w22), $this->format($eta), $this->format($delta2), $this->format($x2), $this->format($newW22),
                $this->format($b2), $this->format($eta), $this->format($delta2), $this->format($newB2)
            ),
            'result' => sprintf('\\(\\color{#3b82f6}{w_{21}} = %s, \\color{#3b82f6}{w_{22}} = %s, \\color{#10b981}{b_2} = %s\\)', $this->format($newW21), $this->format($newW22), $this->format($newB2)),
            'type' => 'update',
            'data' => [
                'w21_before' => $w21,
                'w21_after' => $newW21,
                'w22_before' => $w22,
                'w22_after' => $newW22,
                'b2_before' => $b2,
                'b2_after' => $newB2
            ]
        ];

        $steps[] = [
            'title' => 'Resumen de Backpropagation MLP',
            'description' => '¡Hemos completado un ciclo completo de Backpropagation para esta muestra! La red ha ajustado todos sus pesos y sesgos para clasificar mejor esta entrada en la siguiente iteración.',
            'formula' => '',
            'substitution' => '',
            'result' => 'Iteración finalizada',
            'type' => 'final',
            'data' => [
                'new_weights_hidden' => ['w11' => $newW11, 'w12' => $newW12, 'w21' => $newW21, 'w22' => $newW22],
                'new_weights_output' => ['v1' => $newV1, 'v2' => $newV2],
                'new_biases' => ['b1' => $newB1, 'b2' => $newB2, 'b0' => $newB0],
                'y_calculated' => $yCalc,
                'error' => $error
            ]
        ];

        return [
            'z1' => $z1,
            'h1' => $h1,
            'z2' => $z2,
            'h2' => $h2,
            'z0' => $z0,
            'y_calculated' => $yCalc,
            'error' => $error,
            'delta0' => $delta0,
            'delta1' => $delta1,
            'delta2' => $delta2,
            'new_weights_hidden' => ['w11' => $newW11, 'w12' => $newW12, 'w21' => $newW21, 'w22' => $newW22],
            'new_weights_output' => ['v1' => $newV1, 'v2' => $newV2],
            'new_biases' => ['b1' => $newB1, 'b2' => $newB2, 'b0' => $newB0],
            'steps' => $steps
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
