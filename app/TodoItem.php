<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TodoItem extends Model {

    protected $fillable = [
        "parent_id",
        "todo_name",
        "todo_description",
        "expected_end_date",
        "active",
        "status_id"
    ];
    protected $table = "todoitem";
    protected $with = ['status'];
    
    public function parent() {
        return $this->belongsTo(TodoItem::class, 'parent_id', 'id');
    }

    public function children() {
        return $this->hasMany(TodoItem::class, 'parent_id', 'id');
    }
    
    public function status(){
        return $this->belongsTo(Status::class)->orderBy('status.priority','asc');
    }
    
    public function history(){
        return $this->hasMany(StatusLog::class, 'todoitem_id', 'id');
    }
    public function scopeActive($sql){
        return $sql->where('active', 1);
    }
    

}
