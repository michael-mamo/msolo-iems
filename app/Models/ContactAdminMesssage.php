<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactAdminMesssage extends Model
{
    public function RecieverInfo(){
        return $this->belongsTo(User::class, 'recieverid', 'id');
    }
    public function SenderInfo(){
        return $this->belongsTo(User::class, 'senderid', 'id');
    }
}
