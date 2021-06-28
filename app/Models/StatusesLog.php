<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusesLog extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $appends = ['status_class'];
    public function status(){
        return $this->belongsTo(Status::class,'inquiry_status_id');
    }

    public function getStatusClassAttribute(){
        $class = get_status_class($this->status);
        return $class;
    }

}
