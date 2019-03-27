<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Raod;
use App\Func;
use App\Ooe;
use App\Chrt;
use Yajra\Datatables\Facades\Datatables;


class ChrtsController extends Controller
{
    /**
     * Displays datatables front end view
     *
     * @return \Illuminate\View\View
     */
    public function beforeChrt()
    {


        $chrts = [''=>''] + Chrt::whereIn('factcde', function($query) {
                $query->select('factcode')->from('ooe')->groupBy('factcode');
            })
            ->orderBy('FTITLE','ASC')
            ->lists('FTITLE','FACTCDE')
            ->toArray();

        return view('chrts.beforeChrt',compact('chrts'));
    }

    public function index()
    {

        $account_code = \Request::get('factcde');
        \Session::put('year',\Request::get('year'));

        return view('chrts.index', compact('account_code','raoh'));
    }

    public function anyData()
    {
        $account_code = \Request::get('factcde');
        $year = \Session::get('year');

        $chrts = Chrt::leftjoin('ooe','chrt.FACTCDE','=','ooe.FACTCODE')
            ->leftjoin('raod','raod.FOOECODE','=','ooe.FOOECODE')
            ->leftjoin('raoh','raoh.FRAOCOD','=','raod.FRAOCOD')
            ->leftjoin('func','func.FFUNCCOD','=','raoh.FFUNCCOD')
            ->leftjoin(\DB::raw('(Select FRAOCOD, FOOECODE, sum(FAMOUNT) as FAMOUNT from appd where tyear ='.$year.' group by FRAOCOD,FOOECODE) as appd'), function($join){
                $join->on('raod.FRAOCOD','=','appd.FRAOCOD');
                $join->on('raod.fooecode','=','appd.fooecode');

            })
            ->leftjoin(\DB::raw('(Select FRAOCOD, FOOECODE, sum(FAMOUNT) as FAMOUNT from altd where tyear ='.$year.' group by FRAOCOD,FOOECODE) as altd'), function($join){
                $join->on('raod.FRAOCOD','=','altd.FRAOCOD');
                $join->on('raod.fooecode','=','altd.FOOECODE');

            })
            ->leftjoin(\DB::raw('(Select FRAOCOD, FOOECODE, sum(FAMOUNT) as FAMOUNT from obrd where tyear ='.$year.' group by FRAOCOD,FOOECODE) as obrd'), function($join){
                $join->on('raod.FRAOCOD','=','obrd.FRAOCOD');
                $join->on('raod.fooecode','=','obrd.FOOECODE');

            })
            ->where('ooe.FACTCODE','=',trim($account_code))
            ->where('raod.tyear','=', $year)
            ->where('raoh.tyear','=', $year)
            ->where('chrt.tyear','=', $year)
            ->where('ooe.tyear','=', $year)
            ->select(
                [
                    //'fraodesc', 'raoh.FSOURCOD', 'raoh.ffunccod', 'raoh.FRAOCOD','appd.FAMOUNT as fapprop', 'altd.FAMOUNT as fallot', 'obrd.FAMOUNT as foblig'
                    'ooe.fooedesc as fooedesc',
                    'raoh.FRAODESC as FRAOCOD',
                    'func.FFUNCTION as FFUNCTION',
                    'raoh.FFUNCCOD as FUNCCOD',
                    'appd.FAMOUNT as fapprop',
                    'altd.FAMOUNT as fallot',
                    'obrd.FAMOUNT as foblig'

                ]
            )
            ->groupBy('raoh.FFUNCCOD', 'raoh.tyear')
            ->get();

        return Datatables::of($chrts)
            ->addColumn('balance', function ($raods) {
                return number_format($raods->fapprop - $raods->foblig,2);
            })
            ->editColumn('fraodesc', function ($data) {
                return "<a href='raohs/$data->FRAOCOD/raods'> $data->fraodesc </a>";
            })
            ->editColumn('fapprop', function ($data) {
                return number_format($data->fapprop, 2);
            })
            ->editColumn('fallot', function ($data) {
                return number_format($data->fallot, 2);
            })
            ->editColumn('foblig', function ($data) {
                return number_format($data->foblig, 2);
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
