<?php

namespace App\Models;

use App\Models\SocMed;  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Unit extends Model
{
    use HasFactory;
    protected $table  = 'units';
    protected $fillable = [
     'unit_name','url'
     ];
    protected $guarded = [];
    protected $dates = ['created_at'];

    public function socMed(){
       return $this->hasMany(SocMed::class);
    }

    public function website(){
        return $this->hasMany(Website::class);
    }

    public function user(){
        return $this->hasOne(User::class);
    }

    public function getCreatedAtAttribute($date){
        return  $this->attributes['created_at'] = Carbon::parse($date)->format('d M Y H:i:s');
    }
    public function getUpdatedAtAttribute($date){
        return  $this->attributes['updated_at'] = Carbon::parse($date)->format('d M Y H:i:s');
    }

}
