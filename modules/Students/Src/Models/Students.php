<?php

namespace Modules\Students\Src\Models;

use App\Notifications\EmailVerifyQueue;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Modules\Courses\Src\Models\Course;

class Students extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'address',
        'phone'
    ];

    public function sendEmailVerificationNotification() {
        return $this->notify(new EmailVerifyQueue());
    }

    public function courses() {
        return $this->belongsToMany(Course::class, 'students_courses', 'student_id', 'course_id');
    }

}
