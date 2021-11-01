<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Desc;

class DescController extends Controller{

     public function index(){
         $descs = Auth::user()->desc;

         return response() -> json([
            'success' => true,
            'data' => $descs
         ]);
     }

     public function show($id){


         $descs = Auth::user() -> desc() -> find($id);
        
         if(is_null($descs)){
             return response() -> json([
                 'success' => false,
                 'message' => 'Description not found!'
             ], 400);
         }

         return response() -> json([
             'success' => true,
             'data' => $descs -> toArray()
         ], 400);
     }


     public function store(Request $request){
        $this -> validate($request,[
            'title' => 'required',
            'desc' => 'required'
        ]);

        $descs = new Desc();
        $descs -> title = $request -> title;
        $descs -> desc = $request ->desc;

        if(Auth::user() -> desc() -> save($descs)){
            return response() -> json([
                'success' => true,
                'data' => $descs -> toArray()
            ]);
        } else{
            return response() -> json([
                'success' => false,
                'message' => 'Description not added!'
            ], 500);
        }
     }

     public function update(Request $request, $id){
         $descs = Auth::user() -> desc() -> find($id);

         if(is_null($descs)){
             return response() -> json([
                 'success' => false,
                 'message' => 'Description not found!'
             ], 400);
         }

         $newInput = $request -> all();
         $updatedDesc = $descs -> fill($newInput) -> save();

         if($updatedDesc){
             return response() -> json([
                 'success' => true,
                 'message' => 'Description has successfully updated'
             ]);
         } else{
             return response() -> json([
                 'success' => false,
                 'message' => 'Description can not be updated!'
             ], 500);
         }
     }

     public function destroy($id){
        $descs = Auth::user() -> desc() -> find($id);

        if(is_null($descs)){
            return response() -> json([
                'success' => false,
                'message' => 'Description not found'
            ], 400);
        }

        if($descs -> delete()){
            return response() -> json([
                'success' => true,
                'message' => 'Description successfully deleted'
            ]);
        } else{
            return response() -> json([
                'success' => false,
                'message' => 'Description can not be deleted'
            ], 500);
        }
    }
}
