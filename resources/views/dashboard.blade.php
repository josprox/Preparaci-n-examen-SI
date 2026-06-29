<x-app-layout>
    <x-slot name="title">Dashboard - NeuroSmart Trainer</x-slot>

    <!-- Header Section -->
    <div class="mb-8 text-center md:text-left">
        <h1 class="text-4xl font-extrabold font-outfit tracking-tight text-gray-900 dark:text-white mb-2">
            Bienvenido a <span class="text-[var(--m3-primary)]">NeuroSmart Trainer</span>
        </h1>
        <p class="text-base text-gray-600 dark:text-gray-400">
            Tu tutor interactivo para estudiar, simular y dominar Sistemas Inteligentes y Redes Neuronales.
        </p>
    </div>

    <!-- Quick Stats / Welcome Banner -->
    <div class="mb-8 p-6 bg-[var(--m3-primary-container)] text-[var(--m3-on-primary-container)] rounded-3xl shadow-sm flex flex-col md:flex-row items-center justify-between gap-6">
        <div class="max-w-xl">
            <h2 class="text-2xl font-bold font-outfit mb-2">¡Listo para el Examen Espejo!</h2>
            <p class="text-sm opacity-90">
                Esta herramienta ha sido adaptada directamente para cubrir los apuntes y ejercicios de la guía de Sistemas Inteligentes. Practica Perceptrón, Backpropagation y Redes Hopfield paso a paso con los mismos números y convenciones que verás en tu examen.
            </p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('guide.index') }}" class="px-5 py-2.5 bg-[var(--m3-primary)] text-white hover:bg-opacity-90 font-semibold rounded-full text-sm shadow-sm transition-all">
                Estudiar Guía
            </a>
            <a href="{{ route('quiz.index') }}" class="px-5 py-2.5 bg-white text-[var(--m3-primary)] hover:bg-opacity-95 font-semibold rounded-full text-sm shadow-sm transition-all border border-purple-200">
                Iniciar Quiz
            </a>
        </div>
    </div>

    <!-- Grid of Modules -->
    <h3 class="text-xl font-bold font-outfit text-gray-800 dark:text-gray-200 mb-4">Módulos de Aprendizaje</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        
        <!-- Module 1: Perceptron -->
        <a href="{{ route('perceptron.index') }}" class="group block p-6 bg-white dark:bg-gray-800 hover:bg-[var(--m3-surface-variant)] dark:hover:bg-gray-700 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-1">
            <div class="w-12 h-12 rounded-2xl bg-sky-100 dark:bg-sky-950 flex items-center justify-center text-sky-600 dark:text-sky-400 mb-4 group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
            <h4 class="text-lg font-bold font-outfit text-gray-900 dark:text-white mb-2">1. Perceptrón Simple</h4>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Aprende el algoritmo de entrenamiento Hebbiano paso a paso con sumas ponderadas, funciones escalón y reajuste dinámico de pesos.
            </p>
            <div class="mt-4 flex items-center gap-1.5 text-xs font-semibold text-sky-600 dark:text-sky-400">
                <span>Comenzar práctica</span>
                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </div>
        </a>

        <!-- Module 2: Forward Propagation -->
        <a href="{{ route('forward.index') }}" class="group block p-6 bg-white dark:bg-gray-800 hover:bg-[var(--m3-surface-variant)] dark:hover:bg-gray-700 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-1">
            <div class="w-12 h-12 rounded-2xl bg-cyan-100 dark:bg-cyan-950 flex items-center justify-center text-cyan-600 dark:text-cyan-400 mb-4 group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </div>
            <h4 class="text-lg font-bold font-outfit text-gray-900 dark:text-white mb-2">2. Forward Propagation</h4>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Configura redes multicapa (MLP) y visualiza cómo fluyen los datos de entrada a través de las capas hasta generar predicciones.
            </p>
            <div class="mt-4 flex items-center gap-1.5 text-xs font-semibold text-cyan-600 dark:text-cyan-400">
                <span>Simular propagación</span>
                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </div>
        </a>

        <!-- Module 3: Backpropagation -->
        <a href="{{ route('backprop.index') }}" class="group block p-6 bg-white dark:bg-gray-800 hover:bg-[var(--m3-surface-variant)] dark:hover:bg-gray-700 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-1">
            <div class="w-12 h-12 rounded-2xl bg-purple-100 dark:bg-purple-950 flex items-center justify-center text-purple-600 dark:text-purple-400 mb-4 group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </div>
            <h4 class="text-lg font-bold font-outfit text-gray-900 dark:text-white mb-2">3. Backpropagation</h4>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Descubre cómo se propaga el error de salida hacia atrás. Analiza derivadas de sigmoides, deltas y actualizaciones en redes 2-2-1.
            </p>
            <div class="mt-4 flex items-center gap-1.5 text-xs font-semibold text-purple-600 dark:text-purple-400">
                <span>Ver retropropagación</span>
                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </div>
        </a>

        <!-- Module 4: Hopfield -->
        <a href="{{ route('hopfield.index') }}" class="group block p-6 bg-white dark:bg-gray-800 hover:bg-[var(--m3-surface-variant)] dark:hover:bg-gray-700 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-1">
            <div class="w-12 h-12 rounded-2xl bg-emerald-100 dark:bg-emerald-950 flex items-center justify-center text-emerald-600 dark:text-emerald-400 mb-4 group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"/>
                </svg>
            </div>
            <h4 class="text-lg font-bold font-outfit text-gray-900 dark:text-white mb-2">4. Red Neuronal Hopfield</h4>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Construye memorias asociativas recurrentes. Entrena la red, elimina auto-conexiones y calcula la energía para verificar estabilidad.
            </p>
            <div class="mt-4 flex items-center gap-1.5 text-xs font-semibold text-emerald-600 dark:text-emerald-400">
                <span>Abrir simulador</span>
                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </div>
        </a>

        <!-- Module 5: Quiz -->
        <a href="{{ route('quiz.index') }}" class="group block p-6 bg-white dark:bg-gray-800 hover:bg-[var(--m3-surface-variant)] dark:hover:bg-gray-700 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-1">
            <div class="w-12 h-12 rounded-2xl bg-amber-100 dark:bg-amber-950 flex items-center justify-center text-amber-600 dark:text-amber-400 mb-4 group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h4 class="text-lg font-bold font-outfit text-gray-900 dark:text-white mb-2">5. Quiz tipo Kahoot</h4>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Practica de forma lúdica con un examen dinámico con tiempo o repasa tus errores históricos sobre sistemas de control e IA.
            </p>
            <div class="mt-4 flex items-center gap-1.5 text-xs font-semibold text-amber-600 dark:text-amber-400">
                <span>Comenzar juego</span>
                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </div>
        </a>

        <!-- Module 6: Guide -->
        <a href="{{ route('guide.index') }}" class="group block p-6 bg-white dark:bg-gray-800 hover:bg-[var(--m3-surface-variant)] dark:hover:bg-gray-700 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-1">
            <div class="w-12 h-12 rounded-2xl bg-pink-100 dark:bg-pink-950 flex items-center justify-center text-pink-600 dark:text-pink-400 mb-4 group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
            <h4 class="text-lg font-bold font-outfit text-gray-900 dark:text-white mb-2">6. Guía teórica rápida</h4>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Accede a resúmenes estructurados sobre PLCs, sensores, actuadores, sintonización PID e IA simbólica frente a conexionista.
            </p>
            <div class="mt-4 flex items-center gap-1.5 text-xs font-semibold text-pink-600 dark:text-pink-400">
                <span>Abrir chuleta</span>
                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </div>
        </a>

        <!-- Module 7: History -->
        <a href="{{ route('history.index') }}" class="group block p-6 bg-white dark:bg-gray-800 hover:bg-[var(--m3-surface-variant)] dark:hover:bg-gray-700 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-1">
            <div class="w-12 h-12 rounded-2xl bg-indigo-100 dark:bg-indigo-950 flex items-center justify-center text-indigo-600 dark:text-indigo-400 mb-4 group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h4 class="text-lg font-bold font-outfit text-gray-900 dark:text-white mb-2">7. Historial de ejercicios</h4>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Visualiza, repite o clona ejercicios resueltos con anterioridad. Guardado localmente en tu base de datos SQLite.
            </p>
            <div class="mt-4 flex items-center gap-1.5 text-xs font-semibold text-indigo-600 dark:text-indigo-400">
                <span>Ver historial</span>
                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </div>
        </a>

        <!-- Module 8: Aula Multimedia -->
        <a href="{{ route('media.index') }}" class="group block p-6 bg-white dark:bg-gray-800 hover:bg-[var(--m3-surface-variant)] dark:hover:bg-gray-700 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-1">
            <div class="w-12 h-12 rounded-2xl bg-red-100 dark:bg-red-950 flex items-center justify-center text-red-600 dark:text-red-400 mb-4 group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h4 class="text-lg font-bold font-outfit text-gray-900 dark:text-white mb-2">8. Aula Multimedia</h4>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Accede a las video clases de repaso y audios explicativos sobre el paso de sistemas clásicos a redes neuronales.
            </p>
            <div class="mt-4 flex items-center gap-1.5 text-xs font-semibold text-red-600 dark:text-red-400">
                <span>Reproducir contenido</span>
                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </div>
        </a>

        <!-- Module 9: App Settings & Info -->
        <div class="p-6 bg-gray-55 dark:bg-gray-850 rounded-3xl border border-dashed border-gray-300 dark:border-gray-700 shadow-sm flex flex-col justify-between">
            <div>
                <h4 class="text-lg font-bold font-outfit text-gray-900 dark:text-white mb-2">Información del Sistema</h4>
                <p class="text-xs text-gray-600 dark:text-gray-400 mb-2">
                    <strong>Estado de compilación:</strong> Preparado para empaquetarse en PC y Android (APK) vía NativePHP Mobile.
                </p>
                <p class="text-xs text-gray-600 dark:text-gray-400">
                    <strong>Tecnología:</strong> PHP 8.4 + Laravel 12 + Tailwind CSS v4.
                </p>
            </div>
            <div class="mt-6 pt-4 border-t border-gray-200 dark:border-gray-800 text-xs text-gray-500 flex items-center justify-between">
                <span>Versión: 1.0.0</span>
                <span class="px-2 py-0.5 rounded-full bg-green-100 text-green-800 dark:bg-green-950 dark:text-green-300 font-semibold">Activo</span>
            </div>
        </div>

    </div>
</x-app-layout>
