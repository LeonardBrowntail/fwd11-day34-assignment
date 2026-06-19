<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'instructor_id',
        'category_id',
        'title',
        'description',
        'rating',
        'thumbnail',
        'level',
        'duration',
        'status',
        'enrolled_count'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function instructor() : BelongsTo {
        return $this->belongsTo(User::class);
    }
}
