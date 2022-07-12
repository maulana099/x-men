<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuperHero;
use DataTables;
use DB;

class SuperHeroController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request){
        if ($request->ajax()) {
            DB::statement(DB::raw('set @rownum=0'));
            $data = SuperHero::orderBy('id', 'desc');
            $data->select('*', DB::raw('@rownum := @rownum +1 as rownum'));

            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                $btn = "<a href='#' class='btn btn-primary'>view details</a>
                <a href='#' class='btn btn-danger'>Hapus</a>";
                return $btn;
            })
            ->rawColumns(['actions'])
            ->make(true);
        }

        return view('superhero.index', ['url' => $request->url()]);
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
