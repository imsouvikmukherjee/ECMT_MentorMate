<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MentoringChangeRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'mentor_id',
        'semester',
        'section',
        'changes',
        'status',
        'reject_reason',
        'processed_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'changes' => 'array',
        'processed_at' => 'datetime',
    ];

    /**
     * Get the student that owns the change request.
     */
    public function student()
    {
        return $this->belongsTo(StudentDetail::class, 'student_id');
    }

    /**
     * Get the mentor for the change request.
     */
    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }
} 