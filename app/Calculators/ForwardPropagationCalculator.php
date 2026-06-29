<?php

namespace App\Calculators;

class ForwardPropagationCalculator
{
    /**
     * Compute forward propagation for a Multi-Layer Perceptron and return step-by-step details.
     *
     * @param array{
     *     num_inputs: int,
     *     layer_sizes: array<int>, // e.g. [2, 1] means 2 hidden, 1 output
     *     weights: array<array<array<float>>>, // weights[layer][neuron][input]
     *     biases: array<array<float>>, // biases[layer][neuron]
     *     activation_fns: array<string>, // activation_fns[layer] e.g. ['sigmoid', 'sigmoid']
     *     inputs_data: array<float> // size num_inputs
     * } $config
     * @return array<string, mixed>
     */
    public function compute(array $config): array
    {
        $numInputs = (int) $config['num_inputs'];
        $layerSizes = $config['layer_sizes'];
        $weights = $config['weights'];
        $biases = $config['biases'];
        $activationFns = $config['activation_fns'];
        $inputsData = array_map('floatval', $config['inputs_data']);

        $steps = [];
        $layerOutputs = [$inputsData]; // Layer 0 outputs are the network inputs
        $networkArchitecture = [];

        // Log the network architecture
        $networkArchitecture[] = [
            'type' => 'input',
            'neurons' => $numInputs,
            'label' => 'Capa de Entrada'
        ];
        foreach ($layerSizes as $layerIndex => $size) {
            $networkArchitecture[] = [
                'type' => $layerIndex === count($layerSizes) - 1 ? 'output' : 'hidden',
                'neurons' => $size,
                'label' => $layerIndex === count($layerSizes) - 1 ? 'Capa de Salida' : "Capa Oculta " . ($layerIndex + 1),
                'activation' => $activationFns[$layerIndex]
            ];
        }

        $inputsStr = implode(', ', array_map(fn($val, $idx) => "\\(\\color{#f97316}{x_" . ($idx + 1) . "} = " . $this->format($val) . "\\)", $inputsData, array_keys($inputsData)));
        $steps[] = [
            'title' => 'Inicialización de la Red',
            'description' => 'Establecemos los valores de entrada y la arquitectura de la red neuronal.',
            'formula' => 'Vector de Entrada: \\(X = [\\color{#f97316}{x_1}, \\color{#f97316}{x_2}, \\dots, \\color{#f97316}{x_n}]\\)',
            'substitution' => sprintf(
                'Entradas: %s | Arquitectura: Entrada (%d) -> %s',
                $inputsStr,
                $numInputs,
                implode(' -> ', array_map(fn($size, $idx) => sprintf('%s (%d)', $idx === count($layerSizes) - 1 ? 'Salida' : 'Oculta', $size), $layerSizes, array_keys($layerSizes)))
            ),
            'result' => 'Red inicializada',
            'type' => 'input',
            'data' => [
                'inputs' => $inputsData,
                'architecture' => $networkArchitecture
            ]
        ];

        // Process layer by layer
        foreach ($layerSizes as $layerIndex => $neuronsInLayer) {
            $layerInputs = $layerOutputs[$layerIndex];
            $currentLayerOutputs = [];

            $activationFn = $activationFns[$layerIndex];
            $layerLabel = $layerIndex === count($layerSizes) - 1 ? 'Capa de Salida' : "Capa Oculta " . ($layerIndex + 1);

            $steps[] = [
                'title' => "Procesando $layerLabel",
                'description' => "Calculamos la salida de cada neurona en la $layerLabel utilizando las salidas de la capa anterior como entradas.",
                'formula' => '',
                'substitution' => '',
                'result' => $layerLabel,
                'type' => 'info',
                'data' => ['layer' => $layerIndex + 1]
            ];

            for ($neuronIndex = 0; $neuronIndex < $neuronsInLayer; $neuronIndex++) {
                $neuronWeights = array_map('floatval', $weights[$layerIndex][$neuronIndex]);
                $neuronBias = (float) $biases[$layerIndex][$neuronIndex];

                // 1. Calculate ponderated sum: z = b + w1*a1 + w2*a2 + ...
                $ponderatedSum = $neuronBias;
                $sumTermsParts = ["\\color{#10b981}{b_{" . ($neuronIndex + 1) . "}^{(" . ($layerIndex + 1) . ")}}"];
                $sumTermsValues = [sprintf("\\color{#10b981}{%s}", $this->format($neuronBias))];

                for ($i = 0; $i < count($layerInputs); $i++) {
                    $w = $neuronWeights[$i];
                    $val = $layerInputs[$i];
                    $ponderatedSum += $w * $val;

                    $sumTermsParts[] = sprintf("\\color{#3b82f6}{w_{%d,%d}^{(%d)}} \\cdot \\color{#f97316}{a_%d^{(%d)}}", $neuronIndex + 1, $i + 1, $layerIndex + 1, $i + 1, $layerIndex);
                    $sumTermsValues[] = sprintf("(\\color{#3b82f6}{%s})(\\color{#f97316}{%s})", $this->format($w), $this->format($val));
                }

                $formulaZ = sprintf("\\(\\color{#8b5cf6}{z_{%d}^{(%d)}} = %s\\)", $neuronIndex + 1, $layerIndex + 1, implode(" + ", $sumTermsParts));
                $substitutionZ = sprintf("\\(\\color{#8b5cf6}{z_{%d}^{(%d)}} = %s\\)", $neuronIndex + 1, $layerIndex + 1, implode(" + ", $sumTermsValues));

                // Detailed explanation of numbers and origins
                $explanationDetails = sprintf(
                    "Calculamos la suma ponderada para la neurona %d de la %s:<br>" .
                    "1. Partimos del **sesgo (bias)**: \\(\\color{#10b981}{b = %s}\\).<br>" .
                    implode("<br>", array_map(function($i) use ($layerInputs, $neuronWeights) {
                        return sprintf(
                            "%d. Multiplicamos la entrada anterior \\(\\color{#f97316}{a_%d = %s}\\) por su peso \\(\\color{#3b82f6}{w = %s}\\), aportando \\(%s\\).",
                            $i + 2, $i + 1, $this->format($layerInputs[$i]), $this->format($neuronWeights[$i]), $this->format($layerInputs[$i] * $neuronWeights[$i])
                        );
                    }, array_keys($layerInputs))) . "<br>" .
                    "Al sumar todo, obtenemos la entrada neta final \\(\\color{#8b5cf6}{z = %s}\\).",
                    $neuronIndex + 1,
                    strtolower($layerLabel),
                    $this->format($neuronBias),
                    $this->format($ponderatedSum)
                );

                $steps[] = [
                    'title' => "$layerLabel - Neurona " . ($neuronIndex + 1) . ": Entrada Neta (z)",
                    'description' => $explanationDetails,
                    'formula' => $formulaZ,
                    'substitution' => $substitutionZ,
                    'result' => sprintf("\\(\\color{#8b5cf6}{z} = %s\\)", $this->format($ponderatedSum)),
                    'type' => 'sum',
                    'data' => [
                        'layer' => $layerIndex + 1,
                        'neuron' => $neuronIndex + 1,
                        'weights' => $neuronWeights,
                        'bias' => $neuronBias,
                        'inputs' => $layerInputs,
                        'z' => $ponderatedSum
                    ]
                ];

                // 2. Apply activation function
                $activatedValue = 0.0;
                $activationFormula = '';
                $activationSubstitution = '';

                switch ($activationFn) {
                    case 'sigmoid':
                        $activatedValue = 1.0 / (1.0 + exp(-$ponderatedSum));
                        $activationFormula = '\\(\\color{#6366f1}{a} = \\sigma(\\color{#8b5cf6}{z}) = \\frac{1}{1 + e^{-\\color{#8b5cf6}{z}}}\\)';
                        $activationSubstitution = sprintf('\\(\\color{#6366f1}{a} = \\frac{1}{1 + e^{-(\\color{#8b5cf6}{%s})}} = %s\\)', $this->format($ponderatedSum), $this->format($activatedValue));
                        break;
                    case 'tanh':
                        $activatedValue = tanh($ponderatedSum);
                        $activationFormula = '\\(\\color{#6366f1}{a} = \\tanh(\\color{#8b5cf6}{z}) = \\frac{e^{\\color{#8b5cf6}{z}} - e^{-\\color{#8b5cf6}{z}}}{e^{\\color{#8b5cf6}{z}} + e^{-\\color{#8b5cf6}{z}}}\\)';
                        $activationSubstitution = sprintf('\\(\\color{#6366f1}{a} = \\tanh(\\color{#8b5cf6}{%s}) = %s\\)', $this->format($ponderatedSum), $this->format($activatedValue));
                        break;
                    case 'relu':
                        $activatedValue = max(0.0, $ponderatedSum);
                        $activationFormula = '\\(\\color{#6366f1}{a} = \\max(0, \\color{#8b5cf6}{z})\\)';
                        $activationSubstitution = sprintf('\\(\\color{#6366f1}{a} = \\max(0, \\color{#8b5cf6}{%s}) = %s\\)', $this->format($ponderatedSum), $this->format($activatedValue));
                        break;
                    case 'step':
                        $activatedValue = $ponderatedSum >= 0.0 ? 1.0 : 0.0;
                        $activationFormula = '\\(\\color{#6366f1}{a} = \\begin{cases} 1 & \\text{si } \\color{#8b5cf6}{z} \\ge 0 \\\\ 0 & \\text{si } \\color{#8b5cf6}{z} < 0 \\end{cases}\\)';
                        $activationSubstitution = sprintf('\\(\\color{#6366f1}{a} = \\begin{cases} 1 & \\text{si } \\color{#8b5cf6}{%s} \\ge 0 \\\\ 0 & \\text{si } \\color{#8b5cf6}{%s} < 0 \\end{cases} = %s\\)', $this->format($ponderatedSum), $this->format($ponderatedSum), $this->format($activatedValue));
                        break;
                    case 'linear':
                    default:
                        $activatedValue = $ponderatedSum;
                        $activationFormula = '\\(\\color{#6366f1}{a} = \\color{#8b5cf6}{z}\\)';
                        $activationSubstitution = sprintf('\\(\\color{#6366f1}{a} = %s\\)', $this->format($ponderatedSum));
                        break;
                }

                $steps[] = [
                    'title' => "$layerLabel - Neurona " . ($neuronIndex + 1) . ": Activación (a)",
                    'description' => sprintf("Aplicamos la función de activación **%s** al valor de entrada neta \\(\\color{#8b5cf6}{z = %s}\\), dando un resultado de \\(\\color{#6366f1}{a = %s}\\).", ucfirst($activationFn), $this->format($ponderatedSum), $this->format($activatedValue)),
                    'formula' => $activationFormula,
                    'substitution' => $activationSubstitution,
                    'result' => sprintf("\\(\\color{#6366f1}{a} = %s\\)", $this->format($activatedValue)),
                    'type' => 'activation',
                    'data' => [
                        'layer' => $layerIndex + 1,
                        'neuron' => $neuronIndex + 1,
                        'z' => $ponderatedSum,
                        'activated' => $activatedValue,
                        'activation_function' => $activationFn
                    ]
                ];

                $currentLayerOutputs[] = $activatedValue;
            }

            $layerOutputs[] = $currentLayerOutputs;
        }

        $finalOutput = end($layerOutputs);
        $outputsStr = implode(', ', array_map(fn($v, $idx) => "\\(\\color{#6366f1}{\\hat{y}_" . ($idx + 1) . "} = " . $this->format($v) . "\\)", $finalOutput, array_keys($finalOutput)));
        $steps[] = [
            'title' => 'Cálculo de Salida Finalizado',
            'description' => 'La propagación hacia adelante ha concluido. La salida final predicha por la red se muestra a continuación.',
            'formula' => 'Output = \\color{#6366f1}{\\hat{Y}}',
            'substitution' => '',
            'result' => "Salidas obtenidas: $outputsStr",
            'type' => 'final',
            'data' => [
                'inputs' => $inputsData,
                'all_outputs' => $layerOutputs,
                'final_output' => $finalOutput
            ]
        ];

        return [
            'output' => $finalOutput,
            'layer_outputs' => $layerOutputs,
            'steps' => $steps,
            'architecture' => $networkArchitecture
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
