<?php

namespace Modules\Lessons\Src\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Courses\Src\Models\Course;
use Modules\Document\Src\Models\Document;
use Modules\Video\Src\Models\Video;

class Lessons extends model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'video_id',
        'document_id',
        'parent_id',
        'is_trial',
        'view',
        'position',
        'duration',
        'description',
        'course_id',
        'status'
    ];

    protected $with = ['video', 'document'];

    public function childrent() {
        return $this->hasMany(Lessons::class, 'parent_id');
    }

    public function subLessons() {
        return $this->childrent()->with('subLessons');
    }

    public function video() {
        return $this->belongsTo(Video::class, 'video_id', 'id');
    }

    public function document() {
        return $this->belongsTo(Document::class);
    }

    public function course() {
        return $this->belongsTo(Course::class);
    }

}
