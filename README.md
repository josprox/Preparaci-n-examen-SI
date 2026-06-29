# NeuroSmart Trainer 🧠🎓

NeuroSmart Trainer es una aplicación educativa interactiva diseñada en **PHP con Laravel 12 y NativePHP Mobile**, con estilos visuales inspirados en **Material 3 Expressive**. Su objetivo principal es servir como tutor interactivo para que los estudiantes de Sistemas Inteligentes y Redes Neuronales repasen conceptos teóricos y practiquen la resolución de ejercicios matemáticos paso a paso de cara a su **Examen Espejo**.

---

## 🚀 Características Principales

1. **Perceptrón Simple:** Entrenamiento dinámico monocapa. Muestra la suma ponderada, función escalón/signo/sigmoide, error, actualización de pesos Hebbiana y tabla de evolución de pesos época por época.
2. **Forward Propagation:** Permite configurar arquitecturas de redes neuronales multicapa (MLP), ingresando pesos y sesgos personalizados y visualizando el flujo a través de un **diagrama de red interactivo en SVG**.
3. **Backpropagation:** Resuelve el algoritmo de retropropagación del error paso a paso. Incluye una versión simple (1 neurona, 2 entradas) que sigue los números de las diapositivas de clase, y una versión multicapa (2 entradas, 2 neuronas ocultas, 1 de salida) con diagramas animados de propagación.
4. **Red Neuronal Hopfield (Modo Estándar y Modo Matlab):** Modela memorias asociativas recurrentes bipolares (1 y -1). Incluye un **Modo Matlab** personalizable para ingresar vectores fila $p$ y columna $Pt$ de forma independiente (respetando la sintaxis de comas y punto y coma `;`), con previsualización matemática en vivo (KaTeX) y cálculo de estabilidad bajo el concepto matemático de punto fijo. Anula la diagonal principal ($w_{ii}=0$), calcula la energía y dibuja el **grafo circular de la red** en SVG.
5. **Quiz tipo Kahoot:** Cuestionario de opción múltiple con barra de progreso, temporizador (Modo Examen), drawer de retroalimentación inmediata con explicaciones y sugerencias de estudio inteligentes basadas en los errores cometidos.
6. **Guía de Estudio Rápida:** Una chuleta teórica digital interactiva sobre IA, control de lazo abierto/cerrado, actuadores, sensores, PLCs y controladores PID.
7. **Historial Local:** Mantiene un registro de las simulaciones realizadas en una base de datos local SQLite, con capacidad para borrar, vaciar o **recargar parámetros** para repetir cualquier ejercicio al instante.
8. **Modo Examen Escrito / Exportación PDF:** Un botón permite convertir el procedimiento interactivo en un texto plano limpio formateado para copiar en hojas de examen, imprimiéndose perfectamente como PDF con estilos adaptados.

---

## 🎨 Sistema de Colores Pedagógicos

El simulador utiliza colores consistentes para asociar variables:
* **Entradas (x):** Azul.
* **Pesos (w):** Morado.
* **Sesgo (b / w0):** Naranja.
* **Salida Esperada (y):** Verde.
* **Salida Calculada (ŷ):** Cian.
* **Error (e):** Rojo.
* **Delta (δ):** Rosa.
* **Actualización:** Amarillo.

---

## 🛠️ Requisitos Técnicos

* **PHP:** v8.2 o superior.
* **Laravel Framework:** v12.
* **Tailwind CSS:** v4 (configuración CSS-first).
* **NativePHP Mobile:** v3.
* **Motor de Base de Datos:** SQLite (para almacenamiento local del historial).

---

## 🏃 Cómo Correr el Proyecto Localmente

1. **Instalar dependencias de PHP y Node:**
   ```bash
   composer install
   npm install
   ```

## 🏃 Cómo Probar y Correr el Proyecto

Puedes probar y depurar la aplicación de tres maneras diferentes dependiendo de tu entorno:

### Opción A: En el Navegador Web (Recomendado para desarrollo rápido)
Al ser una aplicación web Laravel, puedes probar toda la funcionalidad, lógica matemática e interfaz de usuario directamente desde tu navegador sin instalar emuladores ni compilar nada:

1. Inicia Vite (compilador de CSS/JS) y el servidor de desarrollo en terminales separadas (o usando Herd/Valet):
   ```bash
   # Terminal 1: Inicia Vite
   npm run dev
   ```
   ```bash
   # Terminal 2: Inicia el servidor de Laravel
   php artisan serve
   ```
2. Abre tu navegador e ingresa a `http://127.0.0.1:8000`.

---

### Opción B: Ejecutar en un Emulador de Android o Teléfono Físico (Sin construir APK de producción)
Si quieres probar cómo se ve y comporta la app dentro de un celular sin generar el paquete de distribución final (`APK`), puedes usar el modo de desarrollo de NativePHP Mobile:

1. Asegúrate de tener un emulador de Android abierto (puedes listar y abrir uno con `php artisan native:emulator`) o un teléfono físico conectado por USB con depuración activada.
2. Ejecuta el comando de ejecución en modo depuración con soporte para cambios en vivo (live-reload):
   ```bash
   php artisan native:run android --watch
   ```
   *Nota: En Windows, correr `native:run` o `native:build` sin especificar plataforma intentará compilar para iOS por defecto, lo cual fallará debido a la falta de Xcode.*

---

## 🧪 Pruebas Unitarias

El proyecto incluye 10 pruebas automatizadas (46 aserciones) escritas en **Pest** que verifican la precisión matemática de los algoritmos y los ejemplos de los PDFs:

* **Perceptrón:** Pruebas de convergencia en AND, OR y el ejercicio de la guía con pesos y tasa específicos.
* **Backpropagation:** Prueba de variables intermedias ($z$, $\hat{y}$, error, delta, pesos actualizados) del ejemplo numérico del curso.
* **Red Hopfield:** Prueba de entrenamiento de 3 neuronas, anulación de la diagonal, signo y estabilidad del ejercicio 38.
* **Quiz:** Carga de preguntas y aleatorización.

Para ejecutar los tests:
```bash
php artisan test
```

---

## 📦 Compilación para Producción (Construcción Final)

Cuando la aplicación esté lista para distribuirse de forma nativa:

### Compilar APK para Android
Asegúrate de tener configurado tu Android SDK, JDK y Gradle (ej. configurados en tu archivo `.env` o en `config/nativephp.php`), y corre:
```bash
php artisan native:build --target=android
```
Esto generará el paquete final de instalación en `storage/nativephp/builds/android/` listo para tu celular.

### Firmar la App con tu Certificado Keystore

Para empaquetar y firmar tu aplicación para distribución (Play Store o instalación oficial), debes usar el comando `native:package`. Tienes dos formas de pasar tus credenciales de firma:

#### Opción A: A través de Variables de Entorno (Recomendado)
Agrega las siguientes variables a tu archivo `.env`:
```env
ANDROID_KEYSTORE_FILE="C:\Ruta\A\TuCertificado.jks"
ANDROID_KEYSTORE_PASSWORD="TuPasswordDeKeystore"
ANDROID_KEY_ALIAS="TuAlias"
ANDROID_KEY_PASSWORD="TuPasswordDeAlias"
```
Y luego ejecuta:
```bash
php artisan native:package android
```

#### Opción B: Directamente en la consola
Pasa los parámetros como opciones al comando:
```bash
php artisan native:package android --keystore="C:\Ruta\A\TuCertificado.jks" --keystore-password="TuPasswordDeKeystore" --key-alias="TuAlias" --key-password="TuPasswordDeAlias"
```

El archivo APK firmado resultante se ubicará en la carpeta `/storage/nativephp/builds/android/`.

---

## 📤 Cómo Subir el Proyecto a GitHub

Sigue estos pasos en tu terminal para inicializar el repositorio local y subirlo a tu cuenta de GitHub por primera vez:

1. **Inicializar el repositorio Git local:**
   ```bash
   git init
   ```

2. **Agregar todos los archivos al área de preparación:**
   ```bash
   git add .
   ```

3. **Realizar el commit inicial:**
   ```bash
   git commit -m "First commit: NeuroSmart Trainer con simuladores de IA, modo Matlab y explicaciones pedagógicas"
   ```

4. **Crear o renombrar la rama principal a `main`:**
   ```bash
   git branch -M main
   ```

5. **Vincular el repositorio remoto de GitHub (reemplaza con tu URL de GitHub):**
   ```bash
   git remote add origin https://github.com/TU_USUARIO/TU_REPOSITORIO.git
   ```

6. **Subir los cambios a tu rama remota:**
   ```bash
   git push -u origin main
   ```


