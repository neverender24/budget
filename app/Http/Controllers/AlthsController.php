<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Alth;
use App\Func;
use App\Raoh;
use Yajra\Datatables\Facades\Datatables;


class AlthsController extends Controller
{
    public function index($ffunccod,$fraocod)
    {
        // if(\Auth::user()->func_id != $ffunccod and \Auth::user()->role != 'admin' ){
        //     return view('errors.403');
        // }

        $func = Func::where('FFUNCCOD',$ffunccod)->first();
        if($ffunccod != 0){
            $funcName = trim($func->FFUNCTION);
            $funcCode = trim($func->FFUNCCOD);
        }else{
            $funcName = "";
            $funcCode = 0;
        }

        $raoh = Raoh::where('FRAOCOD',$fraocod)->first();

        $log = new \App\UserLog;
        $log->user_id = \Auth::user()->id;
        $log->log = "Viewed RAOH ".$fraocod." obligations ";
        $log->save();

        return view('alths.index', compact('func','raoh', 'funcName', 'funcCode'));
    }

    public function anyData($ffunccod,$fraocod)
    {
        $fields = Alth::where('fraocod','=',$fraocod)
            ->where('alth.tyear', \Session::get('year'))
            ->select(
                [
                    'alth.tyear',
                    'alth.fdate',
                    'alth.famount',
                    'alth.fremarks',
                ]
            )
            ->get();

        return Datatables::of($fields)
            ->editColumn('famount', function ($data) {
                return number_format($data->famount, 2);
            })
            ->make(true);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
