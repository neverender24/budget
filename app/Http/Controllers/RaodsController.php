<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Raod;
use App\Func;
use App\Raoh;
use App\UserLog;
use Yajra\Datatables\Facades\Datatables;


class RaodsController extends Controller
{
    /**
     * Displays datatables front end view
     *
     * @return \Illuminate\View\View
     */
    public function index($ffunccod,$fraocod)
    {
        $func = Func::where('FFUNCCOD',$ffunccod)->first();
        
        if($ffunccod != 0){
            $funcName = trim($func->FFUNCTION);
            $funcCode = trim($func->FFUNCCOD);
        }else{
            $funcName = "";
            $funcCode = 0;
        }
        
        $raoh = Raoh::where('FRAOCOD',$fraocod)->first();

        $log = new UserLog;
        $log->user_id = \Auth::user()->id;
        $log->log = "Viewed RAOH ".$fraocod." details ";
        $log->save();

        return view('raods.index', compact('func','raoh', 'funcName', 'funcCode'));
    }

    public function anyData($ffunccod,$fraocod)
    {
        $year = \Session::get('year');

        $raods = Raod::leftjoin('raoh','raod.fraocod','=','raoh.fraocod')
            ->leftjoin('ooe','raod.fooecode','=','ooe.fooecode')
            ->leftjoin(\DB::raw('(Select FRAOCOD, FOOECODE, sum(FAMOUNT) as FAMOUNT from appd where tyear ='.$year.' group by FRAOCOD,FOOECODE) as appd'), function($join)
            {
                $join->on('ooe.fooecode', '=', 'appd.fooecode');
                $join->on('raoh.fraocod', '=', 'appd.fraocod');

            })
            ->leftjoin(\DB::raw('(Select FRAOCOD, FOOECODE, sum(FAMOUNT) as FAMOUNT from altd where tyear ='.$year.' group by FRAOCOD,FOOECODE) as altd'), function($join)
            {
                $join->on('ooe.fooecode', '=', 'altd.fooecode');
                $join->on('raoh.fraocod', '=', 'altd.fraocod');

            })
            ->leftjoin(\DB::raw('(Select FRAOCOD, FOOECODE, sum(FAMOUNT) as FAMOUNT from obrd where tyear ='.$year.' group by FRAOCOD,FOOECODE) as obrd'), function($join)
            {
                $join->on('ooe.fooecode', '=', 'obrd.fooecode');
                $join->on('raoh.fraocod', '=', 'obrd.fraocod');

            })
            ->where('raoh.fraocod','=',$fraocod)
            ->where('ooe.tyear','=',$year)
            ->where('raoh.tyear','=',$year)
            ->where('raod.tyear','=',$year)
            ->select(
                [
                    'raoh.FRAOCOD as fraocod',
                    'ooe.FOOECODE as fooecode',
                    'raod.FACTCODE',
                    'raod.PRAMOUNT',
                    'raod.tyear',
                    'raoh.FSOURCOD',
                    'ooe.FOOEDESC',
                    'appd.FAMOUNT as fapprop',
                    'altd.FAMOUNT as fallot',
                    'obrd.FAMOUNT as foblig'
                ]
            )
            ->orderBy('ooe.fooedesc')
            ->get();


        return Datatables::of($raods)
            ->addColumn('balance', function ($raods) {
                return number_format($raods->fapprop - $raods->foblig,2);
            })
            ->addColumn('balance_percent', function ($raods) { //unutilized approp
                $balance = $raods->fapprop - $raods->foblig;
                if($balance != 0){
                    $newBalance = ($balance/$raods->fapprop)*100;
                }else{
                    $newBalance = $balance;
                }

                return number_format( $newBalance ,2)."%";
            })
            ->addColumn('balance_percent2', function ($raods) { //utilization rate
                if( $raods->foblig != 0){
                    $newBalance =  ($raods->foblig/$raods->fapprop)*100;
                }else{
                    $newBalance = $raods->foblig;
                }

                return number_format( $newBalance ,2)."%";
            })
            ->addColumn('balance', function ($raods) {
                return number_format($raods->fapprop - $raods->foblig,2);
            })
            ->addColumn('balance2', function ($raods) {
                return number_format($raods->fapprop - $raods->fallot,2);
            })
            ->addColumn('balance3', function ($raods) {
                return number_format($raods->fallot - $raods->foblig,2);
            })
            ->editColumn('fapprop', function ($data) {
                $format = number_format($data->fapprop, 2);
                 return "<a href='raods/$data->fooecode/appds'>$format</a>";
            })
            ->editColumn('fallot', function ($data) {
                $format = number_format($data->fallot, 2);
                 return "<a href='raods/$data->fooecode/altds'>$format</a>";
            })
            ->editColumn('foblig', function ($data) {
                $format = number_format($data->foblig, 2);

                return "<a href='raods/$data->fooecode/obrds'>$format</a>";
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
