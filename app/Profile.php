<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model {

    protected $table = 'profiles';
    public $timestamps = true;

    public function user(){
        return $this->belongsTo(User::class);
    }
}
