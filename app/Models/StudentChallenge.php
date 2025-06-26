<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentChallenge extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'semester',
        'name',
        'description',
        'result'
    ];

    /**
     * Get the student that owns the challenge.
     */
    public function student()
    {
        return $this->belongsTo(StudentDetail::class, 'student_id');
    }
} 