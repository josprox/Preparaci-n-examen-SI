<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KnowledgeBaseController extends Controller
{
    public function index(): View
    {
        return view('knowledge.index');
    }

    public function solve(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'symptom' => 'nullable|string',
            'custom_fact' => 'nullable|string',
            'custom_condition' => 'nullable|string',
            'custom_action' => 'nullable|string',
        ]);

        $steps = [];
        $facts = [];
        $rules = [];
        $conclusions = [];

        // Preset Medical Diagnosis scenario from notes
        if ($request->filled('symptom')) {
            $symptom = trim($validated['symptom']);
            $facts[] = 'Paciente tiene '.$symptom;

            $rules[] = [
                'id' => 'R1',
                'condition' => 'Paciente tiene síntoma A',
                'conclusion' => 'Posible enfermedad B',
                'description' => 'El síntoma A es característico de la enfermedad B.',
            ];
            $rules[] = [
                'id' => 'R2',
                'condition' => 'Paciente tiene fiebre alta',
                'conclusion' => 'Posible infección viral o bacteriana',
                'description' => 'Fiebre persistente activa protocolo de laboratorio.',
            ];
            $rules[] = [
                'id' => 'R3',
                'condition' => 'Paciente tiene dolor articular AND fiebre alta',
                'conclusion' => 'Recomendación: Evaluación por reumatología',
                'description' => 'Combinación de síntomas de alta severidad.',
            ];

            $steps[] = [
                'stage' => 'Base de Datos de Hechos',
                'detail' => 'Hecho ingresado a la Memoria de Trabajo: "'.$facts[0].'"',
            ];

            $steps[] = [
                'stage' => 'Carga de Reglas de Producción',
                'detail' => 'Se cargan 3 Reglas de Producción (SI-ENTONCES) en la Base de Conocimientos.',
            ];

            // Evaluate Inference Engine
            $matched = false;
            if (mb_stripos($symptom, 'síntoma A') !== false || mb_stripos($symptom, 'sintoma A') !== false) {
                $conclusions[] = 'Posible enfermedad B (Grado de certeza: 95%)';
                $steps[] = [
                    'stage' => 'Motor de Inferencia (Equiparación de Patrones)',
                    'detail' => 'La Regla R1 ("SI síntoma A ENTONCES posible enfermedad B") coincide exactamente con los hechos introducidos.',
                ];
                $matched = true;
            }

            if (mb_stripos($symptom, 'fiebre') !== false) {
                $conclusions[] = 'Posible infección viral o bacteriana';
                $steps[] = [
                    'stage' => 'Motor de Inferencia (Equiparación de Patrones)',
                    'detail' => 'La Regla R2 se activa ante la presencia de la condición "fiebre".',
                ];
                $matched = true;
            }

            if (! $matched) {
                $conclusions[] = 'No se encontraron reglas predefinidas en la BC para este síntoma exacto. Se activa el módulo Heurístico de derivación.';
                $steps[] = [
                    'stage' => 'Motor de Inferencia (Conflicto / Fallback)',
                    'detail' => 'El hecho introducido "'.$symptom.'" no disparó reglas inmediatas; se registra como hecho nuevo.',
                ];
            }
        } elseif ($request->filled('custom_condition') && $request->filled('custom_action')) {
            $fact = $validated['custom_fact'] ?? 'Hecho inicial ingresado';
            $condition = $validated['custom_condition'];
            $action = $validated['custom_action'];

            $facts[] = $fact;
            $rules[] = [
                'id' => 'R-Custom',
                'condition' => $condition,
                'conclusion' => $action,
                'description' => 'Regla definida por el usuario',
            ];

            $steps[] = [
                'stage' => 'Base de Conocimientos',
                'detail' => "Hecho: \"$fact\" | Regla: SI \"$condition\" ENTONCES \"$action\"",
            ];
            $steps[] = [
                'stage' => 'Ejecución del Motor de Inferencia',
                'detail' => "Disparo de la regla R-Custom -> Deducción resultante: \"$action\"",
            ];
            $conclusions[] = $action;
        }

        return response()->json([
            'success' => true,
            'facts' => $facts,
            'rules' => $rules,
            'steps' => $steps,
            'conclusions' => $conclusions,
        ]);
    }
}
