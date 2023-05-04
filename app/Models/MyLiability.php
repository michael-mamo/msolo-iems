<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyLiability extends Model
{
    public function LiabilityType(){
        return $this->belongsTo(LiabilityType::class, 'liabilitytypeid', 'id');
    }
}
