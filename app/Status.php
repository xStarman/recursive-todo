<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model {

    protected $fillable = [
        "status_name",
        "status_description",
        "color",
        "priority",
        "active",
    ];
    protected $table = "status";
    
    public function scopeActive($sql){
        return $sql->where('active', 1);
    }

}
