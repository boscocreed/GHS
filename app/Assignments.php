<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignments extends Model
{
    protected $fillable = [
        'id',
        'title',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
