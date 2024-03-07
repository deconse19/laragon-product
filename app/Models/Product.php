<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'company_id',
        'name',
        'price',
        'description',
        'category',
        'stock'

    ];

    public function getNameAttribute($value)
    {
        return ucwords($value);
    }

    // public function getConfirmedAttribute($value)
    // {
    //     return ucwords($value);
    // }

    public function setDescriptionAttribute($value)
    {
        return $this->attributes['description'] = ucfirst($value);
    }

    protected $casts = [

    ];

    

    public function company()
    {

        return $this->belongsTo(Company::class);
    }

    public function transaction(){

        return $this->belongsTo(Transaction::class);
    }
}
