<x-app-layout>
    <x-slot name="title">Guía de Estudio por Parciales - NeuroSmart Trainer</x-slot>

    <!-- Header -->
    <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold font-outfit text-gray-900 dark:text-white mb-1">
                Guía de Estudio Rápida por Parciales (Con Diagramas Mermaid)
            </h1>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Resúmenes, fórmulas, explicaciones y diagramas Mermaid interactivos para el Examen Espejo de Sistemas Inteligentes.
            </p>
        </div>
        <a href="{{ route('quiz.index') }}" class="px-5 py-2.5 bg-[var(--m3-primary)] text-white hover:bg-opacity-90 font-semibold rounded-full text-sm shadow-sm transition-all self-start md:self-auto">
            Ponerse a Prueba (Quiz)
        </a>
    </div>

    <!-- Parcial Navigation Tabs -->
    <div class="flex gap-3 mb-6 border-b border-gray-200 dark:border-gray-700">
        <button id="guide-tab-p1" class="px-6 py-3 font-bold font-outfit text-sm rounded-t-2xl border-b-2 border-purple-600 text-purple-600 dark:text-purple-400 bg-white dark:bg-gray-800 shadow-sm transition-all flex items-center gap-2">
            <span class="w-2.5 h-2.5 rounded-full bg-sky-500"></span>
            PRIMER PARCIAL: Redes Neuronales
        </button>
        <button id="guide-tab-p2" class="px-6 py-3 font-bold font-outfit text-sm text-gray-500 hover:text-gray-800 dark:hover:text-gray-200 rounded-t-2xl border-b-2 border-transparent transition-all flex items-center gap-2">
            <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
            SEGUNDO PARCIAL: Sistemas de Conocimiento
        </button>
    </div>

    <!-- PRIMER PARCIAL CONTENT CONTAINER -->
    <div id="guide-content-p1" class="space-y-8">
        
        <!-- Quick Section Nav P1 -->
        <div class="grid grid-cols-2 md:grid-cols-5 gap-2 no-print">
            <a href="#section-ia" class="px-3 py-2 text-center text-xs font-bold rounded-xl bg-gray-100 dark:bg-gray-800 hover:bg-purple-100 dark:hover:bg-purple-950 transition-colors">
                1. IA & ML
            </a>
            <a href="#section-neurons" class="px-3 py-2 text-center text-xs font-bold rounded-xl bg-gray-100 dark:bg-gray-800 hover:bg-purple-100 dark:hover:bg-purple-950 transition-colors">
                2. Neuronas & Funciones
            </a>
            <a href="#section-perceptron" class="px-3 py-2 text-center text-xs font-bold rounded-xl bg-gray-100 dark:bg-gray-800 hover:bg-purple-100 dark:hover:bg-purple-950 transition-colors">
                3. Perceptrón Simple
            </a>
            <a href="#section-propagation" class="px-3 py-2 text-center text-xs font-bold rounded-xl bg-gray-100 dark:bg-gray-800 hover:bg-purple-100 dark:hover:bg-purple-950 transition-colors">
                4. Backpropagation
            </a>
            <a href="#section-hopfield" class="px-3 py-2 text-center text-xs font-bold rounded-xl bg-gray-100 dark:bg-gray-800 hover:bg-purple-100 dark:hover:bg-purple-950 transition-colors">
                5. Red Hopfield
            </a>
        </div>

        <!-- 1. IA & ML -->
        <section id="section-ia" class="p-6 bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm scroll-mt-20">
            <h2 class="text-xl font-bold font-outfit text-gray-900 dark:text-white mb-4 border-b border-gray-100 dark:border-gray-700 pb-2 flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-purple-500"></span>
                1. Inteligencia Artificial, Machine Learning y Deep Learning
            </h2>
            <div class="space-y-4 text-sm text-gray-600 dark:text-gray-300">
                <p>
                    <strong>Inteligencia Artificial (IA):</strong> Rama de la ciencia enfocada en crear sistemas y dispositivos que imiten las capacidades del ser humano como la percepción, el aprendizaje y el razonamiento para resolver problemas y adaptarse al contexto.
                </p>
                <!-- Mermaid Flowchart IA -->
                <div class="w-full bg-gray-50 dark:bg-gray-950 rounded-2xl p-4 border border-gray-200 dark:border-gray-800 overflow-x-auto flex justify-center my-4">
                    <pre class="mermaid text-center">
graph TD
    IA[Inteligencia Artificial] --> ML[Machine Learning]
    ML --> DL[Deep Learning]
    ML --> Sup[Aprendizaje Supervisado]
    ML --> NoSup[Aprendizaje No Supervisado]
    ML --> Ref[Aprendizaje por Refuerzo]
                    </pre>
                </div>
            </div>
        </section>

        <!-- 2. Neuronas & Funciones -->
        <section id="section-neurons" class="p-6 bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm scroll-mt-20">
            <h2 class="text-xl font-bold font-outfit text-gray-900 dark:text-white mb-4 border-b border-gray-100 dark:border-gray-700 pb-2 flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-purple-500"></span>
                2. Neurona Biológica, Artificial y Funciones de Activación
            </h2>
            <div class="space-y-4 text-sm text-gray-600 dark:text-gray-300">
                <p>
                    <strong>Neurona Artificial:</strong> Combina entradas multiplicadas por pesos sinápticos $w_i$, añade un sesgo (bias) y aplica una función de activación no lineal: $z = \sum w_i x_i + b$.
                </p>
            </div>
        </section>

        <!-- 3. Perceptrón Simple -->
        <section id="section-perceptron" class="p-6 bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm scroll-mt-20">
            <h2 class="text-xl font-bold font-outfit text-gray-900 dark:text-white mb-4 border-b border-gray-100 dark:border-gray-700 pb-2 flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-purple-500"></span>
                3. Perceptrón Simple (Regla de Aprendizaje Hebbiano)
            </h2>
            <div class="space-y-4 text-sm text-gray-600 dark:text-gray-300">
                <p>
                    Ajuste dinámico de pesos: $w_i^{(nUEVO)} = w_i^{(VIEJO)} + \eta \cdot (y^{(DESEADO)} - y^{(CALCULADO)}) \cdot x_i$.
                </p>
            </div>
        </section>

        <!-- 4. Backpropagation -->
        <section id="section-propagation" class="p-6 bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm scroll-mt-20">
            <h2 class="text-xl font-bold font-outfit text-gray-900 dark:text-white mb-4 border-b border-gray-100 dark:border-gray-700 pb-2 flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-purple-500"></span>
                4. Backpropagation (Retropropagación del Error)
            </h2>
            <div class="space-y-4 text-sm text-gray-600 dark:text-gray-300">
                <p>
                    Cálculo de deltas en la capa de salida $\delta_k = (y_k - \hat{y}_k) \cdot \hat{y}_k (1 - \hat{y}_k)$ y retropropagación hacia capas ocultas.
                </p>
            </div>
        </section>

        <!-- 5. Hopfield -->
        <section id="section-hopfield" class="p-6 bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm scroll-mt-20">
            <h2 class="text-xl font-bold font-outfit text-gray-900 dark:text-white mb-4 border-b border-gray-100 dark:border-gray-700 pb-2 flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-purple-500"></span>
                5. Red Neuronal de Hopfield (Memoria Asociativa)
            </h2>
            <div class="space-y-4 text-sm text-gray-600 dark:text-gray-300">
                <p>
                    Matriz de entrenamiento $W = \sum (x_k x_k^T) - M \cdot I$, eliminando la diagonal principal ($w_{ii} = 0$).
                </p>
            </div>
        </section>

    </div>

    <!-- SEGUNDO PARCIAL CONTENT CONTAINER -->
    <div id="guide-content-p2" class="hidden space-y-8">
        
        <!-- Quick Section Nav P2 -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-2 no-print">
            <a href="#section-bc" class="px-3 py-2 text-center text-xs font-bold rounded-xl bg-amber-100 dark:bg-amber-950 text-amber-800 dark:text-amber-300 hover:bg-amber-200 transition-colors">
                6. Bases de Conocimiento
            </a>
            <a href="#section-semantic" class="px-3 py-2 text-center text-xs font-bold rounded-xl bg-amber-100 dark:bg-amber-950 text-amber-800 dark:text-amber-300 hover:bg-amber-200 transition-colors">
                7. Redes Semánticas
            </a>
            <a href="#section-frames" class="px-3 py-2 text-center text-xs font-bold rounded-xl bg-amber-100 dark:bg-amber-950 text-amber-800 dark:text-amber-300 hover:bg-amber-200 transition-colors">
                8. Marcos (Ejemplo Pizarrón)
            </a>
            <a href="#section-rag" class="px-3 py-2 text-center text-xs font-bold rounded-xl bg-amber-100 dark:bg-amber-950 text-amber-800 dark:text-amber-300 hover:bg-amber-200 transition-colors">
                9. IA Moderna & RAG
            </a>
        </div>

        <!-- 6. Arquitectura y Anatomía de Bases de Conocimiento -->
        <section id="section-bc" class="p-6 bg-white dark:bg-gray-800 rounded-3xl border border-amber-200/70 dark:border-amber-900/50 shadow-sm scroll-mt-20">
            <h2 class="text-xl font-bold font-outfit text-gray-900 dark:text-white mb-4 border-b border-amber-100 dark:border-gray-700 pb-2 flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
                6. Arquitectura y Anatomía de una Base de Conocimiento
            </h2>
            <div class="space-y-4 text-sm text-gray-600 dark:text-gray-300">
                <p>
                    Una <strong>Base de Conocimiento (BC)</strong> es un depósito estructurado que contiene reglas y hechos para emular el razonamiento humano.
                </p>

                <!-- Mermaid Diagram Architecture -->
                <div class="w-full bg-gray-50 dark:bg-gray-950 rounded-2xl p-4 border border-gray-200 dark:border-gray-800 overflow-x-auto flex justify-center my-4">
                    <pre class="mermaid text-center">
graph LR
    H[Hechos: Heurística / Datos] --> MI[Motor de Inferencia]
    R[Reglas de Producción: SI-ENTONCES] --> MI
    MI --> D[Decisión / Diagnóstico]
                    </pre>
                </div>
            </div>
        </section>

        <!-- 7. Redes Semánticas -->
        <section id="section-semantic" class="p-6 bg-white dark:bg-gray-800 rounded-3xl border border-amber-200/70 dark:border-amber-900/50 shadow-sm scroll-mt-20">
            <h2 class="text-xl font-bold font-outfit text-gray-900 dark:text-white mb-4 border-b border-amber-100 dark:border-gray-700 pb-2 flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
                7. Redes Semánticas (Grafos Directed)
            </h2>
            <div class="space-y-4 text-sm text-gray-600 dark:text-gray-300">
                <p>
                    Grafos con <strong>Nodos</strong> (conceptos) y <strong>Arcos</strong> (relaciones semánticas).
                </p>

                <!-- Mermaid Graph -->
                <div class="w-full bg-gray-50 dark:bg-gray-950 rounded-2xl p-4 border border-gray-200 dark:border-gray-800 overflow-x-auto flex justify-center my-4">
                    <pre class="mermaid text-center">
graph TD
    Animal[Animal] -->|es_un| Pájaro[Pájaro]
    Pájaro -->|tiene_un| Alas[Alas]
    Pájaro -->|es_un| Canario[Canario]
    Pájaro -->|es_un| Pingüino[Pingüino]
                    </pre>
                </div>
            </div>
        </section>

        <!-- 8. Marcos (Frames) - Whiteboard Example Included -->
        <section id="section-frames" class="p-6 bg-white dark:bg-gray-800 rounded-3xl border border-amber-200/70 dark:border-amber-900/50 shadow-sm scroll-mt-20">
            <h2 class="text-xl font-bold font-outfit text-gray-900 dark:text-white mb-4 border-b border-amber-100 dark:border-gray-700 pb-2 flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
                8. Representación del Conocimiento: Marcos (Ejemplo del Pizarrón)
            </h2>
            <div class="space-y-4 text-sm text-gray-600 dark:text-gray-300">
                <p>
                    Propuestos por <strong>Marvin Minsky en 1975</strong>. A continuación se presenta el diagrama de clases/marcos correspondiente al ejercicio práctico del pizarrón:
                </p>

                <!-- Mermaid Class Diagram from Whiteboard -->
                <div class="w-full bg-gray-50 dark:bg-gray-950 rounded-2xl p-6 border border-gray-200 dark:border-gray-800 overflow-x-auto flex justify-center my-4">
                    <pre class="mermaid text-center">
classDiagram
    class Escuela {
        +Facultades: String
        +Edificios: Char
        +Profesores: String
        +Alumnos: String
        +tieneTalleres: bool
        +colegiaturas: float
        +cicloEscolar: 26-3
        +Inscribir()
        +darMantenimiento()
        +pagar()
        +asistirAClases()
    }
    class Facultades {
        -Ingenieria
        -FACS
        -Salud
    }
    class Alumnos {
        -Nombre
        -Apellido_P
        -Apellido_M
        -Tira_de_Materias
    }
    class Colegiaturas {
        +conBeca()
        +sinBeca()
        +pagarEfectivo()
        +pagarTarjeta()
    }
    class Inscribir {
        +InscribirMaterias()
        +ElegirTalleres()
        +TipoMateria
    }
    class TipoMateria {
        -en_linea
        -presencial
    }

    Escuela --> Facultades : contiene
    Escuela --> Alumnos : contiene
    Escuela --> Colegiaturas : gestiona
    Escuela --> Inscribir : procesa
    Inscribir --> TipoMateria : requiere
                    </pre>
                </div>
            </div>
        </section>

        <!-- 9. IA Moderna & RAG -->
        <section id="section-rag" class="p-6 bg-white dark:bg-gray-800 rounded-3xl border border-amber-200/70 dark:border-amber-900/50 shadow-sm scroll-mt-20">
            <h2 class="text-xl font-bold font-outfit text-gray-900 dark:text-white mb-4 border-b border-amber-100 dark:border-gray-700 pb-2 flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
                9. Evolución: Lógica de Predicados, BD Vectoriales y RAG
            </h2>
            <div class="space-y-4 text-sm text-gray-600 dark:text-gray-300">
                <p>
                    <strong>Era de la IA Moderna (RAG & BD Vectoriales):</strong> Los sistemas de IA actuales combinan modelos de lenguaje con bases vectoriales y consulta de documentos en tiempo real.
                </p>
                <!-- Mermaid Flowchart RAG -->
                <div class="w-full bg-gray-50 dark:bg-gray-950 rounded-2xl p-4 border border-gray-200 dark:border-gray-800 overflow-x-auto flex justify-center my-4">
                    <pre class="mermaid text-center">
graph LR
    Usuario[Usuario] -->|Consulta| Recuperador[Recuperador RAG]
    Recuperador -->|Busca Embeddings| BDV[Base de Datos Vectorial]
    BDV -->|Documentos Relevantes| LLM[Modelo de Lenguaje LLM]
    LLM -->|Respuesta Precisa sin Alucinaciones| Usuario
                    </pre>
                </div>
            </div>
        </section>

    </div>

    <!-- JS Tabs Toggle -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btnP1 = document.getElementById('guide-tab-p1');
            const btnP2 = document.getElementById('guide-tab-p2');
            const contentP1 = document.getElementById('guide-content-p1');
            const contentP2 = document.getElementById('guide-content-p2');

            const activeClassP1 = "px-6 py-3 font-bold font-outfit text-sm rounded-t-2xl border-b-2 border-purple-600 text-purple-600 dark:text-purple-400 bg-white dark:bg-gray-800 shadow-sm transition-all flex items-center gap-2";
            const activeClassP2 = "px-6 py-3 font-bold font-outfit text-sm rounded-t-2xl border-b-2 border-amber-600 text-amber-600 dark:text-amber-400 bg-white dark:bg-gray-800 shadow-sm transition-all flex items-center gap-2";
            const inactiveClass = "px-6 py-3 font-bold font-outfit text-sm text-gray-500 hover:text-gray-800 dark:hover:text-gray-200 rounded-t-2xl border-b-2 border-transparent transition-all flex items-center gap-2";

            btnP1.addEventListener('click', function() {
                contentP1.classList.remove('hidden');
                contentP2.classList.add('hidden');
                btnP1.className = activeClassP1;
                btnP2.className = inactiveClass;
            });

            btnP2.addEventListener('click', function() {
                contentP2.classList.remove('hidden');
                contentP1.classList.add('hidden');
                btnP2.className = activeClassP2;
                btnP1.className = inactiveClass;
            });
        });
    </script>
</x-app-layout>
