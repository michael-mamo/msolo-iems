<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyReceivable extends Model
{
    public function ReceivableType(){
        return $this->belongsTo(ReceivableType::class, 'receivabletypeid', 'id');
    }
}
