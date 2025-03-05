<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $fillable = [
        "user_id","title","content","filename","reply","reply_from", "voic_send", "voic_reply"
        ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
