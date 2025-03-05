<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobApplication extends Model
{
    protected $fillable = [
        "user_id","dob","nid","vill","po","ps","district",
        "present_address","qualification","passingyear","jobchoice","jobarea","experience","resume",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
