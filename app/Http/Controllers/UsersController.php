<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Yajra\Datatables\Facades\Datatables;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(\Auth::user()->id != 1){
            return view('errors.403');
        }

        return view('users.index');
    }

    public function expenditures(){

        if(\Auth::user()->id != 1){
            return redirect('/before_index');
        }else{
            return view('menu_expenditures');
        }
    }

    public function anyData()
    {
        return Datatables::of(User::all())
            ->addColumn('action', function ($data) {
                return '
                    <a href="users/'.$data->id.'/permissions" class="btn btn-warning btn-xs btn-detail open-modal" value="'.$data->id.'">Permissions</a>
                    <a href="users/'.$data->id.'/raohs" class="btn btn-warning btn-xs btn-detail open-modal" value="'.$data->id.'">Raoh</a>
                ';
            })
            ->setRowId(function ($data) {
                return 'row'.$data->id;
            })
            ->make(true);
    }

    public function show()
    {

    }

    public function dashboard(){
        if(\Auth::user()->id != 1){
            return redirect('/before_index');
        }else{
            return view('welcome');
        }
        
    }
}
