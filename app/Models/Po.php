<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Po extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $appends = ['material_name'];
    protected $guarded = ['id'];

    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }
    public function material(){
        return $this->belongsTo(Material::class,'material_id');
    }
    public function getMaterialNameAttribute(){
        return $this->material->name;
    }
    public function inquiry(){
        return $this->belongsTo(Inquiry::class);
    }
    public function payment_term(){
        return $this->belongsTo(PaymentTerm::class,'payment_term_id');
    }
    public function shipping_term(){
        return $this->belongsTo(ShippingTerm::class,'shipping_term_id');
    }

}
