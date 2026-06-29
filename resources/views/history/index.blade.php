<x-app-layout>
    <x-slot name="title">Historial - NeuroSmart Trainer</x-slot>

    <!-- Header -->
    <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold font-outfit text-gray-900 dark:text-white mb-1">
                Historial de Ejercicios
            </h1>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Consulta y repite las simulaciones de redes neuronales guardadas localmente.
            </p>
        </div>
        
        @if($history->isNotEmpty())
            <form action="{{ route('history.clear') }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar todo el historial?');" class="self-start md:self-auto">
                @csrf
                <button type="submit" class="px-5 py-2.5 bg-red-600 text-white hover:bg-red-700 font-semibold rounded-full text-sm shadow-sm transition-all">
                    Vaciar Historial
                </button>
            </form>
        @endif
    </div>

    <!-- Alert Success -->
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 dark:bg-green-950 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-200 text-sm rounded-2xl flex items-center gap-2">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Alert Error -->
    @if(session('error'))
        <div class="mb-6 p-4 bg-red-50 dark:bg-red-950 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-200 text-sm rounded-2xl flex items-center gap-2">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <!-- History List -->
    @if($history->isEmpty())
        <div class="p-12 text-center bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm">
            <svg class="w-16 h-16 text-gray-300 dark:text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
            </svg>
            <h3 class="text-lg font-bold font-outfit text-gray-900 dark:text-white mb-1">Aún no hay registros</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">Resuelve algún ejercicio en cualquiera de los módulos para guardarlo en el historial.</p>
            <div class="flex flex-wrap justify-center gap-2">
                <a href="{{ route('perceptron.index') }}" class="px-4 py-2 bg-sky-100 text-sky-800 dark:bg-sky-950 dark:text-sky-300 hover:bg-opacity-80 rounded-full text-xs font-bold transition-all">Perceptrón</a>
                <a href="{{ route('forward.index') }}" class="px-4 py-2 bg-cyan-100 text-cyan-800 dark:bg-cyan-950 dark:text-cyan-300 hover:bg-opacity-80 rounded-full text-xs font-bold transition-all">Forward Prop</a>
                <a href="{{ route('backprop.index') }}" class="px-4 py-2 bg-purple-100 text-purple-800 dark:bg-purple-950 dark:text-purple-300 hover:bg-opacity-80 rounded-full text-xs font-bold transition-all">Backpropagation</a>
                <a href="{{ route('hopfield.index') }}" class="px-4 py-2 bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-300 hover:bg-opacity-80 rounded-full text-xs font-bold transition-all">Hopfield</a>
            </div>
        </div>
    @else
        <div class="grid grid-cols-1 gap-4">
            @foreach($history as $item)
                @php
                    $typeLabels = [
                        'perceptron' => ['Perceptrón Simple', 'bg-sky-100 text-sky-850 border-sky-200 dark:bg-sky-950 dark:text-sky-300 dark:border-sky-800'],
                        'forward_propagation' => ['Forward Propagation', 'bg-cyan-100 text-cyan-850 border-cyan-200 dark:bg-cyan-950 dark:text-cyan-300 dark:border-cyan-800'],
                        'backpropagation' => ['Backpropagation', 'bg-purple-100 text-purple-850 border-purple-200 dark:bg-purple-950 dark:text-purple-300 dark:border-purple-800'],
                        'hopfield' => ['Red Hopfield', 'bg-emerald-100 text-emerald-850 border-emerald-200 dark:bg-emerald-950 dark:text-emerald-300 dark:border-emerald-800'],
                    ];
                    $label = $typeLabels[$item->type][0] ?? $item->type;
                    $class = $typeLabels[$item->type][1] ?? 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200';
                @endphp

                <div class="p-6 bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div class="space-y-2">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="px-3 py-1 rounded-full text-xs font-bold border {{ $class }}">
                                {{ $label }}
                            </span>
                            @if($item->is_successful)
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-green-150 text-green-800 dark:bg-green-950 dark:text-green-300">
                                    {{ $item->type === 'hopfield' ? 'Estable' : 'Convergente' }}
                                </span>
                            @else
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-red-150 text-red-800 dark:bg-red-950 dark:text-red-300">
                                    {{ $item->type === 'hopfield' ? 'Inestable / No converge' : 'No convergente' }}
                                </span>
                            @endif
                            <span class="text-xs text-gray-400">
                                {{ $item->created_at->format('d/m/Y H:i') }}
                            </span>
                        </div>

                        <!-- Summary of inputs/results -->
                        <div class="text-sm text-gray-600 dark:text-gray-300">
                            @if($item->type === 'perceptron')
                                <p><strong>Entradas:</strong> {{ $item->inputs['num_inputs'] }} | <strong>Épocas:</strong> {{ $item->inputs['epochs'] }} | <strong>η:</strong> {{ $item->inputs['learning_rate'] }}</p>
                                <p class="text-xs text-gray-400">Resultados: Épocas corridas: {{ $item->results['epochs_run'] }} | Pesos finales: [{{ implode(', ', array_map(fn($v) => round($v, 4), $item->results['final_weights'])) }}] | Sesgo: {{ round($item->results['final_bias'], 4) }}</p>
                            @elseif($item->type === 'forward_propagation')
                                <p><strong>Arquitectura:</strong> {{ $item->inputs['num_inputs'] }} \rightarrow {{ implode(' \rightarrow ', $item->inputs['layer_sizes']) }}</p>
                                <p class="text-xs text-gray-400">Resultados: Salida final: [{{ implode(', ', array_map(fn($v) => round($v, 4), $item->results['output'])) }}]</p>
                            @elseif($item->type === 'backpropagation')
                                <p><strong>Modo:</strong> {{ $item->results['mode'] === 'single' ? 'Una Neurona' : 'Multicapa 2-2-1' }} | <strong>η:</strong> {{ $item->inputs['mode'] === 'single' ? $item->inputs['eta'] : $item->inputs['mlp_eta'] }}</p>
                                @if($item->results['mode'] === 'single')
                                    <p class="text-xs text-gray-400">Resultados: w1 = {{ round($item->results['final_w1'], 4) }}, w2 = {{ round($item->results['final_w2'], 4) }}, b = {{ round($item->results['final_b'], 4) }}</p>
                                @else
                                    <p class="text-xs text-gray-400">Resultados: Pesos de Salida v = [{{ round($item->results['new_weights_output']['v1'], 4) }}, {{ round($item->results['new_weights_output']['v2'], 4) }}]</p>
                                @endif
                            @elseif($item->type === 'hopfield')
                                <p><strong>Tamaño del vector S:</strong> {{ count($item->results['final_state']) }} | <strong>Modo:</strong> {{ $item->inputs['update_mode'] === 'sync' ? 'Síncrono' : 'Asíncrono' }}</p>
                                <p class="text-xs text-gray-400">Resultados: Patrón final: [{{ implode(', ', $item->results['final_state']) }}] | {{ $item->results['matched_pattern_index'] !== -1 ? 'Coincide con Patrón ' . ($item->results['matched_pattern_index'] + 1) : 'Estado Espurio' }}</p>
                            @endif
                        </div>

                        <!-- User notes -->
                        @if($item->notes)
                            <div class="mt-2 text-xs italic text-gray-500 dark:text-gray-400 bg-gray-50 dark:bg-gray-900 p-2 rounded-xl">
                                <strong>Nota:</strong> {{ $item->notes }}
                            </div>
                        @endif
                    </div>

                    <div class="flex items-center gap-2 shrink-0">
                        <a href="{{ route('history.repeat', $item->id) }}" class="px-4 py-2 bg-[var(--m3-primary)] text-white hover:bg-opacity-90 font-semibold rounded-full text-xs shadow-sm transition-all">
                            Cargar Parámetros
                        </a>
                        <form action="{{ route('history.delete', $item->id) }}" method="POST" onsubmit="return confirm('¿Eliminar este ejercicio?');">
                            @csrf
                            <button type="submit" class="p-2 text-red-600 hover:bg-red-50 dark:hover:bg-red-950 rounded-full transition-all" title="Eliminar">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</x-app-layout>
