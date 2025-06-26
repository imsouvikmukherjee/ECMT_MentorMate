<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'code',
        'department_id',
        'session',
        'semester',
        'type',
        'description',
        'credits'
    ];
    
    /**
     * Get the department that the subject belongs to.
     */
    public function department()
    {
        return $this->belongsTo('App\Models\Department', 'department_id');
    }
    
    /**
     * Get the students enrolled in this subject.
     */
    public function students()
    {
        return $this->belongsToMany('App\Models\StudentDetail', 'student_subjects', 'subject_id', 'student_id')
                    ->withPivot('ca1', 'ca2', 'ca3', 'ca4', 'pca1', 'pca2', 'attendance', 'grade', 'points')
                    ->withTimestamps();
    }
}
