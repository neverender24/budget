<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\User;
use App\Raod;
use App\Func;
use App\Raoh;

class DatatablesController extends Controller
{
    /**
     * Displays datatables front end view
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        return view('datatables.index');
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData($ffunccod = '1011',$fraocod = '5973')
    {

        $raods = Raod::leftjoin('raoh','raod.fraocod','=','raoh.fraocod')
            ->leftjoin('ooe','raod.fooecode','=','ooe.fooecode')
            ->leftjoin('appd', function($join)
            {
                $join->on('ooe.fooecode', '=', 'appd.fooecode');
                $join->on('raoh.fraocod', '=', 'appd.fraocod');

            })
            ->leftjoin('altd', function($join)
            {
                $join->on('ooe.fooecode', '=', 'altd.fooecode');
                $join->on('raoh.fraocod', '=', 'altd.fraocod');

            })
            ->leftjoin('obrd', function($join)
            {
                $join->on('ooe.fooecode', '=', 'obrd.fooecode');
                $join->on('raoh.fraocod', '=', 'obrd.fraocod');

            })
            ->where('raoh.fraocod','=',$fraocod)
            ->select(['appd.FAMOUNT as fapprop'
                    ,'altd.FAMOUNT as fallot'
                    ,'obrd.FAMOUNT as foblig']
            )
            ->orderBy('ooe.fooedesc')->get();

        return Datatables::of($raods)->make(true);
    }
}
