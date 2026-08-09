<x-app-layout>
    <x-slot name="title">Base de Conocimientos y Motor de Inferencia - NeuroSmart Trainer</x-slot>

    <!-- Header Section -->
    <div class="mb-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800 dark:bg-amber-950 dark:text-amber-300 mb-2">
                <span>SEGUNDO PARCIAL</span> &bull; <span>MÓDULO 5</span>
            </div>
            <h1 class="text-3xl font-extrabold font-outfit text-gray-900 dark:text-white">
                Base de Conocimientos & Motor de Inferencia
            </h1>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                Simula el flujo de razonamiento deductivo: Hechos + Reglas de Producción SI-ENTONCES &rarr; Motor de Inferencia &rarr; Recomendación/Decisión.
            </p>
        </div>
        <a href="{{ route('guide.index') }}#section-bc" class="px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white rounded-full text-xs font-bold font-outfit shadow-sm transition-all self-start md:self-auto">
            Ver Apuntes de la Guía
        </a>
    </div>

    <!-- Architecture Visual Card -->
    <div class="mb-8 p-6 bg-gradient-to-br from-amber-50 to-orange-50 dark:from-gray-800 dark:to-amber-950/40 rounded-3xl border border-amber-200/60 dark:border-amber-900/40 shadow-sm">
        <h3 class="text-lg font-bold font-outfit text-amber-900 dark:text-amber-200 mb-3 flex items-center gap-2">
            <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 01-2 2h-4a2 2 0 01-2-2v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
            Los 3 Pilares de un Sistema Basado en Conocimiento
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-xs">
            <div class="p-4 bg-white dark:bg-gray-800 rounded-2xl border border-amber-100 dark:border-gray-700 shadow-sm">
                <span class="px-2 py-0.5 rounded bg-blue-100 dark:bg-blue-950 text-blue-700 dark:text-blue-300 font-bold">1. HECHOS (Memoria)</span>
                <p class="mt-2 text-gray-600 dark:text-gray-300">
                    Información estática o dinámica sobre el dominio del problema (Ej: <em>"Paciente presenta Síntoma A"</em>).
                </p>
            </div>
            <div class="p-4 bg-white dark:bg-gray-800 rounded-2xl border border-amber-100 dark:border-gray-700 shadow-sm">
                <span class="px-2 py-0.5 rounded bg-purple-100 dark:bg-purple-950 text-purple-700 dark:text-purple-300 font-bold">2. REGLAS (SI-ENTONCES)</span>
                <p class="mt-2 text-gray-600 dark:text-gray-300">
                    Instrucciones condicionales que dictan cómo usar la información (Ej: <em>"SI síntoma A ENTONCES enfermedad B"</em>).
                </p>
            </div>
            <div class="p-4 bg-white dark:bg-gray-800 rounded-2xl border border-amber-100 dark:border-gray-700 shadow-sm">
                <span class="px-2 py-0.5 rounded bg-emerald-100 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-300 font-bold">3. MOTOR DE INFERENCIA</span>
                <p class="mt-2 text-gray-600 dark:text-gray-300">
                    El cerebro del sistema: aplica algoritmos de búsqueda y equiparación de patrones para derivar conclusiones.
                </p>
            </div>
        </div>
    </div>

    <!-- Main Interactive Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Interactive Controls (Left) -->
        <div class="lg:col-span-5 space-y-6">
            
            <!-- Preset Scenario 1: Medical Diagnosis -->
            <div class="p-6 bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm">
                <h3 class="text-base font-bold font-outfit text-gray-900 dark:text-white mb-3">
                    Caso 1: Diagnóstico Médico Inteligente
                </h3>
                <form id="preset-form" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1">
                            Selecciona o escribe el Hecho / Síntoma:
                        </label>
                        <select id="symptom-select" name="symptom" class="w-full px-3 py-2 text-xs rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white focus:ring-2 focus:ring-amber-500">
                            <option value="síntoma A">Síntoma A (Activa Regla R1: Enfermedad B)</option>
                            <option value="fiebre alta">Fiebre alta (Activa Regla R2: Infección)</option>
                            <option value="dolor articular y fiebre alta">Dolor articular y fiebre (Activa Regla R3: Reumatología)</option>
                            <option value="tos leve">Tos leve (Sin regla predefinida)</option>
                        </select>
                    </div>

                    <button type="submit" class="w-full py-2.5 bg-amber-600 hover:bg-amber-700 text-white font-bold text-xs rounded-xl shadow-sm transition-all flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Ejecutar Motor de Inferencia
                    </button>
                </form>
            </div>

            <!-- Custom Rule Builder -->
            <div class="p-6 bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm">
                <h3 class="text-base font-bold font-outfit text-gray-900 dark:text-white mb-3">
                    Caso 2: Construir Regla Personalizada
                </h3>
                <form id="custom-form" class="space-y-3">
                    @csrf
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 dark:text-gray-400">Hecho de Entrada:</label>
                        <input type="text" name="custom_fact" placeholder="Ej: Temperatura > 90°C" class="w-full mt-1 px-3 py-1.5 text-xs rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 dark:text-white">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 dark:text-gray-400">Condición SI:</label>
                        <input type="text" name="custom_condition" placeholder="Ej: Temperatura > 90°C" required class="w-full mt-1 px-3 py-1.5 text-xs rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 dark:text-white">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 dark:text-gray-400">Acción / Conclusión ENTONCES:</label>
                        <input type="text" name="custom_action" placeholder="Ej: Activar sistema de enfriamiento" required class="w-full mt-1 px-3 py-1.5 text-xs rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 dark:text-white">
                    </div>
                    <button type="submit" class="w-full py-2 bg-gray-900 hover:bg-black dark:bg-gray-700 dark:hover:bg-gray-600 text-white font-bold text-xs rounded-xl transition-all">
                        Evaluar Regla Personalizada
                    </button>
                </form>
            </div>
        </div>

        <!-- Reasoning Execution Output (Right) -->
        <div class="lg:col-span-7">
            <div class="p-6 bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm min-h-[450px] flex flex-col justify-between">
                <div>
                    <h3 class="text-lg font-bold font-outfit text-gray-900 dark:text-white mb-4 border-b border-gray-100 dark:border-gray-700 pb-3 flex items-center justify-between">
                        <span>Traza del Motor de Inferencia</span>
                        <span id="status-badge" class="px-2.5 py-1 text-xs font-bold rounded-full bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300">Esperando ejecución...</span>
                    </h3>

                    <!-- Step by Step Results Container -->
                    <div id="results-container" class="space-y-4 text-xs">
                        <div class="text-center py-12 text-gray-400 dark:text-gray-500">
                            <svg class="w-12 h-12 mx-auto mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/></svg>
                            Selecciona una opción a la izquierda y presiona "Ejecutar Motor de Inferencia" para visualizar el algoritmo de equiparación de patrones en tiempo real.
                        </div>
                    </div>
                </div>

                <!-- Final Conclusion Card -->
                <div id="conclusion-box" class="hidden mt-6 p-4 bg-emerald-50 dark:bg-emerald-950/50 border border-emerald-200 dark:border-emerald-900 rounded-2xl">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-emerald-800 dark:text-emerald-300 mb-1">
                        Decisión / Recomendación Derivada:
                    </h4>
                    <p id="conclusion-text" class="text-sm font-semibold text-emerald-900 dark:text-emerald-100">
                        -
                    </p>
                </div>
            </div>
        </div>

    </div>

    <!-- JS Execution Engine -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const presetForm = document.getElementById('preset-form');
            const customForm = document.getElementById('custom-form');
            const resultsContainer = document.getElementById('results-container');
            const conclusionBox = document.getElementById('conclusion-box');
            const conclusionText = document.getElementById('conclusion-text');
            const statusBadge = document.getElementById('status-badge');

            async function handleSolve(formData) {
                statusBadge.textContent = "Procesando...";
                statusBadge.className = "px-2.5 py-1 text-xs font-bold rounded-full bg-amber-100 text-amber-800 dark:bg-amber-950 dark:text-amber-300 animate-pulse";
                
                try {
                    const response = await fetch("{{ route('knowledge.solve') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: formData
                    });

                    const data = await response.json();

                    if (data.success) {
                        statusBadge.textContent = "Inferencia Completada";
                        statusBadge.className = "px-2.5 py-1 text-xs font-bold rounded-full bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-300";

                        let html = '';
                        data.steps.forEach((step, idx) => {
                            html += `
                                <div class="p-3 bg-gray-50 dark:bg-gray-900 rounded-xl border border-gray-200/60 dark:border-gray-700/60">
                                    <span class="font-bold text-amber-600 dark:text-amber-400 uppercase tracking-wide text-[10px]">Paso ${idx+1}: ${step.stage}</span>
                                    <p class="text-gray-800 dark:text-gray-200 mt-1">${step.detail}</p>
                                </div>
                            `;
                        });

                        resultsContainer.innerHTML = html;
                        
                        if (data.conclusions.length > 0) {
                            conclusionText.textContent = data.conclusions.join(" | ");
                            conclusionBox.classList.remove('hidden');
                        } else {
                            conclusionBox.classList.add('hidden');
                        }
                    }
                } catch (err) {
                    statusBadge.textContent = "Error";
                    statusBadge.className = "px-2.5 py-1 text-xs font-bold rounded-full bg-red-100 text-red-800";
                    console.error(err);
                }
            }

            presetForm.addEventListener('submit', function(e) {
                e.preventDefault();
                handleSolve(new FormData(presetForm));
            });

            customForm.addEventListener('submit', function(e) {
                e.preventDefault();
                handleSolve(new FormData(customForm));
            });
        });
    </script>
</x-app-layout>
