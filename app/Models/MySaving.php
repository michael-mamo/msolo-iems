<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MySaving extends Model
{
    public function SavingType(){
        return $this->belongsTo(SavingType::class, 'savingtypeid', 'id');
    }
}
