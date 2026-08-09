<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SemanticNetworkController extends Controller
{
    public function index(): View
    {
        return view('semantic.index');
    }

    public function solve(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'child_frame' => 'required|string',
            'parent_frame' => 'nullable|string',
            'slot_name' => 'required|string',
            'slot_value' => 'required|string',
        ]);

        $child = trim($validated['child_frame']);
        $parent = trim($validated['parent_frame'] ?? 'Animal');
        $slotName = trim($validated['slot_name']);
        $slotValue = trim($validated['slot_value']);

        // Default parent slots for simulation
        $parentSlots = [
            'Animal' => ['respira' => 'sí', 'tiene_células' => 'sí', 'locomoción' => 'varía'],
            'Pájaro' => ['es_un' => 'Animal', 'tiene' => 'Alas', 'vuela' => 'sí (por defecto)', 'reproducción' => 'ovíparo'],
            'Vehículo' => ['tiene' => 'Motor', 'requiere' => 'Combustible / Energía'],
        ];

        $inheritedSlots = $parentSlots[$parent] ?? ['propiedad_padre' => 'Heredado dinámicamente de '.$parent];

        // Specific child slots with exception handling
        $childSlots = array_merge($inheritedSlots, [
            $slotName => $slotValue,
        ]);

        $steps = [];
        $steps[] = [
            'title' => '1. Definición del Marco Padre ('.$parent.')',
            'detail' => 'Atributos (Slots) base del padre: '.json_encode($inheritedSlots, JSON_UNESCAPED_UNICODE),
        ];
        $steps[] = [
            'title' => '2. Aplicación de Herencia en Marco Hijo ('.$child.')',
            'detail' => 'El Marco "'.$child.'" hereda automáticamente todas las ranuras (Slots) de "'.$parent.'".',
        ];
        $steps[] = [
            'title' => '3. Sobrescritura / Adición de Slot Específico',
            'detail' => 'Slot local introducido: ['.$slotName.' = "'.$slotValue.'"]. Si la ranura existía en el padre, se aplica manejo de excepciones (override).',
        ];

        return response()->json([
            'success' => true,
            'frame_name' => $child,
            'parent_name' => $parent,
            'slots' => $childSlots,
            'steps' => $steps,
        ]);
    }
}
