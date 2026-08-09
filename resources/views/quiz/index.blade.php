<x-app-layout>
    <x-slot name="title">Quiz - NeuroSmart Trainer</x-slot>

    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold font-outfit text-gray-900 dark:text-white mb-1">
            Quiz tipo Kahoot
        </h1>
        <p class="text-sm text-gray-600 dark:text-gray-400">
            Pon a prueba tu teoría y tus habilidades matemáticas con preguntas del examen espejo y la guía del curso.
        </p>
    </div>

    <!-- Main Config Card -->
    <div class="max-w-2xl mx-auto p-6 bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm">
        <div class="text-center mb-6">
            <div class="w-16 h-16 bg-amber-105 text-amber-600 dark:bg-amber-950 dark:text-amber-400 rounded-2xl flex items-center justify-center mx-auto mb-3">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h2 class="text-xl font-bold font-outfit text-gray-900 dark:text-white">Preparar Cuestionario</h2>
            <p class="text-xs text-gray-500 mt-1">Elige tus preferencias de estudio para comenzar.</p>
        </div>

        <form action="{{ route('quiz.play') }}" method="GET" class="space-y-6">
            <!-- Topic Filter -->
            <div>
                <label for="topic" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Tema de Estudio / Parcial</label>
                <select id="topic" name="topic" class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white border border-gray-200 dark:border-gray-800 rounded-2xl focus:outline-none focus:ring-2 focus:ring-purple-500 font-outfit">
                    <option value="all">⚡ Todos los temas (Examen Integrador Global)</option>
                    <optgroup label="--- PRIMER PARCIAL: REDES NEURONALES ---">
                        <option value="Sistemas Inteligentes">Sistemas Inteligentes & Agentes</option>
                        <option value="Sistemas de Control">Sistemas de Control & PID</option>
                        <option value="Perceptrón Simple">Perceptrón Simple (Hebbio)</option>
                        <option value="Forward Propagation">Forward Propagation & MLP</option>
                        <option value="Backpropagation">Backpropagation</option>
                        <option value="Red Hopfield">Red Neuronal Hopfield</option>
                    </optgroup>
                    <optgroup label="--- SEGUNDO PARCIAL: SISTEMAS DE CONOCIMIENTO ---">
                        <option value="Bases de Conocimiento">Bases de Conocimiento & Motor de Inferencia</option>
                        <option value="Marcos (Frames)">Marcos (Frames) & Slots de Minsky</option>
                        <option value="Redes Semánticas">Redes Semánticas (Nodos & Arcos)</option>
                        <option value="IA Moderna & RAG">IA Moderna, BD Vectoriales & RAG</option>
                    </optgroup>
                </select>
            </div>

            <!-- Questions Count -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Cantidad de Preguntas</label>
                <div class="grid grid-cols-5 gap-2">
                    @foreach([5, 10, 15, 20, 25] as $c)
                        <label class="cursor-pointer">
                            <input type="radio" name="count" value="{{ $c }}" class="peer sr-only" {{ $c === 10 ? 'checked' : '' }}>
                            <div class="py-2.5 text-center text-sm font-semibold border border-gray-200 dark:border-gray-800 rounded-xl bg-gray-50 dark:bg-gray-900 text-gray-600 dark:text-gray-400 peer-checked:bg-[var(--m3-primary)] peer-checked:text-white peer-checked:border-[var(--m3-primary)] hover:bg-gray-100 transition-all">
                                {{ $c }}
                            </div>
                        </label>
                    @endforeach
                </div>
            </div>

            <!-- Quiz Mode -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Modo de Juego</label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <label class="cursor-pointer">
                        <input type="radio" name="mode" value="practice" class="peer sr-only" checked>
                        <div class="p-4 border border-gray-200 dark:border-gray-800 rounded-2xl bg-gray-50 dark:bg-gray-900 text-left peer-checked:border-[var(--m3-primary)] peer-checked:bg-purple-50 dark:peer-checked:bg-purple-950 transition-all">
                            <span class="block font-bold text-sm text-gray-900 dark:text-white">Modo Práctica</span>
                            <span class="block text-xs text-gray-500 mt-1">Sin límite de tiempo. Ideal para leer explicaciones detalladas y aprender a tu propio ritmo.</span>
                        </div>
                    </label>

                    <label class="cursor-pointer">
                        <input type="radio" name="mode" value="exam" class="peer sr-only">
                        <div class="p-4 border border-gray-200 dark:border-gray-800 rounded-2xl bg-gray-50 dark:bg-gray-900 text-left peer-checked:border-[var(--m3-primary)] peer-checked:bg-purple-50 dark:peer-checked:bg-purple-950 transition-all">
                            <span class="block font-bold text-sm text-gray-900 dark:text-white">Modo Examen</span>
                            <span class="block text-xs text-gray-500 mt-1">Con temporizador (20s por pregunta). Mide tu velocidad y emula las condiciones reales del examen.</span>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Start Button -->
            <button type="submit" class="w-full py-3.5 bg-[var(--m3-primary)] hover:bg-opacity-90 text-white font-bold rounded-2xl text-sm shadow-sm transition-all flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>¡Iniciar Cuestionario!</span>
            </button>
        </form>
    </div>
</x-app-layout>
