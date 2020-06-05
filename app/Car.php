<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{

    protected $fillable = ['make','model','year','registration','engine','price','visible','user_id'];

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }
}
