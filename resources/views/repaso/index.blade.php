<x-app-layout>
    <x-slot name="title">Guía de Estudio Interactiva - NeuroSmart Trainer</x-slot>

    <!-- Header Section -->
    <div class="mb-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center gap-3">
            <div class="p-2.5 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl shadow-lg text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
            </div>
            <div>
                <h1 class="text-3xl font-extrabold font-outfit text-gray-900 dark:text-white">
                    Guía de Estudio Interactiva
                </h1>
                <p class="text-xs sm:text-sm text-indigo-500 font-semibold mt-0.5">
                    UNITEC Ecatepec &bull; Prof. Raymundo Soto Soto &bull; 30 Preguntas Examen
                </p>
            </div>
        </div>

        <!-- Global Search Bar -->
        <div class="relative w-full md:max-w-xs self-start md:self-auto">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
            <input type="text" id="searchInput" oninput="handleSearch()" 
                placeholder="Buscar conceptos, fórmulas..." 
                class="w-full pl-9 pr-4 py-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-xs sm:text-sm text-gray-800 dark:text-gray-200 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
        </div>
    </div>

    <!-- Navigation Tabs -->
    <div class="flex space-x-2 mb-6 border-b border-gray-200 dark:border-gray-700 overflow-x-auto pb-1 scrollbar-none text-xs font-semibold">
        <button onclick="switchTab('preguntas')" id="tab-preguntas" class="tab-btn px-4 py-2 rounded-lg transition-all flex items-center space-x-2 bg-indigo-600 text-white shadow-lg shadow-indigo-500/20">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
            <span>30 Preguntas Examen</span>
        </button>
        <button onclick="switchTab('conceptos')" id="tab-conceptos" class="tab-btn px-4 py-2 rounded-lg transition-all flex items-center space-x-2 bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            <span>Conceptos Clave & Glosario</span>
        </button>
        <button onclick="switchTab('flashcards')" id="tab-flashcards" class="tab-btn px-4 py-2 rounded-lg transition-all flex items-center space-x-2 bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4a2 2 0 012 2v2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2v-3M8 7h12m0 0v-2"/></svg>
            <span>Flashcards de Repaso</span>
        </button>
        <button onclick="switchTab('quiz')" id="tab-quiz" class="tab-btn px-4 py-2 rounded-lg transition-all flex items-center space-x-2 bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <span>Quiz de Autoevaluación</span>
        </button>
    </div>

    <!-- SECTION 1: 30 PREGUNTAS DEL EXAMEN -->
    <section id="sec-preguntas" class="space-y-6">
        <!-- Filter Chips -->
        <div class="flex items-center justify-between flex-wrap gap-3 bg-white dark:bg-gray-800 p-4 rounded-3xl border border-gray-150 dark:border-gray-700 shadow-sm">
            <div class="flex items-center space-x-2 text-xs text-gray-500 dark:text-gray-400 font-semibold">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>
                <span>Filtrar tema:</span>
            </div>
            <div class="flex flex-wrap gap-2 text-xs font-semibold">
                <button onclick="filterTopic('all')" class="topic-btn active bg-indigo-600 text-white px-3 py-1.5 rounded-xl transition shadow-sm">Todos (30)</button>
                <button onclick="filterTopic('bucle')" class="topic-btn bg-gray-100 dark:bg-gray-900 text-gray-650 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 px-3 py-1.5 rounded-xl transition">Bucle y Razonamiento</button>
                <button onclick="filterTopic('arquitectura')" class="topic-btn bg-gray-100 dark:bg-gray-900 text-gray-650 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 px-3 py-1.5 rounded-xl transition">Arquitectura e IoT</button>
                <button onclick="filterTopic('logica')" class="topic-btn bg-gray-100 dark:bg-gray-900 text-gray-650 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 px-3 py-1.5 rounded-xl transition">Lógica Proposicional</button>
                <button onclick="filterTopic('redes')" class="topic-btn bg-gray-100 dark:bg-gray-900 text-gray-650 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 px-3 py-1.5 rounded-xl transition">Redes Semánticas</button>
                <button onclick="filterTopic('marcos')" class="topic-btn bg-gray-100 dark:bg-gray-900 text-gray-650 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 px-3 py-1.5 rounded-xl transition">Marcos (Frames)</button>
            </div>
            <button onclick="toggleAllAccordions()" class="text-xs text-indigo-600 dark:text-indigo-400 hover:underline font-bold transition">
                Expandir/Colapsar todo
            </button>
        </div>

        <!-- Container Questions Container -->
        <div id="questionsContainer" class="space-y-4">
            <!-- Dynamically injected via JS -->
        </div>
    </section>

    <!-- SECTION 2: CONCEPTOS CLAVE Y GLOSARIO -->
    <section id="sec-conceptos" class="hidden space-y-6">
        <div class="bg-gradient-to-r from-indigo-900/40 via-purple-900/30 to-slate-900 p-6 rounded-3xl border border-indigo-500/20">
            <h2 class="text-lg font-bold text-white flex items-center space-x-2">
                <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                <span>Resumen de Conceptos Clave del Curso</span>
            </h2>
            <p class="text-xs sm:text-sm text-slate-350 mt-1 font-outfit">
                Síntesis estructurada y simplificada de las presentaciones del curso con fórmulas matemáticas renderizadas.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5" id="conceptsGrid">
            <!-- Concept 1 -->
            <div class="concept-card bg-white dark:bg-gray-800 p-5 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm space-y-3">
                <div class="flex items-center space-x-3">
                    <div class="p-2 bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 rounded-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 1121.21 8H17.9M9 17a4 4 0 01-4-4 4 4 0 014-4h2a4 4 0 014 4 4 4 0 01-4 4H9z"/></svg>
                    </div>
                    <h3 class="font-bold text-sm text-gray-900 dark:text-white">Redes de Hopfield</h3>
                </div>
                <p class="text-xs text-gray-600 dark:text-gray-300 leading-relaxed">
                    Redes neuronales <strong>recurrentes y binarias</strong> utilizadas como <strong>memoria asociativa</strong>. Tienen conexiones simétricas ($w_{ij} = w_{ji}$) y evolucionan reduciendo la función de energía hasta un estado estable ("recuerdo").
                </p>
                <div class="bg-gray-50 dark:bg-gray-950 p-3 rounded-xl border border-gray-100 dark:border-gray-850 text-xs text-amber-600 dark:text-amber-300 font-mono">
                    Función de Energía:
                    $$E = -\frac{1}{2} \sum_{i \neq j} w_{ij} s_i s_j$$
                    Capacidad máx: $C \approx 0.15 \times N$ neuronas.
                </div>
            </div>

            <!-- Concept 2 -->
            <div class="concept-card bg-white dark:bg-gray-800 p-5 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm space-y-3">
                <div class="flex items-center space-x-3">
                    <div class="p-2 bg-purple-500/10 text-purple-600 dark:text-purple-400 rounded-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                    </div>
                    <h3 class="font-bold text-sm text-gray-900 dark:text-white">Backpropagation</h3>
                </div>
                <p class="text-xs text-gray-600 dark:text-gray-300 leading-relaxed">
                    Algoritmo de <strong>aprendizaje supervisado</strong>. Propaga el error de la salida hacia las capas ocultas utilizando la <strong>regla de la cadena</strong> para actualizar los pesos mediante gradiente descendente.
                </p>
                <div class="bg-gray-50 dark:bg-gray-950 p-3 rounded-xl border border-gray-100 dark:border-gray-850 text-xs text-purple-600 dark:text-purple-300 font-mono">
                    Actualización de Pesos:
                    $$w_{ji} := w_{ji} - \eta \cdot \delta_j \cdot a_i$$
                    $$\delta_{\text{out}} = (\hat{y} - y) \cdot \hat{y}(1 - \hat{y})$$
                </div>
            </div>

            <!-- Concept 3 -->
            <div class="concept-card bg-white dark:bg-gray-800 p-5 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm space-y-3">
                <div class="flex items-center space-x-3">
                    <div class="p-2 bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 rounded-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 002 2h2a2 2 0 002-2z"/></svg>
                    </div>
                    <h3 class="font-bold text-sm text-gray-900 dark:text-white">Perceptrón Simple</h3>
                </div>
                <p class="text-xs text-gray-600 dark:text-gray-300 leading-relaxed">
                    Unidad básica de decisión supervisada. Solo clasifica problemas <strong>linealmente separables</strong> (puertas AND, OR, NAND, NOR).
                </p>
                <div class="bg-gray-50 dark:bg-gray-950 p-3 rounded-xl border border-gray-100 dark:border-gray-850 text-xs text-emerald-650 dark:text-emerald-300 font-mono">
                    Ecuación de entrada neta:
                    $$z = w_0(1) + w_1 x_1 + w_2 x_2$$
                    $$y = \text{escalón}(z)$$
                </div>
            </div>

            <!-- Concept 4 -->
            <div class="concept-card bg-white dark:bg-gray-800 p-5 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm space-y-3">
                <div class="flex items-center space-x-3">
                    <div class="p-2 bg-blue-500/10 text-blue-600 dark:text-blue-400 rounded-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    </div>
                    <h3 class="font-bold text-sm text-gray-900 dark:text-white">Funciones de Activación</h3>
                </div>
                <p class="text-xs text-gray-600 dark:text-gray-300 leading-relaxed font-outfit">
                    Aportan no linealidad a la red neuronal para resolver tareas complejas:
                </p>
                <div class="bg-gray-50 dark:bg-gray-950 p-3 rounded-xl border border-gray-100 dark:border-gray-850 text-xs text-blue-600 dark:text-blue-300 space-y-1 font-mono">
                    <p><strong>ReLU:</strong> $f(x) = \max(0, x)$</p>
                    <p><strong>Sigmoide:</strong> $\sigma(x) = \frac{1}{1 + e^{-x}}$</p>
                    <p><strong>Tanh:</strong> $\tanh(x) = \frac{1 - e^{-2x}}{1 + e^{-2x}}$</p>
                </div>
            </div>

            <!-- Concept 5 -->
            <div class="concept-card bg-white dark:bg-gray-800 p-5 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm space-y-3">
                <div class="flex items-center space-x-3">
                    <div class="p-2 bg-amber-500/10 text-amber-600 dark:text-amber-400 rounded-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/></svg>
                    </div>
                    <h3 class="font-bold text-sm text-gray-900 dark:text-white">Control PID</h3>
                </div>
                <p class="text-xs text-gray-600 dark:text-gray-300 leading-relaxed">
                    Controlador de lazo cerrado para alcanzar un punto de consigna (set-point):
                </p>
                <div class="bg-gray-50 dark:bg-gray-950 p-3 rounded-xl border border-gray-100 dark:border-gray-850 text-xs text-amber-600 dark:text-amber-300 font-mono">
                    $$u(t) = K_p e(t) + K_i \int e(t)dt + K_d \frac{de(t)}{dt}$$
                    <p class="text-[11px] text-gray-400 mt-1 font-outfit">P: Error actual &bull; I: Error acumulado &bull; D: Tendencia futura</p>
                </div>
            </div>

            <!-- Concept 6 -->
            <div class="concept-card bg-white dark:bg-gray-800 p-5 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm space-y-3">
                <div class="flex items-center space-x-3">
                    <div class="p-2 bg-rose-500/10 text-rose-600 dark:text-rose-400 rounded-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    </div>
                    <h3 class="font-bold text-sm text-gray-900 dark:text-white">RAG y Bases Vectoriales</h3>
                </div>
                <p class="text-xs text-gray-600 dark:text-gray-300 leading-relaxed font-outfit">
                    <strong>Generación Aumentada por Recuperación (RAG)</strong> combina LLMs con bases de datos vectoriales para recuperar información relevante en tiempo real y evitar alucinaciones.
                </p>
                <div class="bg-gray-50 dark:bg-gray-950 p-3 rounded-xl border border-gray-100 dark:border-gray-850 text-xs text-rose-600 dark:text-rose-300 font-mono">
                    Embeddings: Vectores en $\mathbb{R}^n$ que codifican cercanía semántica.
                </div>
            </div>

            <!-- Concept 7: Lógica Proposicional y Tablas de Verdad -->
            <div class="concept-card bg-white dark:bg-gray-800 p-5 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm md:col-span-2 lg:col-span-3 space-y-3">
                <div class="flex items-center space-x-3">
                    <div class="p-2 bg-indigo-500/10 text-indigo-650 dark:text-indigo-400 rounded-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                    </div>
                    <h3 class="font-bold text-sm text-gray-900 dark:text-white">Lógica Proposicional: Conectores y Tabla de Verdad de la Proposición</h3>
                </div>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mt-3">
                    <!-- Tabla 1: Conectores Básicos -->
                    <div>
                        <h4 class="text-xs font-semibold text-gray-800 dark:text-gray-300 mb-2 flex items-center">
                            <span class="w-1.5 h-1.5 rounded-full bg-indigo-500 mr-1.5"></span> Tablas de Verdad de Conectores Básicos
                        </h4>
                        <div class="overflow-x-auto bg-gray-50 dark:bg-gray-950 rounded-2xl border border-gray-100 dark:border-gray-850 p-2">
                            <table class="w-full text-xs text-center border-collapse">
                                <thead>
                                    <tr class="border-b border-gray-200 dark:border-gray-800 text-indigo-600 dark:text-indigo-450 font-mono">
                                        <th class="p-1.5">$p$</th>
                                        <th class="p-1.5">$q$</th>
                                        <th class="p-1.5">$\neg p$</th>
                                        <th class="p-1.5">$p \wedge q$</th>
                                        <th class="p-1.5">$p \vee q$</th>
                                        <th class="p-1.5">$p \rightarrow q$</th>
                                        <th class="p-1.5">$p \leftrightarrow q$</th>
                                    </tr>
                                </thead>
                                <tbody class="font-mono text-gray-750 dark:text-gray-300 divide-y divide-gray-200 dark:divide-gray-850">
                                    <tr><td class="p-1.5 text-emerald-500 font-bold">V</td><td class="p-1.5 text-emerald-500 font-bold">V</td><td class="p-1.5 text-rose-500">F</td><td class="p-1.5 text-emerald-500">V</td><td class="p-1.5 text-emerald-500">V</td><td class="p-1.5 text-emerald-500">V</td><td class="p-1.5 text-emerald-500">V</td></tr>
                                    <tr><td class="p-1.5 text-emerald-500 font-bold">V</td><td class="p-1.5 text-rose-500 font-bold">F</td><td class="p-1.5 text-rose-500">F</td><td class="p-1.5 text-rose-500">F</td><td class="p-1.5 text-emerald-500">V</td><td class="p-1.5 text-rose-500 font-bold bg-rose-500/10">F</td><td class="p-1.5 text-rose-500">F</td></tr>
                                    <tr><td class="p-1.5 text-rose-500 font-bold">F</td><td class="p-1.5 text-emerald-500 font-bold">V</td><td class="p-1.5 text-emerald-500">V</td><td class="p-1.5 text-rose-500">F</td><td class="p-1.5 text-emerald-500">V</td><td class="p-1.5 text-emerald-500">V</td><td class="p-1.5 text-rose-500">F</td></tr>
                                    <tr><td class="p-1.5 text-rose-500 font-bold">F</td><td class="p-1.5 text-rose-500 font-bold">F</td><td class="p-1.5 text-emerald-500">V</td><td class="p-1.5 text-rose-500">F</td><td class="p-1.5 text-rose-500">F</td><td class="p-1.5 text-emerald-500">V</td><td class="p-1.5 text-emerald-500">V</td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Tabla 2: Proposición Pregunta 18 -->
                    <div>
                        <h4 class="text-xs font-semibold text-gray-800 dark:text-gray-300 mb-2 flex items-center">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span> Tabla de Verdad Pregunta 18: $((p \wedge (p \rightarrow q)) \rightarrow q)$
                        </h4>
                        <div class="overflow-x-auto bg-gray-50 dark:bg-gray-950 rounded-2xl border border-gray-100 dark:border-gray-850 p-2">
                            <table class="w-full text-xs text-center border-collapse">
                                <thead>
                                    <tr class="border-b border-gray-200 dark:border-gray-800 text-indigo-650 dark:text-indigo-400 font-mono">
                                        <th class="p-1.5">$p$</th>
                                        <th class="p-1.5">$q$</th>
                                        <th class="p-1.5">$p \rightarrow q$</th>
                                        <th class="p-1.5">$p \wedge (p \rightarrow q)$</th>
                                        <th class="p-1.5 text-amber-550 dark:text-amber-300">$((p \wedge (p \rightarrow q)) \rightarrow q)$</th>
                                    </tr>
                                </thead>
                                <tbody class="font-mono text-gray-750 dark:text-gray-300 divide-y divide-gray-200 dark:divide-gray-850">
                                    <tr><td class="p-1.5">V</td><td class="p-1.5">V</td><td class="p-1.5 text-emerald-500">V</td><td class="p-1.5 text-emerald-500">V</td><td class="p-1.5 text-emerald-500 font-bold bg-emerald-500/10">V</td></tr>
                                    <tr><td class="p-1.5">V</td><td class="p-1.5">F</td><td class="p-1.5 text-rose-500">F</td><td class="p-1.5 text-rose-500">F</td><td class="p-1.5 text-emerald-500 font-bold bg-emerald-500/10">V</td></tr>
                                    <tr><td class="p-1.5 font-bold bg-indigo-500/20 text-emerald-500">F</td><td class="p-1.5 font-bold bg-indigo-500/20 text-emerald-500">V</td><td class="p-1.5 text-emerald-500">V</td><td class="p-1.5 text-rose-500">F</td><td class="p-1.5 text-emerald-500 font-bold bg-emerald-500/10">V (Pregunta 18)</td></tr>
                                    <tr><td class="p-1.5">F</td><td class="p-1.5">F</td><td class="p-1.5 text-emerald-500">V</td><td class="p-1.5 text-rose-500">F</td><td class="p-1.5 text-emerald-500 font-bold bg-emerald-500/10">V</td></tr>
                                </tbody>
                            </table>
                        </div>
                        <p class="text-[11px] text-amber-700 dark:text-amber-300 mt-2 font-mono bg-amber-500/10 p-2 rounded-xl border border-amber-500/20">
                            <strong>Tautología:</strong> Como la columna final es completamente Verdadero (V), demuestra la validez lógica formal del <em>Modus Ponens</em> en cualquier circunstancia.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 3: FLASHCARDS DE REPASO -->
    <section id="sec-flashcards" class="hidden space-y-6">
        <div class="max-w-xl mx-auto bg-white dark:bg-gray-800 p-6 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm text-center">
            <!-- Progress Header -->
            <div class="flex items-center justify-between text-xs text-gray-500 dark:text-gray-400 mb-4 font-semibold">
                <span>Tarjeta <span id="cardCurrent">1</span> de 30</span>
                <span id="cardCategory" class="px-2.5 py-1 bg-indigo-500/10 text-indigo-650 dark:text-indigo-400 rounded-xl border border-indigo-500/20 font-bold">Categoría</span>
            </div>

            <!-- Flashcard UI -->
            <div id="flashcard" onclick="flipCard()" class="perspective-1000 w-full h-80 cursor-pointer my-4">
                <div id="cardInner" class="transform-style-3d transition-transform duration-500 relative w-full h-full rounded-2xl shadow-md">
                    <!-- Front -->
                    <div class="absolute inset-0 backface-hidden bg-gradient-to-br from-gray-50 to-gray-100 dark:from-slate-900 dark:to-slate-800 border-2 border-indigo-500/30 rounded-2xl p-6 flex flex-col justify-center items-center">
                        <span class="text-xs text-indigo-600 dark:text-indigo-400 font-bold mb-2 uppercase tracking-wider">Pregunta</span>
                        <h3 id="cardQuestion" class="text-base sm:text-lg font-bold text-gray-900 dark:text-white leading-snug">Pregunta aquí...</h3>
                        <p class="text-[11px] text-gray-500 dark:text-slate-400 mt-6 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 1121.21 8H17.9"/></svg>
                            <span>Haz clic para ver la respuesta</span>
                        </p>
                    </div>

                    <!-- Back -->
                    <div class="absolute inset-0 backface-hidden rotate-y-180 bg-gradient-to-br from-gray-50 via-gray-100 to-indigo-50 dark:from-slate-900 dark:via-slate-800 dark:to-indigo-950 border-2 border-emerald-500/30 rounded-2xl p-6 flex flex-col justify-between text-left overflow-y-auto">
                        <div>
                            <span class="text-xs text-emerald-600 dark:text-emerald-400 font-bold uppercase tracking-wider block mb-1">Respuesta Rápida</span>
                            <p id="cardQuickAnswer" class="text-sm font-bold text-gray-900 dark:text-white mb-3">Respuesta corta...</p>

                            <span class="text-xs text-indigo-600 dark:text-indigo-300 font-bold uppercase tracking-wider block mb-1">Explicación</span>
                            <p id="cardExplanation" class="text-xs text-gray-650 dark:text-gray-300 leading-relaxed">Explicación...</p>
                        </div>
                        <p class="text-[10px] text-gray-550 dark:text-slate-400 text-center mt-2 border-t border-gray-200 dark:border-gray-800 pt-2 flex items-center justify-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 1121.21 8H17.9"/></svg>
                            <span>Haz clic para voltear</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Navigation Buttons -->
            <div class="flex items-center justify-between gap-4 mt-6">
                <button onclick="prevCard()" class="flex-1 py-2.5 bg-gray-100 hover:bg-gray-250 dark:bg-gray-900 dark:hover:bg-gray-750 text-gray-700 dark:text-slate-200 text-xs font-bold rounded-xl transition flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    <span>Anterior</span>
                </button>
                <button onclick="randomCard()" class="px-4 py-2.5 bg-gray-100 hover:bg-gray-250 dark:bg-gray-900 dark:hover:bg-gray-750 text-amber-600 dark:text-amber-400 text-xs font-bold rounded-xl transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 1121.21 8H17.9"/></svg>
                </button>
                <button onclick="nextCard()" class="flex-1 py-2.5 bg-indigo-600 hover:bg-indigo-750 text-white text-xs font-bold rounded-xl transition flex items-center justify-center gap-2">
                    <span>Siguiente</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </button>
            </div>
        </div>
    </section>

    <!-- SECTION 4: QUIZ DE AUTOEVALUACIÓN -->
    <section id="sec-quiz" class="hidden space-y-6">
        <div class="max-w-2xl mx-auto bg-white dark:bg-gray-800 p-6 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm">
            <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-200 dark:border-gray-700">
                <div>
                    <h2 class="text-lg font-bold text-gray-900 dark:text-white flex items-center space-x-2">
                        <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>Quiz de Práctica</span>
                    </h2>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Preguntas de opción múltiple tipo examen</p>
                </div>
                <div class="text-right">
                    <span class="text-xs text-gray-500 dark:text-gray-400">Puntaje:</span>
                    <span id="quizScore" class="block text-lg font-bold text-emerald-650 dark:text-emerald-400">0 / 0</span>
                </div>
            </div>

            <!-- Quiz Question Container -->
            <div id="quizContainer" class="space-y-5">
                <!-- Dynamically populated -->
            </div>

            <div class="mt-6 flex justify-end">
                <button onclick="resetQuiz()" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 dark:bg-gray-900 dark:hover:bg-gray-750 text-gray-700 dark:text-gray-300 text-xs font-bold rounded-xl transition flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 1121.21 8H17.9"/></svg>
                    <span>Reiniciar Quiz</span>
                </button>
            </div>
        </div>
    </section>

    <!-- Style additions for flashcard 3D effects -->
    <style>
        .perspective-1000 {
            perspective: 1000px;
        }
        .transform-style-3d {
            transform-style: preserve-3d;
        }
        .backface-hidden {
            backface-visibility: hidden;
        }
        .rotate-y-180 {
            transform: rotateY(180deg);
        }
    </style>

    <!-- JAVASCRIPT LOGIC -->
    <script>
        const questionsData = [
            {
                id: 1,
                topic: "bucle",
                question: "¿Cuáles son las fases del bucle cognitivo de un sistema inteligente?",
                quick: "Percepción, Procesamiento/Memoria, Razonamiento, Decisión y Actuación.",
                exp: "Un sistema inteligente lee el entorno (percibe), organiza los datos relevantes (memoria), analiza posibles soluciones (razona), elige la mejor opción (decide) y ejecuta la acción (actúa).",
                tech: "1. Percepción (captura mediante sensores/APIs)\n2. Procesamiento/Memoria (estructuración del contexto)\n3. Razonamiento (evaluación de caminos lógicos/probabilísticos)\n4. Decisión (selección óptima basada en objetivos)\n5. Actuación (ejecución con actuadores o comandos).",
                quizOpts: ["Percepción, Memoria, Razonamiento, Decisión, Actuación.", "Entrada, Proceso, Salida, Almacenamiento.", "Pensamiento, Acción, Observación, Feedback.", "Cómputo, Análisis, Sensor, Actuador."],
                quizCorrect: 0
            },
            {
                id: 2,
                topic: "bucle",
                question: "¿Cuál fase del bucle cognitivo está enfocada en organizar y recordar el conocimiento?",
                quick: "La fase de Procesamiento y Memoria.",
                exp: "Esta fase actúa como el centro de almacenamiento del sistema. Limpia los datos ruidosos del entorno y los guarda en estructuras ordenadas (como grafos o vectores) para usarlos después.",
                tech: "La fase de Procesamiento y Memoria (procesamiento de conocimiento). Retiene contexto histórico y gestiona el conocimiento a corto y largo plazo (mediante bases de datos vectoriales y grafos).",
                quizOpts: ["Razonamiento", "Procesamiento y Memoria", "Percepción", "Decisión"],
                quizCorrect: 1
            },
            {
                id: 3,
                topic: "bucle",
                question: "¿Qué es la memoria episódica?",
                quick: "Es la memoria que responde a '¿Qué pasó?', guardando el historial de eventos del sistema.",
                exp: "Es como la bitácora o diario personal del sistema. Almacena las experiencias pasadas en orden cronológico o contextual para consultar qué hizo antes.",
                tech: "Componente de memoria a largo plazo que retiene el contexto histórico e interacciones pasadas (el '¿Qué pasó?'). En IA moderna se implementa con bases de datos vectoriales para RAG.",
                quizOpts: ["Almacena hechos formales como reglas y definiciones.", "Responde a '¿Qué pasó?' guardando el historial de eventos.", "Es la memoria RAM que se borra al apagar.", "Son las reglas IF-THEN del motor de inferencia."],
                quizCorrect: 1
            },
            {
                id: 4,
                topic: "bucle",
                question: "¿Qué es la memoria semántica?",
                quick: "Es la memoria que responde a '¿Qué sé?', guardando hechos y conceptos generales.",
                exp: "Es la enciclopedia interna del sistema. Guarda reglas, definiciones y categorías estables que no dependen de un solo evento (ej. saber que un perro es un mamífero).",
                tech: "Componente que almacena hechos estructurados, conceptos, reglas y relaciones formales sobre el dominio del problema ('¿Qué sé?'). Típicamente implementada con grafos de conocimiento o marcos.",
                quizOpts: ["Guarda fotos e imágenes de eventos pasados.", "Responde a '¿Qué sé?' guardando hechos estructurados y conceptos.", "Almacena los errores de retropropagación.", "Es el registro temporal de los sensores."],
                quizCorrect: 1
            },
            {
                id: 5,
                topic: "bucle",
                question: "¿Cuáles son las fases del patrón ReAct?",
                quick: "Pensamiento (Thought), Acción (Action) y Observación (Observation).",
                exp: "La IA combina razonamiento y acción: primero razona sobre qué hacer (Pensamiento), ejecuta un comando o herramienta (Acción) y lee el resultado (Observación) para decidir el siguiente paso.",
                tech: "Las fases del patrón ReAct (Reasoning + Acting) son: 1. Pensamiento (razonamiento en lenguaje/lógica), 2. Acción (interacción con entorno/herramientas), 3. Observación (recepción de retroalimentación).",
                quizOpts: ["Percepción, Razonamiento, Respuesta.", "Pensamiento, Acción, Observación.", "Inicialización, Ejecución, Finalización.", "Proposición, Inferencia, Conclusión."],
                quizCorrect: 1
            },
            {
                id: 6,
                topic: "bucle",
                question: "¿Qué es el razonamiento ToT?",
                quick: "Es la exploración en árbol (Tree-of-Thoughts) que evalúa múltiples caminos antes de decidir.",
                exp: "En lugar de pensar en una sola línea recta, ToT crea ramas de alternativas, evalúa cada opción y descuenta o 'poda' las erróneas antes de tomar la decisión final.",
                tech: "Tree-of-Thoughts (ToT) es un paradigma que evalúa múltiples hipótesis simultáneamente en forma de árbol, aplicando algoritmos de búsqueda y poda (pruning) para descartar rutas no viables.",
                quizOpts: ["Razonamiento lineal simple de un solo paso.", "Evaluación de múltiples rutas en árbol con poda (pruning).", "Un modelo de redes neuronales convolucionales.", "Una base de datos en formato de texto."],
                quizCorrect: 1
            },
            {
                id: 7,
                topic: "arquitectura",
                question: "¿Qué es una base de conocimientos en un sistema inteligente?",
                quick: "Un depósito estructurado de hechos, reglas y relaciones para emular el razonamiento humano.",
                exp: "A diferencia de una base de datos común con información plana, la base de conocimientos incluye tanto los hechos como las reglas lógicas para que la máquina pueda deducir información nueva.",
                tech: "Repositorio central estructurado que almacena información sobre un dominio en forma de hechos, reglas de producción, ontologías o relaciones, procesado por el motor de inferencia.",
                quizOpts: ["Una tabla SQL con datos sin procesar.", "Depósito estructurado de hechos, reglas y relaciones.", "La memoria RAM de la computadora.", "El código fuente en lenguaje C++."],
                quizCorrect: 1
            },
            {
                id: 8,
                topic: "arquitectura",
                question: "¿Cuál es la arquitectura de un sistema experto?",
                quick: "Base de Conocimientos, Motor de Inferencia e Interfaz de Usuario / Módulo de Explicación.",
                exp: "Imita a un especialista humano: guarda el saber (Base de Conocimientos), razona con lógica (Motor de Inferencia) y explica sus razones al usuario (Módulo de Explicación).",
                tech: "Componentes principales: 1. Base de Conocimientos (hechos y reglas SI-ENTONCES), 2. Motor de Inferencia (procesador deductivo), 3. Módulo de Explicación / Interfaz (trazabilidad y diálogo).",
                quizOpts: ["Sensor, Microcontrolador, Actuador.", "Base de Conocimientos, Motor de Inferencia, Módulo de Explicación / Interfaz.", "CPU, Memoria RAM, Disco Duro.", "Capa de Entrada, Capa Oculta, Capa de Salida."],
                quizCorrect: 1
            },
            {
                id: 9,
                topic: "arquitectura",
                question: "¿Qué es el motor de inferencia de un sistema inteligente?",
                quick: "Es el componente de software que procesa las reglas y hechos para llegar a una conclusión.",
                exp: "Es el 'cerebro procesador'. Toma las reglas de la base de conocimientos y los hechos dados por el usuario para resolver el problema y entregar la respuesta.",
                tech: "Módulo de software que aplica algoritmos de búsqueda y reglas de deducción (ej. encadenamiento hacia adelante/atrás) sobre los hechos y reglas para derivar nuevo conocimiento.",
                quizOpts: ["El motor físico de un robot doméstico.", "El módulo de software que aplica reglas de deducción para derivar conclusiones.", "Una base de datos de imágenes vectoriales.", "El cable de red del IoT."],
                quizCorrect: 1
            },
            {
                id: 10,
                topic: "arquitectura",
                question: "¿Cuál es el objetivo del módulo de explicación en un sistema inteligente?",
                quick: "Justificar y dar trazabilidad a las decisiones tomadas por el sistema.",
                exp: "Los humanos necesitamos saber por qué la máquina tomó una decisión. El módulo de explicación enseña paso a paso la lógica seguida para generar confianza.",
                tech: "Garantizar la explicabilidad y trazabilidad del sistema, mostrando la secuencia de reglas e inferencias aplicadas. Ayuda a verificar ética, corregir sesgos y dar confianza.",
                quizOpts: ["Acelerar la velocidad del procesador.", "Justificar y dar trazabilidad a las decisiones del sistema.", "Guardar las fotos del usuario.", "Aumentar la memoria de la red."],
                quizCorrect: 1
            },
            {
                id: 11,
                topic: "arquitectura",
                question: "¿Por qué una arquitectura IoT es una inteligencia distribuida?",
                quick: "Porque el procesamiento y las decisiones se reparten entre múltiples dispositivos en red.",
                exp: "En lugar de tener una supercomputadora central haciendo todo, cada sensor o microcontrolador (en el 'edge') toma pequeñas decisiones y las comunica a los demás.",
                tech: "Porque distribuye la capacidad de cómputo, percepción y reacción en múltiples nodos débiles/embebidos autónomos (Edge computing) que operan colaborativamente sin un núcleo único.",
                quizOpts: ["Porque requiere un solo servidor gigante centralizado.", "Porque distribuye el cómputo y decisiones en múltiples nodos/dispositivos.", "Porque utiliza cables de fibra óptica.", "Porque no utiliza sensores ni actuadores."],
                quizCorrect: 1
            },
            {
                id: 12,
                topic: "arquitectura",
                question: "¿Qué es una arquitectura agéntica?",
                quick: "Un sistema compuesto por sub-agentes especializados coordinados para resolver tareas complejas.",
                exp: "En lugar de un programa único monolítico, se organiza como un equipo de trabajo: un coordinador (Meta-Controller) delega tareas a agentes expertos (investigador, programador, revisor).",
                tech: "Arquitectura donde un controlador central orquesta sub-agentes autónomos de IA. Cada sub-agente tiene un rol especializado y utiliza herramientas para resolver problemas no estructurados.",
                quizOpts: ["Un único script de Python sin funciones.", "Un sistema de sub-agentes especializados coordinados por un Meta-Controller.", "Un controlador PID en un circuito impreso.", "Una base de datos relacional MySQL."],
                quizCorrect: 1
            },
            {
                id: 13,
                topic: "arquitectura",
                question: "¿Por qué el futuro de los sistemas inteligentes es ecosistémico?",
                quick: "Porque integra de forma colaborativa IoT, Sistemas Expertos y Agentes LLM.",
                exp: "Ninguna tecnología por sí sola lo resuelve todo. El futuro combina la percepción física de IoT, la exactitud lógica de los Sistemas Expertos y la adaptabilidad fluida de los LLM en una pizarra compartida (Blackboard).",
                tech: "Porque requiere la federación de distintas arquitecturas: percepción física (IoT), garantías lógicas deterministas (Sistemas Expertos) y razonamiento adaptativo (LLMs) interactuando en tiempo real.",
                quizOpts: ["Porque solo existirá una inteligencia artificial gigante.", "Porque combina e integra IoT, Sistemas Expertos y LLMs de forma colaborativa.", "Porque dejarán de usarse computadoras.", "Porque todo se manejará con reglas IF-THEN simples."],
                quizCorrect: 1
            },
            {
                id: 14,
                topic: "logica",
                question: "¿Por qué la lógica proposicional es un tipo de base de conocimiento de un sistema?",
                quick: "Porque permite representar hechos mediante afirmaciones formales que son Verdaderas o Falsas.",
                exp: "Le da a la máquina un lenguaje matemático exacto y sin ambigüedades para representar premisas y evaluarlas.",
                tech: "Porque constituye un formalismo matemático simbólico capaz de codificar afirmaciones (proposiciones $p, q$) y conectores ($\wedge, \vee, \rightarrow, \neg$) para inferir conclusiones rigurosas.",
                quizOpts: ["Porque permite texto libre sin reglas.", "Porque codifica declaraciones formales (V/F) y sus conectores para inferir conclusiones.", "Porque solo sirve para diseñar circuitos impresos.", "Porque reemplaza a las redes neuronales."],
                quizCorrect: 1
            },
            {
                id: 15,
                topic: "logica",
                question: "¿Qué es la inferencia en un sistema inteligente?",
                quick: "El proceso formal para obtener nueva información lógica a partir de datos conocidos.",
                exp: "Es el acto de 'conectar los puntos'. Si sabemos la regla 'si llueve la calle se moja' y el hecho 'está lloviendo', inferimos que 'la calle está mojada'.",
                tech: "Es el proceso deductivo, inductivo o probabilístico mediante el cual el sistema aplica reglas de transformación sobre premisas conocidas para derivar válidamente una nueva verdad.",
                quizOpts: ["Guardar datos en el disco duro.", "Proceso formal para derivar nueva información o conclusiones desde premisas.", "Apagar los actuadores ante una falla.", "Medir la temperatura con un sensor."],
                quizCorrect: 1
            },
            {
                id: 16,
                topic: "logica",
                question: "Dada la implicación $p \\rightarrow q$, determine bajo qué única combinación la proposición es falsa.",
                quick: "Cuando $p$ es Verdadero (V) y $q$ es Falso (F).",
                exp: "Una promesa ('Si estudio apruebo') solo se rompe si cumples la condición ($p=\\text{V}$) pero no obtienes el resultado prometido ($q=\\text{F}$).",
                tech: "La condicional $p \\rightarrow q$ es Falsa ÚNICAMENTE cuando el antecedente es verdadero ($p = \\text{V}$) y el consecuente es falso ($q = \\text{F}$). En todos los demás casos ($V \\rightarrow V, F \\rightarrow V, F \\rightarrow F$) es Verdadera.",
                quizOpts: ["p = F, q = V", "p = V, q = F", "p = F, q = F", "p = V, q = V"],
                quizCorrect: 1
            },
            {
                id: 17,
                topic: "logica",
                question: "¿Qué son las reglas de producción?",
                quick: "Sentencias condicionales estructuradas como SI-ENTONCES (IF-THEN).",
                exp: "Son las instrucciones básicas de un sistema experto. Dicen: 'SI el paciente tiene fiebre y tos, ENTONCES diagnosticar gripe'.",
                tech: "Estructuras formales de representación del conocimiento con premisa y consecuente: $\\text{SI } \\langle\\text{condición}\\rangle \\text{ ENTONCES } \\langle\\text{acción/conclusión}\\rangle$.",
                quizOpts: ["Líneas de ensamblaje en fábricas de IoT.", "Sentencias condicionales formales del tipo SI-ENTONCES (IF-THEN).", "Ecuaciones diferenciales de control PID.", "Vectores de embeddings en redes neuronales."],
                quizCorrect: 1
            },
            {
                id: 18,
                topic: "logica",
                question: "Si $p$ es falsa y $q$ es verdadera, evalúe el valor de verdad de la proposición $((p \\wedge (p \\rightarrow q)) \\rightarrow q)$.",
                quick: "La proposición es VERDADERA (V).",
                exp: "<strong>Paso a paso de evaluación con $p=\\text{F}$ y $q=\\text{V}$:</strong><br>1) Implicación interna: $(p \\rightarrow q) \\equiv (\\text{F} \\rightarrow \\text{V}) \\equiv \\text{V}$.<br>2) Conjunción: $(p \\wedge \\text{V}) \\equiv (\\text{F} \\wedge \\text{V}) \\equiv \\text{F}$.<br>3) Condicional principal: $(\\text{F} \\rightarrow q) \\equiv (\\text{F} \\rightarrow \\text{V}) \\equiv \\text{V}$.",
                tech: "<strong>Desarrollo Formal Paso a Paso:</strong><br>• Valores asignados: $v(p) = \\text{F}$, $v(q) = \\text{V}$<br>• Evaluando el antecedente interno $(p \\rightarrow q)$: $(\\text{F} \\rightarrow \\text{V}) \\equiv \\text{V}$<br>• Conjunción del antecedente principal $p \\wedge (p \\rightarrow q)$: $\\text{F} \\wedge \\text{V} \\equiv \\text{F}$<br>• Condicional final $\\text{F} \\rightarrow q$: $\\text{F} \\rightarrow \\text{V} \\equiv \\text{V}$<br><br><strong>Conclusión:</strong> El valor de verdad es <strong>Verdadero (V)</strong>.<br><em>Nota: Esta fórmula es la expresión formal de la regla de inferencia Modus Ponens, la cual es una <strong>tautología</strong> (siempre es verdadera sin importar los valores de $p$ y $q$).</em>",
                quizOpts: ["Falsa", "Verdadera", "Indeterminada", "Inconsistente"],
                quizCorrect: 1
            },
            {
                id: 19,
                topic: "logica",
                question: "¿Cuál es la diferencia entre una proposición condicional y una bicondicional?",
                quick: "La condicional va en un sentido ($p \\rightarrow q$); la bicondicional en ambos sentidos ($p \\leftrightarrow q$).",
                exp: "En la condicional ($p \\rightarrow q$), $p$ obliga a $q$. En la bicondicional ($p \\leftrightarrow q$), $p$ y $q$ están amarrados: son ciertos si ambos tienen el mismo valor de verdad.",
                tech: "• <strong>Condicional ($p \\rightarrow q$):</strong> Unidireccional. Falsa solo si $V \\rightarrow F$.<br>• <strong>Bicondicional ($p \\leftrightarrow q$):</strong> Bidireccional ('si y solo si'). Verdadera solo si $p$ y $q$ tienen igual valor de verdad ($V \\leftrightarrow V$ o $F \\leftrightarrow F$).",
                quizOpts: ["No hay diferencia, son idénticas.", "Condicional es unidireccional (p → q); Bicondicional es equivalencia de dos sentidos (p ↔ q).", "La condicional usa el conector 'O' y la bicondicional usa 'Y'.", "La bicondicional nunca puede ser falsa."],
                quizCorrect: 1
            },
            {
                id: 20,
                topic: "logica",
                question: "Convierte: a) 'Si nivel alto ($p$) o bomba apagada ($q$), no se llena ($r$)' b) 'Si y solo si viera marciano ($p$), creería ($q$)'",
                quick: "a) $(p \\vee q) \\rightarrow r$  |  b) $p \\leftrightarrow q$",
                exp: "En a) 'o' es disyunción ($\\vee$) e 'Si...' es implicación ($\\rightarrow$). En b) 'Si y solo si' es bicondicional ($\\leftrightarrow$).",
                tech: "a) $(p \\vee q) \\rightarrow r$<br>b) $p \\leftrightarrow q$",
                quizOpts: ["a) (p ∧ q) ↔ r, b) p → q", "a) (p ∨ q) → r, b) p ↔ q", "a) p → (q ∨ r), b) p ∧ q", "a) ¬(p ∨ q) → r, b) p ∨ q"],
                quizCorrect: 1
            },
            {
                id: 21,
                topic: "redes",
                question: "¿Qué es una red semántica?",
                quick: "Un grafo con nodos (conceptos) y arcos dirigidos (relaciones) que representan conocimiento.",
                exp: "Es un mapa visual del conocimiento. Los círculos son conceptos ('Perro', 'Mamífero') y las flechas con palabras explican su relación ('es un').",
                tech: "Modelo de representación estructurado mediante un grafo orientado compuesto por nodos (entidades/conceptos) y arcos dirigidos etiquetados (relaciones semánticas).",
                quizOpts: ["Una red de cableado de fibra óptica.", "Un grafo orientado de nodos (conceptos) y arcos etiquetados (relaciones).", "Un conjunto de tablas en Excel.", "Un algoritmo de aprendizaje supervisado."],
                quizCorrect: 1
            },
            {
                id: 22,
                topic: "redes",
                question: "¿Para qué sirve una red semántica?",
                quick: "Para almacenar, relacionar, recuperar e inferir información estructurada en máquinas.",
                exp: "Sirve para darle significado a la información. Permite que la computadora entienda cómo se conectan las cosas y herede propiedades automáticamente.",
                tech: "Estructura e interpreta el conocimiento de un dominio facilitando el almacenamiento, la búsqueda asociativa, recuperación e inferencia mediante herencia.",
                quizOpts: ["Para medir voltaje en sensores IoT.", "Para estructurar conocimiento facilitando almacenamiento, recuperación e inferencia.", "Para entrenar redes de deep learning con imágenes.", "Para compilar código en C++."],
                quizCorrect: 1
            },
            {
                id: 23,
                topic: "redes",
                question: "¿Cómo se recupera información de una red semántica?",
                quick: "Recorriendo o navegando a través de los arcos del grafo entre los nodos.",
                exp: "El algoritmo comienza en un nodo (ej. 'Perro') y sigue las flechas etiquetadas (ej. 'es un') hasta hallar la respuesta o propiedad deseada (ej. 'Mamífero').",
                tech: "Mediante algoritmos de búsqueda y recorrido en grafos (ej. propagación de la activación) transitando por los arcos para deducir propiedades explícitas o implícitas.",
                quizOpts: ["Haciendo una consulta SQL.", "Recorriendo los arcos y nodos del grafo con algoritmos de búsqueda.", "Mediante retropropagación del error.", "Apagando el sistema."],
                quizCorrect: 1
            },
            {
                id: 24,
                topic: "redes",
                question: "¿Qué son las relaciones en una red semántica?",
                quick: "Los arcos o enlaces dirigidos que conectan dos conceptos y le dan significado a la red.",
                exp: "Son los conectores/verbos entre conceptos. Sin relaciones solo habría palabras sueltas. Ejemplos: 'es un', 'tiene', 'causa', 'parte de'.",
                tech: "Son los arcos dirigidos etiquetados que definen el vínculo entre nodos. Pueden ser jerárquicas ('es un'), atributivas ('tiene'), o causales ('provoca').",
                quizOpts: ["Los usuarios que usan la red.", "Los arcos dirigidos etiquetados que conectan y dan significado a los nodos.", "Los cables ethernet de conexión.", "Los pesos numéricos del perceptrón."],
                quizCorrect: 1
            },
            {
                id: 25,
                topic: "marcos",
                question: "¿Qué es un marco (Frame)?",
                quick: "Una estructura de datos jerárquica que agrupa atributos (slots) y valores de un objeto.",
                exp: "Propuesto por Marvin Minsky (1975). Es similar a una plantilla u objeto que agrupa casilleros llamados 'slots' para describir un concepto (ej. Auto, Refresco).",
                tech: "Estructura de representación propuesta por Minsky (1975) que modela entidades mediante ranuras (slots) con valores, restricciones y procedimientos adjuntos.",
                quizOpts: ["Un marco de fotos digital en IoT.", "Estructura de datos jerárquica que agrupa slots (atributos), valores y restricciones.", "El chasis físico de un vehículo autónomo.", "Una función de activación no lineal."],
                quizCorrect: 1
            },
            {
                id: 26,
                topic: "marcos",
                question: "¿Cómo se organiza la información en los marcos?",
                quick: "En jerarquías compuestas por ranuras (slots) que contienen atributos, valores y restricciones.",
                exp: "De lo general a lo particular. En la cima hay marcos padre con propiedades generales y abajo marcos hijos especializado con slots detallados.",
                tech: "De forma jerárquica y modular. Contiene slots (atributos), valores por defecto (defaults), restricciones de tipo y enlaces de herencia.",
                quizOpts: ["En filas y columnas sin jerarquía.", "En jerarquías padre-hijo compuestas por slots con atributos, valores y restricciones.", "En archivos de texto plano desordenados.", "En capas de neuronas conectadas con pesos."],
                quizCorrect: 1
            },
            {
                id: 27,
                topic: "marcos",
                question: "¿Qué información se puede agregar en un marco?",
                quick: "Slots de atributos, valores por defecto, restricciones, procedimientos adjuntos (demons) y enlaces.",
                exp: "No solo datos simples: puedes poner valores asumidos por defecto, reglas de validación y pequeños programas (demons) que se ejecutan solos.",
                tech: "Slots de atributos, valores por defecto (default values), restricciones, procedimientos adjuntos (if-needed, if-added) y enlaces jerárquicos.",
                quizOpts: ["Solo texto sin formato.", "Slots, valores por defecto, restricciones, procedimientos adjuntos (demons) y enlaces.", "Únicamente números enteros y flotantes.", "Direcciones IP de red."],
                quizCorrect: 1
            },
            {
                id: 28,
                topic: "marcos",
                question: "¿Cómo es que un marco puede heredar información o propiedades?",
                quick: "A través de la jerarquía padre-hijo, donde el hijo hereda los slots del marco superior.",
                exp: "Igual que en la programación orientada a objetos. Si el marco 'Vehículo' dice 'Tiene_Motor = Verdadero', 'AutoEléctrico' lo hereda automáticamente.",
                tech: "Mediante herencia en jerarquías conceptuales (enlaces is-a o subclase-de). Los marcos hijos adoptan ranuras y valores del padre, pudiendo sobreescribirlos si hay excepciones.",
                quizOpts: ["Copiando y pegando el código manualmente.", "A través de enlaces de jerarquía padre-hijo (is-a) de los marcos superiores.", "Mediante entrenamiento con gradiente descendente.", "Enviando paquetes por la red local."],
                quizCorrect: 1
            },
            {
                id: 29,
                topic: "redes",
                question: "Crea una red semántica cuyo concepto principal sea: Árboles",
                quick: "Nodo central '[ÁRBOLES]' con enlaces a sus partes, funciones y clases de herencia.",
                exp: "Concepto central Árboles $\\rightarrow$ (es un) Planta; $\\rightarrow$ (tiene) Tronco, Hojas, Raíces; $\\rightarrow$ (realiza) Fotosíntesis; $\\rightarrow$ Subclases: Pino y Encino.",
                tech: "<strong>Grafo Formal:</strong><br>[Planta] $\\xleftarrow{\\text{es un}}$ [ÁRBOLES]<br>[ÁRBOLES] $\\xrightarrow{\\text{tiene}}$ [Tronco, Hojas, Raíces]<br>[ÁRBOLES] $\\xrightarrow{\\text{realiza}}$ [Fotosíntesis]<br>[ÁRBOLES] $\\xrightarrow{\\text{tipos}}$ [Pino (Conífera)], [Encino (Caducifolio)]",
                quizOpts: ["Árboles -> Algoritmos -> Código", "Red con nodo central ÁRBOLES conectado a Planta, Partes (Hojas/Raíz), Fotosíntesis y Tipos (Pino/Encino).", "Árboles -> Sensor -> Actuador", "Árboles -> 1 + 0 = 1"],
                quizCorrect: 1
            },
            {
                id: 30,
                topic: "marcos",
                question: "Crea un frame donde el frame principal modele el concepto: Metales",
                quick: "Frame Principal 'Metales' (Estado: Sólido, Conductividad: Alta) y Sub-Frame 'Cobre' (Punto Fusión: 1085°C).",
                exp: "Plantilla base 'Metales' define propiedades universales de metales y el sub-marco 'Cobre' hereda todo agregando datos propios (Símbolo Cu, Usos).",
                tech: "<strong>FRAME PRINCIPAL: Metales</strong><br>&nbsp;&nbsp;Slots: $\\text{Estado} = \\text{Sólido (Excepción: Mercurio)}$, $\\text{Conductividad} = \\text{Alta}$, $\\text{Maleabilidad} = \\text{Verdadera}$.<br><br><strong>SUB-FRAME: Cobre</strong> (Superclase: Metales)<br>&nbsp;&nbsp;Slots: $\\text{Símbolo} = \\text{Cu}$, $\\text{Punto\\_Fusión} = 1085^\\circ\\text{C}$, $\\text{Usos} = [\\text{Cableado}, \\text{Tuberías}]$",
                quizOpts: ["Frame Metales = Tabla con 1 columna", "Frame Principal Metales (Slots de propiedades generales) + Sub-frame heredado Cobre (slots específicos).", "Frame Metales -> Red de Hopfield con 9 pixeles", "Frame Metales = Archivo HTML simple"],
                quizCorrect: 1
            }
        ];

        let activeTopic = 'all';
        let currentCardIndex = 0;
        let quizScore = 0;
        let quizAnswered = 0;

        function renderMath() {
            setTimeout(() => {
                if (typeof renderMathInElement === 'function') {
                    renderMathInElement(document.body, {
                        delimiters: [
                            {left: '$$', right: '$$', display: true},
                            {left: '$', right: '$', display: false},
                            {left: '\\(', right: '\\)', display: false},
                            {left: '\\[', right: '\\]', display: true}
                        ],
                        ignoredTags: ["script", "noscript", "style", "textarea"],
                        throwOnError: false
                    });
                }
            }, 50);
        }

        window.onload = function() {
            renderQuestions();
            updateFlashcard();
            renderQuiz();
            renderMath();
        };

        // Fallback in case window.onload already fired
        document.addEventListener("DOMContentLoaded", function() {
            renderQuestions();
            updateFlashcard();
            renderQuiz();
            renderMath();
        });

        function switchTab(tabId) {
            document.querySelectorAll('#sec-preguntas, #sec-conceptos, #sec-flashcards, #sec-quiz').forEach(sec => sec.classList.add('hidden'));
            document.getElementById(`sec-${tabId}`).classList.remove('hidden');

            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('bg-indigo-600', 'text-white', 'shadow-lg', 'shadow-indigo-500/20');
                btn.classList.add('bg-gray-100', 'dark:bg-gray-800', 'text-gray-600', 'dark:text-gray-300');
            });

            const activeBtn = document.getElementById(`tab-${tabId}`);
            activeBtn.classList.remove('bg-gray-100', 'dark:bg-gray-800', 'text-gray-600', 'dark:text-gray-300');
            activeBtn.classList.add('bg-indigo-600', 'text-white', 'shadow-lg', 'shadow-indigo-500/20');
            
            renderMath();
        }

        function renderQuestions() {
            const container = document.getElementById('questionsContainer');
            if (!container) return;
            const searchVal = document.getElementById('searchInput').value.toLowerCase();
            
            const filtered = questionsData.filter(q => {
                const matchTopic = activeTopic === 'all' || q.topic === activeTopic;
                const matchSearch = q.question.toLowerCase().includes(searchVal) ||
                                    q.quick.toLowerCase().includes(searchVal) ||
                                    q.exp.toLowerCase().includes(searchVal) ||
                                    q.tech.toLowerCase().includes(searchVal);
                return matchTopic && matchSearch;
            });

            if(filtered.length === 0) {
                container.innerHTML = `
                    <div class="text-center py-12 bg-gray-50 dark:bg-gray-900 rounded-3xl border border-gray-150 dark:border-gray-700">
                        <p class="text-sm text-gray-500 dark:text-gray-450">No se encontraron preguntas que coincidan con la búsqueda.</p>
                    </div>
                `;
                return;
            }

            container.innerHTML = filtered.map(q => `
                <div class="bg-white dark:bg-gray-800 border border-gray-150 dark:border-gray-700 rounded-3xl overflow-hidden hover:border-gray-300 dark:hover:border-gray-650 transition shadow-sm">
                    <button onclick="toggleAccordion(${q.id})" class="w-full px-5 py-4 text-left flex items-start justify-between gap-4">
                        <div class="flex items-start space-x-3">
                            <span class="inline-flex items-center justify-center w-7 h-7 rounded-xl bg-indigo-500/10 text-indigo-650 dark:text-indigo-400 font-bold text-xs border border-indigo-500/20 shrink-0 mt-0.5">
                                ${q.id}
                            </span>
                            <div>
                                <h3 class="font-bold text-sm sm:text-base text-gray-900 dark:text-white leading-snug font-outfit">${q.question}</h3>
                                <span class="inline-block mt-1 text-[11px] text-amber-700 dark:text-amber-400 font-bold">
                                    Rápida: ${q.quick}
                                </span>
                            </div>
                        </div>
                        <svg id="acc-icon-${q.id}" class="w-4 h-4 text-gray-500 mt-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>

                    <div id="acc-content-${q.id}" class="hidden px-5 py-4 border-t border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-950/60 space-y-4">
                        <!-- Respuesta Rápida -->
                        <div class="bg-amber-500/5 dark:bg-amber-950/15 border border-amber-500/10 dark:border-amber-900/30 p-3.5 rounded-2xl">
                            <div class="text-xs font-bold text-amber-800 dark:text-amber-350 flex items-center gap-1.5 mb-1">
                                <span>Respuesta Rápida (Para Memorizar):</span>
                            </div>
                            <p class="text-xs sm:text-sm text-gray-900 dark:text-amber-100 font-semibold">${q.quick}</p>
                        </div>

                        <!-- Explicación Sencilla -->
                        <div class="bg-indigo-500/5 dark:bg-indigo-950/15 border border-indigo-500/10 dark:border-indigo-900/30 p-3.5 rounded-2xl">
                            <div class="text-xs font-bold text-indigo-800 dark:text-indigo-300 flex items-center gap-1.5 mb-1">
                                <span>Explicación Sencilla:</span>
                            </div>
                            <p class="text-xs sm:text-sm text-gray-900 dark:text-gray-200 leading-relaxed">${q.exp}</p>
                        </div>

                        <!-- Respuesta Concisa / Técnica -->
                        <div class="bg-emerald-500/5 dark:bg-emerald-950/15 border border-emerald-500/10 dark:border-emerald-900/30 p-3.5 rounded-2xl">
                            <div class="text-xs font-bold text-emerald-800 dark:text-emerald-300 flex items-center gap-1.5 mb-1">
                                <span>Respuesta Concisa / Técnica:</span>
                            </div>
                            <div class="text-xs text-gray-900 dark:text-emerald-100 font-mono leading-relaxed whitespace-pre-wrap">${q.tech}</div>
                        </div>
                    </div>
                </div>
            `).join('');

            renderMath();
        }

        function toggleAccordion(id) {
            const content = document.getElementById(`acc-content-${id}`);
            const icon = document.getElementById(`acc-icon-${id}`);
            if(content.classList.contains('hidden')) {
                content.classList.remove('hidden');
                icon.classList.add('rotate-180');
            } else {
                content.classList.add('hidden');
                icon.classList.remove('rotate-180');
            }
            renderMath();
        }

        let allExpanded = false;
        function toggleAllAccordions() {
            allExpanded = !allExpanded;
            questionsData.forEach(q => {
                const content = document.getElementById(`acc-content-${q.id}`);
                const icon = document.getElementById(`acc-icon-${q.id}`);
                if(content && icon) {
                    if(allExpanded) {
                        content.classList.remove('hidden');
                        icon.classList.add('rotate-180');
                    } else {
                        content.classList.add('hidden');
                        icon.classList.remove('rotate-180');
                    }
                }
            });
            renderMath();
        }

        function filterTopic(topic) {
            activeTopic = topic;
            document.querySelectorAll('.topic-btn').forEach(btn => {
                btn.classList.remove('bg-indigo-600', 'text-white');
                btn.classList.add('bg-gray-100', 'dark:bg-gray-900', 'text-gray-650', 'dark:text-gray-300');
            });
            event.target.classList.remove('bg-gray-100', 'dark:bg-gray-900', 'text-gray-650', 'dark:text-gray-300');
            event.target.classList.add('bg-indigo-600', 'text-white');
            renderQuestions();
        }

        function handleSearch() {
            renderQuestions();
        }

        function updateFlashcard() {
            const q = questionsData[currentCardIndex];
            const currentEl = document.getElementById('cardCurrent');
            if (!currentEl) return;
            currentEl.innerText = currentCardIndex + 1;
            document.getElementById('cardQuestion').innerText = q.question;
            document.getElementById('cardQuickAnswer').innerText = q.quick;
            document.getElementById('cardExplanation').innerHTML = q.exp;
            document.getElementById('cardCategory').innerText = q.topic.toUpperCase();

            document.getElementById('cardInner').classList.remove('rotate-y-180');
            renderMath();
        }

        function flipCard() {
            document.getElementById('cardInner').classList.toggle('rotate-y-180');
            renderMath();
        }

        function nextCard() {
            currentCardIndex = (currentCardIndex + 1) % questionsData.length;
            updateFlashcard();
        }

        function prevCard() {
            currentCardIndex = (currentCardIndex - 1 + questionsData.length) % questionsData.length;
            updateFlashcard();
        }

        function randomCard() {
            currentCardIndex = Math.floor(Math.random() * questionsData.length);
            updateFlashcard();
        }

        function renderQuiz() {
            const container = document.getElementById('quizContainer');
            if (!container) return;
            container.innerHTML = questionsData.slice(0, 10).map((q, idx) => `
                <div class="bg-gray-50 dark:bg-gray-950 p-4 rounded-2xl border border-gray-150 dark:border-gray-850 space-y-3">
                    <p class="text-xs sm:text-sm font-bold text-gray-900 dark:text-white font-outfit">
                        <span class="text-indigo-650 dark:text-indigo-400 font-mono mr-1">${idx + 1}.</span> ${q.question}
                    </p>
                    <div class="grid grid-cols-1 gap-2 text-xs">
                        ${q.quizOpts.map((opt, optIdx) => `
                            <button onclick="checkQuizAnswer(this, ${q.id}, ${optIdx}, ${q.quizCorrect})" 
                                class="quiz-opt-${q.id} w-full text-left p-3 bg-white dark:bg-gray-900 border border-gray-150 dark:border-gray-800 rounded-xl transition text-gray-700 dark:text-gray-300">
                                ${opt}
                            </button>
                        `).join('')}
                    </div>
                </div>
            `).join('');
            renderMath();
        }

        function checkQuizAnswer(btn, questionId, selectedIdx, correctIdx) {
            const buttons = document.querySelectorAll(`.quiz-opt-${questionId}`);
            buttons.forEach(b => b.disabled = true);

            quizAnswered++;

            if(selectedIdx === correctIdx) {
                btn.classList.remove('bg-white', 'dark:bg-gray-900', 'border-gray-150', 'border-gray-800');
                btn.classList.add('bg-emerald-500/20', 'border-emerald-500', 'text-emerald-700', 'dark:text-emerald-300', 'font-bold');
                quizScore++;
            } else {
                btn.classList.remove('bg-white', 'dark:bg-gray-900', 'border-gray-150', 'border-gray-800');
                btn.classList.add('bg-rose-500/20', 'border-rose-500', 'text-rose-700', 'dark:text-rose-350');
                buttons[correctIdx].classList.remove('bg-white', 'dark:bg-gray-900', 'border-gray-150', 'border-gray-800');
                buttons[correctIdx].classList.add('bg-emerald-500/20', 'border-emerald-500', 'text-emerald-700', 'dark:text-emerald-300', 'font-bold');
            }

            document.getElementById('quizScore').innerText = `${quizScore} / ${quizAnswered}`;
        }

        function resetQuiz() {
            quizScore = 0;
            quizAnswered = 0;
            document.getElementById('quizScore').innerText = `0 / 0`;
            renderQuiz();
        }
    </script>
</x-app-layout>
