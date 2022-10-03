<?php

namespace App\Models;

use App\Models\SocMed;  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
