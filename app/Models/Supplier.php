<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = ['id'];
    protected $appends = ['country_name'];
    public function materials(){
        return $this->belongsToMany(Material::class);
    }
    public function inquiries(){
        return $this->hasMany(Inquiry::class);
    }
    public function files(){
        return $this->hasMany(File::class,'supplier_id');
    }
    public function log_inquiries(){
        return $this->inquiries()->where('type','logistic');
    }
    public function reg_inquiries(){
        return $this->inquiries()->where('type','regular');
    }
    public function setLogoImgAttribute($logo){
        if ($logo){
            $this->attributes['logo_img'] = upload('images/',$logo);
        }
    }

    public function pos(){
        return $this->hasMany(Po::class);
    }

    public function c_country(){
        return $this->belongsTo(Country::class,'country');
    }

    public function getCountryNameAttribute(){
        return $this->c_country->name;
    }

}
