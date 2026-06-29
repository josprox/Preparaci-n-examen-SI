<x-app-layout>
    <x-slot name="title">Red Hopfield - NeuroSmart Trainer</x-slot>

    <!-- Header -->
    <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold font-outfit text-gray-900 dark:text-white mb-1">
                Red Neuronal Recurrente de Hopfield
            </h1>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Almacena patrones de memoria asociativa y comprueba la estabilidad del sistema.
            </p>
        </div>
        
        <div class="flex flex-wrap gap-2 no-print">
            <button type="button" onclick="loadExample('std3')" class="px-4 py-2 bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-full text-xs font-bold transition-all">
                Ejemplo 3 N (Estándar)
            </button>
            <button type="button" onclick="loadExample('std4')" class="px-4 py-2 bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-full text-xs font-bold transition-all">
                Ejercicio 38 Examen (Estándar)
            </button>
            <button type="button" onclick="loadExample('matlab')" class="px-4 py-2 bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-full text-xs font-bold transition-all">
                Ejemplo de Matlab (Personalizado)
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
        
        <!-- Left Column: Inputs Form (no-print) -->
        <div class="lg:col-span-1 no-print">
            <div class="p-6 bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm space-y-4">
                <h2 class="text-lg font-bold font-outfit text-gray-900 dark:text-white mb-2 font-outfit">Configuración de Hopfield</h2>

                <form action="{{ route('hopfield.solve') }}" method="POST" class="space-y-4">
                    @csrf

                    <!-- Mode Selector -->
                    <div>
                        <label for="hopfield_mode" class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1">Modo de Red Hopfield</label>
                        <select id="hopfield_mode" name="hopfield_mode" onchange="toggleHopfieldFields()" class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-white border border-gray-200 dark:border-gray-800 rounded-2xl focus:outline-none focus:ring-2 focus:ring-purple-500">
                            <option value="matlab" {{ ($inputs['hopfield_mode'] ?? 'matlab') === 'matlab' ? 'selected' : '' }}>Modo Matlab (Vectores Fila/Columna)</option>
                            <option value="standard" {{ ($inputs['hopfield_mode'] ?? 'matlab') === 'standard' ? 'selected' : '' }}>Estándar (Autoasociativo)</option>
                        </select>
                    </div>

                    <!-- Standard Mode Fields -->
                    <div id="standard-mode-fields" class="{{ ($inputs['hopfield_mode'] ?? 'standard') === 'standard' ? '' : 'hidden' }}">
                        <label for="patterns_raw" class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1">Patrones a Memorizar (uno por línea)</label>
                        <textarea id="patterns_raw" name="patterns_raw" rows="3" placeholder="ej. 1, 1, 1, -1" class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-white border border-gray-200 dark:border-gray-800 rounded-2xl focus:outline-none focus:ring-2 focus:ring-purple-500 font-mono text-sm">{{ $inputs['patterns_raw'] }}</textarea>
                        <span class="text-[10px] text-gray-400 block mt-1">Usa valores separados por comas. Si ingresas 0, se convertirá a -1 automáticamente.</span>
                    </div>

                    <!-- Matlab Mode Fields -->
                    <div id="matlab-mode-fields" class="space-y-4 {{ ($inputs['hopfield_mode'] ?? 'standard') === 'matlab' ? '' : 'hidden' }}">
                        <div>
                            <label for="matlab_p" class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1">p (Fila - Separado por comas ,)</label>
                            <input type="text" id="matlab_p" name="matlab_p" value="{{ $inputs['matlab_p'] ?? '' }}" placeholder="ej. [1, -1, 1, -1]" class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-white border border-gray-200 dark:border-gray-800 rounded-2xl focus:outline-none focus:ring-2 focus:ring-purple-500 font-mono text-sm">
                        </div>
                        <div>
                            <label for="matlab_pt" class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1">Pt (Columna - Separado por punto y coma ;)</label>
                            <input type="text" id="matlab_pt" name="matlab_pt" value="{{ $inputs['matlab_pt'] ?? '' }}" placeholder="ej. [1; -1; 1; 1]" class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-white border border-gray-200 dark:border-gray-800 rounded-2xl focus:outline-none focus:ring-2 focus:ring-purple-500 font-mono text-sm">
                        </div>
                    </div>

                    <!-- Test pattern S -->
                    <div id="test-pattern-container">
                        <label id="test-pattern-label" for="test_pattern_raw" class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1">Patrón de Prueba (S)</label>
                        <input type="text" id="test_pattern_raw" name="test_pattern_raw" value="{{ $inputs['test_pattern_raw'] }}" placeholder="ej. [1; 1; 1; -1]" class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-white border border-gray-200 dark:border-gray-800 rounded-2xl focus:outline-none focus:ring-2 focus:ring-purple-500 font-mono text-sm" required>
                    </div>

                    <!-- Update Mode -->
                    <div id="update-mode-container" class="{{ ($inputs['hopfield_mode'] ?? 'standard') === 'standard' ? '' : 'hidden' }}">
                        <label for="update_mode" class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1">Modo de Actualización</label>
                        <select id="update_mode" name="update_mode" class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-white border border-gray-200 dark:border-gray-800 rounded-2xl focus:outline-none focus:ring-2 focus:ring-purple-500">
                            <option value="sync" {{ $inputs['update_mode'] === 'sync' ? 'selected' : '' }}>Síncrono (Vector Completo)</option>
                            <option value="async" {{ $inputs['update_mode'] === 'async' ? 'selected' : '' }}>Asíncrono (Secuencial In-place)</option>
                        </select>
                    </div>

                    <!-- Max Iterations -->
                    <div id="max-iterations-container" class="{{ ($inputs['hopfield_mode'] ?? 'standard') === 'standard' ? '' : 'hidden' }}">
                        <label for="max_iterations" class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1">Iteraciones Máximas</label>
                        <input type="number" id="max_iterations" name="max_iterations" min="1" max="100" value="{{ $inputs['max_iterations'] }}" class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-white border border-gray-200 dark:border-gray-800 rounded-2xl focus:outline-none focus:ring-2 focus:ring-purple-500">
                    </div>

                    <!-- Notes -->
                    <div>
                        <label for="notes" class="block text-xs font-bold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1">Notas del Ejercicio (Opcional)</label>
                        <input type="text" id="notes" name="notes" placeholder="ej. Pregunta 38 del Examen espejo" class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-white border border-gray-200 dark:border-gray-800 rounded-2xl focus:outline-none focus:ring-2 focus:ring-purple-500">
                    </div>

                    <!-- Live LaTeX Preview -->
                    <div id="latex-preview-card" class="p-4 bg-gray-50 dark:bg-gray-950 border border-gray-200 dark:border-gray-900 rounded-2xl">
                        <div id="latex-preview-container">
                            <!-- Populated dynamically by JS -->
                        </div>
                    </div>

                    <button type="submit" class="w-full py-3 bg-[var(--m3-primary)] hover:bg-opacity-90 text-white font-bold rounded-2xl text-sm transition-all">
                        Simular Red Hopfield
                    </button>
                </form>
            </div>
        </div>

        <!-- Right Column: Results & Matrix -->
        <div class="lg:col-span-2">
            @if(isset($results))
                <!-- Result Banner -->
                <div class="mb-6 p-6 bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm flex flex-col md:flex-row items-center justify-between gap-4">
                    <div>
                        <span class="text-xs font-bold uppercase tracking-widest text-gray-400">Estado de Estabilidad</span>
                        <h2 class="text-2xl font-black font-outfit mt-1 flex items-center gap-2">
                            @if($results['stable'])
                                <span class="text-green-600">✓ Patrón Estable</span>
                            @else
                                <span class="text-red-600">✗ Inestable / No Converge</span>
                            @endif
                        </h2>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            @if($results['matched_pattern_index'] !== -1)
                                El patrón convergió y recuperó el <strong>Patrón Original {{ $results['matched_pattern_index'] + 1 }}</strong>.
                            @else
                                Convergió en un <strong>Estado Espurio</strong> (Mínimo local fantasma).
                            @endif
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

                <!-- Weight Matrix Display -->
                <div id="matrix-card" class="mb-6 p-6 bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm">
                    <h3 class="text-sm font-bold font-outfit text-gray-800 dark:text-gray-200 mb-4">Matriz de Pesos W (Sin Auto-conexiones)</h3>
                    <div class="flex justify-center overflow-auto py-2">
                        <div class="inline-block border border-gray-200 dark:border-gray-850 p-2.5 rounded-2xl bg-gray-50 dark:bg-gray-950">
                            <table class="border-collapse">
                                @foreach($results['weights'] as $rIdx => $row)
                                    <tr>
                                        @foreach($row as $cIdx => $val)
                                            @php
                                                $cellClass = 'bg-gray-250 text-gray-500 dark:bg-gray-800 dark:text-gray-500 line-through'; // diagonal 0
                                                if ($rIdx !== $cIdx) {
                                                    if ($val > 0) $cellClass = 'bg-green-100 text-green-800 dark:bg-green-950 dark:text-green-300 font-bold';
                                                    elseif ($val < 0) $cellClass = 'bg-red-100 text-red-800 dark:bg-red-950 dark:text-red-300 font-bold';
                                                    else $cellClass = 'bg-gray-100 text-gray-500 dark:bg-gray-900 dark:text-gray-400';
                                                }
                                            @endphp
                                            <td class="w-12 h-12 text-center text-xs border border-gray-250 dark:border-gray-800 rounded-lg p-1 font-mono {{ $cellClass }}">
                                                {{ $val }}
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Hopfield Graph SVG Card -->
                <div id="graph-card" class="mb-6 p-6 bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm flex flex-col items-center">
                    <h3 class="text-sm font-bold font-outfit text-gray-800 dark:text-gray-200 mb-4 self-start">Grafo de Conexiones entre Neuronas</h3>
                    <div id="svg-container" class="w-full flex justify-center max-w-[320px]">
                        <!-- SVG Drawn dynamically by JS -->
                    </div>
                    <div class="mt-4 flex flex-wrap gap-4 text-xs font-semibold justify-center">
                        <span class="flex items-center gap-1"><span class="w-3 h-3 rounded-full bg-green-500"></span> Conexión Excitatoria (+)</span>
                        <span class="flex items-center gap-1"><span class="w-3 h-3 rounded-full bg-red-500"></span> Conexión Inhibitoria (-)</span>
                        <span class="flex items-center gap-1"><span class="w-3 h-3 rounded-full bg-cyan-400 ring-2 ring-cyan-150"></span> Neurona Activa (1)</span>
                        <span class="flex items-center gap-1"><span class="w-3 h-3 rounded-full bg-gray-400"></span> Neurona Inactiva (-1)</span>
                    </div>
                </div>

                <!-- EXAM MODE RESOLVING PROCEDURAL STEPS -->
                <div id="exam-mode-view" class="hidden p-6 bg-white border border-gray-300 rounded-2xl font-mono text-sm text-black space-y-4">
                    <h3 class="text-lg font-bold border-b pb-2">Procedimiento Resolutivo de Examen (Red Hopfield)</h3>
                    <div>
                        @if(($inputs['hopfield_mode'] ?? 'standard') === 'matlab')
                            <strong>Vector Fila p:</strong> [{{ implode(', ', $results['steps'][0]['data']['bipolar_p'] ?? []) }}]<br>
                            <strong>Vector Columna Pt:</strong> [{{ implode(', ', $results['steps'][0]['data']['bipolar_pt'] ?? []) }}]<br>
                        @else
                            <strong>Patrones Memorizados:</strong><br>
                            @if(isset($results['steps'][0]['data']['bipolar_patterns']))
                                @foreach($results['steps'][0]['data']['bipolar_patterns'] as $idx => $bp)
                                    Patrón {{ $idx + 1 }}: [{{ implode(', ', $bp) }}]<br>
                                @endforeach
                            @endif
                        @endif
                        <strong>Patrón de Prueba Inicial S:</strong> [{{ implode(', ', $results['steps'][0]['data']['bipolar_test_pattern'] ?? []) }}]
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

                <!-- VISUAL DETAILED PROCEDURES -->
                <div id="visual-mode-view" class="space-y-6">
                    <h3 class="text-lg font-bold font-outfit text-gray-800 dark:text-gray-200 border-b pb-2">Procedimiento de Simulación</h3>

                    <div class="space-y-4">
                        @foreach($results['steps'] as $step)
                            @php
                                $typeColors = [
                                    'input' => 'bg-sky-50 dark:bg-sky-950/20 border-sky-100 dark:border-sky-900 text-sky-900 dark:text-sky-200',
                                    'matrix' => 'bg-purple-50 dark:bg-purple-950/20 border-purple-100 dark:border-purple-900 text-purple-900 dark:text-purple-200',
                                    'update' => 'bg-amber-50 dark:bg-amber-950/20 border-amber-100 dark:border-amber-900 text-amber-900 dark:text-amber-250',
                                    'final' => 'bg-green-50 dark:bg-green-950/20 border-green-100 dark:border-green-900 text-green-900 dark:text-green-200',
                                    'info' => 'bg-gray-55 dark:bg-gray-900 border-gray-100 dark:border-gray-800 text-gray-800 dark:text-gray-200',
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
                <!-- Pre-run Banner -->
                <div class="p-12 text-center bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm no-print">
                    <svg class="w-16 h-16 text-gray-300 dark:text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                    </svg>
                    <h3 class="text-lg font-bold font-outfit text-gray-900 dark:text-white mb-1">Cálculo Listo</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Ingresa tus vectores a la izquierda o carga un ejemplo para simular la estabilidad de la red Hopfield.</p>
                </div>
            @endif
        </div>

    </div>

    <!-- JS Example Loader & SVG Draw -->
    <script>
        function toggleHopfieldFields() {
            const mode = document.getElementById('hopfield_mode').value;
            const stdFields = document.getElementById('standard-mode-fields');
            const matFields = document.getElementById('matlab-mode-fields');
            const patternsRaw = document.getElementById('patterns_raw');
            const matlabP = document.getElementById('matlab_p');
            const matlabPt = document.getElementById('matlab_pt');

            const updateModeContainer = document.getElementById('update-mode-container');
            const maxIterationsContainer = document.getElementById('max-iterations-container');
            const testLabel = document.getElementById('test-pattern-label');

            if (mode === 'matlab') {
                stdFields.classList.add('hidden');
                matFields.classList.remove('hidden');
                updateModeContainer.classList.add('hidden');
                maxIterationsContainer.classList.add('hidden');
                testLabel.innerText = "S (ej. [1; 1; 1; -1])";

                patternsRaw.required = false;
                matlabP.required = true;
                matlabPt.required = true;
            } else {
                stdFields.classList.remove('hidden');
                matFields.classList.add('hidden');
                updateModeContainer.classList.remove('hidden');
                maxIterationsContainer.classList.remove('hidden');
                testLabel.innerText = "Patrón de Prueba (S)";

                patternsRaw.required = true;
                matlabP.required = false;
                matlabPt.required = false;
            }
        }

        function parseLiveVector(raw) {
            let clean = raw.trim();
            if (clean.startsWith('[')) clean = clean.substring(1);
            if (clean.endsWith(']')) clean = clean.substring(0, clean.length - 1);
            
            // If it has semicolons or newlines, it's a column vector.
            const isColumn = clean.includes(';') || clean.includes('\n');
            const separators = /[;,\r\n\s]+/;
            const parts = clean.split(separators).map(v => v.trim()).filter(v => v !== '');
            
            return {
                parts: parts,
                isColumn: isColumn
            };
        }

        function vectorToLatexJS(vecInfo) {
            if (!vecInfo || vecInfo.parts.length === 0) {
                return '\\begin{bmatrix} ? \\end{bmatrix}';
            }
            const separator = vecInfo.isColumn ? ' \\\\ ' : ' & ';
            return '\\begin{bmatrix} ' + vecInfo.parts.join(separator) + ' \\end{bmatrix}';
        }

        function updateLivePreview() {
            const mode = document.getElementById('hopfield_mode').value;
            const previewContainer = document.getElementById('latex-preview-container');
            const testPatternRaw = document.getElementById('test_pattern_raw').value;

            if (mode === 'matlab') {
                const pRaw = document.getElementById('matlab_p').value;
                const ptRaw = document.getElementById('matlab_pt').value;

                const pInfo = parseLiveVector(pRaw);
                pInfo.isColumn = false; // force row for p
                
                const ptInfo = parseLiveVector(ptRaw);
                ptInfo.isColumn = true; // force column for Pt

                const sInfo = parseLiveVector(testPatternRaw);
                sInfo.isColumn = true; // force column for S in Matlab

                const pLatex = vectorToLatexJS(pInfo);
                const ptLatex = vectorToLatexJS(ptInfo);
                const sLatex = vectorToLatexJS(sInfo);

                let matrixLatex = '\\begin{bmatrix} ? \\end{bmatrix}';
                if (pInfo.parts.length > 0 && ptInfo.parts.length > 0 && pInfo.parts.length === ptInfo.parts.length) {
                    const size = pInfo.parts.length;
                    const rows = [];
                    for (let i = 0; i < size; i++) {
                        const row = [];
                        for (let j = 0; j < size; j++) {
                            const val1 = parseFloat(ptInfo.parts[i]) || 0;
                            const val2 = parseFloat(pInfo.parts[j]) || 0;
                            const prod = val1 * val2;
                            row.push(prod === 0 ? '0' : prod);
                        }
                        rows.push(row.join(' & '));
                    }
                    matrixLatex = '\\begin{bmatrix} ' + rows.join(' \\\\ ') + ' \\end{bmatrix}';
                }

                previewContainer.innerHTML = `
                    <div class="space-y-2 text-gray-800 dark:text-gray-200">
                        <div class="text-xs font-bold text-gray-500 uppercase">Previsualización Matemática (Matlab):</div>
                        <div class="overflow-auto py-2 text-center text-sm space-y-2">
                            <div>\\( p = ${pLatex} \\)</div>
                            <div>\\( P_t = ${ptLatex} \\)</div>
                            <div>\\( S = ${sLatex} \\)</div>
                            <div class="mt-2 text-xs font-bold text-purple-600 dark:text-purple-400">Matriz H esperada (Pt * p):</div>
                            <div class="mt-1">\\( H = ${ptLatex} \\times ${pLatex} = ${matrixLatex} \\)</div>
                        </div>
                    </div>
                `;
            } else {
                const patternsRaw = document.getElementById('patterns_raw').value;
                const lines = patternsRaw.split('\n').map(l => l.trim()).filter(l => l !== '');
                
                let patternsLatex = '';
                lines.forEach((line, idx) => {
                    const vecInfo = parseLiveVector(line);
                    vecInfo.isColumn = false;
                    patternsLatex += `<div>\\( P_{${idx+1}} = ${vectorToLatexJS(vecInfo)} \\)</div>`;
                });

                const sInfo = parseLiveVector(testPatternRaw);
                sInfo.isColumn = false;
                const sLatex = vectorToLatexJS(sInfo);

                previewContainer.innerHTML = `
                    <div class="space-y-2 text-gray-800 dark:text-gray-200">
                        <div class="text-xs font-bold text-gray-500 uppercase">Previsualización de Patrones (Estándar):</div>
                        <div class="overflow-auto py-2 text-center text-sm space-y-1">
                            ${patternsLatex || '<div>(Ingresa patrones)</div>'}
                            <div class="mt-2">\\( S = ${sLatex} \\)</div>
                        </div>
                    </div>
                `;
            }

            if (window.renderMathInElement) {
                renderMathInElement(previewContainer, {
                    delimiters: [
                        {left: '$$', right: '$$', display: true},
                        {left: '$', right: '$', display: false},
                        {left: '\\(', right: '\\)', display: false},
                        {left: '\\[', right: '\\]', display: true}
                    ]
                });
            }
        }

        function loadExample(type) {
            const modeSel = document.getElementById('hopfield_mode');
            const patterns = document.getElementById('patterns_raw');
            const testPattern = document.getElementById('test_pattern_raw');
            const mode = document.getElementById('update_mode');
            const matlabP = document.getElementById('matlab_p');
            const matlabPt = document.getElementById('matlab_pt');

            if (type === 'std3') {
                modeSel.value = "standard";
                patterns.value = "1, -1, 1";
                testPattern.value = "1, 1, 1";
                mode.value = "async";
            } else if (type === 'std4') {
                modeSel.value = "standard";
                patterns.value = "1, 1, 1, -1";
                testPattern.value = "1, 1, -1, -1";
                mode.value = "async";
            } else if (type === 'matlab') {
                modeSel.value = "matlab";
                matlabP.value = "[1, -1, 1, -1]";
                matlabPt.value = "[1; -1; 1; 1]";
                testPattern.value = "[1; 1; 1; -1]";
                mode.value = "sync";
            }
            toggleHopfieldFields();
            updateLivePreview();
        }

        document.addEventListener('DOMContentLoaded', () => {
            toggleHopfieldFields();
            
            // Live Preview listeners
            document.getElementById('hopfield_mode').addEventListener('change', updateLivePreview);
            document.getElementById('patterns_raw').addEventListener('input', updateLivePreview);
            document.getElementById('matlab_p').addEventListener('input', updateLivePreview);
            document.getElementById('matlab_pt').addEventListener('input', updateLivePreview);
            document.getElementById('test_pattern_raw').addEventListener('input', updateLivePreview);
            
            updateLivePreview();
        });

        @if(isset($results))
            document.addEventListener('DOMContentLoaded', () => {
                drawHopfieldGraph();
            });

            function drawHopfieldGraph() {
                const results = @json($results);
                const weights = results.weights;
                const state = results.final_state;
                const n = state.length;

                const width = 300;
                const height = 300;
                const radius = 90; // radius of circle layout
                const cx = width / 2;
                const cy = height / 2;
                const nodeRadius = 15;

                // Calculate coordinates for circular layout
                const nodes = [];
                for (let i = 0; i < n; i++) {
                    const angle = (2 * Math.PI * i) / n - Math.PI / 2; // start at top
                    const x = cx + radius * Math.cos(angle);
                    const y = cy + radius * Math.sin(angle);
                    nodes.push({ x, y });
                }

                let svg = `<svg viewBox="0 0 ${width} ${height}" class="w-full h-full font-sans overflow-visible">`;

                // Draw connections (lines)
                for (let i = 0; i < n; i++) {
                    for (let j = i + 1; j < n; j++) {
                        const weight = weights[i][j];
                        
                        let strokeColor = '#9ca3af'; // gray for 0
                        if (weight > 0) strokeColor = '#22c55e'; // green
                        if (weight < 0) strokeColor = '#ef4444'; // red

                        const thickness = Math.min(4, 1 + Math.abs(weight));

                        svg += `
                            <line x1="${nodes[i].x}" y1="${nodes[i].y}" x2="${nodes[j].x}" y2="${nodes[j].y}" 
                                  stroke="${strokeColor}" stroke-width="${thickness}" stroke-opacity="0.8" />
                            <!-- Text weight value -->
                            <text x="${(nodes[i].x + nodes[j].x)/2}" y="${(nodes[i].y + nodes[j].y)/2 - 3}" 
                                  font-size="7" fill="#4b5563" text-anchor="middle" font-weight="bold">${weight}</text>
                        `;
                    }
                }

                // Draw Neurons (nodes)
                for (let i = 0; i < n; i++) {
                    const x = nodes[i].x;
                    const y = nodes[i].y;
                    const val = state[i];

                    let nodeClass = 'fill-white dark:fill-gray-900 stroke-gray-400';
                    let glow = '';

                    if (val === 1) {
                        nodeClass = 'fill-white dark:fill-gray-900 stroke-cyan-500 stroke-2';
                        glow = 'filter="url(#glow)"';
                    }

                    svg += `
                        <circle cx="${x}" cy="${y}" r="${nodeRadius}" class="${nodeClass} stroke-2" ${glow} />
                        <!-- Value inside -->
                        <text x="${x}" y="${y + 3}" font-size="8" fill="currentColor" text-anchor="middle" font-weight="bold" class="text-gray-900 dark:text-white">
                            ${val}
                        </text>
                        <!-- Node label -->
                        <text x="${x}" y="${y - nodeRadius - 4}" font-size="8" fill="#9ca3af" text-anchor="middle">
                            n${i + 1}
                        </text>
                    `;
                }

                // Glow filter def
                svg += `
                    <defs>
                        <filter id="glow" x="-20%" y="-20%" width="140%" height="140%">
                            <feGaussianBlur stdDeviation="3" result="blur" />
                            <feComposite in="SourceGraphic" in2="blur" operator="over" />
                        </filter>
                    </defs>
                </svg>`;

                document.getElementById('svg-container').innerHTML = svg;
            }
        @endif

        function toggleExamMode() {
            const examView = document.getElementById('exam-mode-view');
            const visualView = document.getElementById('visual-mode-view');
            const btn = document.getElementById('exam-mode-btn');
            const matrixCard = document.getElementById('matrix-card');
            const graphCard = document.getElementById('graph-card');

            if (examView.classList.contains('hidden')) {
                examView.classList.remove('hidden');
                visualView.classList.add('hidden');
                matrixCard.classList.add('hidden');
                graphCard.classList.add('hidden');
                btn.innerText = "Ver como Visual";
            } else {
                examView.classList.add('hidden');
                visualView.classList.remove('hidden');
                matrixCard.classList.remove('hidden');
                graphCard.classList.remove('hidden');
                btn.innerText = "Ver como Examen";
            }
        }
    </script>
</x-app-layout>
