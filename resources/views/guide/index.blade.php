<x-app-layout>
    <x-slot name="title">Guía de Estudio - NeuroSmart Trainer</x-slot>

    <!-- Header -->
    <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold font-outfit text-gray-900 dark:text-white mb-1">
                Guía de Estudio Rápida
            </h1>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Resúmenes, fórmulas y explicaciones para repasar antes del Examen Espejo de Sistemas Inteligentes.
            </p>
        </div>
        <a href="{{ route('quiz.index') }}" class="px-5 py-2.5 bg-[var(--m3-primary)] text-white hover:bg-opacity-90 font-semibold rounded-full text-sm shadow-sm transition-all self-start md:self-auto">
            Ponerse a Prueba (Quiz)
        </a>
    </div>

    <!-- Quick Navigation Tabs -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-2 mb-8 no-print">
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
        <a href="#section-control" class="px-3 py-2 text-center text-xs font-bold rounded-xl bg-gray-100 dark:bg-gray-800 hover:bg-purple-100 dark:hover:bg-purple-950 transition-colors">
            6. Control & PID
        </a>
    </div>

    <!-- Content Sections -->
    <div class="space-y-8">

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
                <p>
                    <strong>Machine Learning (ML):</strong> Rama de la IA que estudia cómo dotar a las máquinas de capacidad de aprendizaje a partir de datos, sin ser programadas explícitamente para cada tarea. Se divide en:
                </p>
                <ul class="list-disc pl-6 space-y-1.5">
                    <li><strong>Aprendizaje Supervisado:</strong> Los datos de entrenamiento incluyen tanto las entradas como las salidas esperadas (etiquetas). La red aprende a minimizar el error.</li>
                    <li><strong>Aprendizaje No Supervisado:</strong> Los datos no tienen etiquetas. El sistema busca agrupar o encontrar patrones significativos por sí mismo.</li>
                    <li><strong>Aprendizaje por Refuerzo:</strong> El sistema aprende de forma interactiva mediante recompensas y castigos según las acciones que realice.</li>
                </ul>
                <p>
                    <strong>Deep Learning (DL):</strong> Subconjunto de algoritmos de Machine Learning que utiliza arquitecturas compuestas de transformaciones no lineales y múltiples capas ocultas (Redes Neuronales Profundas) para modelar abstracciones de alto nivel.
                </p>
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
                    <strong>Neurona Biológica:</strong> Se compone de:
                </p>
                <ul class="list-disc pl-6 space-y-1.5">
                    <li><strong>Dendritas:</strong> Reciben los impulsos eléctricos de otras neuronas.</li>
                    <li><strong>Soma (Cuerpo):</strong> Procesa la información y genera las descargas.</li>
                    <li><strong>Axón:</strong> Envía el impulso hacia los órganos efectores u otras neuronas.</li>
                    <li><strong>Sinapsis:</strong> Comunicación química a través de neurotransmisores en la hendidura sináptica.</li>
                </ul>
                <p>
                    <strong>Fisiología Eléctrica:</strong> La <strong>bomba de sodio-potasio</strong> mantiene un potencial de reposo en la membrana. Cuando un estímulo supera el <strong>potencial umbral</strong>, se dispara un potencial de acción bajo la <strong>ley del todo o nada</strong>.
                </p>
                <p>
                    <strong>Neurona Artificial:</strong> Emula la biología combinando entradas multiplicadas por pesos sinápticos, añadiendo un sesgo (bias) y aplicando una función de activación no lineal.
                </p>
                
                <h3 class="text-md font-bold font-outfit text-gray-800 dark:text-gray-200 mt-4 mb-2">Funciones de Activación</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="p-3 bg-gray-50 dark:bg-gray-900 rounded-2xl">
                        <span class="font-bold text-[var(--m3-primary)]">Escalón Unitario (Step)</span>
                        <p class="text-xs mt-1">
                            $u(z) = \begin{cases} 0 & \text{si } z \le 0 \\ 1 & \text{si } z > 0 \end{cases}$<br>
                            Acotada entre 0 y 1. Se usa en el Perceptrón Simple.
                        </p>
                    </div>
                    <div class="p-3 bg-gray-50 dark:bg-gray-900 rounded-2xl">
                        <span class="font-bold text-[var(--m3-primary)]">Sigmoide (Sigmoid)</span>
                        <p class="text-xs mt-1">
                            $\sigma(z) = \frac{1}{1 + e^{-z}}$<br>
                            Acotada en el rango $(0, 1)$. Muy útil para modelar probabilidades y para Backpropagation.
                        </p>
                    </div>
                    <div class="p-3 bg-gray-50 dark:bg-gray-900 rounded-2xl">
                        <span class="font-bold text-[var(--m3-primary)]">Tangente Hiperbólica (Tanh)</span>
                        <p class="text-xs mt-1">
                            $\tanh(z) = \frac{1 - e^{-2z}}{1 + e^{-2z}}$<br>
                            Acotada en el rango $(-1, 1)$. Centrada en cero.
                        </p>
                    </div>
                    <div class="p-3 bg-gray-50 dark:bg-gray-900 rounded-2xl">
                        <span class="font-bold text-[var(--m3-primary)]">Unidad Lineal Rectificada (ReLU)</span>
                        <p class="text-xs mt-1">
                            $f(z) = \max(0, z)$<br>
                            Acotada en $[0, +\infty)$. Evita el desvanecimiento del gradiente en redes profundas.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- 3. Perceptron Simple -->
        <section id="section-perceptron" class="p-6 bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm scroll-mt-20">
            <h2 class="text-xl font-bold font-outfit text-gray-900 dark:text-white mb-4 border-b border-gray-100 dark:border-gray-700 pb-2 flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-purple-500"></span>
                3. Perceptrón Simple
            </h2>
            <div class="space-y-4 text-sm text-gray-600 dark:text-gray-300">
                <p>
                    El perceptrón simple es la red neuronal más básica. Clasifica patrones linealmente separables (ej. compuertas lógicas AND, OR, NAND).
                </p>
                <div class="p-4 bg-gray-50 dark:bg-gray-900 rounded-2xl space-y-2">
                    <p><strong>Cálculo de entrada neta:</strong> $z = w_0 + w_1 x_1 + w_2 x_2 + \dots$ (donde $w_0$ es el bias o sesgo)</p>
                    <p><strong>Salida predicha:</strong> $\hat{y} = u(z)$</p>
                    <p><strong>Cálculo del error:</strong> $e = y - \hat{y}$ (Salida esperada - Salida predicha)</p>
                    <p><strong>Actualización de pesos (Hebb):</strong> $w_i = w_i + \eta \cdot e \cdot x_i \quad | \quad w_0 = w_0 + \eta \cdot e$</p>
                </div>
                <div class="p-4 bg-yellow-50 dark:bg-yellow-950 text-yellow-800 dark:text-yellow-200 rounded-2xl text-xs">
                    <strong>Limitación teórica:</strong> No puede resolver problemas que no sean linealmente separables, como la compuerta <strong>XOR</strong>, ya que no es posible trazar una sola línea recta que divida las clases.
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('perceptron.index') }}" class="px-4 py-2 bg-sky-600 text-white rounded-full text-xs font-semibold hover:bg-sky-700 transition-colors">
                        Practicar Perceptrón
                    </a>
                </div>
            </div>
        </section>

        <!-- 4. Propagation & Backpropagation -->
        <section id="section-propagation" class="p-6 bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm scroll-mt-20">
            <h2 class="text-xl font-bold font-outfit text-gray-900 dark:text-white mb-4 border-b border-gray-100 dark:border-gray-700 pb-2 flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-purple-500"></span>
                4. Forward y Backpropagation
            </h2>
            <div class="space-y-4 text-sm text-gray-600 dark:text-gray-300">
                <p>
                    <strong>Forward Propagation (Propagación hacia adelante):</strong> Las entradas fluyen a través de las capas ocultas multiplicándose por pesos y sumando sesgos, calculando la activación en cada neurona hasta llegar a la salida.
                </p>
                <p>
                    <strong>Backpropagation (Retropropagación):</strong> Algoritmo de aprendizaje supervisado para ajustar los pesos y sesgos basándose en la <strong>regla de la cadena</strong> para calcular derivadas parciales de una función de pérdida (generalmente el Error Cuadrático Medio, $E = \frac{1}{2}(y-\hat{y})^2$).
                </p>
                <div class="p-4 bg-gray-50 dark:bg-gray-900 rounded-2xl space-y-2">
                    <p><strong>Derivada de la Sigmoide:</strong> $\sigma'(z) = \hat{y}(1 - \hat{y})$</p>
                    <p><strong>Delta de salida:</strong> $\delta_0 = (y - \hat{y}) \cdot \sigma'(z_0)$</p>
                    <p><strong>Delta oculta (neurona j):</strong> $\delta_j = \delta_0 \cdot v_j \cdot h_j (1 - h_j)$ (donde $v_j$ es el peso entre la neurona oculta y la de salida)</p>
                    <p><strong>Actualización de pesos (Convención de la Guía):</strong> $w_{new} = w_{old} - \eta \cdot \delta \cdot x$ (signo negativo)</p>
                </div>
                <div class="p-4 bg-purple-50 dark:bg-purple-950 text-purple-800 dark:text-purple-200 rounded-2xl text-xs">
                    <strong>Nota de Signo:</strong> Algunas convenciones matemáticas usan $+ \eta \delta x$ porque definen el gradiente de forma negativa. La guía de esta materia define $\delta = (y-\hat{y})\sigma'(z)$ con signo positivo, y realiza el ajuste con signo menos ($-$), por lo que en el simulador se aplica la resta.
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('backprop.index') }}" class="px-4 py-2 bg-purple-600 text-white rounded-full text-xs font-semibold hover:bg-purple-700 transition-colors">
                        Practicar Backpropagation
                    </a>
                </div>
            </div>
        </section>

        <!-- 5. Red Hopfield -->
        <section id="section-hopfield" class="p-6 bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm scroll-mt-20">
            <h2 class="text-xl font-bold font-outfit text-gray-900 dark:text-white mb-4 border-b border-gray-100 dark:border-gray-700 pb-2 flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-purple-500"></span>
                5. Red Neuronal Hopfield
            </h2>
            <div class="space-y-4 text-sm text-gray-600 dark:text-gray-300">
                <p>
                    La red Hopfield es una red recurrente (con retroalimentación) que funciona como una **memoria asociativa**. Permite recuperar patrones completos a partir de versiones ruidosas o incompletas.
                </p>
                <p>
                    Usa codificación bipolar ($1$ y $-1$), donde los ceros lógicos de las entradas se traducen a $-1$.
                </p>
                <div class="p-4 bg-gray-50 dark:bg-gray-900 rounded-2xl space-y-2">
                    <p><strong>Cálculo de pesos (Hebb):</strong> $W = p^T \times p$ (vector columna por vector renglón)</p>
                    <p><strong>Eliminar auto-conexión:</strong> $w_{ii} = 0$ (forzar ceros en la diagonal principal)</p>
                    <p><strong>Actualización:</strong> $H = S \times W$</p>
                    <ul class="list-disc pl-6 space-y-1">
                        <li><strong>Síncrono:</strong> Todo el vector se actualiza simultáneamente $S_{new} = \text{sign}(S \cdot W)$.</li>
                        <li><strong>Asíncrono:</strong> Una neurona se actualiza cada vez: $s_i := \text{sign}(\sum_{j \ne i} w_{ij} s_j)$ y el nuevo valor se usa de inmediato para calcular las siguientes neuronas.</li>
                        <li>Si el valor neto es $0$, la neurona mantiene su estado anterior.</li>
                    </ul>
                    <p><strong>Energía de la Red:</strong> $E = -\frac{1}{2} \sum_{i \ne j} w_{ij} s_i s_j$ (la red evoluciona buscando minimizar esta energía hasta llegar a un estado estable).</p>
                </div>
                <div class="p-4 bg-emerald-50 dark:bg-emerald-950 text-emerald-800 dark:text-emerald-200 rounded-2xl text-xs font-semibold">
                    <strong>Capacidad de Almacenamiento:</strong> Alrededor de $0.15 \cdot N$ patrones estables. Si se satura la red, aparecen <strong>estados espurios</strong> (mínimos locales estables que no corresponden a ningún patrón entrenado).
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('hopfield.index') }}" class="px-4 py-2 bg-emerald-600 text-white rounded-full text-xs font-semibold hover:bg-emerald-700 transition-colors">
                        Practicar Red Hopfield
                    </a>
                </div>
            </div>
        </section>

        <!-- 6. Control & PID -->
        <section id="section-control" class="p-6 bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm scroll-mt-20">
            <h2 class="text-xl font-bold font-outfit text-gray-900 dark:text-white mb-4 border-b border-gray-100 dark:border-gray-700 pb-2 flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-purple-500"></span>
                6. Sistemas de Control y Controladores PID
            </h2>
            <div class="space-y-4 text-sm text-gray-600 dark:text-gray-300">
                <p>
                    <strong>Lazo Abierto:</strong> La acción de control no depende del estado actual de la salida del proceso. No tiene retroalimentación (feedback).
                </p>
                <p>
                    <strong>Lazo Cerrado:</strong> Mide continuamente la variable controlada mediante <strong>sensores</strong>, la compara con el <strong>setpoint</strong> y calcula el error para ajustar la salida a través de <strong>actuadores</strong>.
                </p>
                <p>
                    <strong>PLC:</strong> Un Controlador Lógico Programable es una computadora sólida industrial adaptada para controlar procesos y automatizaciones en condiciones extremas.
                </p>
                
                <h3 class="text-md font-bold font-outfit text-gray-800 dark:text-gray-200 mt-4 mb-2">Controladores PID</h3>
                <div class="space-y-3">
                    <p>
                        Un controlador **Proporcional, Integral y Derivativo** calcula la corrección total sumando tres términos:
                    </p>
                    <div class="p-4 bg-gray-50 dark:bg-gray-900 rounded-2xl">
                        <p class="font-semibold text-gray-800 dark:text-gray-200 text-xs">Fórmula General:</p>
                        <p class="text-sm mt-1 font-mono text-[var(--m3-primary)]">
                            $$u(t) = K_p \, e(t) + K_i \int e(t) \, dt + K_d \, \frac{de(t)}{dt}$$
                        </p>
                    </div>
                    <ul class="list-disc pl-6 space-y-2">
                        <li><strong>Acción Proporcional (P):</strong> Genera una respuesta lineal y directa al error actual. Si la constante es muy alta, el sistema responde rápido pero oscila. No elimina el error estacionario.</li>
                        <li><strong>Acción Integral (I):</strong> Acumula el error a lo largo del tiempo. Aumenta la velocidad de respuesta y **elimina por completo el error en estado estable (offset)**. Si es excesiva, puede desestabilizar el sistema.</li>
                        <li><strong>Acción Derivativa (D):</strong> Responde a la velocidad de cambio del error (su derivada). Aporta un efecto de anticipación o amortiguador, reduciendo las oscilaciones y estabilizando el control.</li>
                    </ul>
                </div>
            </div>
        </section>

    </div>
</x-app-layout>
