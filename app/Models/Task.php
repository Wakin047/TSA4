<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public const STATUSES = [
        'pending' => 'Pending',
        'in_progress' => 'In progress',
        'done' => 'Done',
    ];

    protected $fillable = [
        'title',
        'description',
        'due_date',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'due_date' => 'date',
            'is_archived' => 'boolean',
        ];
    }
}
