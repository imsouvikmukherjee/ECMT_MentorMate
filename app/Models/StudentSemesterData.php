<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentSemesterData extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'semester',
        'subjects',
        'projects',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'subjects' => 'array',
    ];

    /**
     * Get the student that owns the semester data.
     */
    public function student()
    {
        return $this->belongsTo(StudentDetail::class, 'student_id');
    }
} 