<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UnitWeb extends Model
{
    use HasFactory;
    protected $table = 'unit_website';
    protected $fillable = ['name','url'];
    protected $dates = ['created_at'];

    public function unit(){
        return $this->belongsTo(Unit::class);
    }

    public function getActDateAttribute($date){
        return  $this->attributes['act_date'] = Carbon::parse($date)->format('d M Y H:i:s');
    }

    public function getCreatedAtAttribute($date){
        return  $this->attributes['created_at'] = Carbon::parse($date)->format('d M Y H:i:s');
    }
    public function getUpdatedAtAttribute($date){
        return  $this->attributes['updated_at'] = Carbon::parse($date)->format('d M Y H:i:s');
    }
}
