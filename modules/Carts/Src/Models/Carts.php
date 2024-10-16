<?php

namespace Modules\Carts\Src\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Courses\Src\Models\Course;

class Carts extends model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'student_id',
        'course_id',
        'price',
        'quantity'
    ];

    public function course() {
        return $this->hasOne(Course::class, 'id', 'course_id');
    }


}
