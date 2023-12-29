<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutorial extends Model
{
    public function Category(){
        return $this->belongsTo(TutorialCategory::class, 'category', 'id');
    }
}
