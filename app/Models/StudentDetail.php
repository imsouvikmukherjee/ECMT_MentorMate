<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class StudentDetail extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'student_details';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'session',
        'aadhaar_no',
        'father_name',
        'mother_name',
        'dob',
        'blood_group',
        'sex',
        'nationality',
        'category',
        'religion',
        'student_address',
        'state',
        'district',
        'pin',
        'alternate_mobile',
        'gurdian_name',
        'gurdian_address',
        'guardian_mobile',
        'relation_with_guardian',
        'residence_status',
        'reg_no',
        'roll_no',
        'profile_picture',
        'picture_changes_left',
    ];

    /**
     * Get the user that owns the student detail.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the semester data for the student.
     */
    public function semesterData()
    {
        return $this->hasMany(StudentSemesterData::class, 'student_id');
    }

    /**
     * Get the certifications for the student.
     */
    public function certifications()
    {
        return $this->hasMany(StudentCertification::class, 'student_id');
    }

    /**
     * Get the workshops for the student.
     */
    public function workshops()
    {
        return $this->hasMany(StudentWorkshop::class, 'student_id');
    }

    /**
     * Get the internships for the student.
     */
    public function internships()
    {
        return $this->hasMany(StudentInternship::class, 'student_id');
    }

    /**
     * Get the challenges for the student.
     */
    public function challenges()
    {
        return $this->hasMany(StudentChallenge::class, 'student_id');
    }
} 