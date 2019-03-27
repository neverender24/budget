<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Obrd;
use App\Func;
use App\Raoh;
use App\Ooe;
use Yajra\Datatables\Facades\Datatables;


class ObrdsController extends Controller
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

        return view('obrds.index', compact('func','raoh', 'fraod','ooe', 'funcName', 'funcCode'));
    }

    public function anyData($ffunccod, $fraocod, $fooecode)
    {

        $fields = Obrd::leftjoin('obrh','obrd.refid','=','obrh.refid')
            ->where('obrd.fraocod','=',$fraocod)
            ->where('obrd.fooecode','=',$fooecode)
            ->leftjoin('vhd2','obrh.FOBRNO','=','vhd2.FALOBNO')
            ->leftjoin('vhh','vhd2.FVOUCHNO','=','vhh.FVOUCHNO')
            ->leftjoin('vhd3','vhh.FVOUCHNO','=','vhd3.FVOUCHNO')
            ->leftjoin('jevh','vhh.FCHKNO','=','jevh.FCHKNO')
            ->where('obrd.tyear',\Session::get('year'))
            ->where('obrh.tyear',\Session::get('year'))
            ->select(
                [
                    'obrd.tyear',
                    'fobrno',
                    'fdate',
                    'obrh.fpayee',
                    'obrh.fpart',
                    'obrh.famount as famount',
                    'vhd2.FVOUCHNO',
                    'vhh.FCHKNO',
                    'vhh.FADVNO',
                    'vhd3.FPONO',
                    'jevh.FJEVNO',
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
