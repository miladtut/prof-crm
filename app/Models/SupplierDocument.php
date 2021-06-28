<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SupplierDocument extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = ['id'];
    public function setDocumentAttribute($file){
        $this->attributes['document'] = upload('documents/',$file);
    }
}
