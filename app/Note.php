<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $appends = ['updatedAtTimestamp'];

    protected $fillable = [
        'title',
        'body'
    ];

    public function getUpdatedAtTimestampAttribute()
    {
        return $this->updated_at->getTimestamp();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
