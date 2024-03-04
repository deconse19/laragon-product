<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'price',
        'description',
        'category',
        'confirmed'
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

    protected $casts=[

        'confirmed' => 'boolean'

    ];
  
   
    
}
