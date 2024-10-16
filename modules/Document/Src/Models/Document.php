<?php

namespace Modules\Document\Src\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Lessons\Src\Models\Lessons;

class Document extends model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'url',
        'size',
        'name',
    ];

    protected $attributes = [
        'size' => 0
    ];

    public function lessons() {
        $this->hasMany(Lessons::class);
    }
}
