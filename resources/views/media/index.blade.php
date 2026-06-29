<x-app-layout>
    <x-slot name="title">Aula Multimedia - NeuroSmart Trainer</x-slot>

    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold font-outfit text-gray-900 dark:text-white mb-1">
            Aula Multimedia de Repaso
        </h1>
        <p class="text-sm text-gray-600 dark:text-gray-400">
            Escucha los podcasts educativos y repasa los videos explicativos para el Examen Espejo.
        </p>
    </div>

    <!-- Grid Container -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

        <!-- Column Left: Video Lesson -->
        <div class="space-y-6">
            <div class="p-6 bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm space-y-4">
                <div class="flex items-center gap-3">
                    <div class="p-3 bg-red-50 dark:bg-red-950/40 text-red-600 dark:text-red-400 rounded-2xl">
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                            <path d="M17 10.5V7c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v10c0 .55.45 1 1 1h12c.55 0 1-.45 1-1v-3.5l4 4v-11l-4 4zM14 13h-3v3H9v-3H6v-2h3V8h2v3h3v2z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold font-outfit text-gray-900 dark:text-white">Clase: De Sistemas a Redes Neuronales</h2>
                        <span class="text-[10px] uppercase font-bold text-gray-450 dark:text-gray-400 tracking-wider">Video Explicativo (MP4)</span>
                    </div>
                </div>

                <!-- Video Container -->
                <div class="relative overflow-hidden rounded-2xl border border-gray-150 dark:border-gray-750 bg-black aspect-video flex items-center justify-center">
                    <!-- Custom Placeholder Cover -->
                    <div id="video-cover" class="absolute inset-0 flex flex-col items-center justify-center bg-gray-900 text-white p-4 text-center cursor-pointer group z-20">
                        <div class="w-16 h-16 rounded-full bg-red-600 group-hover:bg-red-700 flex items-center justify-center shadow-lg transition-transform group-hover:scale-110 mb-3">
                            <svg class="w-8 h-8 fill-current text-white ml-1" viewBox="0 0 24 24">
                                <path d="M8 5v14l11-7z"/>
                            </svg>
                        </div>
                        <span class="text-sm font-semibold font-outfit">Haga clic para reproducir video</span>
                        <span class="text-[10px] text-gray-400 mt-1">Carga local instantánea</span>
                    </div>

                    <!-- Loading Spinner Overlay -->
                    <div id="video-loader" class="absolute inset-0 hidden flex flex-col items-center justify-center bg-gray-900 text-white p-4 z-20">
                        <svg class="animate-spin h-10 w-10 text-red-500 mb-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span class="text-xs font-semibold font-outfit text-gray-300">Preparando clase...</span>
                    </div>

                    <!-- Actual HTML5 Video tag -->
                    <video id="main-video" class="hidden w-full h-full object-cover" controls preload="none">
                        Tu dispositivo no soporta la reproducción de video HTML5.
                    </video>
                </div>

                <p class="text-xs text-gray-600 dark:text-gray-400 leading-relaxed">
                    Analiza la transición conceptual entre la teoría de control clásica (Lazo abierto, lazo cerrado, actuadores, sensores y controladores PID) y los modelos de redes neuronales artificiales capaces de aprender y tomar decisiones complejas de forma autónoma.
                </p>
            </div>
        </div>

        <!-- Column Right: Podcasts / Audios -->
        <div class="space-y-6">

            <!-- Podcast 1 -->
            <div class="p-6 bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm space-y-4">
                <div class="flex items-center gap-3">
                    <div class="p-3 bg-purple-50 dark:bg-purple-950/40 text-purple-600 dark:text-purple-400 rounded-2xl">
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                            <path d="M12 3c-3.87 0-7 3.13-7 7v4c0 .55.45 1 1 1h3c.55 0 1-.45 1-1v-4c0-.55-.45-1-1-1H7v-3c0-2.76 2.24-5 5-5s5 2.24 5 5v3h-2c-.55 0-1 .45-1 1v4c0 .55.45 1 1 1h3c.55 0 1-.45 1-1v-4c0-3.87-3.13-7-7-7z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold font-outfit text-gray-900 dark:text-white">Podcast: Cómo sienten y deciden las máquinas</h2>
                        <span class="text-[10px] uppercase font-bold text-gray-450 dark:text-gray-400 tracking-wider">Audio Clase (M4A)</span>
                    </div>
                </div>

                <div class="space-y-3">
                    <!-- Play Button Placeholder -->
                    <button id="audio1-btn" onclick="prepareAudio('audio1', '{{ asset('media/como_sienten_y_deciden_maquinas.m4a') }}')" class="w-full py-4 px-6 bg-purple-500 hover:bg-purple-600 text-white font-semibold rounded-2xl shadow-sm text-sm flex items-center justify-center gap-2 transition-all cursor-pointer">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                            <path d="M8 5v14l11-7z"/>
                        </svg>
                        <span>Preparar y Escuchar Podcast</span>
                    </button>

                    <!-- Loading Spinner -->
                    <div id="audio1-loader" class="hidden py-4 text-center flex items-center justify-center gap-2 text-xs font-semibold text-purple-600 dark:text-purple-400">
                        <svg class="animate-spin h-5 w-5 text-purple-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span>Cargando audio localmente...</span>
                    </div>

                    <!-- Audio Element (hidden initially) -->
                    <div id="audio1-container" class="hidden p-3 bg-gray-50 dark:bg-gray-950 rounded-2xl border border-gray-100 dark:border-gray-850">
                        <audio id="audio1" class="w-full" controls preload="none">
                            Tu dispositivo no soporta la reproducción de audio HTML5.
                        </audio>
                    </div>
                </div>

                <p class="text-xs text-gray-600 dark:text-gray-400 leading-relaxed">
                    Un podcast formativo centrado en la percepción de los sistemas inteligentes, describiendo cómo capturan la información del entorno mediante sensores, y cómo ejecutan respuestas utilizando actuadores.
                </p>
            </div>

            <!-- Podcast 2 -->
            <div class="p-6 bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm space-y-4">
                <div class="flex items-center gap-3">
                    <div class="p-3 bg-cyan-50 dark:bg-cyan-950/40 text-cyan-600 dark:text-cyan-400 rounded-2xl">
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                            <path d="M12 3c-3.87 0-7 3.13-7 7v4c0 .55.45 1 1 1h3c.55 0 1-.45 1-1v-4c0-.55-.45-1-1-1H7v-3c0-2.76 2.24-5 5-5s5 2.24 5 5v3h-2c-.55 0-1 .45-1 1v4c0 .55.45 1 1 1h3c.55 0 1-.45 1-1v-4c0-3.87-3.13-7-7-7z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold font-outfit text-gray-900 dark:text-white">Podcast: Repaso Examen Bimestral</h2>
                        <span class="text-[10px] uppercase font-bold text-gray-450 dark:text-gray-400 tracking-wider">Audio Clase (M4A)</span>
                    </div>
                </div>

                <div class="space-y-3">
                    <!-- Play Button Placeholder -->
                    <button id="audio2-btn" onclick="prepareAudio('audio2', '{{ asset('media/repaso_examen_bimestral.m4a') }}')" class="w-full py-4 px-6 bg-cyan-600 hover:bg-cyan-700 text-white font-semibold rounded-2xl shadow-sm text-sm flex items-center justify-center gap-2 transition-all cursor-pointer">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                            <path d="M8 5v14l11-7z"/>
                        </svg>
                        <span>Preparar y Escuchar Podcast</span>
                    </button>

                    <!-- Loading Spinner -->
                    <div id="audio2-loader" class="hidden py-4 text-center flex items-center justify-center gap-2 text-xs font-semibold text-cyan-600 dark:text-cyan-400">
                        <svg class="animate-spin h-5 w-5 text-cyan-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span>Cargando audio localmente...</span>
                    </div>

                    <!-- Audio Element (hidden initially) -->
                    <div id="audio2-container" class="hidden p-3 bg-gray-50 dark:bg-gray-950 rounded-2xl border border-gray-100 dark:border-gray-850">
                        <audio id="audio2" class="w-full" controls preload="none">
                            Tu dispositivo no soporta la reproducción de audio HTML5.
                        </audio>
                    </div>
                </div>

                <p class="text-xs text-gray-600 dark:text-gray-400 leading-relaxed">
                    Sesión de repaso exhaustiva para el examen espejo. En esta grabación se analizan las preguntas teóricas clave y el planteamiento general de los ejercicios prácticos de redes neuronales, perceptrón, backpropagation y Hopfield.
                </p>
            </div>

        </div>

    </div>

    <!-- Blob Loader Script -->
    <script>
        // Cache object urls to avoid re-fetching
        const loadedUrls = {};

        async function prepareAudio(id, url) {
            const btn = document.getElementById(id + '-btn');
            const loader = document.getElementById(id + '-loader');
            const container = document.getElementById(id + '-container');
            const player = document.getElementById(id);

            // Hide play button, show loader
            btn.classList.add('hidden');
            loader.classList.remove('hidden');

            try {
                let objectUrl = loadedUrls[url];
                if (!objectUrl) {
                    // Fetch the file as a blob
                    const response = await fetch(url);
                    if (!response.ok) throw new Error('Network response was not ok');
                    const blob = await response.blob();
                    
                    // Create object url
                    objectUrl = URL.createObjectURL(blob);
                    loadedUrls[url] = objectUrl;
                }

                // Assign to player and play
                player.src = objectUrl;
                loader.classList.add('hidden');
                container.classList.remove('hidden');
                player.play();
            } catch (error) {
                console.error('Error loading audio:', error);
                alert('No se pudo cargar el audio. Por favor reintente.');
                btn.classList.remove('hidden');
                loader.classList.add('hidden');
            }
        }

        // Prepare video event listener
        document.getElementById('video-cover').addEventListener('click', async function() {
            const cover = document.getElementById('video-cover');
            const loader = document.getElementById('video-loader');
            const video = document.getElementById('main-video');
            const videoUrl = "{{ asset('media/sistemas_a_redes_neuronales.mp4') }}";

            cover.classList.add('hidden');
            loader.classList.remove('hidden');

            try {
                let objectUrl = loadedUrls[videoUrl];
                if (!objectUrl) {
                    const response = await fetch(videoUrl);
                    if (!response.ok) throw new Error('Video fetch failed');
                    const blob = await response.blob();
                    objectUrl = URL.createObjectURL(blob);
                    loadedUrls[videoUrl] = objectUrl;
                }

                video.src = objectUrl;
                loader.classList.add('hidden');
                video.classList.remove('hidden');
                video.play();
            } catch (error) {
                console.error('Error loading video:', error);
                alert('No se pudo preparar el video.');
                cover.classList.remove('hidden');
                loader.classList.add('hidden');
            }
        });
    </script>
</x-app-layout>
