<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MentorFeedback extends Model
{
    use HasFactory;

    protected $table = 'mentor_feedbacks';

    protected $fillable = [
        'student_id',
        'mentor_id',
        'semester',
        'academic_feedback',
        'personal_feedback',
        'recommendations',
        'feedback_date'
    ];

    public function student()
    {
        return $this->belongsTo(StudentDetail::class, 'student_id');
    }

    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }
} 