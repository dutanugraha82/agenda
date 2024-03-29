<?php

namespace App\Models;

use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class SocMed extends Model
{
    use HasFactory;
    protected $table = 'unit_social_media';
    protected $fillable = [
        'account_name','social_media' ,'url', 'unit_id',
    ];
    protected $dates = ['created_at'];

    public function Unit(){
       return $this->belongsTo(Unit::class);
    }

    public function getCreatedAtAttribute($date){
        return  $this->attributes['created_at'] = Carbon::parse($date)->format('d M Y H:i:s');
    }
    public function getUpdatedAtAttribute($date){
        return  $this->attributes['updated_at'] = Carbon::parse($date)->format('d M Y H:i:s');
    }
}
