<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentSubject extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'student_id',
        'subject_id',
        'semester',
        'ca1',
        'ca2',
        'ca3',
        'ca4',
        'pca1',
        'pca2',
        'attendance',
        'grade',
        'points',
        'academic_year'
    ];
    
    /**
     * Get the student that owns the record.
     */
    public function student()
    {
        return $this->belongsTo(StudentDetail::class, 'student_id');
    }
    
    /**
     * Get the subject associated with this record.
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
}
