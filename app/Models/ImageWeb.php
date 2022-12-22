<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageWeb extends Model
{
    use HasFactory;

    protected $table = 'image_website';
    protected $fillable = ['image','websites_id'];
    
     protected function website(){
       return $this->belongsTo(Website::class);
     }
}
