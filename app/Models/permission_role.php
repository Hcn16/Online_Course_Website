<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class permission_role extends Model
{
    use HasFactory;
    public function show_by_id(){
        return $this->hasMany(permission_role::class,"role_id","id");
    }
}
