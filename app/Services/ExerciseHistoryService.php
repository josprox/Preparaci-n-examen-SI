<?php

namespace App\Services;

use App\Models\Exercise;
use Illuminate\Database\Eloquent\Collection;

class ExerciseHistoryService
{
    /**
     * Get all exercise logs ordered by date.
     *
     * @return Collection<int, Exercise>
     */
    public function getAll(): Collection
    {
        return Exercise::query()->latest()->get();
    }

    /**
     * Find a specific exercise log by ID.
     *
     * @param int $id
     * @return Exercise|null
     */
    public function find(int $id): ?Exercise
    {
        return Exercise::query()->find($id);
    }

    /**
     * Create a new exercise log in history.
     *
     * @param string $type
     * @param array<string, mixed> $inputs
     * @param array<string, mixed> $results
     * @param string|null $notes
     * @param bool $isSuccessful
     * @return Exercise
     */
    public function create(string $type, array $inputs, array $results, ?string $notes = null, bool $isSuccessful = true): Exercise
    {
        return Exercise::query()->create([
            'type' => $type,
            'inputs' => $inputs,
            'results' => $results,
            'notes' => $notes,
            'is_successful' => $isSuccessful,
        ]);
    }

    /**
     * Delete an exercise log from history.
     *
     * @param int $id
     * @return bool|null
     */
    public function delete(int $id): ?bool
    {
        $exercise = Exercise::query()->find($id);
        if ($exercise) {
            return $exercise->delete();
        }
        return false;
    }

    /**
     * Clear all exercise logs from history.
     *
     * @return void
     */
    public function clear(): void
    {
        Exercise::query()->truncate();
    }
}
