<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentCertification extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'semester',
        'title',
        'issuer',
        'completion_date'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'completion_date' => 'date',
    ];

    /**
     * Get the student that owns the certification.
     */
    public function student()
    {
        return $this->belongsTo(StudentDetail::class, 'student_id');
    }
} 