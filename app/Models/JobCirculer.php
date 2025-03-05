<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobCirculer extends Model
{
    protected $fillable = [
        'emp_id',
        'job_title',
        'description',
        'office_location',
        'area',
        'status',
        'circuler_file',
        'admin_status'
    ];
    public function employer() // Use singular if each circular belongs to one employer
    {
        return $this->belongsTo(Employer::class, 'emp_id', 'id');
    }
}
