<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $appends = ['notification_url'];
    public function getNotificationUrlAttribute(){
        if (auth('admin')->check()){
            return route('admin.inquiry.show',$this->attributes['inquiry_id']);
        }elseif (auth()->check()){
            return route('company-inquiry-show',$this->attributes['inquiry_id']);
        }
    }
}
