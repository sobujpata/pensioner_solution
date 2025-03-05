<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BafCircular extends Model
{
    protected $fillable = [
        "name",
        "file_url",
        "subject",
        "published_on",
        "remarks",
    ];
}
