<x-app-layout>
    <x-slot name="title">Perceptrón Simple - NeuroSmart Trainer</x-slot>

    <!-- Header -->
    <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold font-outfit text-gray-900 dark:text-white mb-1">
                Entrenamiento del Perceptrón Simple
            </h1>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Resuelve ejercicios y entrena un perceptrón monocapa paso a paso.
            </p>
        </div>
        
        <div class="flex gap-2 no-print">
            <button type="button" onclick="loadExample('or')" class="px-4 py-2 bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-full text-xs font-bold transition-all">
                Cargar OR (Examen)
            </button>
            <button type="button" onclick="loadExample('and')" class="px-4 py-2 bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-full text-xs font-bold transition-all">
                Cargar AND (Apuntes)
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
        
        <!-- Left Column: Input Form (no-print) -->
        <div class="lg:col-span-1 no-print">
            <div class="p-6 bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm">
                <h2 class="text-lg font-bold font-outfit text-gray-900 dark:text-white mb-4">Datos del Perceptrón</h2>
                
                <form action="{{ route('perceptron.solve') }}" method="POST" class="space-y-4">
                    @csrf

                    <!-- Number of inputs -->
                    <div>
                        <label for="num_inputs" class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1">Entradas (x)</label>
                        <input type="number" id="num_inputs" name="num_inputs" min="1" max="10" value="{{ $inputs['num_inputs'] ?? 2 }}" onchange="adjustWeightsCount()" class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-white border border-gray-200 dark:border-gray-800 rounded-2xl focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                    </div>

                    <!-- Initial weights -->
                    <div>
                        <label for="initial_weights" class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1">Pesos Iniciales (w1, w2, ...)</label>
                        <input type="text" id="initial_weights" name="initial_weights" value="{{ $inputs['initial_weights'] ?? '0.7, 0.1' }}" placeholder="ej. 0.7, 0.1" class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-white border border-gray-200 dark:border-gray-800 rounded-2xl focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                    </div>

                    <!-- Bias w0 -->
                    <div>
                        <label for="bias" class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1">Sesgo w0 (b)</label>
                        <input type="number" step="any" id="bias" name="bias" value="{{ $inputs['bias'] ?? -0.9 }}" class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-white border border-gray-200 dark:border-gray-800 rounded-2xl focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                    </div>

                    <!-- Learning rate eta -->
                    <div>
                        <label for="learning_rate" class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1">Tasa de Aprendizaje (η)</label>
                        <input type="number" step="any" id="learning_rate" name="learning_rate" min="0.0001" max="10" value="{{ $inputs['learning_rate'] ?? 0.4 }}" class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-white border border-gray-200 dark:border-gray-800 rounded-2xl focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                    </div>

                    <!-- Epochs -->
                    <div>
                        <label for="epochs" class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1">Máximo de Épocas</label>
                        <input type="number" id="epochs" name="epochs" min="1" max="100" value="{{ $inputs['epochs'] ?? 10 }}" class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-white border border-gray-200 dark:border-gray-800 rounded-2xl focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                    </div>

                    <!-- Activation function -->
                    <div>
                        <label for="activation_fn" class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1">Función de Activación</label>
                        <select id="activation_fn" name="activation_fn" onchange="toggleThresholdField()" class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-white border border-gray-200 dark:border-gray-800 rounded-2xl focus:outline-none focus:ring-2 focus:ring-purple-500">
                            <option value="step" {{ (isset($inputs['activation_fn']) && $inputs['activation_fn'] === 'step') ? 'selected' : '' }}>Escalón Unitario (u)</option>
                            <option value="sign" {{ (isset($inputs['activation_fn']) && $inputs['activation_fn'] === 'sign') ? 'selected' : '' }}>Signo (sign)</option>
                            <option value="sigmoid" {{ (isset($inputs['activation_fn']) && $inputs['activation_fn'] === 'sigmoid') ? 'selected' : '' }}>Sigmoide</option>
                        </select>
                    </div>

                    <!-- Threshold (only for step, optional) -->
                    <div id="threshold-container">
                        <label for="threshold" class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1">Valor de Umbral (θ)</label>
                        <input type="number" step="any" id="threshold" name="threshold" value="{{ $inputs['threshold'] ?? 0.0 }}" class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-white border border-gray-200 dark:border-gray-800 rounded-2xl focus:outline-none focus:ring-2 focus:ring-purple-500">
                    </div>

                    <!-- Training data raw -->
                    <div>
                        <label for="training_data_raw" class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1">Tabla de Entrenamiento (x1 x2 ... y)</label>
                        <textarea id="training_data_raw" name="training_data_raw" rows="6" placeholder="ej.&#10;0  0  0&#10;0  1  1&#10;1  0  1&#10;1  1  1" class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-white border border-gray-200 dark:border-gray-800 rounded-2xl focus:outline-none focus:ring-2 focus:ring-purple-500 font-mono text-sm" required>{{ $inputs['training_data_raw'] ?? '' }}</textarea>
                    </div>

                    <!-- Optional User Notes -->
                    <div>
                        <label for="notes" class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1">Notas del Ejercicio (Opcional)</label>
                        <input type="text" id="notes" name="notes" placeholder="ej. Ejercicio de la guía del examen" class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-white border border-gray-200 dark:border-gray-800 rounded-2xl focus:outline-none focus:ring-2 focus:ring-purple-500">
                    </div>

                    <button type="submit" class="w-full py-3 bg-[var(--m3-primary)] hover:bg-opacity-90 text-white font-bold rounded-2xl text-sm shadow-sm transition-all">
                        Entrenar Red
                    </button>
                </form>
            </div>
        </div>

        <!-- Right Column: Results & Explanations -->
        <div class="lg:col-span-2">
            @if(isset($results))
                <!-- Result Banner -->
                <div class="mb-6 p-6 bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm flex flex-col md:flex-row items-center justify-between gap-4">
                    <div>
                        <span class="text-xs font-bold uppercase tracking-widest text-gray-400">Estado Final del Perceptrón</span>
                        <h2 class="text-2xl font-black font-outfit mt-1 flex items-center gap-2">
                            @if($results['converged'])
                                <span class="text-green-600">✓ Entrenado con éxito</span>
                            @else
                                <span class="text-red-600">✗ No convergió</span>
                            @endif
                        </h2>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            El entrenamiento duró {{ $results['epochs_run'] }} época{{ $results['epochs_run'] > 1 ? 's' : '' }}.
                        </p>
                    </div>

                    <div class="flex gap-2 no-print">
                        <button type="button" onclick="toggleExamMode()" id="exam-mode-btn" class="px-4 py-2 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 text-gray-700 dark:text-gray-300 font-bold rounded-full text-xs transition-all">
                            Ver como Examen
                        </button>
                        <button type="button" onclick="window.print()" class="px-4 py-2 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 text-gray-700 dark:text-gray-300 font-bold rounded-full text-xs transition-all">
                            Exportar PDF
                        </button>
                    </div>
                </div>

                <!-- EXAM MODE VIEW (Initially hidden) -->
                <div id="exam-mode-view" class="hidden p-6 bg-white border border-gray-300 rounded-2xl font-mono text-sm text-black space-y-4">
                    <h3 class="text-lg font-bold border-b pb-2">Procedimiento Resolutivo de Examen (Perceptrón)</h3>
                    <div>
                        <strong>Datos Iniciales:</strong><br>
                        Entradas (x): {{ $inputs['num_inputs'] }} | η = {{ $inputs['learning_rate'] }}<br>
                        Pesos Iniciales: [{{ $inputs['initial_weights'] }}]<br>
                        Sesgo Inicial (w0): {{ $inputs['bias'] }}<br>
                        Activación: {{ $inputs['activation_fn'] === 'step' ? 'Escalón Unitario' : ($inputs['activation_fn'] === 'sign' ? 'Signo' : 'Sigmoide') }}
                    </div>

                    <div class="space-y-4">
                        @foreach($results['epochs_details'] as $eInfo)
                            <div class="border-t pt-2">
                                <strong>ÉPOCA {{ $eInfo['epoch'] }} (Errores: {{ $eInfo['errors'] }}):</strong>
                                <div class="pl-4 mt-2 space-y-2">
                                    @foreach($eInfo['samples'] as $sInfo)
                                        <div>
                                            <u>Muestra {{ $sInfo['sample_index'] }}:</u> x = [{{ implode(', ', $sInfo['x']) }}], y = {{ $sInfo['y'] }}<br>
                                            z = ({{ $sInfo['bias_before'] }}) + {!! implode(' + ', array_map(fn($w, $x) => "($w)($x)", $sInfo['weights_before'], $sInfo['x'])) !!} = {{ $sInfo['z'] }}<br>
                                            ŷ = {{ $sInfo['y_calculated'] }} | Error e = {{ $sInfo['y'] }} - {{ $sInfo['y_calculated'] }} = {{ $sInfo['error'] }}<br>
                                            @if($sInfo['error'] != 0)
                                                Pesos Nuevos: w0 = {{ $sInfo['bias_before'] }} + ({{ $inputs['learning_rate'] }})({{ $sInfo['error'] }}) = {{ $sInfo['bias_after'] }}<br>
                                                {!! implode('<br>', array_map(fn($wB, $wA, $x, $i) => "w" . ($i + 1) . " = $wB + (" . $inputs['learning_rate'] . ")(" . $sInfo['error'] . ")($x) = $wA", $sInfo['weights_before'], $sInfo['weights_after'], $sInfo['x'], array_keys($sInfo['weights_before']))) !!}
                                            @else
                                                e = 0 \Rightarrow Los pesos no cambian.
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="border-t pt-4 font-bold">
                        Resultados Finales:<br>
                        Pesos: [{{ implode(', ', $results['final_weights']) }}] | Sesgo: {{ $results['final_bias'] }}<br>
                        Ecuación Recta: z = {{ $results['final_bias'] }} + {!! implode(' + ', array_map(fn($w, $i) => "($w)x_" . ($i + 1), $results['final_weights'], array_keys($results['final_weights']))) !!}
                    </div>
                </div>

                <!-- VISUAL LEARNER VIEW (Standard) -->
                <div id="visual-mode-view" class="space-y-6">
                    <!-- Carousel Slider Steps -->
                    <div class="p-6 bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm no-print">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-md font-bold font-outfit text-gray-900 dark:text-white">Simulador Paso a Paso</h3>
                            <div class="flex gap-2">
                                <button type="button" onclick="prevStep()" class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                                </button>
                                <span id="step-counter" class="text-xs font-bold text-gray-400 self-center">Paso 1 de 10</span>
                                <button type="button" onclick="nextStep()" class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </button>
                            </div>
                        </div>

                        <!-- Step Card Content -->
                        <div class="min-h-[220px] p-5 rounded-2xl bg-purple-50 dark:bg-purple-950/20 border border-purple-100 dark:border-purple-900 relative">
                            <!-- Step Badge type -->
                            <span id="step-badge" class="absolute top-4 right-4 px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider">TIPO</span>

                            <h4 id="step-title" class="text-md font-bold text-gray-900 dark:text-white mb-2">Título del Paso</h4>
                            <p id="step-desc" class="text-sm text-gray-600 dark:text-gray-300 mb-4">Descripción del procedimiento explicativo.</p>

                            <!-- Math Box -->
                            <div id="step-math-box" class="p-4 bg-white dark:bg-gray-900 rounded-xl space-y-2 font-mono text-xs text-gray-800 dark:text-gray-200">
                                <div class="text-[var(--m3-primary)] font-bold" id="step-formula">Fórmula</div>
                                <div class="text-gray-400" id="step-sub">Sustitución</div>
                                <div class="text-base font-bold border-t pt-2 border-gray-100 dark:border-gray-800" id="step-res">Resultado</div>
                            </div>
                        </div>
                    </div>

                    <!-- Epochs Details Tables -->
                    <div class="space-y-6">
                        <h3 class="text-lg font-bold font-outfit text-gray-800 dark:text-gray-200 border-b pb-2">Resultados por Época</h3>
                        
                        @foreach($results['epochs_details'] as $epochInfo)
                            <div class="p-6 bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm space-y-4">
                                <div class="flex items-center justify-between border-b border-gray-100 dark:border-gray-800 pb-2">
                                    <h4 class="font-bold text-gray-900 dark:text-white">ÉPOCA {{ $epochInfo['epoch'] }}</h4>
                                    <span class="px-2.5 py-0.5 rounded-full text-xs font-bold {{ $epochInfo['errors'] > 0 ? 'bg-red-100 text-red-800 dark:bg-red-950 dark:text-red-300' : 'bg-green-100 text-green-800 dark:bg-green-950 dark:text-green-300' }}">
                                        {{ $epochInfo['errors'] }} error{{ $epochInfo['errors'] != 1 ? 'es' : '' }}
                                    </span>
                                </div>

                                <div class="overflow-x-auto">
                                    <table class="w-full text-left border-collapse text-xs">
                                        <thead>
                                            <tr class="border-b border-gray-200 dark:border-gray-700 text-gray-400">
                                                <th class="py-2">Muestra</th>
                                                <th class="py-2">Entradas (x)</th>
                                                <th class="py-2">Pesos Antes (w)</th>
                                                <th class="py-2">Entrada Neta (z)</th>
                                                <th class="py-2">Salida ŷ</th>
                                                <th class="py-2">Esperada y</th>
                                                <th class="py-2">Error e</th>
                                                <th class="py-2">Pesos Después (w)</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-100 dark:divide-gray-800 text-gray-700 dark:text-gray-300">
                                            @foreach($epochInfo['samples'] as $sampleInfo)
                                                <tr class="{{ $sampleInfo['error'] != 0 ? 'bg-amber-50/50 dark:bg-amber-950/10' : '' }}">
                                                    <td class="py-3 font-semibold">{{ $sampleInfo['sample_index'] }}</td>
                                                    <td class="py-3 font-mono text-[var(--color-input-x)] font-bold">
                                                        [{{ implode(', ', $sampleInfo['x']) }}]
                                                    </td>
                                                    <td class="py-3 font-mono text-[var(--color-weight-w)]">
                                                        [{{ implode(', ', array_map(fn($v) => round($v, 2), $sampleInfo['weights_before'])) }}] (b: {{ round($sampleInfo['bias_before'], 2) }})
                                                    </td>
                                                    <td class="py-3 font-mono">{{ round($sampleInfo['z'], 4) }}</td>
                                                    <td class="py-3 font-mono text-[var(--color-output-calc)] font-bold">{{ $sampleInfo['y_calculated'] }}</td>
                                                    <td class="py-3 font-mono text-[var(--color-output-y)] font-bold">{{ $sampleInfo['y'] }}</td>
                                                    <td class="py-3 font-mono font-bold {{ $sampleInfo['error'] != 0 ? 'text-[var(--color-error-err)]' : 'text-gray-400' }}">
                                                        {{ $sampleInfo['error'] }}
                                                    </td>
                                                    <td class="py-3 font-mono">
                                                        @if($sampleInfo['weights_updated'])
                                                            <span class="text-yellow-600 dark:text-yellow-400 font-bold">
                                                                [{{ implode(', ', array_map(fn($v) => round($v, 2), $sampleInfo['weights_after'])) }}] (b: {{ round($sampleInfo['bias_after'], 2) }})
                                                            </span>
                                                        @else
                                                            <span class="text-gray-400">Se mantiene</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <!-- Pre-run default information banner -->
                <div class="p-12 text-center bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm no-print">
                    <svg class="w-16 h-16 text-gray-300 dark:text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                    </svg>
                    <h3 class="text-lg font-bold font-outfit text-gray-900 dark:text-white mb-1">Simulación Lista</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Ingresa tus datos a la izquierda o carga un ejemplo para simular el Perceptrón paso a paso.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Step Slider JS engine -->
    @if(isset($results))
        <script>
            const stepsData = @json($results['steps']);
            let currentStepIdx = 0;

            function updateStepCard(index) {
                if (index < 0 || index >= stepsData.length) return;
                currentStepIdx = index;

                // Toggle buttons state
                document.getElementById('step-counter').innerText = `Paso ${index + 1} de ${stepsData.length}`;
                
                const step = stepsData[index];
                document.getElementById('step-title').innerText = step.title;
                document.getElementById('step-desc').innerHTML = step.description;

                // Color badges depending on step type
                const badge = document.getElementById('step-badge');
                badge.innerText = step.type;
                badge.className = "absolute top-4 right-4 px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider ";
                
                const badgeMap = {
                    'input': 'badge-input',
                    'sum': 'badge-weight',
                    'activation': 'badge-output-calc',
                    'error': 'badge-error',
                    'update': 'badge-update',
                    'final': 'badge-output',
                    'epoch_end': 'badge-zero',
                    'neutral': 'badge-zero',
                    'info': 'badge-input'
                };
                badge.classList.add(badgeMap[step.type] || 'badge-zero');

                // Helper to render math on dynamic elements
                function renderMath(element) {
                    if (window.renderMathInElement) {
                        renderMathInElement(element, {
                            delimiters: [
                                {left: '$$', right: '$$', display: true},
                                {left: '$', right: '$', display: false},
                                {left: '\\(', right: '\\)', display: false},
                                {left: '\\[', right: '\\]', display: true}
                            ],
                            throwOnError: false
                        });
                    }
                }

                // Render math in the description text
                renderMath(document.getElementById('step-desc'));

                // Render math content
                const formulaEl = document.getElementById('step-formula');
                const subEl = document.getElementById('step-sub');
                const resEl = document.getElementById('step-res');

                if (step.formula) {
                    formulaEl.innerHTML = step.formula;
                    formulaEl.classList.remove('hidden');
                    renderMath(formulaEl);
                } else {
                    formulaEl.classList.add('hidden');
                }

                if (step.substitution) {
                    subEl.innerHTML = step.substitution;
                    subEl.classList.remove('hidden');
                    renderMath(subEl);
                } else {
                    subEl.classList.add('hidden');
                }

                resEl.innerHTML = step.result;
                renderMath(resEl);
            }

            function nextStep() {
                if (currentStepIdx < stepsData.length - 1) {
                    updateStepCard(currentStepIdx + 1);
                }
            }

            function prevStep() {
                if (currentStepIdx > 0) {
                    updateStepCard(currentStepIdx - 1);
                }
            }

            // Initialize first step
            document.addEventListener('DOMContentLoaded', () => {
                updateStepCard(0);
            });

            function toggleExamMode() {
                const examView = document.getElementById('exam-mode-view');
                const visualView = document.getElementById('visual-mode-view');
                const btn = document.getElementById('exam-mode-btn');

                if (examView.classList.contains('hidden')) {
                    examView.classList.remove('hidden');
                    visualView.classList.add('hidden');
                    btn.innerText = "Ver como Visual";
                } else {
                    examView.classList.add('hidden');
                    visualView.classList.remove('hidden');
                    btn.innerText = "Ver como Examen";
                }
            }
        </script>
    @endif

    <script>
        // Adjust elements
        function toggleThresholdField() {
            const actFn = document.getElementById('activation_fn').value;
            const container = document.getElementById('threshold-container');
            if (actFn === 'step') {
                container.classList.remove('hidden');
            } else {
                container.classList.add('hidden');
            }
        }
        
        // Dynamic weight fields adjust helper
        function adjustWeightsCount() {
            const numInputs = parseInt(document.getElementById('num_inputs').value) || 2;
            const weightsInput = document.getElementById('initial_weights');
            
            // Build default weights array (0.5, 0.5, ...)
            const weights = Array(numInputs).fill(0.5);
            weightsInput.value = weights.join(', ');
        }

        // Example loaders
        function loadExample(type) {
            const numInputs = document.getElementById('num_inputs');
            const weights = document.getElementById('initial_weights');
            const bias = document.getElementById('bias');
            const eta = document.getElementById('learning_rate');
            const epochs = document.getElementById('epochs');
            const actFn = document.getElementById('activation_fn');
            const threshold = document.getElementById('threshold');
            const table = document.getElementById('training_data_raw');

            if (type === 'or') {
                numInputs.value = 2;
                weights.value = "0.7, 0.1";
                bias.value = -0.9;
                eta.value = 0.4;
                epochs.value = 10;
                actFn.value = "step";
                threshold.value = 0.0;
                table.value = "0\t0\t0\n0\t1\t1\n1\t0\t1\n1\t1\t1";
            } else if (type === 'and') {
                numInputs.value = 2;
                weights.value = "0.7, 0.2";
                bias.value = -0.5;
                eta.value = 0.25;
                epochs.value = 10;
                actFn.value = "step";
                threshold.value = 0.0;
                table.value = "0\t0\t0\n0\t1\t0\n1\t0\t0\n1\t1\t1";
            }

            toggleThresholdField();
        }

        // Initial setup run
        document.addEventListener('DOMContentLoaded', () => {
            toggleThresholdField();
        });
    </script>
</x-app-layout>
