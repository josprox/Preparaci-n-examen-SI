<x-app-layout>
    <x-slot name="title">Dashboard - NeuroSmart Trainer</x-slot>

    <!-- Header & Hero Section -->
    <div class="mb-8 relative overflow-hidden p-8 bg-gradient-to-r from-purple-900 via-indigo-900 to-slate-900 text-white rounded-3xl shadow-lg border border-purple-800/40">
        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
            <div class="max-w-2xl">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold bg-purple-500/20 text-purple-200 border border-purple-400/30 mb-3 backdrop-blur-sm">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span> Plataforma de Estudio Espejo
                </div>
                <h1 class="text-3xl sm:text-4xl font-extrabold font-outfit tracking-tight mb-2">
                    Bienvenido a <span class="bg-gradient-to-r from-purple-300 to-pink-300 bg-clip-text text-transparent">NeuroSmart Trainer</span>
                </h1>
                <p class="text-sm opacity-90 text-purple-100 font-normal leading-relaxed">
                    Tu entrenador interactivo para dominar <strong>Sistemas Inteligentes</strong>, <strong>Redes Neuronales</strong> y <strong>Sistemas Basados en Conocimiento</strong> con simulación en tiempo real.
                </p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('guide.index') }}" class="px-5 py-2.5 bg-white text-purple-950 hover:bg-purple-50 font-bold rounded-full text-xs shadow-md transition-all duration-300 hover:scale-105">
                    Estudiar Guía
                </a>
                <a href="{{ route('quiz.index') }}" class="px-5 py-2.5 bg-purple-600/80 hover:bg-purple-600 border border-purple-400/30 text-white font-bold rounded-full text-xs shadow-md transition-all duration-300 hover:scale-105 backdrop-blur-sm">
                    Iniciar Quiz
                </a>
            </div>
        </div>
    </div>

    <!-- Parcial Filter Chips -->
    <div class="mb-6 flex items-center gap-2 overflow-x-auto pb-2 scrollbar-none">
        <button id="filter-all" class="px-4 py-2 text-xs font-bold rounded-full bg-[var(--m3-primary)] text-white shadow-sm transition-all whitespace-nowrap">
            Todos los Módulos
        </button>
        <button id="filter-parcial1" class="px-4 py-2 text-xs font-bold rounded-full bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-purple-100 dark:hover:bg-purple-950 transition-all whitespace-nowrap flex items-center gap-1.5">
            <span class="w-2 h-2 rounded-full bg-sky-500"></span> 1er Parcial: Redes Neuronales
        </button>
        <button id="filter-parcial2" class="px-4 py-2 text-xs font-bold rounded-full bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-amber-100 dark:hover:bg-amber-950 transition-all whitespace-nowrap flex items-center gap-1.5">
            <span class="w-2 h-2 rounded-full bg-amber-500"></span> 2do Parcial: Sistemas de Conocimiento
        </button>
    </div>

    <!-- PRIMER PARCIAL SECTION -->
    <div id="section-p1-group" class="mb-10">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-bold font-outfit text-gray-900 dark:text-white flex items-center gap-2">
                <span class="px-2.5 py-0.5 rounded-lg bg-sky-100 dark:bg-sky-950 text-sky-700 dark:text-sky-300 text-xs font-bold">1ER PARCIAL</span>
                Redes Neuronales Artificiales
            </h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
            
            <!-- Module 1: Perceptrón -->
            <a href="{{ route('perceptron.index') }}" class="group block p-5 bg-white dark:bg-gray-800 hover:bg-sky-50/50 dark:hover:bg-gray-750 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-1">
                <div class="w-10 h-10 rounded-2xl bg-sky-100 dark:bg-sky-950 flex items-center justify-center text-sky-600 dark:text-sky-400 mb-3 group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <h4 class="text-base font-bold font-outfit text-gray-900 dark:text-white mb-1">1. Perceptrón Simple</h4>
                <p class="text-xs text-gray-600 dark:text-gray-400 leading-relaxed">
                    Algoritmo de entrenamiento Hebbiano con sumas ponderadas, funciones escalón y ajuste dinámico de pesos.
                </p>
                <div class="mt-4 flex items-center gap-1 text-xs font-semibold text-sky-600 dark:text-sky-400">
                    <span>Abrir Perceptrón</span>
                    <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </div>
            </a>

            <!-- Module 2: Forward Propagation -->
            <a href="{{ route('forward.index') }}" class="group block p-5 bg-white dark:bg-gray-800 hover:bg-cyan-50/50 dark:hover:bg-gray-750 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-1">
                <div class="w-10 h-10 rounded-2xl bg-cyan-100 dark:bg-cyan-950 flex items-center justify-center text-cyan-600 dark:text-cyan-400 mb-3 group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </div>
                <h4 class="text-base font-bold font-outfit text-gray-900 dark:text-white mb-1">2. Forward Propagation</h4>
                <p class="text-xs text-gray-600 dark:text-gray-400 leading-relaxed">
                    Flujo de datos hacia adelante en redes multicapa (MLP) evaluando sigmoides y predicciones.
                </p>
                <div class="mt-4 flex items-center gap-1 text-xs font-semibold text-cyan-600 dark:text-cyan-400">
                    <span>Simular Forward</span>
                    <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </div>
            </a>

            <!-- Module 3: Backpropagation -->
            <a href="{{ route('backprop.index') }}" class="group block p-5 bg-white dark:bg-gray-800 hover:bg-purple-50/50 dark:hover:bg-gray-750 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-1">
                <div class="w-10 h-10 rounded-2xl bg-purple-100 dark:bg-purple-950 flex items-center justify-center text-purple-600 dark:text-purple-400 mb-3 group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                </div>
                <h4 class="text-base font-bold font-outfit text-gray-900 dark:text-white mb-1">3. Backpropagation</h4>
                <p class="text-xs text-gray-600 dark:text-gray-400 leading-relaxed">
                    Propagación del error hacia atrás, deltas de sigmoide y actualización matemática de pesos.
                </p>
                <div class="mt-4 flex items-center gap-1 text-xs font-semibold text-purple-600 dark:text-purple-400">
                    <span>Ver Backprop</span>
                    <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </div>
            </a>

            <!-- Module 4: Hopfield -->
            <a href="{{ route('hopfield.index') }}" class="group block p-5 bg-white dark:bg-gray-800 hover:bg-emerald-50/50 dark:hover:bg-gray-750 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-1">
                <div class="w-10 h-10 rounded-2xl bg-emerald-100 dark:bg-emerald-950 flex items-center justify-center text-emerald-600 dark:text-emerald-400 mb-3 group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"/></svg>
                </div>
                <h4 class="text-base font-bold font-outfit text-gray-900 dark:text-white mb-1">4. Red Hopfield</h4>
                <p class="text-xs text-gray-600 dark:text-gray-400 leading-relaxed">
                    Memorias asociativas recurrentes, matriz de pesos sin autoconexiones y función de energía.
                </p>
                <div class="mt-4 flex items-center gap-1 text-xs font-semibold text-emerald-600 dark:text-emerald-400">
                    <span>Simulador Hopfield</span>
                    <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </div>
            </a>

        </div>
    </div>

    <!-- SEGUNDO PARCIAL SECTION -->
    <div id="section-p2-group" class="mb-10">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-bold font-outfit text-gray-900 dark:text-white flex items-center gap-2">
                <span class="px-2.5 py-0.5 rounded-lg bg-amber-100 dark:bg-amber-950 text-amber-700 dark:text-amber-300 text-xs font-bold">2DO PARCIAL</span>
                Representación del Conocimiento & Bases de Conocimiento
            </h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-5">
            
            <!-- Module 5: Knowledge Base & Inference Engine -->
            <a href="{{ route('knowledge.index') }}" class="group block p-6 bg-white dark:bg-gray-800 hover:bg-amber-50/50 dark:hover:bg-gray-750 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-12 h-12 rounded-2xl bg-amber-100 dark:bg-amber-950 flex items-center justify-center text-amber-600 dark:text-amber-400 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 01-2 2h-4a2 2 0 01-2-2v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                    </div>
                    <span class="px-2.5 py-1 text-[10px] font-bold rounded-full bg-amber-100 text-amber-800 dark:bg-amber-950 dark:text-amber-300">NUEVO SIMULADOR</span>
                </div>
                <h4 class="text-lg font-bold font-outfit text-gray-900 dark:text-white mb-2">5. Base de Conocimientos & Motor de Inferencia</h4>
                <p class="text-xs text-gray-600 dark:text-gray-400 leading-relaxed mb-4">
                    Simula la arquitectura de Sistemas Inteligentes basados en conocimiento: Hechos (Heurística), Reglas de Producción SI-ENTONCES y Motor de Inferencia para derivación deductiva.
                </p>
                <div class="flex items-center gap-1.5 text-xs font-bold text-amber-600 dark:text-amber-400">
                    <span>Ejecutar simulador de reglas</span>
                    <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </div>
            </a>

            <!-- Module 6: Semantic Networks & Frames -->
            <a href="{{ route('semantic.index') }}" class="group block p-6 bg-white dark:bg-gray-800 hover:bg-teal-50/50 dark:hover:bg-gray-750 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-12 h-12 rounded-2xl bg-teal-100 dark:bg-teal-950 flex items-center justify-center text-teal-600 dark:text-teal-400 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/></svg>
                    </div>
                    <span class="px-2.5 py-1 text-[10px] font-bold rounded-full bg-teal-100 text-teal-800 dark:bg-teal-950 dark:text-teal-300">NUEVO SIMULADOR</span>
                </div>
                <h4 class="text-lg font-bold font-outfit text-gray-900 dark:text-white mb-2">6. Redes Semánticas & Marcos (Frames)</h4>
                <p class="text-xs text-gray-600 dark:text-gray-400 leading-relaxed mb-4">
                    Explora la representación mediante grafos dirigidos (Nodos, Arcos, Jerarquías) y Marcos (Marvin Minsky, 1975) con ranuras (slots), herencia de propiedades y excepciones.
                </p>
                <div class="flex items-center gap-1.5 text-xs font-bold text-teal-600 dark:text-teal-400">
                    <span>Ver grafos e inspeccionar slots</span>
                    <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </div>
            </a>

        </div>
    </div>

    <!-- JS Category Filter Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btnAll = document.getElementById('filter-all');
            const btnP1 = document.getElementById('filter-parcial1');
            const btnP2 = document.getElementById('filter-parcial2');
            const secP1 = document.getElementById('section-p1-group');
            const secP2 = document.getElementById('section-p2-group');

            const activeClass = "px-4 py-2 text-xs font-bold rounded-full bg-[var(--m3-primary)] text-white shadow-sm transition-all whitespace-nowrap";
            const inactiveClass = "px-4 py-2 text-xs font-bold rounded-full bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 transition-all whitespace-nowrap flex items-center gap-1.5";

            btnAll.addEventListener('click', function() {
                secP1.style.display = 'block';
                secP2.style.display = 'block';
                btnAll.className = activeClass;
                btnP1.className = inactiveClass;
                btnP2.className = inactiveClass;
            });

            btnP1.addEventListener('click', function() {
                secP1.style.display = 'block';
                secP2.style.display = 'none';
                btnP1.className = activeClass;
                btnAll.className = inactiveClass;
                btnP2.className = inactiveClass;
            });

            btnP2.addEventListener('click', function() {
                secP1.style.display = 'none';
                secP2.style.display = 'block';
                btnP2.className = activeClass;
                btnAll.className = inactiveClass;
                btnP1.className = inactiveClass;
            });
        });
    </script>
</x-app-layout>
