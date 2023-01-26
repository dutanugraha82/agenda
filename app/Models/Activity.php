<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;
    protected $table = 'activities';
    protected $fillable = ['feedback','act_name','act_date','act_address','partisipant','unit_id','act_status','type','category','image'];
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
