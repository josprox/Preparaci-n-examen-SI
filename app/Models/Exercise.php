<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    protected $fillable = [
        'type',
        'inputs',
        'results',
        'notes',
        'is_successful',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'inputs' => 'array',
            'results' => 'array',
            'is_successful' => 'boolean',
        ];
    }
}
