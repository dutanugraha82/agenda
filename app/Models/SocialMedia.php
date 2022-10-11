<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    use HasFactory;

    protected $table = 'social_media';
    protected $fillable = [
        'socmed_name',
        'socmed_date',
        'socmed_address',
        'caption',
        'category',
        'socmed_url',
        'socmed_status',
        'unit_id',
        'thumbnail'
    ];

    public function unit(){
        return $this->belongsTo(Unit::class);
    }
}
