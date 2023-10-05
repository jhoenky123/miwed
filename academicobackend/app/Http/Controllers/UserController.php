<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        {

             
             $inputs = $request->input();
             $inputs["password"]= Hash::make(trim($request->password));//encripta elimina los espacios de la contrasena
             $e = User::create($inputs);
             return response()->json([
                 'data'=>$e,
                 'mensaje'=>' Registrado con exito.',
             ]);
         }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $e=User::find($id);
        if (isset($e)){

            return response()->json([
                'data'=>$e,
                'mensaje'=>' Encontrado con exito.',
            ]);
        }else {
            return response()->json([
                'error'=>true,
                'mensaje'=>'No existe.',
            ]);
            
        }

    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $e=User::find($id);
        if (isset($e)){
         $e->fisrt_name= $request->fisrt_name;
         $e->last_name= $request->last_name;
         $e->email= $request->email;
        // $e->password= $request->password;
        $e->password=Hash::make($request->password);
         if ($e->save()) {
             return response()->json([
                 'data'=>$e,
                 'mensaje'=>'Actualizado con exito.',
             ]);
             
             }else {
                 return response()->json([
                     'error'=>true,
                     'mensaje'=>'No se actualizo.',
                 ]);
             }
 
        }else {
         return response()->json([
             'error'=>true,
             'mensaje'=>'No existe el Usuario.',
         ]);
        }
     }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $e=User::find($id);
        if (isset($e)){
            $res=User::destroy($id);
            if ($res) {
                return response()->json([
                    'data'=>$e,
                    'mensaje'=>'Usuario Eliminado.',
                ]);
            }else {
                return response()->json([
                    'data'=>[],
                    'mensaje'=>'No existe el Usuario.',
                ]);
                
            }

            
        }else {
            return response()->json([
                'error'=>true,
                'mensaje'=>'No existe el Usuario.',
            ]);
            
        }
    }
}
