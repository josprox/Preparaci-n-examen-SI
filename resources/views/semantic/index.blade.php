<x-app-layout>
    <x-slot name="title">Redes Semánticas y Marcos - NeuroSmart Trainer</x-slot>

    <!-- Header Section -->
    <div class="mb-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-bold bg-teal-100 text-teal-800 dark:bg-teal-950 dark:text-teal-300 mb-2">
                <span>SEGUNDO PARCIAL</span> &bull; <span>MÓDULO 6</span>
            </div>
            <h1 class="text-3xl font-extrabold font-outfit text-gray-900 dark:text-white">
                Redes Semánticas & Marcos Conectados (Visual Mermaid)
            </h1>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                Representación visual interactiva del Sistema Escuela (Pizarrón) con conexiones de herencia, ranuras y diagramas Mermaid.
            </p>
        </div>
        <a href="{{ route('guide.index') }}#section-frames" class="px-4 py-2 bg-teal-600 hover:bg-teal-700 text-white rounded-full text-xs font-bold font-outfit shadow-sm transition-all self-start md:self-auto">
            Ver Apuntes de Marcos
        </a>
    </div>

    <!-- Interactive Tabs Header -->
    <div class="flex flex-wrap gap-2 mb-6 border-b border-gray-200 dark:border-gray-700">
        <button id="tab-pizarrón-btn" class="px-5 py-2.5 font-bold font-outfit text-xs rounded-t-2xl border-b-2 border-teal-600 text-teal-600 dark:text-teal-400 bg-white dark:bg-gray-800 shadow-sm transition-all flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            1. Diagrama de Marcos Conectado (Escuela - Pizarrón)
        </button>
        <button id="tab-semantic-btn" class="px-5 py-2.5 font-bold font-outfit text-xs text-gray-500 hover:text-gray-800 dark:hover:text-gray-200 rounded-t-2xl border-b-2 border-transparent transition-all flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/></svg>
            2. Red Semántica (Grafos Dirigidos)
        </button>
        <button id="tab-frame-btn" class="px-5 py-2.5 font-bold font-outfit text-xs text-gray-500 hover:text-gray-800 dark:hover:text-gray-200 rounded-t-2xl border-b-2 border-transparent transition-all flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/></svg>
            3. Inspector & Generador de Marcos
        </button>
    </div>

    <!-- TAB 1: Whiteboard Connected Diagram (Sistema Escuela) -->
    <div id="tab-pizarrón" class="space-y-6">
        <div class="p-6 bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm">
            <div class="flex items-center justify-between mb-4 border-b border-gray-100 dark:border-gray-700 pb-3">
                <div>
                    <h3 class="text-lg font-bold font-outfit text-gray-900 dark:text-white flex items-center gap-2">
                        <span>Diagrama de Marcos Conectados: Sistema Escuela</span>
                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-purple-100 text-purple-700 dark:bg-purple-950 dark:text-purple-300">EJERCICIO DE CLASE</span>
                    </h3>
                    <p class="text-xs text-gray-500 mt-1">
                        Representación gráfica orientada con arcos de conexión (<code>contiene</code>, <code>registra</code>, <code>gestiona</code>, <code>procesa</code>, <code>requiere</code>).
                    </p>
                </div>
            </div>

            <!-- Visual Connected Vector Graph Canvas for Escuela System -->
            <div class="w-full bg-slate-950 rounded-3xl p-6 border border-slate-800 overflow-x-auto flex justify-center my-4">
                <svg width="980" height="460" viewBox="0 0 980 460" class="w-full max-w-full">
                    <defs>
                        <marker id="arrow-red" viewBox="0 0 10 10" refX="8" refY="5" markerWidth="6" markerHeight="6" orient="auto-start-reverse">
                            <path d="M 0 0 L 10 5 L 0 10 z" fill="#ef4444" />
                        </marker>
                        <marker id="arrow-blue" viewBox="0 0 10 10" refX="8" refY="5" markerWidth="6" markerHeight="6" orient="auto-start-reverse">
                            <path d="M 0 0 L 10 5 L 0 10 z" fill="#38bdf8" />
                        </marker>
                        <marker id="arrow-amber" viewBox="0 0 10 10" refX="8" refY="5" markerWidth="6" markerHeight="6" orient="auto-start-reverse">
                            <path d="M 0 0 L 10 5 L 0 10 z" fill="#f59e0b" />
                        </marker>
                        <marker id="arrow-emerald" viewBox="0 0 10 10" refX="8" refY="5" markerWidth="6" markerHeight="6" orient="auto-start-reverse">
                            <path d="M 0 0 L 10 5 L 0 10 z" fill="#10b981" />
                        </marker>
                    </defs>

                    <!-- CONNECTING ARROWS -->
                    <!-- Escuela -> Facultades (contiene) -->
                    <path d="M 270 90 L 410 90" stroke="#ef4444" stroke-width="3" marker-end="url(#arrow-red)" />
                    <rect x="305" y="76" width="66" height="24" rx="6" fill="#0f172a" stroke="#ef4444" stroke-width="1.5" />
                    <text x="338" y="92" text-anchor="middle" fill="#f87171" font-size="11" font-weight="bold">contiene</text>

                    <!-- Escuela -> Alumnos (registra) -->
                    <path d="M 270 200 L 410 200" stroke="#38bdf8" stroke-width="3" marker-end="url(#arrow-blue)" />
                    <rect x="305" y="186" width="66" height="24" rx="6" fill="#0f172a" stroke="#38bdf8" stroke-width="1.5" />
                    <text x="338" y="202" text-anchor="middle" fill="#38bdf8" font-size="11" font-weight="bold">registra</text>

                    <!-- Escuela -> Colegiaturas (gestiona) -->
                    <path d="M 270 330 L 410 330" stroke="#f59e0b" stroke-width="3" marker-end="url(#arrow-amber)" />
                    <rect x="305" y="316" width="66" height="24" rx="6" fill="#0f172a" stroke="#f59e0b" stroke-width="1.5" />
                    <text x="338" y="332" text-anchor="middle" fill="#fbbf24" font-size="11" font-weight="bold">gestiona</text>

                    <!-- Escuela -> Inscribir (procesa) -->
                    <path d="M 270 380 Q 480 430 675 330" fill="none" stroke="#10b981" stroke-width="3" marker-end="url(#arrow-emerald)" />
                    <rect x="440" y="405" width="66" height="24" rx="6" fill="#0f172a" stroke="#10b981" stroke-width="1.5" />
                    <text x="473" y="421" text-anchor="middle" fill="#34d399" font-size="11" font-weight="bold">procesa</text>

                    <!-- Inscribir -> TipoMateria (requiere) -->
                    <path d="M 780 270 L 780 320" stroke="#10b981" stroke-width="3" marker-end="url(#arrow-emerald)" />
                    <rect x="745" y="282" width="70" height="22" rx="6" fill="#0f172a" stroke="#10b981" stroke-width="1.5" />
                    <text x="780" y="297" text-anchor="middle" fill="#34d399" font-size="11" font-weight="bold">requiere</text>


                    <!-- NODES / FRAMES -->

                    <!-- 1. Central Node: Escuela -->
                    <g transform="translate(20, 30)">
                        <rect width="250" height="400" rx="20" fill="#1e293b" stroke="#38bdf8" stroke-width="2.5" />
                        <rect width="250" height="42" rx="18" fill="#0284c7" />
                        <text x="125" y="26" text-anchor="middle" fill="#ffffff" font-weight="extrabold" font-size="16">Escuela</text>
                        
                        <!-- Attributes header -->
                        <text x="15" y="62" fill="#38bdf8" font-size="11" font-weight="bold">ATRIBUTOS (SLOTS):</text>
                        <text x="15" y="82" fill="#cbd5e1" font-size="11" font-family="monospace">&bull; Facultades : String</text>
                        <text x="15" y="100" fill="#cbd5e1" font-size="11" font-family="monospace">&bull; Edificios : Char</text>
                        <text x="15" y="118" fill="#cbd5e1" font-size="11" font-family="monospace">&bull; Profesores : String</text>
                        <text x="15" y="136" fill="#cbd5e1" font-size="11" font-family="monospace">&bull; Alumnos : String</text>
                        <text x="15" y="154" fill="#cbd5e1" font-size="11" font-family="monospace">&bull; tieneTalleres : bool</text>
                        <text x="15" y="172" fill="#cbd5e1" font-size="11" font-family="monospace">&bull; colegiaturas : float</text>
                        <text x="15" y="190" fill="#cbd5e1" font-size="11" font-family="monospace">&bull; cicloEscolar : "26-3"</text>

                        <!-- Line separator -->
                        <line x1="10" y1="210" x2="240" y2="210" stroke="#334155" stroke-width="1.5" />

                        <!-- Methods header -->
                        <text x="15" y="232" fill="#34d399" font-size="11" font-weight="bold">MÉTODOS (DEMONIOS):</text>
                        <text x="15" y="252" fill="#6ee7b7" font-size="11" font-family="monospace">+ Inscribir()</text>
                        <text x="15" y="272" fill="#6ee7b7" font-size="11" font-family="monospace">+ darMantenimiento()</text>
                        <text x="15" y="292" fill="#6ee7b7" font-size="11" font-family="monospace">+ pagar()</text>
                        <text x="15" y="312" fill="#6ee7b7" font-size="11" font-family="monospace">+ asistirAClases()</text>
                    </g>

                    <!-- 2. Frame: Facultades -->
                    <g transform="translate(420, 30)">
                        <rect width="220" height="120" rx="16" fill="#1e293b" stroke="#ef4444" stroke-width="2" />
                        <rect width="220" height="32" rx="14" fill="#dc2626" />
                        <text x="110" y="21" text-anchor="middle" fill="#ffffff" font-weight="extrabold" font-size="13">Facultades</text>
                        <text x="15" y="55" fill="#fca5a5" font-size="11" font-family="monospace">- Ingeniería</text>
                        <text x="15" y="75" fill="#fca5a5" font-size="11" font-family="monospace">- FACS</text>
                        <text x="15" y="95" fill="#fca5a5" font-size="11" font-family="monospace">- Salud</text>
                    </g>

                    <!-- 3. Frame: Alumnos -->
                    <g transform="translate(420, 165)">
                        <rect width="220" height="125" rx="16" fill="#1e293b" stroke="#38bdf8" stroke-width="2" />
                        <rect width="220" height="32" rx="14" fill="#0284c7" />
                        <text x="110" y="21" text-anchor="middle" fill="#ffffff" font-weight="extrabold" font-size="13">Alumnos</text>
                        <text x="15" y="55" fill="#7dd3fc" font-size="11" font-family="monospace">- Nombre</text>
                        <text x="15" y="73" fill="#7dd3fc" font-size="11" font-family="monospace">- Apellido Paterno</text>
                        <text x="15" y="91" fill="#7dd3fc" font-size="11" font-family="monospace">- Apellido Materno</text>
                        <text x="15" y="109" fill="#7dd3fc" font-size="11" font-family="monospace">- Tira de Materias</text>
                    </g>

                    <!-- 4. Frame: Colegiaturas -->
                    <g transform="translate(420, 300)">
                        <rect width="220" height="130" rx="16" fill="#1e293b" stroke="#f59e0b" stroke-width="2" />
                        <rect width="220" height="32" rx="14" fill="#d97706" />
                        <text x="110" y="21" text-anchor="middle" fill="#ffffff" font-weight="extrabold" font-size="13">Colegiaturas</text>
                        <text x="15" y="55" fill="#fde68a" font-size="11" font-family="monospace">+ conBeca()</text>
                        <text x="15" y="73" fill="#fde68a" font-size="11" font-family="monospace">+ sinBeca()</text>
                        <text x="15" y="91" fill="#fde68a" font-size="11" font-family="monospace">+ pagarEfectivo()</text>
                        <text x="15" y="109" fill="#fde68a" font-size="11" font-family="monospace">+ pagarTarjeta()</text>
                    </g>

                    <!-- 5. Frame: Inscribir -->
                    <g transform="translate(680, 165)">
                        <rect width="220" height="105" rx="16" fill="#1e293b" stroke="#10b981" stroke-width="2" />
                        <rect width="220" height="32" rx="14" fill="#059669" />
                        <text x="110" y="21" text-anchor="middle" fill="#ffffff" font-weight="extrabold" font-size="13">Inscribir ()</text>
                        <text x="15" y="55" fill="#a7f3d0" font-size="11" font-family="monospace">+ InscribirMaterias()</text>
                        <text x="15" y="73" fill="#a7f3d0" font-size="11" font-family="monospace">+ ElegirTalleres()</text>
                        <text x="15" y="91" fill="#a7f3d0" font-size="11" font-family="monospace">+ TipoMateria</text>
                    </g>

                    <!-- 6. Frame: TipoMateria -->
                    <g transform="translate(680, 320)">
                        <rect width="220" height="100" rx="16" fill="#1e293b" stroke="#10b981" stroke-width="2" />
                        <rect width="220" height="32" rx="14" fill="#047857" />
                        <text x="110" y="21" text-anchor="middle" fill="#ffffff" font-weight="extrabold" font-size="13">TipoMateria</text>
                        <text x="15" y="55" fill="#a7f3d0" font-size="11" font-family="monospace">- en_linea</text>
                        <text x="15" y="75" fill="#a7f3d0" font-size="11" font-family="monospace">- presencial</text>
                    </g>

                </svg>
            </div>

            <!-- Mermaid Code Representation Box -->
            <div class="mt-8 border-t border-gray-100 dark:border-gray-700 pt-4">
                <h4 class="text-xs font-bold font-outfit text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-2">
                    Código de Representación Mermaid (UML ClassDiagram):
                </h4>
                <pre class="p-4 bg-slate-950 text-sky-300 font-mono text-xs rounded-2xl border border-slate-800 overflow-x-auto mb-6">
classDiagram
    class Escuela {
        +String Facultades
        +Char Edificios
        +String Profesores
        +String Alumnos
        +bool tieneTalleres
        +float colegiaturas
        +String cicloEscolar "26-3"
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

    Escuela --> Facultades : contiene
    Escuela --> Alumnos : registra
    Escuela --> Colegiaturas : gestiona
    Escuela --> Inscribir : procesa
                </pre>
            </div>

            <!-- Dynamic Mermaid Container Rendered Directly via JS -->
            <div class="mt-4 border-t border-gray-100 dark:border-gray-700 pt-4">
                <h4 class="text-xs font-bold font-outfit text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-3">
                    Renderizado en Vivo con Mermaid.js:
                </h4>
                <div id="mermaid-target-escuela" class="w-full bg-slate-950 rounded-3xl p-6 border border-slate-800 overflow-x-auto flex justify-center min-h-[300px]">
                    <div class="text-sky-400 text-xs font-mono">Generando render Mermaid...</div>
                </div>
            </div>

        </div>
    </div>

    <!-- TAB 2: Semantic Network Graph Visualizer -->
    <div id="tab-semantic" class="hidden space-y-6">
        <div class="p-6 bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm">
            <h3 class="text-base font-bold font-outfit text-gray-900 dark:text-white mb-2">
                Grafo Orientado de Conocimiento (Red Semántica)
            </h3>
            <p class="text-xs text-gray-600 dark:text-gray-400 mb-6">
                Los <strong>Nodos</strong> representan conceptos/entidades y los <strong>Arcos</strong> definen relaciones semánticas (<code>es_un</code>, <code>tiene_un</code>).
            </p>

            <!-- Vector SVG Canvas -->
            <div class="w-full bg-slate-950 rounded-3xl p-4 border border-slate-800 overflow-x-auto flex justify-center items-center">
                <svg width="780" height="340" viewBox="0 0 780 340" class="w-full max-w-full">
                    <defs>
                        <marker id="arrow-sky2" viewBox="0 0 10 10" refX="8" refY="5" markerWidth="6" markerHeight="6" orient="auto-start-reverse">
                            <path d="M 0 0 L 10 5 L 0 10 z" fill="#38bdf8" />
                        </marker>
                        <marker id="arrow-purple2" viewBox="0 0 10 10" refX="8" refY="5" markerWidth="6" markerHeight="6" orient="auto-start-reverse">
                            <path d="M 0 0 L 10 5 L 0 10 z" fill="#c084fc" />
                        </marker>
                    </defs>

                    <!-- Connection Lines -->
                    <line x1="200" y1="80" x2="390" y2="150" stroke="#38bdf8" stroke-width="2.5" marker-end="url(#arrow-sky2)" />
                    <rect x="275" y="102" width="54" height="22" rx="6" fill="#0f172a" stroke="#38bdf8" stroke-width="1" />
                    <text x="302" y="117" text-anchor="middle" fill="#38bdf8" font-size="11" font-weight="bold">es_un</text>

                    <line x1="390" y1="150" x2="580" y2="80" stroke="#38bdf8" stroke-width="2.5" marker-end="url(#arrow-sky2)" />
                    <rect x="465" y="102" width="54" height="22" rx="6" fill="#0f172a" stroke="#38bdf8" stroke-width="1" />
                    <text x="492" y="117" text-anchor="middle" fill="#38bdf8" font-size="11" font-weight="bold">es_un</text>

                    <line x1="390" y1="150" x2="580" y2="240" stroke="#38bdf8" stroke-width="2.5" marker-end="url(#arrow-sky2)" />
                    <rect x="465" y="182" width="54" height="22" rx="6" fill="#0f172a" stroke="#38bdf8" stroke-width="1" />
                    <text x="492" y="197" text-anchor="middle" fill="#38bdf8" font-size="11" font-weight="bold">es_un</text>

                    <line x1="390" y1="150" x2="200" y2="240" stroke="#c084fc" stroke-width="2.5" stroke-dasharray="4" marker-end="url(#arrow-purple2)" />
                    <rect x="260" y="182" width="66" height="22" rx="6" fill="#0f172a" stroke="#c084fc" stroke-width="1" />
                    <text x="293" y="197" text-anchor="middle" fill="#c084fc" font-size="11" font-weight="bold">tiene_un</text>

                    <!-- Nodes -->
                    <g transform="translate(100, 45)">
                        <rect width="170" height="65" rx="16" fill="#1e293b" stroke="#0284c7" stroke-width="2" />
                        <text x="85" y="28" text-anchor="middle" fill="#38bdf8" font-weight="extrabold" font-size="14">Animal</text>
                        <text x="85" y="48" text-anchor="middle" fill="#94a3b8" font-size="11">Respira &bull; Células</text>
                    </g>

                    <g transform="translate(305, 115)">
                        <rect width="170" height="65" rx="16" fill="#1e293b" stroke="#0d9488" stroke-width="2" />
                        <text x="85" y="28" text-anchor="middle" fill="#2dd4bf" font-weight="extrabold" font-size="14">Pájaro</text>
                        <text x="85" y="48" text-anchor="middle" fill="#94a3b8" font-size="11">Vuela por defecto</text>
                    </g>

                    <g transform="translate(510, 45)">
                        <rect width="170" height="65" rx="16" fill="#1e293b" stroke="#a855f7" stroke-width="2" />
                        <text x="85" y="28" text-anchor="middle" fill="#c084fc" font-weight="extrabold" font-size="14">Canario</text>
                        <text x="85" y="48" text-anchor="middle" fill="#e9d5ff" font-size="11">Canta &bull; Color Amarillo</text>
                    </g>

                    <g transform="translate(510, 210)">
                        <rect width="170" height="65" rx="16" fill="#1e293b" stroke="#f59e0b" stroke-width="2" />
                        <text x="85" y="28" text-anchor="middle" fill="#fbbf24" font-weight="extrabold" font-size="14">Pingüino</text>
                        <text x="85" y="48" text-anchor="middle" fill="#fde68a" font-size="11">Excepción: Vuela = No</text>
                    </g>

                    <g transform="translate(100, 210)">
                        <rect width="170" height="65" rx="16" fill="#1e293b" stroke="#c084fc" stroke-width="2" />
                        <text x="85" y="28" text-anchor="middle" fill="#c084fc" font-weight="extrabold" font-size="14">Alas</text>
                        <text x="85" y="48" text-anchor="middle" fill="#94a3b8" font-size="11">Plumas &bull; Propulsión</text>
                    </g>
                </svg>
            </div>

            <!-- Dynamic Mermaid Container for Red Semántica -->
            <div class="mt-8 border-t border-gray-100 dark:border-gray-700 pt-4">
                <h4 class="text-xs font-bold font-outfit text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-3">
                    Renderizado en Vivo con Mermaid.js:
                </h4>
                <div id="mermaid-target-semantic" class="w-full bg-slate-950 rounded-3xl p-6 border border-slate-800 overflow-x-auto flex justify-center min-h-[250px]">
                    <div class="text-teal-400 text-xs font-mono">Generando render Mermaid...</div>
                </div>
            </div>

        </div>
    </div>

    <!-- TAB 3: Frames & Slots Dynamic Inspector -->
    <div id="tab-frame" class="hidden space-y-6">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <!-- Controls Form -->
            <div class="lg:col-span-5 p-6 bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm">
                <h3 class="text-base font-bold font-outfit text-gray-900 dark:text-white mb-3">
                    Crear / Modificar Marco (Frame)
                </h3>
                <form id="frame-form" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1">Nombre del Marco Hijo:</label>
                        <input type="text" name="child_frame" value="Pingüino" required class="w-full px-3 py-2 text-xs rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 dark:text-white">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1">Hereda de Marco Padre:</label>
                        <select name="parent_frame" class="w-full px-3 py-2 text-xs rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white">
                            <option value="Pájaro">Pájaro (Hereda: Alas, Vuela=sí)</option>
                            <option value="Animal">Animal (Hereda: Respira, Células)</option>
                            <option value="Vehículo">Vehículo (Hereda: Motor, Combustible)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1">Ranura Específica (Slot Name):</label>
                        <input type="text" name="slot_name" value="vuela" required class="w-full px-3 py-2 text-xs rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 dark:text-white">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1">Valor / Excepción (Slot Value):</label>
                        <input type="text" name="slot_value" value="no (nada en su lugar)" required class="w-full px-3 py-2 text-xs rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 dark:text-white">
                    </div>
                    <button type="submit" class="w-full py-2.5 bg-teal-600 hover:bg-teal-700 text-white font-bold text-xs rounded-xl shadow-sm transition-all">
                        Simular Herencia y Slots
                    </button>
                </form>
            </div>

            <!-- Dynamic Frame Output -->
            <div class="lg:col-span-7 p-6 bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm min-h-[400px]">
                <h3 class="text-base font-bold font-outfit text-gray-900 dark:text-white mb-4 border-b border-gray-100 dark:border-gray-700 pb-2 flex items-center justify-between">
                    <span>Estructura de Marco Resultante</span>
                    <span id="frame-status" class="text-xs font-semibold text-gray-500">Listo</span>
                </h3>

                <div id="frame-results" class="space-y-4 text-xs">
                    <div class="text-center py-12 text-gray-400">
                        Haz clic en "Simular Herencia y Slots" para calcular la herencia de las ranuras.
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- JS Render Engine -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btnPizarrón = document.getElementById('tab-pizarrón-btn');
            const btnSemantic = document.getElementById('tab-semantic-btn');
            const btnFrame = document.getElementById('tab-frame-btn');

            const tabPizarrón = document.getElementById('tab-pizarrón');
            const tabSemantic = document.getElementById('tab-semantic');
            const tabFrame = document.getElementById('tab-frame');

            const frameForm = document.getElementById('frame-form');
            const frameResults = document.getElementById('frame-results');
            const frameStatus = document.getElementById('frame-status');

            const activeClass = "px-5 py-2.5 font-bold font-outfit text-xs rounded-t-2xl border-b-2 border-teal-600 text-teal-600 dark:text-teal-400 bg-white dark:bg-gray-800 shadow-sm transition-all flex items-center gap-2";
            const inactiveClass = "px-5 py-2.5 font-bold font-outfit text-xs text-gray-500 hover:text-gray-800 dark:hover:text-gray-200 rounded-t-2xl border-b-2 border-transparent transition-all flex items-center gap-2";

            async function renderMermaidAsync(targetId, code) {
                try {
                    const targetEl = document.getElementById(targetId);
                    if (!targetEl) return;
                    
                    if (window.mermaid && typeof mermaid.render === 'function') {
                        const uniqueId = 'mermaid-svg-' + Math.floor(Math.random() * 10000);
                        const { svg } = await mermaid.render(uniqueId, code);
                        targetEl.innerHTML = svg;
                    }
                } catch (e) {
                    console.log('Async mermaid render note:', e);
                }
            }

            const escuelaCode = `classDiagram
    class Escuela {
        +String Facultades
        +Char Edificios
        +String Profesores
        +String Alumnos
        +bool tieneTalleres
        +float colegiaturas
        +String cicloEscolar "26-3"
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

    Escuela --> Facultades : contiene
    Escuela --> Alumnos : registra
    Escuela --> Colegiaturas : gestiona
    Escuela --> Inscribir : procesa`;

            const semanticCode = `graph LR
    Animal["Animal: Respira, Células"] -->|es_un| Pajaro["Pájaro: Vuela por defecto"]
    Pajaro -->|es_un| Canario["Canario: Canta"]
    Pajaro -->|es_un| Pinguino["Pingüino: Vuela = No"]
    Pajaro -->|tiene_un| Alas["Alas: Plumas"]`;

            function showTab(targetTab, targetBtn) {
                [tabPizarrón, tabSemantic, tabFrame].forEach(t => t.classList.add('hidden'));
                [btnPizarrón, btnSemantic, btnFrame].forEach(b => b.className = inactiveClass);

                targetTab.classList.remove('hidden');
                targetBtn.className = activeClass;

                if (targetTab === tabPizarrón) {
                    renderMermaidAsync('mermaid-target-escuela', escuelaCode);
                } else if (targetTab === tabSemantic) {
                    renderMermaidAsync('mermaid-target-semantic', semanticCode);
                }
            }

            btnPizarrón.addEventListener('click', () => showTab(tabPizarrón, btnPizarrón));
            btnSemantic.addEventListener('click', () => showTab(tabSemantic, btnSemantic));
            btnFrame.addEventListener('click', () => showTab(tabFrame, btnFrame));

            // Initial trigger
            setTimeout(() => {
                renderMermaidAsync('mermaid-target-escuela', escuelaCode);
            }, 300);

            frameForm.addEventListener('submit', async function(e) {
                e.preventDefault();
                frameStatus.textContent = "Calculando...";
                
                try {
                    const res = await fetch("{{ route('semantic.solve') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        },
                        body: new FormData(frameForm)
                    });
                    const data = await res.json();

                    if (data.success) {
                        frameStatus.textContent = "Cálculo Completado";
                        
                        let slotsHtml = '';
                        for (const [key, val] of Object.entries(data.slots)) {
                            slotsHtml += `
                                <div class="flex justify-between items-center py-2 px-3 bg-gray-50 dark:bg-gray-900 rounded-xl border border-gray-100 dark:border-gray-700">
                                    <span class="font-bold text-teal-700 dark:text-teal-300">${key}:</span>
                                    <span class="text-gray-700 dark:text-gray-300 font-mono">${val}</span>
                                </div>
                            `;
                        }

                        frameResults.innerHTML = `
                            <div class="p-4 bg-slate-900 text-white rounded-2xl mb-4 border border-teal-500">
                                <h4 class="text-sm font-bold font-outfit text-teal-300">FRAME: ${data.frame_name}</h4>
                                <p class="text-[11px] opacity-80">Padre directo: ${data.parent_name}</p>
                            </div>
                            <div class="space-y-2">
                                <h5 class="font-bold font-outfit text-gray-800 dark:text-gray-200">Ranuras (Slots) Resultantes:</h5>
                                ${slotsHtml}
                            </div>
                        `;
                    }
                } catch (err) {
                    console.error(err);
                    frameStatus.textContent = "Error";
                }
            });
        });
    </script>
</x-app-layout>
