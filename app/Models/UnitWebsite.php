<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UnitWebsite extends Model
{
    use HasFactory;

    protected $table = 'unit_website';
    protected $fillable = [
        'name', 'url', 'unit_id'
    ];

    protected $dates = ['created_at'];

    public function unit(){
        return $this->belongsTo(Unit::class);
    }

    public function website(){
        return $this->hasMany(Website::class);
    }

    public function getCreatedAtAttribute($date){
        return  $this->attributes['created_at'] = Carbon::parse($date)->format('d M Y H:i:s');
    }
    public function getUpdatedAtAttribute($date){
        return  $this->attributes['updated_at'] = Carbon::parse($date)->format('d M Y H:i:s');
    }
}
