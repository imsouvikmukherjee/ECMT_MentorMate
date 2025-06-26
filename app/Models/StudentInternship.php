<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentInternship extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'semester',
        'company',
        'role',
        'duration',
        'work_done'
    ];

    /**
     * Get the student that owns the internship.
     */
    public function student()
    {
        return $this->belongsTo(StudentDetail::class, 'student_id');
    }
} 