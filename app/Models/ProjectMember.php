<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectMember extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_id',
        'user_id',
        'member_type',
        'status'
    ];

    function user()
    {
        return $this->belongsTo(User::class);
    }

    function project()
    {
        return $this->belongsTo(Project::class);
    }
}
