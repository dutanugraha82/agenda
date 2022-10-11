<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activities extends Model
{
    use HasFactory;
    protected $table = 'activities';
    protected $fillable = ['act_name','act_date','act_address','partisipant','unit_id','act_status'];
    protected $dates = ['created_at'];

    public function Unit(){
       return $this->belongsTo(Unit::class);
    }
}
