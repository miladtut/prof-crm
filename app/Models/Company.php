<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Psy\Util\Str;

class Company extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $appends = ['country_name'];
    protected $guarded = ['id'];
    public function setPasswordAttribute($password)
    {
        if ($password){
            $this->attributes['password'] = bcrypt($password);
        }
    }

    public function setLogoImgAttribute($logo){
        if ($logo != null){
            $this->attributes['logo_img'] = upload('images/',$logo);
        }else{
            $this->attributes['logo_img'] = null;
        }
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    public function inquiries(){
        return $this->hasMany(Inquiry::class);
    }

    public function c_country(){
        return $this->belongsTo(Country::class,'country');
    }

    public function getCountryNameAttribute(){
        return $this->c_country->name;
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class,'company_id');
    }
}
