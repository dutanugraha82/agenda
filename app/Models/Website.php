<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Website extends Model
{
    use HasFactory;

    protected $table = 'websites';
    protected $fillable = ['web_name','web_date','web_address','web_thumbnail','web_document','web_category','web_url','unit_id','web_status','feedback','unit_website_id'];

    public function unit(){
        return $this->belongsTo(Unit::class);
    }

    public function getCreatedAtAttribute($date){
        return  $this->attributes['created_at'] = Carbon::parse($date)->format('d M Y H:i:s');
    }
    public function getUpdatedAtAttribute($date){
        return  $this->attributes['updated_at'] = Carbon::parse($date)->format('d M Y H:i:s');
    }
}
