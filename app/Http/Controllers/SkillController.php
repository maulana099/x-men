<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skill;
use App\Models\SuperHero;
use DB;
use DataTables;

class SkillController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        // skill view
        if ($request->ajax()) {
            DB::statement(DB::raw('set @rownum=0'));
            $data = Skill::orderBy('id', 'desc');
            $data->select('*', DB::raw('@rownum := @rownum +1 as rownum'));

            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('actions', function ($row) {
                $btn = "
                <a href='" . route('skill.show', $row->id) . "' class='btn btn-primary btn-show-skill'>View Detail</a>";
                return $btn;
            })
            ->rawColumns(['actions'])
            ->make(true);
        }

        return view('superhero.skill', ['url' => $request->url()]);
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
        $data = new Skill;
        $data->superhero_id = $request->superhero_id;
        $data->skill = $request->skill;
        $data->save();
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        $data = Skill::with('superhero')->find($id);
        return view('superhero.detail-skill', compact('data'));
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
        $data = Skill::find($id);
        $data->skill = $request->skill;
        $data->save();
        return redirect()->back();
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $data = Skill::find($id);
        $data->delete();
        return redirect()->back();
    }
}
