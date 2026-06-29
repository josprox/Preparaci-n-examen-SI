<?php

namespace App\Services;

class QuizService
{
    /**
     * Complete bank of questions.
     *
     * @var array<int, array{
     *     question: string,
     *     options: array<string>,
     *     correctAnswer: int,
     *     explanation: string,
     *     topic: string,
     *     difficulty: string,
     *     tags: array<string>
     * }>
     */
    protected array $questions = [
        [
            'question' => '¿Cuál de las siguientes es una característica esencial de los Sistemas Inteligentes?',
            'options' => [
                'La proactividad, reactividad, autonomía y comportamiento social',
                'El procesamiento secuencial de archivos en disco duro',
                'La dependencia constante de intervención humana para toda decisión',
                'Funcionar únicamente bajo control en lazo cerrado continuo'
            ],
            'correctAnswer' => 0,
            'explanation' => 'Los sistemas inteligentes se caracterizan por ser autónomos, reactivos (responden al entorno), proactivos (toman la iniciativa) y sociales (se comunican con otros agentes).',
            'topic' => 'Sistemas Inteligentes',
            'difficulty' => 'basic',
            'tags' => ['agentes', 'autonomía']
        ],
        [
            'question' => 'En el contexto de Sistemas Inteligentes, ¿qué se entiende por "proactividad"?',
            'options' => [
                'La capacidad de tomar la iniciativa para alcanzar objetivos predefinidos, adelantándose a los cambios',
                'Responder únicamente cuando ocurre un evento de error crítico',
                'Ejecutar instrucciones escritas por el usuario en tiempo real',
                'Actualizar los pesos sinápticos usando el algoritmo backpropagation'
            ],
            'correctAnswer' => 0,
            'explanation' => 'La proactividad es la capacidad de un agente inteligente para actuar de manera anticipada a fin de cumplir sus metas, en lugar de limitarse a reaccionar ante eventos externos.',
            'topic' => 'Sistemas Inteligentes',
            'difficulty' => 'medium',
            'tags' => ['comportamiento', 'agentes']
        ],
        [
            'question' => '¿Qué define a un Agente Inteligente Colaborativo?',
            'options' => [
                'Trabaja en conjunto con otros agentes compartiendo información para resolver un problema común',
                'Ejecuta acciones aisladas sin importar el estado de otros sistemas',
                'Es un PLC que se comunica únicamente mediante señales analógicas de lazo cerrado',
                'Es una red neuronal que no utiliza pesos en sus conexiones'
            ],
            'correctAnswer' => 0,
            'explanation' => 'Un agente colaborativo coopera con otros sistemas o agentes dentro de un entorno multiagente para lograr metas colectivas de manera eficiente.',
            'topic' => 'Sistemas Inteligentes',
            'difficulty' => 'basic',
            'tags' => ['agentes', 'cooperación']
        ],
        [
            'question' => '¿Qué es la "percepción" en un Sistema Inteligente?',
            'options' => [
                'El proceso de capturar y procesar información del entorno usando sensores',
                'La salida física que realiza un actuador en el mundo real',
                'El error cuadrático medio que calcula la neurona de salida',
                'La desconexión temporal de las auto-conexiones en una red Hopfield'
            ],
            'correctAnswer' => 0,
            'explanation' => 'La percepción es la fase en la que el agente recibe señales del entorno externo mediante sensores para construir una representación de su estado.',
            'topic' => 'Sistemas Inteligentes',
            'difficulty' => 'basic',
            'tags' => ['percepción', 'sensores']
        ],
        [
            'question' => '¿Qué es el "comportamiento racional" en Inteligencia Artificial?',
            'options' => [
                'Hacer lo correcto basándose en la información percibida para maximizar la probabilidad de éxito',
                'Imitar perfectamente la psicología y emociones del cerebro humano',
                'Resolver ecuaciones algebraicas en el menor tiempo posible',
                'Desactivar el sistema si la señal de error es diferente de cero'
            ],
            'correctAnswer' => 0,
            'explanation' => 'Un agente racional actúa de manera que logre el mejor resultado esperado, dada la evidencia disponible a través de sus percepciones y su conocimiento previo.',
            'topic' => 'Sistemas Inteligentes',
            'difficulty' => 'medium',
            'tags' => ['racionalidad', 'agentes']
        ],
        [
            'question' => '¿Qué es el "Embodiment" (Corporización) en Inteligencia Artificial?',
            'options' => [
                'La interacción del agente con el entorno físico real a través de un cuerpo físico, con sensores y actuadores',
                'La codificación de redes neuronales en lenguaje ensamblador',
                'Utilizar simuladores de software sin conexión física con el exterior',
                'La conversión de patrones bipolares a binarios en redes Hopfield'
            ],
            'correctAnswer' => 0,
            'explanation' => 'El embodiment se refiere a que un sistema inteligente está físicamente presente en el mundo real y experimenta el entorno directamente a través de su propio hardware.',
            'topic' => 'Sistemas Inteligentes',
            'difficulty' => 'advanced',
            'tags' => ['embodiment', 'robótica']
        ],
        [
            'question' => '¿Cuál es la diferencia principal entre los métodos simbólicos y los conexionistas en IA?',
            'options' => [
                'Los simbólicos usan lógica y reglas explícitas; los conexionistas emulan redes neuronales y aprenden de datos',
                'Los simbólicos son digitales y los conexionistas son analógicos',
                'Los simbólicos no tienen entradas y los conexionistas no tienen salidas',
                'Los simbólicos se usan para control industrial y los conexionistas para domótica'
            ],
            'correctAnswer' => 0,
            'explanation' => 'La IA simbólica (clásica) se basa en la manipulación de símbolos y reglas lógicas declaradas de forma explícita. La IA conexionista (redes neuronales) procesa información de forma paralela y distribuida a través de conexiones ponderadas.',
            'topic' => 'Sistemas Inteligentes',
            'difficulty' => 'medium',
            'tags' => ['teoría', 'conexionismo']
        ],
        [
            'question' => '¿Qué es la "explicabilidad" en los Sistemas Inteligentes?',
            'options' => [
                'La capacidad del sistema para justificar y hacer entendible el razonamiento detrás de sus decisiones',
                'La velocidad con la que el código PHP compila en NativePHP',
                'El manual escrito que describe el funcionamiento de los sensores',
                'La prueba matemática que demuestra que una red Hopfield es estable'
            ],
            'correctAnswer' => 0,
            'explanation' => 'La explicabilidad (XAI) busca que las decisiones de los modelos de inteligencia artificial sean comprensibles y transparentes para los humanos, mitigando el problema de la "caja negra".',
            'topic' => 'Sistemas Inteligentes',
            'difficulty' => 'medium',
            'tags' => ['explicabilidad', 'XAI']
        ],
        [
            'question' => '¿Qué diferencia a un sistema de control de lazo abierto de uno de lazo cerrado?',
            'options' => [
                'El de lazo cerrado utiliza retroalimentación (feedback) del sensor para ajustar la salida; el de lazo abierto no',
                'El de lazo abierto es analógico y el de lazo cerrado es puramente digital',
                'El de lazo abierto es más costoso y complejo de programar',
                'El de lazo cerrado no requiere fuente de alimentación eléctrica'
            ],
            'correctAnswer' => 0,
            'explanation' => 'Un sistema de lazo cerrado mide continuamente la salida real mediante sensores y la compara con la deseada (retroalimentación) para reducir el error. En lazo abierto, la acción de control no depende de la salida.',
            'topic' => 'Sistemas de Control',
            'difficulty' => 'basic',
            'tags' => ['lazo cerrado', 'control']
        ],
        [
            'question' => '¿Cuál es la función de un Actuador en un sistema de control?',
            'options' => [
                'Modificar el estado del entorno físico ejecutando una acción ordenada por el controlador',
                'Medir una variable física del entorno y convertirla en señal eléctrica',
                'Almacenar el historial de pesos de la red en la base de datos',
                'Calcular el gradiente descendente en el algoritmo Backpropagation'
            ],
            'correctAnswer' => 0,
            'explanation' => 'El actuador es el elemento final de control que recibe la señal del controlador (como encender un motor o abrir una válvula) y actúa físicamente sobre el proceso.',
            'topic' => 'Sistemas de Control',
            'difficulty' => 'basic',
            'tags' => ['actuadores', 'control']
        ],
        [
            'question' => '¿Qué significan las siglas PLC en el ámbito industrial?',
            'options' => [
                'Controlador Lógico Programable (Programmable Logic Controller)',
                'Conexión de Lazo Proporcional (Proportional Loop Connection)',
                'Cálculo de Pérdida por Derivada (Partial Loss Calculator)',
                'Circuito de Aprendizaje de Perceptrón (Perceptron Learning Circuit)'
            ],
            'correctAnswer' => 0,
            'explanation' => 'Un PLC es una computadora industrial sólida y programable diseñada para controlar procesos de manufactura, maquinaria y líneas de producción en entornos hostiles.',
            'topic' => 'Sistemas de Control',
            'difficulty' => 'basic',
            'tags' => ['PLC', 'automatización']
        ],
        [
            'question' => '¿Cómo funciona un controlador On-Off (Todo o Nada)?',
            'options' => [
                'Activa o desactiva la salida completamente basándose en si la variable está arriba o abajo del setpoint',
                'Calcula una salida proporcional al error de forma continua e incremental',
                'Integra el error en el tiempo para eliminar el offset permanente',
                'Utiliza redes neuronales artificiales para predecir el comportamiento del sistema'
            ],
            'correctAnswer' => 0,
            'explanation' => 'El control On-Off tiene solo dos estados de salida (100% encendido o 0% apagado). Es el tipo de control más simple y oscila constantemente alrededor de la consigna (ej. termostato doméstico).',
            'topic' => 'Sistemas de Control',
            'difficulty' => 'medium',
            'tags' => ['controladores', 'on-off']
        ],
        [
            'question' => '¿Qué función cumple la acción Proporcional (P) en un controlador PID?',
            'options' => [
                'Genera una acción correctiva proporcional al error actual en el sistema',
                'Corrige el error sumando las variaciones ocurridas en el pasado',
                'Predice el comportamiento futuro del error basándose en su velocidad de cambio',
                'Estabiliza la red neuronal eliminando las auto-conexiones de pesos'
            ],
            'correctAnswer' => 0,
            'explanation' => 'La acción proporcional responde al error instantáneo. A mayor error, mayor será la salida correctiva del controlador (Salida = Kp * error).',
            'topic' => 'Sistemas de Control',
            'difficulty' => 'medium',
            'tags' => ['controladores', 'PID']
        ],
        [
            'question' => '¿Cuál es el beneficio de la acción Integral (I) en un controlador PID?',
            'options' => [
                'Elimina el error en estado estacionario (offset) acumulando el error a lo largo del tiempo',
                'Reduce la velocidad de respuesta inicial del actuador para evitar desgastes',
                'Multiplica la derivada de la sigmoide para acelerar la convergencia',
                'Convierte los valores de entrada binarios a bipolares automáticamente'
            ],
            'correctAnswer' => 0,
            'explanation' => 'La acción integral suma los errores pasados a lo largo del tiempo. Sigue actuando mientras exista el más mínimo error, eliminando por completo la desviación permanente (offset) en estado estable.',
            'topic' => 'Sistemas de Control',
            'difficulty' => 'advanced',
            'tags' => ['controladores', 'PID']
        ],
        [
            'question' => '¿Qué función tiene la acción Derivativa (D) en un controlador PID?',
            'options' => [
                'Anticipa el comportamiento del error basándose en su tasa de cambio, ayudando a frenar oscilaciones',
                'Elimina los residuos acumulados por la acción proporcional',
                'Calcula la salida de forma binaria aplicando una función escalón',
                'Ajusta la tasa de aprendizaje del sistema inteligente de forma aleatoria'
            ],
            'correctAnswer' => 0,
            'explanation' => 'La acción derivativa mide la velocidad con la que cambia el error en el tiempo y reacciona a su tendencia. Aporta un efecto amortiguador que reduce las sobreoscilaciones.',
            'topic' => 'Sistemas de Control',
            'difficulty' => 'advanced',
            'tags' => ['controladores', 'PID']
        ],
        [
            'question' => '¿Cómo se relacionan Inteligencia Artificial, Machine Learning y Deep Learning?',
            'options' => [
                'IA es el campo general, Machine Learning es una rama de la IA, y Deep Learning es una subrama de ML basada en redes profundas',
                'Son tres términos idénticos que describen el mismo tipo de algoritmo algebraico',
                'Machine Learning y Deep Learning son métodos de control físico y la IA es el software',
                'Deep Learning es el campo de control lineal y IA es la base de control no lineal'
            ],
            'correctAnswer' => 0,
            'explanation' => 'La Inteligencia Artificial es el concepto más amplio de emular capacidades humanas. Machine Learning es la disciplina que permite a los sistemas aprender a partir de datos. Deep Learning utiliza redes neuronales artificiales profundas de múltiples capas ocultas.',
            'topic' => 'Introducción a la IA',
            'difficulty' => 'basic',
            'tags' => ['conceptos', 'ML']
        ],
        [
            'question' => '¿Cuáles son las partes fundamentales de una Neurona Artificial?',
            'options' => [
                'Conjunto de entradas, pesos sinápticos, suma ponderada, función de activación y sesgo (bias)',
                'Soma, dendritas, axón, botones sinápticos y neurotransmisores',
                'Lazo abierto, actuadores, PLC, controlador proporcional e integrador',
                'Patrones, vector fila, matriz diagonal, iteraciones y coeficiente de estabilidad'
            ],
            'correctAnswer' => 0,
            'explanation' => 'La neurona artificial consta de entradas ($x_i$), pesos ($w_i$), sesgo ($b$), una función de transferencia o suma ponderada ($z$) y una función de activación ($f$) que produce la salida.',
            'topic' => 'Redes Neuronales',
            'difficulty' => 'basic',
            'tags' => ['neurona', 'partes']
        ],
        [
            'question' => '¿Qué es la "bomba de sodio-potasio" en la neurona biológica?',
            'options' => [
                'Un mecanismo activo de transporte iónico que mantiene el potencial de reposo en la membrana celular',
                'La sección del axón encargada de liberar los neurotransmisores',
                'La analogía biológica de la actualización de pesos en backpropagation',
                'El umbral de disparo que define el comportamiento del todo o nada'
            ],
            'correctAnswer' => 0,
            'explanation' => 'La bomba de sodio-potasio es una proteína de membrana que bombea sodio hacia el exterior y potasio hacia el interior celular, manteniendo la diferencia de potencial eléctrico necesaria para transmitir el impulso nervioso.',
            'topic' => 'Redes Neuronales',
            'difficulty' => 'medium',
            'tags' => ['biología', 'neurona']
        ],
        [
            'question' => '¿Qué establece la "Ley del todo o nada" en los impulsos nerviosos?',
            'options' => [
                'Si el estímulo no supera el potencial umbral, no hay descarga; si lo supera, se transmite un impulso de intensidad constante',
                'Una red neuronal aprende todo en la primera época o no aprende nada',
                'Los pesos de las conexiones deben ser todos mayores a cero o todos menores a cero',
                'En redes Hopfield, todas las neuronas deben actualizarse sincrónicamente o no se actualiza ninguna'
            ],
            'correctAnswer' => 0,
            'explanation' => 'La transmisión del impulso nervioso sigue la ley del todo o nada: la membrana requiere un estímulo mínimo (potencial umbral) para generar el potencial de acción. Si se rebasa, el impulso viaja siempre con la misma amplitud.',
            'topic' => 'Redes Neuronales',
            'difficulty' => 'medium',
            'tags' => ['biología', 'potencial de acción']
        ],
        [
            'question' => '¿Qué es una función de activación en una neurona artificial?',
            'options' => [
                'Una función no lineal matemática que decide si la neurona se activa y define su salida en función del valor neto z',
                'El código PHP que arranca el bucle de entrenamiento',
                'El sensor que mide el comportamiento del actuador físico',
                'El producto externo utilizado en la regla de Hebb de Hopfield'
            ],
            'correctAnswer' => 0,
            'explanation' => 'La función de activación introduce no linealidad en la red neuronal, permitiéndole modelar relaciones complejas. De lo contrario, cualquier red multicapa equivaldría a una sola combinación lineal.',
            'topic' => 'Redes Neuronales',
            'difficulty' => 'basic',
            'tags' => ['activación', 'funciones']
        ],
        [
            'question' => '¿Cuál es la fórmula y el rango de la función de activación Sigmoide?',
            'options' => [
                'y = 1 / (1 + e^-z), acotada en el rango (0, 1)',
                'y = max(0, z), acotada en el rango [0, +inf)',
                'y = tanh(z), acotada en el rango (-1, 1)',
                'y = sign(z), acotada en el rango {-1, 1}'
            ],
            'correctAnswer' => 0,
            'explanation' => 'La función sigmoide comprime cualquier número real al intervalo abierto (0, 1), lo que la hace ideal para modelar probabilidades en clasificación binaria.',
            'topic' => 'Redes Neuronales',
            'difficulty' => 'medium',
            'tags' => ['activación', 'sigmoide']
        ],
        [
            'question' => '¿Qué rango tiene la función Tangente Hiperbólica (Tanh)?',
            'options' => [
                '(-1, 1)',
                '(0, 1)',
                '[0, +inf)',
                '{-1, 0, 1}'
            ],
            'correctAnswer' => 0,
            'explanation' => 'A diferencia de la sigmoide, la función Tanh está centrada en cero y devuelve valores en el rango (-1, 1), lo que suele acelerar la convergencia del entrenamiento.',
            'topic' => 'Redes Neuronales',
            'difficulty' => 'medium',
            'tags' => ['activación', 'tanh']
        ],
        [
            'question' => '¿Cómo se entrena un Perceptrón Simple?',
            'options' => [
                'Evaluando muestras paso a paso y sumando (o restando) un ajuste a los pesos si hay error en la predicción',
                'Multiplicando la matriz de pesos por la transpuesta del patrón y borrando la diagonal principal',
                'Derivando la salida de la función sigmoide y propagándola hacia atrás usando la regla de la cadena',
                'Modificando los coeficientes del PID (Kp, Ki, Kd) sincrónicamente'
            ],
            'correctAnswer' => 0,
            'explanation' => 'El perceptrón simple se entrena mediante aprendizaje supervisado. Ajusta sus pesos utilizando la regla $w_i = w_i + \eta \cdot e \cdot x_i$ únicamente cuando la predicción obtenida difiere de la deseada ($e \neq 0$).',
            'topic' => 'Perceptrón',
            'difficulty' => 'medium',
            'tags' => ['entrenamiento', 'perceptrón']
        ],
        [
            'question' => '¿Qué limitación teórica clave tiene el Perceptrón Simple?',
            'options' => [
                'Solo puede resolver problemas que sean linealmente separables (ej. no resuelve XOR)',
                'No puede utilizar la función de activación escalón unitario',
                'Requiere al menos 3 capas ocultas para poder calcular una suma ponderada',
                'Su tasa de aprendizaje η debe ser mayor a 1.0 para converger'
            ],
            'correctAnswer' => 0,
            'explanation' => 'Como demostraron Minsky y Papert, un perceptrón simple solo puede clasificar datos que se puedan dividir mediante una recta o hiperplano (linealmente separables). Problemas lógicos como la compuerta XOR no son linealmente separables.',
            'topic' => 'Perceptrón',
            'difficulty' => 'medium',
            'tags' => ['limitaciones', 'separabilidad']
        ],
        [
            'question' => '¿Qué realiza la propagación hacia adelante (Forward propagation)?',
            'options' => [
                'Transmite las entradas de capa en capa hacia el final de la red para generar una predicción',
                'Propaga el gradiente del error desde la salida de la red hacia los pesos de entrada',
                'Elimina las auto-conexiones de las neuronas en una red recurrente',
                'Calcula el nivel mínimo de energía usando la función de Hebb'
            ],
            'correctAnswer' => 0,
            'explanation' => 'La propagación hacia adelante calcula las combinaciones lineales y las activaciones de cada capa, fluyendo la información desde la entrada hasta la capa de salida de la red.',
            'topic' => 'Forward propagation',
            'difficulty' => 'basic',
            'tags' => ['redes', 'forward']
        ],
        [
            'question' => '¿En qué se basa el algoritmo Backpropagation para calcular los gradientes de los pesos ocultos?',
            'options' => [
                'En la regla de la cadena del cálculo diferencial',
                'En la regla de Hebb de Hopfield',
                'En la ley del todo o nada de los potenciales de acción',
                'En los coeficientes proporcional, integral y derivativo'
            ],
            'correctAnswer' => 0,
            'explanation' => 'Backpropagation propaga el error de salida hacia las capas anteriores calculando las derivadas parciales del error respecto a cada peso mediante la regla de la cadena.',
            'topic' => 'Backpropagation',
            'difficulty' => 'medium',
            'tags' => ['derivación', 'regla de la cadena']
        ],
        [
            'question' => '¿Cuál es la derivada de la función de activación Sigmoide ŷ = σ(z)?',
            'options' => [
                "σ'(z) = ŷ (1 - ŷ)",
                "σ'(z) = ŷ (ŷ - 1)",
                "σ'(z) = 1 / (1 + e^-z)",
                "σ'(z) = 1 - ŷ^2"
            ],
            'correctAnswer' => 0,
            'explanation' => 'La derivada de la sigmoide tiene una propiedad matemática muy conveniente: se puede expresar en términos de su propia salida: $f\'(z) = f(z)(1 - f(z))$.',
            'topic' => 'Backpropagation',
            'difficulty' => 'medium',
            'tags' => ['matemáticas', 'sigmoide']
        ],
        [
            'question' => '¿A qué grupo especial de redes pertenece la Red Neuronal Hopfield?',
            'options' => [
                'Redes recursivas o recurrentes (con conexiones hacia atrás)',
                'Redes monocapa puramente feedforward',
                'Redes de base radial con una sola capa oculta lineal',
                'Redes antagónicas generativas (GANs)'
            ],
            'correctAnswer' => 0,
            'explanation' => 'Las redes Hopfield son redes recurrentes auto-asociativas donde la información fluye en ambos sentidos (dinámica bidireccional), lo que les permite comportarse como memorias asociativas.',
            'topic' => 'Red Hopfield',
            'difficulty' => 'basic',
            'tags' => ['recurrencia', 'arquitectura']
        ],
        [
            'question' => '¿Qué regla matemática se utiliza para calcular los pesos de una Red Hopfield (entrenamiento)?',
            'options' => [
                'La regla de Hebb (producto externo de los vectores del patrón)',
                'El descenso del gradiente stocástico (SGD)',
                'La ecuación de diferencias discretas de un PID',
                'La derivada parcial de la sigmoide multiplicada por η'
            ],
            'correctAnswer' => 0,
            'explanation' => 'El entrenamiento en redes Hopfield utiliza la regla de Hebb. La matriz de pesos se construye calculando el producto externo del patrón consigo mismo: $W = p^T \times p$.',
            'topic' => 'Red Hopfield',
            'difficulty' => 'medium',
            'tags' => ['Hebb', 'entrenamiento']
        ],
        [
            'question' => '¿Qué ocurre con la diagonal de la matriz de pesos W de una Red Hopfield?',
            'options' => [
                'Se debe establecer a cero para eliminar las auto-conexiones de las neuronas',
                'Se debe rellenar con valores 1 para mantener la identidad del patrón',
                'Se multiplica por la tasa de aprendizaje η en cada iteración',
                'Se calcula utilizando el error cuadrático medio de la red'
            ],
            'correctAnswer' => 0,
            'explanation' => 'Una neurona en la red Hopfield no se conecta consigo misma. Por lo tanto, los pesos $w_{ii}$ (diagonal principal) se fuerzan a cero.',
            'topic' => 'Red Hopfield',
            'difficulty' => 'medium',
            'tags' => ['diagonal', 'pesos']
        ],
        [
            'question' => '¿Qué diferencia hay entre la actualización síncrona y asíncrona en Hopfield?',
            'options' => [
                'La síncrona actualiza todas las neuronas a la vez; la asíncrona actualiza una neurona por paso en orden secuencial',
                'La síncrona utiliza valores binarios y la asíncrona valores bipolares',
                'La síncrona calcula la energía y la asíncrona no utiliza energía',
                'La síncrona requiere una tasa de aprendizaje η mayor a cero'
            ],
            'correctAnswer' => 0,
            'explanation' => 'En la actualización síncrona, calculamos $S_{new} = \text{sign}(S \cdot W)$ actualizando todo el vector al mismo tiempo. En la asíncrona, cada neurona se actualiza secuencialmente y su nuevo estado se usa de inmediato para el cálculo de la siguiente neurona.',
            'topic' => 'Red Hopfield',
            'difficulty' => 'medium',
            'tags' => ['actualización', 'dinámica']
        ],
        [
            'question' => '¿Qué es un "estado espurio" en una Red de Hopfield?',
            'options' => [
                'Un estado estable (mínimo de energía) en el que converge la red, pero que no corresponde a ningún patrón entrenado',
                'Un estado transitorio donde la energía del sistema oscila infinitamente',
                'Un valor de peso sináptico que se convierte en cero tras eliminar la diagonal',
                'El estado inicial ruidoso antes de aplicar el algoritmo'
            ],
            'correctAnswer' => 0,
            'explanation' => 'Los estados espurios son mínimos locales de energía "fantasma" que aparecen de forma no deseada en el paisaje de energía de la red, normalmente causados por sobrecargar la capacidad de almacenamiento de la red.',
            'topic' => 'Red Hopfield',
            'difficulty' => 'advanced',
            'tags' => ['convergencia', 'energía']
        ],
        [
            'question' => '¿Cuál es la capacidad máxima aproximada de almacenamiento estable de una Red Hopfield de N neuronas?',
            'options' => [
                'Aproximadamente 0.15 * N patrones',
                'Exactamente 2^N patrones independientes',
                'N / 2 patrones si se usa codificación binaria',
                'Cualquier número ilimitado de patrones'
            ],
            'correctAnswer' => 0,
            'explanation' => 'La capacidad teórica límite de almacenamiento asociativo sin que los patrones se interfieran destructivamente (creando estados espurios) es de aproximadamente $0.15 \times N$ patrones.',
            'topic' => 'Red Hopfield',
            'difficulty' => 'advanced',
            'tags' => ['capacidad', 'teoría']
        ],
        [
            'question' => 'Dada la red Hopfield con matriz W entrenada y un estado S. ¿Qué indica si S es un estado estable?',
            'options' => [
                'Que al aplicar la actualización de la red, el estado no sufre ningún cambio (S_nuevo = S)',
                'Que el valor de la energía es exactamente cero',
                'Que el error absoluto calculado es menor a la tasa de aprendizaje η',
                'Que coincide con el patrón XOR del perceptrón simple'
            ],
            'correctAnswer' => 0,
            'explanation' => 'Un estado es estable (o punto fijo) si el sistema ha alcanzado un mínimo local de energía, por lo que aplicar las reglas de actualización no produce modificaciones en los valores de sus neuronas.',
            'topic' => 'Red Hopfield',
            'difficulty' => 'medium',
            'tags' => ['estabilidad', 'punto fijo']
        ]
    ];

    /**
     * Get all questions.
     *
     * @return array<int, array<string, mixed>>
     */
    public function getAllQuestions(): array
    {
        return $this->questions;
    }

    /**
     * Get randomized questions.
     *
     * @param int $count
     * @param string|null $topic
     * @return array<int, array{
     *     question: string,
     *     options: array<string>,
     *     correctAnswer: int,
     *     explanation: string,
     *     topic: string,
     *     difficulty: string,
     *     tags: array<string>
     * }>
     */
    public function getRandomQuestions(int $count = 10, ?string $topic = null): array
    {
        $filtered = $this->questions;

        if ($topic) {
            $filtered = array_values(array_filter($filtered, fn($q) => strcasecmp($q['topic'], $topic) === 0));
        }

        // If not enough questions, use what we have
        $count = min($count, count($filtered));
        if ($count === 0) {
            return [];
        }

        // Select random indices
        $keys = array_rand($filtered, $count);
        $keys = is_array($keys) ? $keys : [$keys];

        $selected = [];
        foreach ($keys as $key) {
            $q = $filtered[$key];
            
            // Shuffle the options while keeping track of correct answer
            $options = $q['options'];
            $correctText = $options[$q['correctAnswer']];
            shuffle($options);
            $newCorrectIndex = array_search($correctText, $options);
            
            $q['options'] = $options;
            $q['correctAnswer'] = $newCorrectIndex;
            
            $selected[] = $q;
        }

        shuffle($selected);
        return $selected;
    }

    /**
     * Get available topics.
     *
     * @return array<string>
     */
    public function getTopics(): array
    {
        return array_values(array_unique(array_column($this->questions, 'topic')));
    }
}
