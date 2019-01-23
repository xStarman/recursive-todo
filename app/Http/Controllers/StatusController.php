<?php

namespace App\Http\Controllers;

use App\TodoItem;
use App\Status;
use DB;
use Illuminate\Http\Request;

class StatusController extends Controller {
    public function index() {
        $status = Status::active()->get();
        return response()->json($status, 200);
    }

    public function store(Request $request) {
        $this->validate($request, [
            "status_name" => "required",
        ]);

        try {
            DB::beginTransaction();
            $status = Status::create($request->all());
            DB::commit();
            return response()->json(['error' => false, "data" => $status], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(["error" => true, "message" => $e->getMessage()], 500);
        }
    }

    public function update($status, Request $request) {
        $this->validate($request, [
            "status_name" => "required",
        ]);

        try {
            $status = Status::where('id', $status)->first();
            if(!$status) return $this->_404 ();
            DB::beginTransaction();
            $status->fill($request->all());
            $status->save();
            DB::commit();
            return response()->json(['error' => false, "data" => $status], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(["error" => true, "message" => $e->getMessage()], 500);
        }
    }
    
    public function softDelete($status){

        try {
            $status = Status::where('id', $status)->first();
            if(!$status) return $this->_404 ();
            DB::beginTransaction();
            $status->active = false;
            $status->save();
            DB::commit();
            return response()->json(['error' => false, "data" => $status], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(["error" => true, "message" => $e->getMessage()], 500);
        }
    }
    
     private function _404(){
        return response()->json(["error" => true, "message" =>  'Unabled to find status with given id'], 404);
    }

}
