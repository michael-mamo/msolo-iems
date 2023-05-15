<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyExpense extends Model
{
    public function ExpenseType(){
        return $this->belongsTo(ExpenseType::class, 'expensetypeid', 'id');
    }
}
