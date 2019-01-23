<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusLog extends Model {

    protected $fillable = [
        "new_status_id",
        "old_status_id",
        "todoitem_id",
        "status_change_reason"
    ];
    protected $table = "status_log";
    protected $with = ['oldStatus', 'newStatus'];

    public function oldStatus() {
        return $this->hasOne(Status::class, 'id', 'old_status_id');
    }

    public function newStatus() {
        return $this->hasOne(Status::class, 'id', 'new_status_id');
    }

    public function todoItem() {
        return $this->hasOne(TodoItem::class, 'id', 'todoitem_id');
    }
    
}
