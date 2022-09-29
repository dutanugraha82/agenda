<?php

namespace App\Models;

use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocMed extends Model
{
    use HasFactory;
    protected $table = 'unit_social_media';
    protected $fillable = [
        'name_unit_socmed', 'url', 'unit_id',
    ];
    protected $dates = ['created_at'];

    public function Unit(){
       return $this->belongsTo(Unit::class);
    }
}
