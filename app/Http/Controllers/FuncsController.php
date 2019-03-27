<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Func;
use App\User;
use App\Permission;

class FuncsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $funcs = Func::paginate(20);

        return view('funcs.index',compact('funcs'));
    }

    public function before_index()
    {
        if(\Auth::user()->role != 'admin') {
            $permissions = Permission::with(['func' => function ($query) {
                $query->select('refid', 'FFUNCCOD', 'FFUNCTION');
            }])
                ->where('user_id', \Auth::user()->id)->get()->lists('func.FFUNCTION', 'func.FFUNCCOD')
                ->toArray();
        }else{
            $permissions = Func::select(\DB::raw('CONCAT(ffunction, " - ", FFUNCCOD) AS offices'), 'FFUNCCOD')->orderBy('ffunction')->lists('offices', 'func.FFUNCCOD');
        }

        return view('funcs.before_index');
    }

}
