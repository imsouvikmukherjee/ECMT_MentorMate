<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentWorkshop extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'semester',
        'name',
        'organizer',
        'date'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'date' => 'date',
    ];

    /**
     * Get the student that owns the workshop.
     */
    public function student()
    {
        return $this->belongsTo(StudentDetail::class, 'student_id');
    }
} 