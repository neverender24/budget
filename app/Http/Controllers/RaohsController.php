<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Func;
use App\Raoh;
use App\Permission;
use App\UserLog;
use Yajra\Datatables\Facades\Datatables;


class RaohsController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function before_index()
    {
        \Session::put('year',\Request::get('year'));
        \Session::put('type',\Request::get('type'));
        \Session::put('all',\Request::get('all'));

        $func = \Request::get('permission');

        return redirect('funcs/'.trim($func).'/raohs');
    }

    public function index($ffunccod)
    {

        $func = Func::where('FFUNCCOD',$ffunccod)->first();

        $log = new UserLog;
        $log->user_id = \Auth::user()->id;
        $log->log = "Viewed ".$ffunccod." RAOH";
        $log->save();

        if($ffunccod != 0){
            $funcName = trim($func->FFUNCTION);
            $funcCode = trim($func->FFUNCCOD);
        }else{
            $funcName = "";
            $funcCode = 0;
        }

        return view('raohs.index', compact('func', 'funcName', 'funcCode'));
    }

    public function anyData($ffunccod)
    {
        //from before_index
        $year   = \Session::get('year');
        $type   = \Session::get('type');
        $all    = \Session::get('all');

        $permissions = Permission::where('user_id', \Auth::user()->id)->first();


        $raohs = Raoh::leftjoin(\DB::raw('(Select FRAOCOD, sum(FAMOUNT) as FAMOUNT from appd where tyear ='.$year.'  group by FRAOCOD) as appd'),'raoh.FRAOCOD','=','appd.FRAOCOD')
            ->leftjoin(\DB::raw('(Select FRAOCOD, sum(FAMOUNT) as FAMOUNT from altd where tyear = '.$year.' group by FRAOCOD) as altd'),'raoh.FRAOCOD','=','altd.FRAOCOD')
            ->leftjoin(\DB::raw('(Select FRAOCOD, sum(FAMOUNT) as FAMOUNT from obrd where tyear =  '.$year.' group by FRAOCOD) as obrd'),'raoh.FRAOCOD','=','obrd.FRAOCOD')
            ->where('raoh.tyear', $year)
            ->select(
                [
                    'raoh.refid','raoh.tyear','fraodesc', 'raoh.FSOURCOD', 'raoh.ffunccod', 'raoh.FRAOCOD','appd.FAMOUNT as fapprop', 'altd.FAMOUNT as fallot', 'obrd.FAMOUNT as foblig', 'raoh.PRAMOUNT', 'raoh.DateCompleted', 'raoh.ProjectStatus', 'raoh.ProjectRemarks'
                ]
            )
            ->orderBy('fraodesc')
            ->groupBy('raoh.FRAOCOD');

        // if @all checkbox is checked
        // display all function
        if($all == null){
            $raohs->leftjoin('func','raoh.FFUNCCOD','=','func.FFUNCCOD')
                ->leftjoin('permissions','func.refid','=','permissions.func_id')
                ->where('func.FFUNCCOD',trim($ffunccod));
        }

        // filter user permission
        if( !is_null($permissions) ){
            $permissions = unserialize($permissions->raoh_id); 
            if($permissions != false)
            {
                $raohs->where(function($query) use($permissions){
                    foreach($permissions as $p){
                        $query->orWhere('raoh.refid','like','%'.$p.'%');
                    }
                });
            }
        }

        // filter @fraotype
        if($type != ''){
            $raohs->where("FRAOTYPE", $type);
        }

        // final get()
        $raohs = $raohs->get();

        return Datatables::of($raohs)
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
            ->addColumn('balance2', function ($raods) {
                return number_format($raods->fapprop - $raods->fallot,2);
            })
            ->addColumn('balance3', function ($raods) {
                return number_format($raods->fallot - $raods->foblig,2);
            })
            ->editColumn('fraodesc', function ($data) {
                return "<a href='raohs/$data->FRAOCOD/raods'> $data->fraodesc </a>";
            })
            ->editColumn('fapprop', function ($data) {
                $format = number_format($data->fapprop, 2);
                return "<a href='raohs/$data->FRAOCOD/apphs'>$format</a>";
            })
            ->editColumn('fallot', function ($data) {
                $format =  number_format($data->fallot, 2);
                return "<a href='raohs/$data->FRAOCOD/alths'>$format</a>";
            })
            ->editColumn('foblig', function ($data) {
                $format = number_format($data->foblig, 2);
                return "<a href='raohs/$data->FRAOCOD/obrhs'>$format</a>";
            })
            ->editColumn('PRAMOUNT', function ($data) {
                $format = number_format($data->PRAMOUNT, 2);
                return $format;
            })
            ->make(true);
    }

    public function status_report()
    {
        return view('status-report');
    }

    public function anyStatus()
    {
        $query = \DB::select('call STATUS_ASOF("01-23-2016")');
        $query = collect($query);

        return Datatables::of($query)
            ->make(true);

    }
}
