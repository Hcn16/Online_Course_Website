<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class permission extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function permission_Item(){
        return $this->hasMany(permission::class, 'parent_id');
    }

    
}
