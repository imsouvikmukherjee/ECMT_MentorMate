<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;

class ProfileChangeRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'student_id',
        'mentor_id',
        'changes',
        'status',
        'reject_reason',
        'processed_at',
    ];

    protected $casts = [
        'changes' => 'array',
        'processed_at' => 'datetime',
    ];

    // Create a boot method to check if the table exists
    protected static function boot()
    {
        parent::boot();
        
        try {
            if (!Schema::hasTable('profile_change_requests')) {
                Log::warning('profile_change_requests table does not exist');
            }
        } catch (\Exception $e) {
            Log::error('Error checking profile_change_requests table: ' . $e->getMessage());
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Using DB relationship since we're using raw DB queries for student_details
    public function getStudentAttribute()
    {
        return DB::table('student_details')
            ->where('id', $this->student_id)
            ->first();
    }

    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }
} 