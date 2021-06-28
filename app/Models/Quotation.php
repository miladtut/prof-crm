<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quotation extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded =['id'];
    protected $appends = ['currency_name'];
    public function currency(){
        return $this->belongsTo(Currency::class);
    }
    public function payment(){
        return $this->belongsTo(PaymentTerm::class,'payment_term_id');
    }
    public function shipping(){
        return $this->belongsTo(ShippingTerm::class,'shipping_term_id');
    }
    public function documents(){
        return $this->belongsToMany(Document::class);
    }

    public function spec(){
        return $this->belongsTo(Spec::class);
    }

    public function origin(){
        return $this->belongsTo(Country::class,'origin_id');
    }

    public function inquiry(){
        return $this->belongsTo(Inquiry::class);
    }

    public function getCurrencyNameAttribute(){
        return $this->currency->currency_name;
    }
}
