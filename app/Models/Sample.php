<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sample extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function inquiry(){
        return $this->belongsTo(Inquiry::class);
    }
}
