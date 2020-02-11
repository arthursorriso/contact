<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class FileEntry extends Model
{
    protected $fillable = ['filename', 'path'];

    protected $table = 'files';

    public function postFile($file, $disk) {
        $filename = $file->getClientOriginalName();

        $path = hash( 'sha256', time());

        if(Storage::disk($disk)->put($path.'/'.$filename,  File::get($file))) {

            $this->filename = $filename;
            $this->path = $path;
            $this->save();

            return $this->id;
        }

        return false;
    }

    public function contact() {
        return $this->belongsTo('App\Contact');
    }
}
