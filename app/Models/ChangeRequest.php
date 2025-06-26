<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChangeRequest extends Model
{
    use HasFactory;

    protected $table = 'change_requests';
    
    protected $fillable = [
        'user_id',
        'student_id',
        'field_name',
        'old_value',
        'new_value',
        'status', // pending, approved, rejected
        'notes',
        'reviewed_by',
        'reviewed_at'
    ];

    public function student()
    {
        return $this->belongsTo(StudentDetail::class, 'student_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }
} 