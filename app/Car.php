<?php

namespace App;

//use App\Search\Searchable;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
//    use Searchable;

    protected $fillable = ['make','model','year','registration','engine','price','visible','user_id'];

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }
}
