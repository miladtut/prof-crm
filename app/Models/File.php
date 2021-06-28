<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class File extends Model
{
    use HasFactory;
    protected $guarded =['id'];

    public static function boot ()
    {
        parent::boot();

        self::deleting(function ($file) {
            if (file_exists(asset('uploads/'.$file->name))){
                unlink(asset('uploads/'.$file->name));
            }
        });
    }

    public function setNameAttribute($file){
        $this->attributes['name'] = upload('documents/',$file);
    }

}
