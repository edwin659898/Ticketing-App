<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ticket extends Model
{
    protected $fillable = ['subject','message','user_id','comments','sorted','image',];

    public function owner()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
