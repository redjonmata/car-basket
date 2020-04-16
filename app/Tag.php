<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['slug'];
    public $timestamps = false;

    public function cars()
    {
        return $this->belongsToMany('App\Car');
    }
}
