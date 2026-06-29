<x-app-layout>
    <x-slot name="title">Forward Propagation - NeuroSmart Trainer</x-slot>

    <!-- Header -->
    <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold font-outfit text-gray-900 dark:text-white mb-1">
                Forward Propagation (Propagación hacia Adelante)
            </h1>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Diseña una red neuronal multicapa (MLP) y analiza su inferencia paso a paso.
            </p>
        </div>
        
        <div class="flex gap-2 no-print">
            <button type="button" onclick="loadMlpExample()" class="px-4 py-2 bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-full text-xs font-bold transition-all">
                Cargar Red 2-2-1 (Apuntes)
            </button>
        </div>
    </div>

    <!-- Alert error -->
    @if(session('error') || $errors->any())
        <div class="mb-6 p-4 bg-red-50 dark:bg-red-950 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-200 text-sm rounded-2xl">
            <strong>Error:</strong> {{ session('error') ?? $errors->first() }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Left Column: Config & Form (no-print) -->
        <div class="lg:col-span-1 no-print">
            <div class="p-6 bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm space-y-6">
                <h2 class="text-lg font-bold font-outfit text-gray-900 dark:text-white">Diseñador de Arquitectura</h2>

                <form id="forward-form" action="{{ route('forward.solve') }}" method="POST" class="space-y-4">
                    @csrf

                    <!-- Number of inputs -->
                    <div>
                        <label for="num_inputs" class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1">Entradas (x)</label>
                        <input type="number" id="num_inputs" name="num_inputs" min="1" max="5" value="{{ $inputs['num_inputs'] ?? 2 }}" onchange="generateArchitectureForm()" class="w-full px-4 py-2 bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-white border border-gray-200 dark:border-gray-800 rounded-2xl focus:outline-none focus:ring-2 focus:ring-purple-500">
                    </div>

                    <!-- Hidden layers count / sizes -->
                    <div>
                        <label for="layer_sizes_str" class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1">Capas Ocultas y Salida (ej. 2, 1)</label>
                        <input type="text" id="layer_sizes_str" value="{{ implode(', ', $inputs['layer_sizes']) }}" onchange="generateArchitectureForm()" class="w-full px-4 py-2 bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-white border border-gray-200 dark:border-gray-800 rounded-2xl focus:outline-none focus:ring-2 focus:ring-purple-500">
                        <span class="text-[10px] text-gray-400">Separa por comas la cantidad de neuronas de cada capa consecutiva.</span>
                        <div id="hidden-inputs-container"></div>
                    </div>

                    <!-- Network Inputs Data -->
                    <div class="p-4 bg-gray-50 dark:bg-gray-900 rounded-2xl">
                        <span class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-2">Valores de Entrada</span>
                        <div id="inputs-data-container" class="grid grid-cols-2 gap-2">
                            <!-- JS Generated -->
                        </div>
                    </div>

                    <!-- Weights & Biases Section -->
                    <div class="space-y-4">
                        <h3 class="text-sm font-bold font-outfit text-gray-800 dark:text-gray-200 border-t pt-4">Pesos y Sesgos</h3>
                        <div id="weights-biases-container" class="space-y-4">
                            <!-- JS Generated -->
                        </div>
                    </div>

                    <!-- Notes -->
                    <div>
                        <label for="notes" class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1">Notas (Opcional)</label>
                        <input type="text" id="notes" name="notes" placeholder="ej. Inferencia compuerta AND" class="w-full px-4 py-2 bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-white border border-gray-200 dark:border-gray-800 rounded-2xl focus:outline-none focus:ring-2 focus:ring-purple-500">
                    </div>

                    <button type="submit" class="w-full py-3 bg-[var(--m3-primary)] hover:bg-opacity-90 text-white font-bold rounded-2xl text-sm shadow-sm transition-all">
                        Simular Forward Pass
                    </button>
                </form>
            </div>
        </div>

        <!-- Right Column: Visualization & Procedural Steps -->
        <div class="lg:col-span-2">
            @if(isset($results))
                <!-- Summary Header -->
                <div class="mb-6 p-6 bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm flex flex-col md:flex-row items-center justify-between gap-4">
                    <div>
                        <span class="text-xs font-bold uppercase tracking-widest text-gray-400">Resultado Inferencia</span>
                        <h2 class="text-2xl font-black font-outfit mt-1 text-[var(--m3-primary)]">
                            ŷ = [{{ implode(', ', array_map(fn($v) => sprintf('%.4f', $v), $results['output'])) }}]
                        </h2>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            Salida calculada de la red neuronal mediante propagación hacia adelante.
                        </p>
                    </div>

                    <div class="flex gap-2 no-print">
                        <button type="button" onclick="toggleForwardExamMode()" id="exam-mode-btn" class="px-4 py-2 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 text-gray-700 dark:text-gray-300 font-bold rounded-full text-xs transition-all">
                            Ver como Examen
                        </button>
                        <button type="button" onclick="window.print()" class="px-4 py-2 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 text-gray-700 dark:text-gray-300 font-bold rounded-full text-xs transition-all">
                            Exportar PDF
                        </button>
                    </div>
                </div>

                <!-- SVG Network Diagram -->
                <div id="network-diagram-card" class="mb-6 p-6 bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm flex flex-col items-center">
                    <h3 class="text-sm font-bold font-outfit text-gray-800 dark:text-gray-200 mb-4 self-start">Diagrama Visual de la Red</h3>
                    <div id="svg-container" class="w-full flex justify-center max-w-[500px]">
                        <!-- Dynamic SVG will be rendered here by JS -->
                    </div>
                    <div class="mt-4 flex flex-wrap gap-4 text-xs font-semibold justify-center">
                        <span class="flex items-center gap-1"><span class="w-3 h-3 rounded-full bg-green-500"></span> Conexión Positiva (+)</span>
                        <span class="flex items-center gap-1"><span class="w-3 h-3 rounded-full bg-red-500"></span> Conexión Negativa (-)</span>
                        <span class="flex items-center gap-1"><span class="w-3 h-3 rounded-full bg-gray-400"></span> Sesgo / Cero</span>
                        <span class="flex items-center gap-1"><span class="w-3 h-3 rounded-full bg-cyan-400 ring-2 ring-cyan-100"></span> Neurona Activada</span>
                    </div>
                </div>

                <!-- EXAM MODE WRITING (Initially hidden) -->
                <div id="exam-mode-view" class="hidden p-6 bg-white border border-gray-300 rounded-2xl font-mono text-sm text-black space-y-4">
                    <h3 class="text-lg font-bold border-b pb-2">Procedimiento Resolutivo de Examen (Forward Propagation)</h3>
                    <div>
                        <strong>Datos de Entrada:</strong><br>
                        {!! implode('<br>', array_map(fn($v, $i) => "x_" . ($i + 1) . " = $v", $inputs['inputs_data'], array_keys($inputs['inputs_data']))) !!}
                    </div>

                    <div class="space-y-4">
                        @foreach($results['steps'] as $idx => $step)
                            @if($step['type'] === 'sum' || $step['type'] === 'activation' || $step['type'] === 'final')
                                <div class="border-t pt-2">
                                    <strong>{{ $step['title'] }}:</strong>
                                    <div class="pl-4 mt-1">
                                        {!! $step['description'] !!}<br>
                                        @if($step['formula'])
                                            <span class="font-bold">Fórmula:</span> {!! $step['formula'] !!}<br>
                                        @endif
                                        @if($step['substitution'])
                                            <span class="font-bold">Sustitución:</span> {!! $step['substitution'] !!}<br>
                                        @endif
                                        <span class="font-bold">Resultado:</span> {!! $step['result'] !!}
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <!-- VISUAL DETAILED STEPS -->
                <div id="visual-mode-view" class="space-y-6">
                    <h3 class="text-lg font-bold font-outfit text-gray-800 dark:text-gray-200 border-b pb-2">Cálculos Paso a Paso</h3>
                    
                    <div class="space-y-4">
                        @foreach($results['steps'] as $step)
                            @php
                                $typeClasses = [
                                    'input' => 'bg-sky-50 dark:bg-sky-950/20 border-sky-100 dark:border-sky-900 text-sky-900 dark:text-sky-200',
                                    'sum' => 'bg-purple-50 dark:bg-purple-950/20 border-purple-100 dark:border-purple-900 text-purple-900 dark:text-purple-200',
                                    'activation' => 'bg-cyan-50 dark:bg-cyan-950/20 border-cyan-100 dark:border-cyan-900 text-cyan-900 dark:text-cyan-200',
                                    'final' => 'bg-green-50 dark:bg-green-950/20 border-green-100 dark:border-green-900 text-green-900 dark:text-green-200',
                                    'info' => 'bg-gray-55 dark:bg-gray-900 border-gray-100 dark:border-gray-800 text-gray-800 dark:text-gray-200',
                                ];
                                $class = $typeClasses[$step['type']] ?? 'bg-gray-50 border-gray-100 text-gray-850';
                            @endphp

                            <div class="p-5 rounded-2xl border {{ $class }} space-y-2">
                                <h4 class="font-bold text-md">{{ $step['title'] }}</h4>
                                <p class="text-xs opacity-90">{!! $step['description'] !!}</p>

                                @if($step['formula'] || $step['substitution'])
                                    <div class="p-3 bg-white dark:bg-gray-900 rounded-xl font-mono text-[10px] space-y-1 mt-2 text-gray-800 dark:text-gray-200 shadow-inner">
                                        @if($step['formula'])
                                            <div class="text-[var(--m3-primary)] font-bold">Fórmula: {!! $step['formula'] !!}</div>
                                        @endif
                                        @if($step['substitution'])
                                            <div class="opacity-75">Sustituye: {!! $step['substitution'] !!}</div>
                                        @endif
                                    </div>
                                @endif
                                <div class="text-sm font-bold mt-2">↳ {!! $step['result'] !!}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <!-- Pre-run Banner -->
                <div class="p-12 text-center bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm no-print">
                    <svg class="w-16 h-16 text-gray-300 dark:text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                    </svg>
                    <h3 class="text-lg font-bold font-outfit text-gray-900 dark:text-white mb-1">Inferencia Lista</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Configura la red y simula la propagación hacia adelante en tiempo real.</p>
                </div>
            @endif
        </div>

    </div>

    <!-- JS Form & SVG generator -->
    <script>
        // Loaded parameters (if any) or defaults
        const currentInputs = @json($inputs);

        function generateArchitectureForm() {
            const numInputsVal = parseInt(document.getElementById('num_inputs').value) || 2;
            const layersStr = document.getElementById('layer_sizes_str').value;
            const layerSizes = layersStr.split(',').map(s => parseInt(s.trim())).filter(n => !isNaN(n) && n > 0);

            // Re-render inputs data container
            const inputsContainer = document.getElementById('inputs-data-container');
            inputsContainer.innerHTML = '';
            for (let i = 0; i < numInputsVal; i++) {
                const val = currentInputs.inputs_data && currentInputs.inputs_data[i] !== undefined 
                    ? currentInputs.inputs_data[i] 
                    : 1.0;
                
                inputsContainer.innerHTML += `
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 mb-0.5">x_${i+1}</label>
                        <input type="number" step="any" name="inputs_data[]" value="${val}" class="w-full px-2 py-1 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-lg text-xs" required>
                    </div>
                `;
            }

            // Re-render weights and biases container
            const wbContainer = document.getElementById('weights-biases-container');
            wbContainer.innerHTML = '';

            let prevLayerSize = numInputsVal;

            layerSizes.forEach((neuronsCount, layerIdx) => {
                const isOutput = layerIdx === layerSizes.length - 1;
                const layerLabel = isOutput ? 'Capa de Salida' : `Capa Oculta ${layerIdx + 1}`;

                let html = `
                    <div class="p-4 bg-gray-50 dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 space-y-3">
                        <div class="flex items-center justify-between border-b border-gray-200 dark:border-gray-800 pb-1.5">
                            <span class="text-xs font-bold text-[var(--m3-primary)] font-outfit uppercase tracking-wider">${layerLabel}</span>
                            
                            <!-- Layer Activation Function -->
                            <div>
                                <select name="activation_fns[]" class="px-2 py-0.5 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-md text-[10px] focus:outline-none">
                                    <option value="sigmoid" ${currentInputs.activation_fns && currentInputs.activation_fns[layerIdx] === 'sigmoid' ? 'selected' : ''}>Sigmoide</option>
                                    <option value="tanh" ${currentInputs.activation_fns && currentInputs.activation_fns[layerIdx] === 'tanh' ? 'selected' : ''}>Tanh</option>
                                    <option value="relu" ${currentInputs.activation_fns && currentInputs.activation_fns[layerIdx] === 'relu' ? 'selected' : ''}>ReLU</option>
                                    <option value="step" ${currentInputs.activation_fns && currentInputs.activation_fns[layerIdx] === 'step' ? 'selected' : ''}>Escalón</option>
                                    <option value="linear" ${currentInputs.activation_fns && currentInputs.activation_fns[layerIdx] === 'linear' ? 'selected' : ''}>Lineal</option>
                                </select>
                            </div>
                        </div>

                        <!-- Form hidden structure mapping layer index -->
                        <input type="hidden" name="layer_sizes[]" value="${neuronsCount}">

                        <div class="space-y-3">
                `;

                for (let neuronIdx = 0; neuronIdx < neuronsCount; neuronIdx++) {
                    const biasVal = currentInputs.biases && currentInputs.biases[layerIdx] && currentInputs.biases[layerIdx][neuronIdx] !== undefined 
                        ? currentInputs.biases[layerIdx][neuronIdx] 
                        : -0.7;

                    html += `
                        <div class="p-3 bg-white dark:bg-gray-950 rounded-xl space-y-2 border border-gray-100 dark:border-gray-900">
                            <div class="text-[10px] font-bold text-gray-500">Neurona ${neuronIdx + 1}</div>
                            
                            <div class="grid grid-cols-2 gap-2">
                                <!-- Bias -->
                                <div>
                                    <label class="block text-[8px] font-bold text-gray-400">Sesgo (b)</label>
                                    <input type="number" step="any" name="biases[${layerIdx}][${neuronIdx}]" value="${biasVal}" class="w-full px-2 py-1 bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-lg text-xs" required>
                                </div>
                                
                                <!-- Weights -->
                                <div class="col-span-2 grid grid-cols-2 gap-2 mt-1 border-t border-gray-50 dark:border-gray-900 pt-1.5">
                    `;

                    for (let inputIdx = 0; inputIdx < prevLayerSize; inputIdx++) {
                        const weightVal = currentInputs.weights && currentInputs.weights[layerIdx] && currentInputs.weights[layerIdx][neuronIdx] && currentInputs.weights[layerIdx][neuronIdx][inputIdx] !== undefined 
                            ? currentInputs.weights[layerIdx][neuronIdx][inputIdx] 
                            : 0.5;

                        html += `
                            <div>
                                <label class="block text-[8px] font-bold text-gray-400">Peso w_${neuronIdx+1},${inputIdx+1}</label>
                                <input type="number" step="any" name="weights[${layerIdx}][${neuronIdx}][${inputIdx}]" value="${weightVal}" class="w-full px-2 py-1 bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-lg text-xs" required>
                            </div>
                        `;
                    }

                    html += `
                                </div>
                            </div>
                        </div>
                    `;
                }

                html += `
                        </div>
                    </div>
                `;

                wbContainer.innerHTML += html;
                prevLayerSize = neuronsCount;
            });
        }

        // Example Loader
        function loadMlpExample() {
            document.getElementById('num_inputs').value = 2;
            document.getElementById('layer_sizes_str').value = "2, 1";
            
            // Set current inputs defaults
            currentInputs.num_inputs = 2;
            currentInputs.layer_sizes = [2, 1];
            currentInputs.inputs_data = [1.0, 1.0];
            currentInputs.weights = {
                0: {
                    0: [0.5, 0.5],
                    1: [0.5, 0.5]
                },
                1: {
                    0: [0.5, 0.5]
                }
            };
            currentInputs.biases = {
                0: [-0.7, -0.7],
                1: [-0.7]
            };
            currentInputs.activation_fns = ["sigmoid", "sigmoid"];

            generateArchitectureForm();
        }

        document.addEventListener('DOMContentLoaded', () => {
            generateArchitectureForm();
            @if(isset($results))
                drawNetworkDiagram();
            @endif
        });

        // Network Diagram SVG Drawer
        function drawNetworkDiagram() {
            const results = @json($results ?? null);
            if (!results) return;

            const inputs = results.steps[0].data.inputs;
            const layers = [inputs.length, ...results.architecture.map(l => l.neurons)];
            const outputs = results.layer_outputs;

            const width = 500;
            const height = 300;
            const nodeRadius = 15;
            
            // Coordinate mappings
            const colWidth = width / (layers.length + 1);
            const positions = [];

            layers.forEach((nodesCount, colIdx) => {
                positions[colIdx] = [];
                const x = colWidth * (colIdx + 1);
                const colHeight = height / (nodesCount + 1);
                
                for (let rowIdx = 0; rowIdx < nodesCount; rowIdx++) {
                    const y = colHeight * (rowIdx + 1);
                    positions[colIdx].push({ x, y });
                }
            });

            // Start drawing SVG
            let svg = `<svg viewBox="0 0 ${width} ${height}" class="w-full h-full font-sans overflow-visible">`;

            // Draw connections (Lines)
            // Loop through each column of weights (starting from layerIndex = 0 mapping to connections between colIdx and colIdx + 1)
            const weights = @json($inputs['weights'] ?? null);

            for (let colIdx = 0; colIdx < layers.length - 1; colIdx++) {
                const nextNodes = positions[colIdx + 1];
                const currNodes = positions[colIdx];

                for (let j = 0; j < nextNodes.length; j++) {
                    for (let i = 0; i < currNodes.length; i++) {
                        const wVal = weights[colIdx] && weights[colIdx][j] && weights[colIdx][j][i] !== undefined 
                            ? weights[colIdx][j][i] 
                            : 0.0;
                        
                        let strokeColor = '#9ca3af'; // gray-400 for 0
                        if (wVal > 0) strokeColor = '#22c55e'; // green-500
                        if (wVal < 0) strokeColor = '#ef4444'; // red-500
                        
                        const thickness = Math.min(5, 1 + Math.abs(wVal) * 2);

                        svg += `
                            <line x1="${currNodes[i].x}" y1="${currNodes[i].y}" x2="${nextNodes[j].x}" y2="${nextNodes[j].y}" 
                                  stroke="${strokeColor}" stroke-width="${thickness}" stroke-opacity="0.7" />
                            <!-- Text weight value -->
                            <text x="${(currNodes[i].x + nextNodes[j].x)/2}" y="${(currNodes[i].y + nextNodes[j].y)/2 - 5}" 
                                  font-size="8" fill="#4b5563" text-anchor="middle" font-weight="bold">${wVal.toFixed(2)}</text>
                        `;
                    }
                }
            }

            // Draw Nodes (Circles)
            layers.forEach((nodesCount, colIdx) => {
                const nodes = positions[colIdx];
                const colOutputs = outputs[colIdx];

                for (let rowIdx = 0; rowIdx < nodes.length; rowIdx++) {
                    const nodeVal = colOutputs[rowIdx];
                    const x = nodes[rowIdx].x;
                    const y = nodes[rowIdx].y;

                    // Node color
                    const isInput = colIdx === 0;
                    let nodeColor = 'fill-white dark:fill-gray-900 stroke-purple-500';
                    let glow = '';

                    if (isInput) {
                        nodeColor = 'fill-white dark:fill-gray-900 stroke-sky-500';
                    } else if (nodeVal >= 0.5) {
                        nodeColor = 'fill-white dark:fill-gray-900 stroke-cyan-500';
                        glow = 'filter="url(#glow)"';
                    }

                    svg += `
                        <circle cx="${x}" cy="${y}" r="${nodeRadius}" class="${nodeColor} stroke-2" ${glow} />
                        <!-- Value inside circle -->
                        <text x="${x}" y="${y + 4}" font-size="8" fill="currentColor" text-anchor="middle" font-weight="bold" class="text-gray-900 dark:text-white">
                            ${nodeVal.toFixed(2)}
                        </text>
                        <!-- Node label -->
                        <text x="${x}" y="${y - nodeRadius - 4}" font-size="8" fill="#9ca3af" text-anchor="middle">
                            ${isInput ? 'x' : (colIdx === layers.length - 1 ? 'ŷ' : 'h')}${rowIdx + 1}
                        </text>
                    `;
                }
            });

            // SVG Glow Filter definition
            svg += `
                <defs>
                    <filter id="glow" x="-20%" y="-20%" width="140%" height="140%">
                        <feGaussianBlur stdDeviation="3" result="blur" />
                        <feComposite in="SourceGraphic" in2="blur" operator="over" />
                    </filter>
                </defs>
            `;

            svg += `</svg>`;

            document.getElementById('svg-container').innerHTML = svg;
        }

        function toggleForwardExamMode() {
            const examView = document.getElementById('exam-mode-view');
            const visualView = document.getElementById('visual-mode-view');
            const btn = document.getElementById('exam-mode-btn');
            const svgCard = document.getElementById('network-diagram-card');

            if (examView.classList.contains('hidden')) {
                examView.classList.remove('hidden');
                visualView.classList.add('hidden');
                svgCard.classList.add('hidden');
                btn.innerText = "Ver como Visual";
            } else {
                examView.classList.add('hidden');
                visualView.classList.remove('hidden');
                svgCard.classList.remove('hidden');
                btn.innerText = "Ver como Examen";
            }
        }
    </script>
</x-app-layout>
