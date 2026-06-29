<x-app-layout>
    <x-slot name="title">Backpropagation - NeuroSmart Trainer</x-slot>

    <!-- Header -->
    <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold font-outfit text-gray-900 dark:text-white mb-1">
                Entrenamiento con Backpropagation
            </h1>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Aprende cómo fluye el error hacia atrás para corregir los pesos sinápticos usando la regla de la cadena.
            </p>
        </div>
        
        <div class="flex gap-2 no-print">
            <button type="button" onclick="loadExample('single')" class="px-4 py-2 bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-full text-xs font-bold transition-all">
                Cargar Una Neurona (Examen)
            </button>
            <button type="button" onclick="loadExample('mlp')" class="px-4 py-2 bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-full text-xs font-bold transition-all">
                Cargar Multicapa 2-2-1
            </button>
        </div>
    </div>

    <!-- Convención Alert Note -->
    <div class="mb-6 p-4 bg-purple-50 dark:bg-purple-950/40 border border-purple-200 dark:border-purple-800 text-purple-900 dark:text-purple-200 text-xs rounded-2xl">
        <strong>Nota de Convención del Curso:</strong> Esta aplicación sigue la convención del signo negativo ($-$) en la actualización de pesos utilizada en las diapositivas de la materia ($w = w - \eta \cdot \delta \cdot x$), a pesar de que el gradiente para error definido como $y-\hat{y}$ resulte matemáticamente en un signo positivo.
    </div>

    <!-- Alert error -->
    @if(session('error') || $errors->any())
        <div class="mb-6 p-4 bg-red-50 dark:bg-red-950 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-200 text-sm rounded-2xl">
            <strong>Error:</strong> {{ session('error') ?? $errors->first() }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Left Column: Config Form (no-print) -->
        <div class="lg:col-span-1 no-print">
            <div class="p-6 bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm space-y-4">
                
                <!-- Tab Toggles (Single vs MLP) -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-2">Estructura de la Red</label>
                    <div class="grid grid-cols-2 gap-2 bg-gray-50 dark:bg-gray-900 p-1.5 rounded-2xl">
                        <button type="button" id="tab-single-btn" onclick="toggleMode('single')" class="py-2 text-center text-xs font-bold rounded-xl transition-all bg-[var(--m3-primary)] text-white shadow-sm">
                            Una Neurona
                        </button>
                        <button type="button" id="tab-mlp-btn" onclick="toggleMode('mlp')" class="py-2 text-center text-xs font-bold rounded-xl transition-all text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800">
                            Multicapa 2-2-1
                        </button>
                    </div>
                </div>

                <form action="{{ route('backprop.solve') }}" method="POST" class="space-y-4">
                    @csrf
                    <!-- Input parameter to send mode to backend -->
                    <input type="hidden" id="mode-input" name="mode" value="{{ $inputs['mode'] ?? 'single' }}">

                    <!-- FORM 1: SINGLE NEURON (2 inputs) -->
                    <div id="form-single" class="space-y-4">
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400">Entrada x1</label>
                                <input type="number" step="any" name="x1" value="{{ $inputs['x1'] ?? 1.0 }}" class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-white border border-gray-200 dark:border-gray-800 rounded-2xl focus:outline-none">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400">Entrada x2</label>
                                <input type="number" step="any" name="x2" value="{{ $inputs['x2'] ?? 1.0 }}" class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-white border border-gray-200 dark:border-gray-800 rounded-2xl focus:outline-none">
                            </div>
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold text-gray-400">Salida Esperada (y)</label>
                            <input type="number" step="any" name="y" value="{{ $inputs['y'] ?? 1.0 }}" class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-white border border-gray-200 dark:border-gray-800 rounded-2xl focus:outline-none">
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400">Peso Inicial w1</label>
                                <input type="number" step="any" name="w1" value="{{ $inputs['w1'] ?? 0.5 }}" class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-white border border-gray-200 dark:border-gray-800 rounded-2xl focus:outline-none">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400">Peso Inicial w2</label>
                                <input type="number" step="any" name="w2" value="{{ $inputs['w2'] ?? 0.5 }}" class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-white border border-gray-200 dark:border-gray-800 rounded-2xl focus:outline-none">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400">Sesgo (b)</label>
                                <input type="number" step="any" name="b" value="{{ $inputs['b'] ?? -0.7 }}" class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-white border border-gray-200 dark:border-gray-800 rounded-2xl focus:outline-none">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400">Tasa Aprendizaje η</label>
                                <input type="number" step="any" name="eta" value="{{ $inputs['eta'] ?? 0.1 }}" class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-white border border-gray-200 dark:border-gray-800 rounded-2xl focus:outline-none">
                            </div>
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold text-gray-400">Épocas de Entrenamiento</label>
                            <input type="number" name="epochs" min="1" max="100" value="{{ $inputs['epochs'] ?? 1 }}" class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-white border border-gray-200 dark:border-gray-800 rounded-2xl focus:outline-none">
                        </div>
                    </div>

                    <!-- FORM 2: MULTI-LAYER (2-2-1 MLP) -->
                    <div id="form-mlp" class="hidden space-y-4">
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400">Entrada x1</label>
                                <input type="number" step="any" name="mlp_x1" value="{{ $inputs['mlp_x1'] ?? 1.0 }}" class="w-full px-4 py-2 bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-white border border-gray-200 dark:border-gray-800 rounded-2xl focus:outline-none">
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-gray-400">Entrada x2</label>
                                <input type="number" step="any" name="mlp_x2" value="{{ $inputs['mlp_x2'] ?? 1.0 }}" class="w-full px-4 py-2 bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-white border border-gray-200 dark:border-gray-800 rounded-2xl focus:outline-none">
                            </div>
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold text-gray-400">Salida Esperada (y)</label>
                            <input type="number" step="any" name="mlp_y" value="{{ $inputs['mlp_y'] ?? 1.0 }}" class="w-full px-4 py-2 bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-white border border-gray-200 dark:border-gray-800 rounded-2xl focus:outline-none">
                        </div>

                        <!-- Hidden Layer Weights -->
                        <div class="p-3 bg-gray-55 dark:bg-gray-900 rounded-2xl space-y-2">
                            <span class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider">Pesos Oculta (w)</span>
                            <div class="grid grid-cols-2 gap-2 text-xs">
                                <div>
                                    <label class="block text-[8px] text-gray-400">w11 (x1 a h1)</label>
                                    <input type="number" step="any" name="mlp_w11" value="{{ $inputs['mlp_w11'] ?? 0.5 }}" class="w-full px-2 py-1 bg-white dark:bg-gray-950 border border-gray-200 dark:border-gray-850 rounded-lg">
                                </div>
                                <div>
                                    <label class="block text-[8px] text-gray-400">w12 (x2 a h1)</label>
                                    <input type="number" step="any" name="mlp_w12" value="{{ $inputs['mlp_w12'] ?? 0.5 }}" class="w-full px-2 py-1 bg-white dark:bg-gray-950 border border-gray-200 dark:border-gray-850 rounded-lg">
                                </div>
                                <div>
                                    <label class="block text-[8px] text-gray-400">w21 (x1 a h2)</label>
                                    <input type="number" step="any" name="mlp_w21" value="{{ $inputs['mlp_w21'] ?? 0.5 }}" class="w-full px-2 py-1 bg-white dark:bg-gray-950 border border-gray-200 dark:border-gray-850 rounded-lg">
                                </div>
                                <div>
                                    <label class="block text-[8px] text-gray-400">w22 (x2 a h2)</label>
                                    <input type="number" step="any" name="mlp_w22" value="{{ $inputs['mlp_w22'] ?? 0.5 }}" class="w-full px-2 py-1 bg-white dark:bg-gray-950 border border-gray-200 dark:border-gray-850 rounded-lg">
                                </div>
                            </div>
                        </div>

                        <!-- Output Layer Weights -->
                        <div class="p-3 bg-gray-55 dark:bg-gray-900 rounded-2xl space-y-2">
                            <span class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider">Pesos Salida (v)</span>
                            <div class="grid grid-cols-2 gap-2 text-xs">
                                <div>
                                    <label class="block text-[8px] text-gray-400">v1 (h1 a y)</label>
                                    <input type="number" step="any" name="mlp_v1" value="{{ $inputs['mlp_v1'] ?? 0.5 }}" class="w-full px-2 py-1 bg-white dark:bg-gray-950 border border-gray-200 dark:border-gray-850 rounded-lg">
                                </div>
                                <div>
                                    <label class="block text-[8px] text-gray-400">v2 (h2 a y)</label>
                                    <input type="number" step="any" name="mlp_v2" value="{{ $inputs['mlp_v2'] ?? 0.5 }}" class="w-full px-2 py-1 bg-white dark:bg-gray-950 border border-gray-200 dark:border-gray-850 rounded-lg">
                                </div>
                            </div>
                        </div>

                        <!-- Biases -->
                        <div class="p-3 bg-gray-55 dark:bg-gray-900 rounded-2xl space-y-2">
                            <span class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider">Sesgos (b)</span>
                            <div class="grid grid-cols-3 gap-2 text-xs">
                                <div>
                                    <label class="block text-[8px] text-gray-400">b1 (h1)</label>
                                    <input type="number" step="any" name="mlp_b1" value="{{ $inputs['mlp_b1'] ?? -0.7 }}" class="w-full px-2 py-1 bg-white dark:bg-gray-950 border border-gray-200 dark:border-gray-850 rounded-lg">
                                </div>
                                <div>
                                    <label class="block text-[8px] text-gray-400">b2 (h2)</label>
                                    <input type="number" step="any" name="mlp_b2" value="{{ $inputs['mlp_b2'] ?? -0.7 }}" class="w-full px-2 py-1 bg-white dark:bg-gray-950 border border-gray-200 dark:border-gray-850 rounded-lg">
                                </div>
                                <div>
                                    <label class="block text-[8px] text-gray-400">b0 (y)</label>
                                    <input type="number" step="any" name="mlp_b0" value="{{ $inputs['mlp_b0'] ?? -0.7 }}" class="w-full px-2 py-1 bg-white dark:bg-gray-950 border border-gray-200 dark:border-gray-850 rounded-lg">
                                </div>
                            </div>
                        </div>

                        <!-- Learning rate mlp -->
                        <div>
                            <label class="block text-[10px] font-bold text-gray-400">Tasa de Aprendizaje η</label>
                            <input type="number" step="any" name="mlp_eta" value="{{ $inputs['mlp_eta'] ?? 0.1 }}" class="w-full px-4 py-2 bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-white border border-gray-200 dark:border-gray-800 rounded-2xl focus:outline-none">
                        </div>
                    </div>

                    <!-- Optional User Notes -->
                    <div>
                        <label for="notes" class="block text-[10px] font-bold text-gray-400">Notas del Ejercicio (Opcional)</label>
                        <input type="text" id="notes" name="notes" placeholder="ej. Ejercicio de la compuerta AND" class="w-full px-4 py-2 bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-white border border-gray-200 dark:border-gray-800 rounded-2xl focus:outline-none">
                    </div>

                    <button type="submit" class="w-full py-3 bg-[var(--m3-primary)] hover:bg-opacity-90 text-white font-bold rounded-2xl text-sm transition-all">
                        Simular Backpropagation
                    </button>
                </form>
            </div>
        </div>

        <!-- Right Column: Results -->
        <div class="lg:col-span-2">
            @if(isset($results))
                <!-- Result Banner -->
                <div class="mb-6 p-6 bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm flex flex-col md:flex-row items-center justify-between gap-4">
                    <div>
                        <span class="text-xs font-bold uppercase tracking-widest text-gray-400">Resultados del Paso</span>
                        <h2 class="text-2xl font-black font-outfit mt-1 text-[var(--m3-primary)]">
                            ŷ = {{ sprintf('%.4f', $results['y_calculated']) }}
                        </h2>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            Error resultante: {{ sprintf('%.4f', $results['error']) }}
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

                <!-- Animated Diagram SVG Card -->
                <div id="animation-card" class="mb-6 p-6 bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm flex flex-col items-center">
                    <h3 class="text-sm font-bold font-outfit text-gray-800 dark:text-gray-200 mb-4 self-start">Visualización del Flujo (Animación)</h3>
                    <div id="backprop-animation-container" class="w-full flex justify-center max-w-[400px]">
                        <!-- Dynamic Animated SVG -->
                    </div>
                    <div class="mt-4 flex gap-4 text-xs font-semibold justify-center">
                        <span class="flex items-center gap-1"><span class="w-3 h-3 rounded-full bg-cyan-400 ring-2 ring-cyan-150 animate-pulse"></span> Forward Pass (Activación)</span>
                        <span class="flex items-center gap-1"><span class="w-3 h-3 rounded-full bg-pink-400 ring-2 ring-pink-150 animate-pulse"></span> Backward Pass (Error Delta)</span>
                    </div>
                </div>

                <!-- EXAM MODE PROCEDURAL WRITING -->
                <div id="exam-mode-view" class="hidden p-6 bg-white border border-gray-300 rounded-2xl font-mono text-sm text-black space-y-4">
                    <h3 class="text-lg font-bold border-b pb-2">Procedimiento Resolutivo de Examen (Backpropagation)</h3>
                    <div>
                        <strong>Datos de Entrada:</strong><br>
                        @if($inputs['mode'] === 'single')
                            x1 = {{ $inputs['x1'] }}, x2 = {{ $inputs['x2'] }} | y = {{ $inputs['y'] }}<br>
                            w1 = {{ $inputs['w1'] }}, w2 = {{ $inputs['w2'] }}, b = {{ $inputs['b'] }} | η = {{ $inputs['eta'] }}
                        @else
                            x1 = {{ $inputs['mlp_x1'] }}, x2 = {{ $inputs['mlp_x2'] }} | y = {{ $inputs['mlp_y'] }}<br>
                            w11 = {{ $inputs['mlp_w11'] }}, w12 = {{ $inputs['mlp_w12'] }}, w21 = {{ $inputs['mlp_w21'] }}, w22 = {{ $inputs['mlp_w22'] }}<br>
                            v1 = {{ $inputs['mlp_v1'] }}, v2 = {{ $inputs['mlp_v2'] }} | b1 = {{ $inputs['mlp_b1'] }}, b2 = {{ $inputs['mlp_b2'] }}, b0 = {{ $inputs['mlp_b0'] }} | η = {{ $inputs['mlp_eta'] }}
                        @endif
                    </div>

                    <div class="space-y-4">
                        @foreach($results['steps'] as $step)
                            @if($step['type'] !== 'input' && $step['type'] !== 'info')
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

                <!-- VISUAL MODE (STANDARD) -->
                <div id="visual-mode-view" class="space-y-6">
                    <h3 class="text-lg font-bold font-outfit text-gray-800 dark:text-gray-200 border-b pb-2">Procedimiento Detallado</h3>

                    <div class="space-y-4">
                        @foreach($results['steps'] as $step)
                            @php
                                $typeColors = [
                                    'input' => 'bg-sky-50 dark:bg-sky-950/20 border-sky-100 dark:border-sky-900 text-sky-900 dark:text-sky-200',
                                    'sum' => 'bg-purple-50 dark:bg-purple-950/20 border-purple-100 dark:border-purple-900 text-purple-900 dark:text-purple-200',
                                    'activation' => 'bg-cyan-50 dark:bg-cyan-950/20 border-cyan-100 dark:border-cyan-900 text-cyan-900 dark:text-cyan-200',
                                    'error' => 'bg-red-50 dark:bg-red-950/20 border-red-100 dark:border-red-900 text-red-900 dark:text-red-200',
                                    'delta' => 'bg-pink-55 dark:bg-pink-950/20 border-pink-100 dark:border-pink-900 text-pink-900 dark:text-pink-200',
                                    'update' => 'bg-yellow-50 dark:bg-yellow-950/20 border-yellow-100 dark:border-yellow-900 text-yellow-900 dark:text-yellow-250',
                                    'final' => 'bg-green-50 dark:bg-green-950/20 border-green-100 dark:border-green-900 text-green-900 dark:text-green-200',
                                ];
                                $class = $typeColors[$step['type']] ?? 'bg-gray-50 border-gray-100 text-gray-850';
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
                <!-- Pre-run banner -->
                <div class="p-12 text-center bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm no-print">
                    <svg class="w-16 h-16 text-gray-300 dark:text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                    </svg>
                    <h3 class="text-lg font-bold font-outfit text-gray-900 dark:text-white mb-1">Cálculo Listo</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Ingresa tus pesos a la izquierda para analizar la retropropagación del error.</p>
                </div>
            @endif
        </div>

    </div>

    <script>
        // Toggle input mode (single vs mlp)
        function toggleMode(mode) {
            const tabSingle = document.getElementById('tab-single-btn');
            const tabMlp = document.getElementById('tab-mlp-btn');
            const formSingle = document.getElementById('form-single');
            const formMlp = document.getElementById('form-mlp');
            const modeInput = document.getElementById('mode-input');

            modeInput.value = mode;

            if (mode === 'single') {
                tabSingle.className = "py-2 text-center text-xs font-bold rounded-xl bg-[var(--m3-primary)] text-white shadow-sm transition-all";
                tabMlp.className = "py-2 text-center text-xs font-bold rounded-xl text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 transition-all";
                formSingle.classList.remove('hidden');
                formMlp.classList.add('hidden');
            } else {
                tabMlp.className = "py-2 text-center text-xs font-bold rounded-xl bg-[var(--m3-primary)] text-white shadow-sm transition-all";
                tabSingle.className = "py-2 text-center text-xs font-bold rounded-xl text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 transition-all";
                formMlp.classList.remove('hidden');
                formSingle.classList.add('hidden');
            }
        }

        // Example Loader
        function loadExample(mode) {
            toggleMode(mode);

            if (mode === 'single') {
                document.getElementsByName('x1')[0].value = 1.0;
                document.getElementsByName('x2')[0].value = 1.0;
                document.getElementsByName('y')[0].value = 1.0;
                document.getElementsByName('w1')[0].value = 0.5;
                document.getElementsByName('w2')[0].value = 0.5;
                document.getElementsByName('b')[0].value = -0.7;
                document.getElementsByName('eta')[0].value = 0.1;
                document.getElementsByName('epochs')[0].value = 1;
            } else {
                document.getElementsByName('mlp_x1')[0].value = 1.0;
                document.getElementsByName('mlp_x2')[0].value = 1.0;
                document.getElementsByName('mlp_y')[0].value = 1.0;
                document.getElementsByName('mlp_w11')[0].value = 0.5;
                document.getElementsByName('mlp_w12')[0].value = 0.5;
                document.getElementsByName('mlp_w21')[0].value = 0.5;
                document.getElementsByName('mlp_w22')[0].value = 0.5;
                document.getElementsByName('mlp_v1')[0].value = 0.5;
                document.getElementsByName('mlp_v2')[0].value = 0.5;
                document.getElementsByName('mlp_b1')[0].value = -0.7;
                document.getElementsByName('mlp_b2')[0].value = -0.7;
                document.getElementsByName('mlp_b0')[0].value = -0.7;
                document.getElementsByName('mlp_eta')[0].value = 0.1;
            }
        }

        // Initial setup
        document.addEventListener('DOMContentLoaded', () => {
            const startMode = "{{ $inputs['mode'] ?? 'single' }}";
            toggleMode(startMode);

            @if(isset($results))
                drawAnimatedDiagram();
            @endif
        });

        // SVG Animated Diagram Drawer
        function drawAnimatedDiagram() {
            const results = @json($results ?? null);
            if (!results) return;

            const mode = "{{ $inputs['mode'] ?? 'single' }}";
            const width = 400;
            const height = 240;
            const nodeRadius = 15;

            let svg = `<svg viewBox="0 0 ${width} ${height}" class="w-full h-full font-sans overflow-visible">`;

            if (mode === 'single') {
                // 2 inputs, 1 output node
                const xNodes = [{x: 100, y: 70}, {x: 100, y: 170}];
                const yNode = {x: 300, y: 120};

                svg += `
                    <!-- Lines -->
                    <line x1="${xNodes[0].x}" y1="${xNodes[0].y}" x2="${yNode.x}" y2="${yNode.y}" stroke="#9ca3af" stroke-width="2" />
                    <line x1="${xNodes[1].x}" y1="${xNodes[1].y}" x2="${yNode.x}" y2="${yNode.y}" stroke="#9ca3af" stroke-width="2" />

                    <!-- Animated Forward pulse -->
                    <circle cx="0" cy="0" r="4" fill="#22d3ee">
                        <animateMotion path="M ${xNodes[0].x} ${xNodes[0].y} L ${yNode.x} ${yNode.y}" dur="2s" repeatCount="indefinite" begin="0s" />
                    </circle>
                    <circle cx="0" cy="0" r="4" fill="#22d3ee">
                        <animateMotion path="M ${xNodes[1].x} ${xNodes[1].y} L ${yNode.x} ${yNode.y}" dur="2s" repeatCount="indefinite" begin="0s" />
                    </circle>

                    <!-- Animated Backward pulse (starts after delay) -->
                    <circle cx="0" cy="0" r="4" fill="#f472b6">
                        <animateMotion path="M ${yNode.x} ${yNode.y} L ${xNodes[0].x} ${xNodes[0].y}" dur="2s" repeatCount="indefinite" begin="1s" />
                    </circle>
                    <circle cx="0" cy="0" r="4" fill="#f472b6">
                        <animateMotion path="M ${yNode.x} ${yNode.y} L ${xNodes[1].x} ${xNodes[1].y}" dur="2s" repeatCount="indefinite" begin="1s" />
                    </circle>

                    <!-- Input Nodes -->
                    <circle cx="${xNodes[0].x}" cy="${xNodes[0].y}" r="${nodeRadius}" class="fill-white dark:fill-gray-900 stroke-sky-500 stroke-2" />
                    <text x="${xNodes[0].x}" y="${xNodes[0].y+4}" font-size="9" fill="currentColor" text-anchor="middle" class="text-gray-900 dark:text-white" font-weight="bold">x1</text>
                    
                    <circle cx="${xNodes[1].x}" cy="${xNodes[1].y}" r="${nodeRadius}" class="fill-white dark:fill-gray-900 stroke-sky-500 stroke-2" />
                    <text x="${xNodes[1].x}" y="${xNodes[1].y+4}" font-size="9" fill="currentColor" text-anchor="middle" class="text-gray-900 dark:text-white" font-weight="bold">x2</text>

                    <!-- Output Node -->
                    <circle cx="${yNode.x}" cy="${yNode.y}" r="${nodeRadius}" class="fill-white dark:fill-gray-900 stroke-cyan-500 stroke-2" filter="url(#glow)" />
                    <text x="${yNode.x}" y="${yNode.y+4}" font-size="9" fill="currentColor" text-anchor="middle" class="text-gray-900 dark:text-white" font-weight="bold">ŷ</text>
                `;
            } else {
                // MLP 2-2-1
                const xNodes = [{x: 80, y: 70}, {x: 80, y: 170}];
                const hNodes = [{x: 200, y: 70}, {x: 200, y: 170}];
                const yNode = {x: 320, y: 120};

                svg += `
                    <!-- Lines Layer 1 -->
                    <line x1="${xNodes[0].x}" y1="${xNodes[0].y}" x2="${hNodes[0].x}" y2="${hNodes[0].y}" stroke="#9ca3af" stroke-width="2" />
                    <line x1="${xNodes[0].x}" y1="${xNodes[0].y}" x2="${hNodes[1].x}" y2="${hNodes[1].y}" stroke="#9ca3af" stroke-width="2" />
                    <line x1="${xNodes[1].x}" y1="${xNodes[1].y}" x2="${hNodes[0].x}" y2="${hNodes[0].y}" stroke="#9ca3af" stroke-width="2" />
                    <line x1="${xNodes[1].x}" y1="${xNodes[1].y}" x2="${hNodes[1].x}" y2="${hNodes[1].y}" stroke="#9ca3af" stroke-width="2" />
                    <!-- Lines Layer 2 -->
                    <line x1="${hNodes[0].x}" y1="${hNodes[0].y}" x2="${yNode.x}" y2="${yNode.y}" stroke="#9ca3af" stroke-width="2" />
                    <line x1="${hNodes[1].x}" y1="${hNodes[1].y}" x2="${yNode.x}" y2="${yNode.y}" stroke="#9ca3af" stroke-width="2" />

                    <!-- Animated Forward pulse (L1) -->
                    <circle cx="0" cy="0" r="3" fill="#22d3ee"><animateMotion path="M ${xNodes[0].x} ${xNodes[0].y} L ${hNodes[0].x} ${hNodes[0].y}" dur="3s" repeatCount="indefinite" begin="0s" /></circle>
                    <circle cx="0" cy="0" r="3" fill="#22d3ee"><animateMotion path="M ${xNodes[0].x} ${xNodes[0].y} L ${hNodes[1].x} ${hNodes[1].y}" dur="3s" repeatCount="indefinite" begin="0s" /></circle>
                    <circle cx="0" cy="0" r="3" fill="#22d3ee"><animateMotion path="M ${xNodes[1].x} ${xNodes[1].y} L ${hNodes[0].x} ${hNodes[0].y}" dur="3s" repeatCount="indefinite" begin="0s" /></circle>
                    <circle cx="0" cy="0" r="3" fill="#22d3ee"><animateMotion path="M ${xNodes[1].x} ${xNodes[1].y} L ${hNodes[1].x} ${hNodes[1].y}" dur="3s" repeatCount="indefinite" begin="0s" /></circle>
                    
                    <!-- Animated Forward pulse (L2) -->
                    <circle cx="0" cy="0" r="3" fill="#22d3ee"><animateMotion path="M ${hNodes[0].x} ${hNodes[0].y} L ${yNode.x} ${yNode.y}" dur="3s" repeatCount="indefinite" begin="1s" /></circle>
                    <circle cx="0" cy="0" r="3" fill="#22d3ee"><animateMotion path="M ${hNodes[1].x} ${hNodes[1].y} L ${yNode.x} ${yNode.y}" dur="3s" repeatCount="indefinite" begin="1s" /></circle>

                    <!-- Animated Backward pulse (L2) -->
                    <circle cx="0" cy="0" r="3" fill="#f472b6"><animateMotion path="M ${yNode.x} ${yNode.y} L ${hNodes[0].x} ${hNodes[0].y}" dur="3s" repeatCount="indefinite" begin="1.5s" /></circle>
                    <circle cx="0" cy="0" r="3" fill="#f472b6"><animateMotion path="M ${yNode.x} ${yNode.y} L ${hNodes[1].x} ${hNodes[1].y}" dur="3s" repeatCount="indefinite" begin="1.5s" /></circle>

                    <!-- Animated Backward pulse (L1) -->
                    <circle cx="0" cy="0" r="3" fill="#f472b6"><animateMotion path="M ${hNodes[0].x} ${hNodes[0].y} L ${xNodes[0].x} ${xNodes[0].y}" dur="3s" repeatCount="indefinite" begin="2.5s" /></circle>
                    <circle cx="0" cy="0" r="3" fill="#f472b6"><animateMotion path="M ${hNodes[0].x} ${hNodes[0].y} L ${xNodes[1].x} ${xNodes[1].y}" dur="3s" repeatCount="indefinite" begin="2.5s" /></circle>
                    <circle cx="0" cy="0" r="3" fill="#f472b6"><animateMotion path="M ${hNodes[1].x} ${hNodes[1].y} L ${xNodes[0].x} ${xNodes[0].y}" dur="3s" repeatCount="indefinite" begin="2.5s" /></circle>
                    <circle cx="0" cy="0" r="3" fill="#f472b6"><animateMotion path="M ${hNodes[1].x} ${hNodes[1].y} L ${xNodes[1].x} ${xNodes[1].y}" dur="3s" repeatCount="indefinite" begin="2.5s" /></circle>

                    <!-- Input Nodes -->
                    <circle cx="${xNodes[0].x}" cy="${xNodes[0].y}" r="${nodeRadius}" class="fill-white dark:fill-gray-900 stroke-sky-500 stroke-2" />
                    <text x="${xNodes[0].x}" y="${xNodes[0].y+3}" font-size="8" fill="currentColor" text-anchor="middle" class="text-gray-900 dark:text-white" font-weight="bold">x1</text>
                    <circle cx="${xNodes[1].x}" cy="${xNodes[1].y}" r="${nodeRadius}" class="fill-white dark:fill-gray-900 stroke-sky-500 stroke-2" />
                    <text x="${xNodes[1].x}" y="${xNodes[1].y+3}" font-size="8" fill="currentColor" text-anchor="middle" class="text-gray-900 dark:text-white" font-weight="bold">x2</text>

                    <!-- Hidden Nodes -->
                    <circle cx="${hNodes[0].x}" cy="${hNodes[0].y}" r="${nodeRadius}" class="fill-white dark:fill-gray-900 stroke-purple-500 stroke-2" />
                    <text x="${hNodes[0].x}" y="${hNodes[0].y+3}" font-size="8" fill="currentColor" text-anchor="middle" class="text-gray-900 dark:text-white" font-weight="bold">h1</text>
                    <circle cx="${hNodes[1].x}" cy="${hNodes[1].y}" r="${nodeRadius}" class="fill-white dark:fill-gray-900 stroke-purple-500 stroke-2" />
                    <text x="${hNodes[1].x}" y="${hNodes[1].y+3}" font-size="8" fill="currentColor" text-anchor="middle" class="text-gray-900 dark:text-white" font-weight="bold">h2</text>

                    <!-- Output Node -->
                    <circle cx="${yNode.x}" cy="${yNode.y}" r="${nodeRadius}" class="fill-white dark:fill-gray-900 stroke-cyan-500 stroke-2" filter="url(#glow)" />
                    <text x="${yNode.x}" y="${yNode.y+3}" font-size="8" fill="currentColor" text-anchor="middle" class="text-gray-900 dark:text-white" font-weight="bold">ŷ</text>
                `;
            }

            // Glow filter
            svg += `
                <defs>
                    <filter id="glow" x="-20%" y="-20%" width="140%" height="140%">
                        <feGaussianBlur stdDeviation="3" result="blur" />
                        <feComposite in="SourceGraphic" in2="blur" operator="over" />
                    </filter>
                </defs>
            </svg>`;

            document.getElementById('backprop-animation-container').innerHTML = svg;
        }

        function toggleExamMode() {
            const examView = document.getElementById('exam-mode-view');
            const visualView = document.getElementById('visual-mode-view');
            const btn = document.getElementById('exam-mode-btn');
            const animationCard = document.getElementById('animation-card');

            if (examView.classList.contains('hidden')) {
                examView.classList.remove('hidden');
                visualView.classList.add('hidden');
                animationCard.classList.add('hidden');
                btn.innerText = "Ver como Visual";
            } else {
                examView.classList.add('hidden');
                visualView.classList.remove('hidden');
                animationCard.classList.remove('hidden');
                btn.innerText = "Ver como Examen";
            }
        }
    </script>
</x-app-layout>
