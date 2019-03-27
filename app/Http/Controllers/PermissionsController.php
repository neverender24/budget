<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Func;
use App\Raoh;
use App\Permission;
use App\Http\Controllers\Controller;

class PermissionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        if(\Auth::user()->id != 1){
            $this->middleware('403',['only'=>'index']);
        }
    }

    public function index($user_id)
    {
        $offices = Func::select('FFUNCCOD','FFUNCTION','refid')->orderBy('FFUNCTION')->get();

        $permissions = Permission::where('user_id', $user_id)->get();
        return view('users.permissions', compact('offices', 'permissions','user_id'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request, $user_id)
    {
        Permission::where('user_id',$user_id)->delete();
        $checked = \Input::get('funcs');

        $checked_count = count($checked);
        for( $x = 0; $x < $checked_count ; $x++){
            $permission = new Permission();
            $permission->user_id = $user_id;
            $permission->func_id = $checked[$x];
            $permission->save();
        }
        
        return redirect('users');

    }

    public function setRaoh(Request $request, $user_id)
    {


        $data = Raoh::leftjoin('func','raoh.FFUNCCOD','=','func.FFUNCCOD')
        ->leftjoin('permissions','func.refid','=','permissions.func_id')
        ->select('raoh.FRAODESC', 'raoh.FFUNCCOD', 'raoh.refid', 'raoh.tyear', 'permissions.user_id', 'permissions.raoh_id')
        ->where('permissions.user_id','=', $user_id)
        ->distinct('permissions.user_id')
        ->orderBy('fraodesc')
        ->get();
//dd($data);

        $permissions = Permission::where('user_id', $user_id)->get();

        return view('users.raohs', compact('data', 'user_id', 'permissions'));

    }

    public function createRaoh(Request $request, $user_id)
    {
        //dd( $checked = \Input::get('raohs'));
        $raohs = \Input::get('raohs');
        $raohs = serialize($raohs);
        $permission = Permission::where('user_id', $user_id)->update(['raoh_id'=>$raohs]);

        return redirect('users');
    }

    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
