<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;
    protected $primaryKey = 'offer_id';
    protected $fillable = [
        'title',
        'description',
        'image',
        'status',
        'created_by'
    ];
}
