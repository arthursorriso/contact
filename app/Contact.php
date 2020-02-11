<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['name', 'email', 'tel', 'message', 'file_id', 'ip'];

    public function file() {
        return $this->belongsTo('App\FileEntry');
    }
}
