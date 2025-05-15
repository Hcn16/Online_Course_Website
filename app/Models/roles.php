<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\Guard;

use Illuminate\Database\Eloquent\SoftDeletes;

class roles extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded=[];
    public function permission_role(){
        return $this->belongsToMany(permission::class,"permission_roles","role_id", 'permission_id')->withTimestamps();
    }
    public function role_id(){
        return $this->belongsToMany(User::class,'role_user','role_id','user_id');
    }

}
