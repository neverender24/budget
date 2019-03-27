<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Appd;
use App\Func;
use App\Raoh;
use App\Ooe;
use Yajra\Datatables\Facades\Datatables;


class AppdsController extends Controller
{
    /**
     * Displays datatables front end view
     *
     * @return \Illuminate\View\View
     */
    public function index($ffunccod, $fraocod, $fraod)
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
        $ooe = Ooe::where('FOOECODE',$fraod)->first();

        $log = new \App\UserLog;
        $log->user_id = \Auth::user()->id;
        $log->log = "Viewed RAOH ".$fraocod." details ".$fraod." obligations";
        $log->save();

        return view('appds.index', compact('func','raoh', 'fraod','ooe','funcName','funcCode'));
    }

    public function anyData($ffunccod, $fraocod, $fooecode)
    {

        $fields = Appd::leftjoin('apph','appd.refid','=','apph.refid')
            ->where('appd.fraocod','=',$fraocod)
            ->where('appd.fooecode','=',$fooecode)
            ->where('appd.tyear',\Session::get('year'))
            ->where('apph.tyear',\Session::get('year'))
            ->select(
                [
                    'appd.tyear',
                    'appd.FAMOUNT',
                    'appd.FACTCODE',
                    'appd.FOOECODE',
                    'apph.FDATE',
                    'apph.FREMARKS'
                ]
            )
            ->get();


        return Datatables::of($fields)
            ->editColumn('FAMOUNT', function ($data) {
                return number_format($data->FAMOUNT, 2);
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
