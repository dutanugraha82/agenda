<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    use HasFactory;

    protected $table = 'websites';
    protected $fillable = ['web_name','web_date','web_address','web_thumbnail','web_document','web_type','web_category','web_url','unit_id','web_status'];

    public function unit(){
        return $this->belongsTo(Unit::class);
    }
}
