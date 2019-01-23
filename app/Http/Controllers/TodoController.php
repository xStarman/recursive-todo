<?php

namespace App\Http\Controllers;

use App\TodoItem;
use App\StatusLog;
use Illuminate\Http\Request;
use DB;

class TodoController extends Controller {

    private $rules = [
        "parent_id" => "nullable|exists:todoitem,id,active,1",
        "todo_name" => "required",
        "status_id" => "required|exists:status,id,active,1",
        "expected_end_date" => "nullable|date",
    ];

    public function index($todoitem = null) {
        
        if($todoitem){
            $todoItemList = TodoItem::active()->with('history')->with('children')->where('id', $todoitem)->first();
            if(!$todoItemList) return $this->_404();
        }else{
            $todoItemList = TodoItem::active()->whereNull('parent_id')->orderBy('expected_end_date', 'asc')->get();
        }
        return response()->json($todoItemList, 200);
    }

    public function store(Request $request) {
        $this->validate($request, $this->rules);
        try {
            DB::beginTransaction();
            $todoitem = TodoItem::create($request->all());
            DB::commit();
            return response()->json(['error' => false, "data" => $todoitem], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(["error" => true, "message" => $e->getMessage()], 500);
        }
    }

    public function update($todoitem, Request $request) {

        $this->validate($request, $this->rules);

        $todoitem = TodoItem::where('id', $todoitem)->first();
        if (!$todoitem)
            return $this->_404();
        if ($request->get('status_id') <> $todoitem->status_id) {
            $this->validate($request, ["status_change_reason" => "required"]);
            StatusLog::create([
                "new_status_id" => $request->get("status_id"),
                "old_status_id" => $todoitem->status_id,
                "todoitem_id" => $todoitem->id,
                "status_change_reason" => $request->get("status_change_reason")
            ]);
        }
        
        try {
            DB::beginTransaction();
            $todoitem->fill($request->all());
            $todoitem->save();
            DB::commit();
            return response()->json(['error' => false, "data" => $todoitem], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(["error" => true, "message" => $e->getMessage()], 500);
        }
    }

    public function softDelete($todoitem) {

        try {
            $todoitem = TodoItem::where('id', $todoitem)->first();
            if (!$todoitem)
                
            DB::beginTransaction();
            $todoitem->active = false;
            $todoitem->save();
            DB::commit();
            return response()->json(['error' => false, "data" => $todoitem], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(["error" => true, "message" => $e->getMessage()], 500);
        }
    }
    
    private function _404(){
        return response()->json(["error" => true, "message" => 'Unabled to find item with given id'], 404);
    }

}
