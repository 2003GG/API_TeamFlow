<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'chef_project_id',
        'description',
        'workspace_id',
    ];
    public function workspace(){
        return $this->belongsTo(Workspace::class);
    }
    public function tasks(){
        return $this->hasMany(Task::class);
    }
    public function users(){
        return $this->hasMany(User::class);
    }
    public function chef(){
        return $this->belongsTo(User::class,'chef_project_id');
    }
}
