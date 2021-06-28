<?php

namespace App\Models;

use App\Classes\Initialization\Inq;
use App\Classes\Status\InquiryStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;
    protected $appends=[
        'material_name',
        'company_name',
        'company_type',
        'spec_name',
        'country_name',
    ];
    protected $guarded = ['id'];

    protected $casts = [
        'status' => 'array',
    ];





    public function material(){
        return $this->belongsTo(Material::class);
    }
    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }
    public function quotation(){
        return $this->hasOne(Quotation::class);
    }

    public function spec(){
        return $this->belongsTo(Spec::class);
    }
    public function country(){
        return $this->belongsTo(Country::class,'end_market_id');
    }
    public function status_logs(){
        return $this->hasMany(StatusesLog::class);
    }

    public function stages(){
        return $this->hasMany(Stage::class);
    }

    public function activeStages(){
        return $this->stages()->where('active',1);
    }

    public function documents(){
        return $this->belongsToMany(Document::class);
    }


    public function supplier_document(){
        return $this->hasMany(SupplierDocument::class);
    }

    public function customer_docs(){
        return $this->belongsToMany(Customerdoc::class);
    }


    public function files(){
        return $this->hasMany(File::class);
    }

    public function getFiles($type){
        return $this->files()->where('type',$type)->get();
    }

    public function sample(){
        return $this->hasOne(Sample::class);
    }

    public function pilot(){
        return $this->hasOne(Pilot::class);
    }

    public function s_po(){
        return $this->hasOne(Po::class);
    }

    public function getMaterialNameAttribute(){
        return @$this->material->name;
    }

    public function getSpecNameAttribute(){
        return @$this->spec->name;
    }

    public function getCompanyNameAttribute(){
        return @$this->company->company_name;
    }

    public function getCompanyTypeAttribute(){
        return @$this->company->account_type;
    }

    public function getCountryNameAttribute(){
        return @$this->country->name;
    }












}
