<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    public $table = 'inquiry_statuses';
    public function logs(){
        return $this->hasMany(StatusesLog::class,'inquiry_status_id');
    }
}
