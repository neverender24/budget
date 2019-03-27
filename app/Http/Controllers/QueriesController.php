<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Func;
use App\Raoh;
use App\Raod;
use App\Fund;


class QueriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $program_id = \Request::get('program_id');
        $funds = [''=>''] + Fund::lists('ffunddes','ffundcode')->toArray();
        $types = [
            '0'=>'',
            '1'=>'PS',
            '2'=>'MOOE',
            '3'=>'CO',
            '4'=>'PROG',
            '5'=>'PROJ',
        ];


        return view('queries.index',compact('funds','types'));
    }

}
