<x-app-layout>
    <x-slot name="title">Jugando Quiz - NeuroSmart Trainer</x-slot>

    <!-- Quiz Wrapper -->
    <div id="quiz-container" class="max-w-3xl mx-auto p-4 md:p-6 bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm relative min-h-[500px] flex flex-col justify-between">
        
        <!-- Game Header (Progress & Timer) -->
        <div class="flex items-center justify-between border-b border-gray-100 dark:border-gray-700 pb-4 mb-6">
            <div>
                <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Sistemas Inteligentes Quiz</span>
                <h2 id="progress-text" class="text-lg font-bold font-outfit text-gray-900 dark:text-white">Pregunta 1 de 10</h2>
            </div>
            
            <!-- Timer (only active in exam mode) -->
            <div id="timer-box" class="flex items-center gap-2 px-4 py-2 rounded-2xl bg-amber-50 dark:bg-amber-950 text-amber-700 dark:text-amber-300 font-bold font-mono">
                <svg class="w-5 h-5 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span id="timer-text">20s</span>
            </div>
        </div>

        <!-- Progress Bar -->
        <div class="w-full bg-gray-100 dark:bg-gray-900 h-2 rounded-full mb-6 overflow-hidden">
            <div id="progress-bar" class="bg-[var(--m3-primary)] h-full transition-all duration-300" style="width: 0%"></div>
        </div>

        <!-- Question Body -->
        <div id="question-card" class="flex-1 flex flex-col justify-center py-4">
            <h3 id="question-text" class="text-xl font-extrabold font-outfit text-gray-900 dark:text-white text-center mb-8">
                Cargando pregunta...
            </h3>

            <!-- Options Grid (Kahoot style) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Option A: Red -->
                <button type="button" onclick="selectOption(0)" class="option-btn p-5 rounded-2xl bg-red-500 hover:bg-red-600 text-white font-bold text-left shadow transition-all flex items-start gap-3 transform hover:-translate-y-0.5 active:translate-y-0">
                    <span class="px-2.5 py-1 bg-red-700 text-white rounded-lg text-xs">▲</span>
                    <span class="option-label flex-1 text-sm md:text-base">Opción A</span>
                </button>

                <!-- Option B: Blue -->
                <button type="button" onclick="selectOption(1)" class="option-btn p-5 rounded-2xl bg-blue-500 hover:bg-blue-600 text-white font-bold text-left shadow transition-all flex items-start gap-3 transform hover:-translate-y-0.5 active:translate-y-0">
                    <span class="px-2.5 py-1 bg-blue-700 text-white rounded-lg text-xs">■</span>
                    <span class="option-label flex-1 text-sm md:text-base">Opción B</span>
                </button>

                <!-- Option C: Yellow -->
                <button type="button" onclick="selectOption(2)" class="option-btn p-5 rounded-2xl bg-amber-500 hover:bg-amber-600 text-white font-bold text-left shadow transition-all flex items-start gap-3 transform hover:-translate-y-0.5 active:translate-y-0">
                    <span class="px-2.5 py-1 bg-amber-700 text-white rounded-lg text-xs">●</span>
                    <span class="option-label flex-1 text-sm md:text-base">Opción C</span>
                </button>

                <!-- Option D: Green -->
                <button type="button" onclick="selectOption(3)" class="option-btn p-5 rounded-2xl bg-green-500 hover:bg-green-600 text-white font-bold text-left shadow transition-all flex items-start gap-3 transform hover:-translate-y-0.5 active:translate-y-0">
                    <span class="px-2.5 py-1 bg-green-700 text-white rounded-lg text-xs">✦</span>
                    <span class="option-label flex-1 text-sm md:text-base">Opción D</span>
                </button>
            </div>
        </div>

        <!-- Answer Feedback Panel (Hidden initially) -->
        <div id="feedback-panel" class="hidden mt-6 p-5 rounded-3xl border transition-all">
            <div class="flex items-center gap-3 mb-2">
                <span id="feedback-icon" class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-white text-lg"></span>
                <h4 id="feedback-title" class="font-bold text-lg">Respuesta correcta</h4>
            </div>
            <p id="explanation-text" class="text-sm opacity-90"></p>
        </div>

        <!-- Navigation Bar -->
        <div class="mt-8 flex justify-end gap-3 border-t border-gray-100 dark:border-gray-700 pt-4">
            <button id="next-btn" type="button" onclick="loadNextQuestion()" class="hidden px-6 py-3 bg-[var(--m3-primary)] hover:bg-opacity-90 text-white font-bold rounded-full text-sm shadow-sm transition-all flex items-center gap-2">
                <span>Siguiente Pregunta</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </button>
        </div>
    </div>

    <!-- Final Results Screen (Hidden initially) -->
    <div id="results-container" class="hidden max-w-2xl mx-auto p-6 bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm text-center">
        <div class="w-20 h-20 bg-purple-100 dark:bg-purple-950 text-[var(--m3-primary)] rounded-3xl flex items-center justify-center mx-auto mb-4">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        
        <h2 class="text-3xl font-extrabold font-outfit text-gray-900 dark:text-white mb-1">¡Cuestionario Terminado!</h2>
        <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">Buen trabajo. Aquí tienes tus estadísticas y recomendaciones.</p>

        <!-- Stats Grid -->
        <div class="grid grid-cols-3 gap-4 mb-8">
            <div class="p-4 bg-gray-50 dark:bg-gray-900 rounded-2xl">
                <span class="block text-2xl font-black font-outfit text-[var(--m3-primary)]" id="res-score">0</span>
                <span class="block text-xs text-gray-400 uppercase tracking-widest mt-1">Puntaje</span>
            </div>
            <div class="p-4 bg-gray-50 dark:bg-gray-900 rounded-2xl">
                <span class="block text-2xl font-black font-outfit text-green-600" id="res-correct">0</span>
                <span class="block text-xs text-gray-400 uppercase tracking-widest mt-1">Correctas</span>
            </div>
            <div class="p-4 bg-gray-50 dark:bg-gray-900 rounded-2xl">
                <span class="block text-2xl font-black font-outfit text-red-600" id="res-incorrect">0</span>
                <span class="block text-xs text-gray-400 uppercase tracking-widest mt-1">Incorrectas</span>
            </div>
        </div>

        <!-- Recommendations Panel -->
        <div id="recommendations-box" class="text-left p-6 bg-purple-50 dark:bg-purple-950/40 rounded-3xl border border-purple-100 dark:border-purple-900 mb-8">
            <h3 class="font-bold text-purple-900 dark:text-purple-300 font-outfit mb-3 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                Recomendaciones de Estudio Personalizadas
            </h3>
            <ul id="recommendations-list" class="list-disc pl-5 text-sm text-purple-800 dark:text-purple-200 space-y-2">
                <!-- Loaded via JS -->
            </ul>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-wrap justify-center gap-3">
            <a href="{{ route('quiz.index') }}" class="px-6 py-3 bg-[var(--m3-primary)] hover:bg-opacity-90 text-white font-bold rounded-full text-sm shadow-sm transition-all">
                Volver a Jugar
            </a>
            <a href="{{ route('guide.index') }}" class="px-6 py-3 bg-white hover:bg-gray-50 text-gray-700 font-bold rounded-full text-sm border border-gray-200 dark:border-gray-700 transition-all">
                Estudiar Guía Teórica
            </a>
        </div>
    </div>

    <!-- Quiz Engine Script -->
    <script>
        // Questions injected from backend
        const questions = @json($questions);
        const mode = "{{ $mode }}"; // 'practice' | 'exam'
        
        let currentIndex = 0;
        let score = 0;
        let correctCount = 0;
        let incorrectCount = 0;
        let answered = false;

        // Timer variables
        let timerInterval = null;
        let secondsLeft = 20;

        // Statistics tracking for recommendations
        const mistakesByTopic = {};

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

        // Start the game
        document.addEventListener('DOMContentLoaded', () => {
            if (questions.length === 0) {
                alert('No se encontraron preguntas para este tema.');
                window.location.href = "{{ route('quiz.index') }}";
                return;
            }
            showQuestion(0);
        });

        function showQuestion(index) {
            answered = false;
            document.getElementById('feedback-panel').classList.add('hidden');
            document.getElementById('next-btn').classList.add('hidden');
            
            // Progress
            document.getElementById('progress-text').innerText = `Pregunta ${index + 1} de ${questions.length}`;
            const percentage = ((index) / questions.length) * 100;
            document.getElementById('progress-bar').style.width = `${percentage}%`;

            const q = questions[index];
            const qTextEl = document.getElementById('question-text');
            qTextEl.innerHTML = q.question;
            renderMath(qTextEl);

            // Option Buttons Reset
            const optionBtns = document.querySelectorAll('.option-btn');
            optionBtns.forEach((btn, idx) => {
                btn.disabled = false;
                btn.className = getOptionOriginalClass(idx);
                // Set text
                const optLbl = btn.querySelector('.option-label');
                optLbl.innerHTML = q.options[idx];
                renderMath(optLbl);
            });

            // Timer management
            if (mode === 'exam') {
                document.getElementById('timer-box').classList.remove('hidden');
                startTimer();
            } else {
                document.getElementById('timer-box').classList.add('hidden');
            }
        }

        function getOptionOriginalClass(index) {
            const base = "option-btn p-5 rounded-2xl text-white font-bold text-left shadow transition-all flex items-start gap-3 transform hover:-translate-y-0.5 active:translate-y-0";
            if (index === 0) return `${base} bg-red-500 hover:bg-red-600`;
            if (index === 1) return `${base} bg-blue-500 hover:bg-blue-600`;
            if (index === 2) return `${base} bg-amber-500 hover:bg-amber-600`;
            return `${base} bg-green-500 hover:bg-green-600`;
        }

        function startTimer() {
            clearInterval(timerInterval);
            secondsLeft = 20;
            updateTimerDisplay();
            
            timerInterval = setInterval(() => {
                secondsLeft--;
                updateTimerDisplay();
                if (secondsLeft <= 0) {
                    clearInterval(timerInterval);
                    timeOutAnswer();
                }
            }, 1000);
        }

        function updateTimerDisplay() {
            document.getElementById('timer-text').innerText = `${secondsLeft}s`;
        }

        function selectOption(index) {
            if (answered) return;
            answered = true;
            clearInterval(timerInterval);

            const q = questions[currentIndex];
            const correctIndex = q.correctAnswer;

            const optionBtns = document.querySelectorAll('.option-btn');
            
            // Disable all buttons
            optionBtns.forEach(btn => btn.disabled = true);

            const feedbackPanel = document.getElementById('feedback-panel');
            const feedbackIcon = document.getElementById('feedback-icon');
            const feedbackTitle = document.getElementById('feedback-title');
            const explanationText = document.getElementById('explanation-text');

            explanationText.innerHTML = q.explanation;
            renderMath(explanationText);
            feedbackPanel.classList.remove('hidden');

            if (index === correctIndex) {
                // Correct!
                correctCount++;
                // Add points
                let pointsGained = 100;
                if (mode === 'exam') {
                    pointsGained += secondsLeft * 10; // Time bonus!
                }
                score += pointsGained;

                // Color correct button
                optionBtns[index].classList.remove('bg-red-500', 'bg-blue-500', 'bg-amber-500', 'bg-green-500', 'hover:bg-red-600', 'hover:bg-blue-600', 'hover:bg-amber-600', 'hover:bg-green-600');
                optionBtns[index].classList.add('bg-green-600', 'ring-4', 'ring-green-300');

                // Panel setup
                feedbackPanel.className = "mt-6 p-5 rounded-3xl border border-green-200 bg-green-50 dark:bg-green-950/40 text-green-900 dark:text-green-200";
                feedbackIcon.className = "w-8 h-8 rounded-full flex items-center justify-center font-bold text-white text-lg bg-green-600";
                feedbackIcon.innerText = "✓";
                feedbackTitle.innerText = `¡Correcto! (+${pointsGained} pts)`;
            } else {
                // Incorrect!
                incorrectCount++;
                // Log mistake for recommendation
                mistakesByTopic[q.topic] = (mistakesByTopic[q.topic] || 0) + 1;

                // Color incorrect button red
                optionBtns[index].classList.remove('bg-red-500', 'bg-blue-500', 'bg-amber-500', 'bg-green-500', 'hover:bg-red-600', 'hover:bg-blue-600', 'hover:bg-amber-600', 'hover:bg-green-600');
                optionBtns[index].classList.add('bg-red-600', 'ring-4', 'ring-red-300', 'opacity-60');

                // Highlight correct button
                optionBtns[correctIndex].classList.remove('bg-red-500', 'bg-blue-500', 'bg-amber-500', 'bg-green-500', 'hover:bg-red-600', 'hover:bg-blue-600', 'hover:bg-amber-600', 'hover:bg-green-600');
                optionBtns[correctIndex].classList.add('bg-green-600', 'ring-4', 'ring-green-200');

                // Panel setup
                feedbackPanel.className = "mt-6 p-5 rounded-3xl border border-red-200 bg-red-50 dark:bg-red-950/40 text-red-900 dark:text-red-200";
                feedbackIcon.className = "w-8 h-8 rounded-full flex items-center justify-center font-bold text-white text-lg bg-red-600";
                feedbackIcon.innerText = "✗";
                feedbackTitle.innerText = "Respuesta Incorrecta";
            }

            document.getElementById('next-btn').classList.remove('hidden');
        }

        function timeOutAnswer() {
            answered = true;
            incorrectCount++;
            const q = questions[currentIndex];
            mistakesByTopic[q.topic] = (mistakesByTopic[q.topic] || 0) + 1;

            const optionBtns = document.querySelectorAll('.option-btn');
            optionBtns.forEach(btn => btn.disabled = true);

            // Highlight the correct one
            const correctIndex = q.correctAnswer;
            optionBtns[correctIndex].classList.remove('bg-red-500', 'bg-blue-500', 'bg-amber-500', 'bg-green-500', 'hover:bg-red-600', 'hover:bg-blue-600', 'hover:bg-amber-600', 'hover:bg-green-600');
            optionBtns[correctIndex].classList.add('bg-green-600', 'ring-4', 'ring-green-200');

            const feedbackPanel = document.getElementById('feedback-panel');
            feedbackPanel.className = "mt-6 p-5 rounded-3xl border border-red-200 bg-red-50 dark:bg-red-950/40 text-red-900 dark:text-red-200";
            
            const feedbackIcon = document.getElementById('feedback-icon');
            feedbackIcon.className = "w-8 h-8 rounded-full flex items-center justify-center font-bold text-white text-lg bg-red-600";
            feedbackIcon.innerText = "!";
            feedbackIcon.classList.add('bg-amber-500');
            
            const feedbackTitle = document.getElementById('feedback-title');
            feedbackTitle.innerText = "¡Se acabó el tiempo!";

            const explanationText = document.getElementById('explanation-text');
            explanationText.innerHTML = q.explanation;
            renderMath(explanationText);
            feedbackPanel.classList.remove('hidden');

            document.getElementById('next-btn').classList.remove('hidden');
        }

        function loadNextQuestion() {
            currentIndex++;
            if (currentIndex < questions.length) {
                showQuestion(currentIndex);
            } else {
                showResults();
            }
        }

        function showResults() {
            document.getElementById('quiz-container').classList.add('hidden');
            
            // Set results values
            document.getElementById('res-score').innerText = score;
            document.getElementById('res-correct').innerText = correctCount;
            document.getElementById('res-incorrect').innerText = incorrectCount;

            // Generate study recommendations
            const recList = document.getElementById('recommendations-list');
            recList.innerHTML = '';

            const topicsWithMistakes = Object.keys(mistakesByTopic);
            
            if (topicsWithMistakes.length === 0) {
                const li = document.createElement('li');
                li.innerText = '¡Felicidades! Respondiste todas las preguntas correctamente. Estás listo para obtener 10 en tu examen espejo.';
                recList.appendChild(li);
            } else {
                topicsWithMistakes.forEach(topic => {
                    const errors = mistakesByTopic[topic];
                    const li = document.createElement('li');
                    
                    let hint = '';
                    if (topic === 'Sistemas Inteligentes') {
                        hint = 'Repasa las características clave (reactividad, proactividad, embodiment) en la Sección 1 de la Guía.';
                    } else if (topic === 'Sistemas de Control') {
                        hint = 'Asegúrate de entender cómo actúan Kp, Ki y Kd en un controlador PID en la Sección 6.';
                    } else if (topic === 'Perceptrón') {
                        hint = 'Practica con el simulador de Perceptrón simple y comprende su restricción de separabilidad lineal (Sección 3).';
                    } else if (topic === 'Backpropagation') {
                        hint = 'Estudia cómo se derivan las sigmoides y cómo se calcula el error local delta en la Sección 4.';
                    } else if (topic === 'Red Hopfield') {
                        hint = 'Repasa la multiplicación matricial de la regla de Hebb y la anulación de la diagonal en la Sección 5.';
                    } else {
                        hint = 'Utiliza la Guía de estudio rápida para repasar las bases teóricas de este tema.';
                    }

                    li.innerHTML = `<strong>${topic}</strong> (${errors} error${errors > 1 ? 'es' : ''}): ${hint}`;
                    recList.appendChild(li);
                });
            }

            document.getElementById('results-container').classList.remove('hidden');
        }
    </script>
</x-app-layout>
