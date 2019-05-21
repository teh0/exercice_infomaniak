<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //
    protected $guarded = ['id'];

    public function category() {
        return $this->belongsTo('App\Category')->withDefault();
    }
    public function user() {
        return $this->belongsTo('App\User')->withDefault();
    }
}
