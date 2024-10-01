<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;


    
    // Defina os campos que podem ser preenchidos
    protected $fillable = [
        'name', 
        'description', 
        'address', 
        'complement', 
        'zipcode', 
        'number', 
        'city', 
        'state', 
        'starts_at', 
        'ends_at', 
        'max_subscription', 
        'is_active',
        'owner_id'
    ];
}
