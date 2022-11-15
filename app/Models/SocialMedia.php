<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
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

    public function getSocmedDateAttribute($date){
        return  $this->attributes['socmed_date'] = Carbon::parse($date)->format('d M Y H:i:s');
    }

    public function getCreatedAtAttribute($date){
        return  $this->attributes['created_at'] = Carbon::parse($date)->format('d M Y H:i:s');
    }
    public function getUpdatedAtAttribute($date){
        return  $this->attributes['updated_at'] = Carbon::parse($date)->format('d M Y H:i:s');
    }
}
