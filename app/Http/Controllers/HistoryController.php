<?php

namespace App\Http\Controllers;

use App\Services\ExerciseHistoryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HistoryController extends Controller
{
    public function __construct(
        protected ExerciseHistoryService $historyService
    ) {}

    public function index(): View
    {
        $history = $this->historyService->getAll();
        return view('history.index', compact('history'));
    }

    public function delete(int $id): RedirectResponse
    {
        $this->historyService->delete($id);
        return redirect()->route('history.index')->with('success', 'Ejercicio eliminado del historial.');
    }

    public function clear(): RedirectResponse
    {
        $this->historyService->clear();
        return redirect()->route('history.index')->with('success', 'Historial vaciado por completo.');
    }

    public function repeat(int $id): RedirectResponse
    {
        $exercise = $this->historyService->find($id);

        if (!$exercise) {
            return redirect()->route('history.index')->with('error', 'Ejercicio no encontrado.');
        }

        // Redirect to the correct module index route, sending the inputs in the query string
        $routeMap = [
            'perceptron' => 'perceptron.index',
            'forward_propagation' => 'forward.index',
            'backpropagation' => 'backprop.index',
            'hopfield' => 'hopfield.index',
        ];

        $route = $routeMap[$exercise->type] ?? 'dashboard';

        return redirect()->route($route, ['repeat' => $id]);
    }
}
