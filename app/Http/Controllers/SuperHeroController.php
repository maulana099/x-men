<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuperHero;
use App\Models\Skill;
use DataTables;
use App\Exports\DataExport;
use DB;
use PDF;
use Maatwebsite\Excel\Facades\Excel;

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
                $btn = "
                <a href='" . route('xmen.show', $row->id) . "' class='btn btn-primary btn-show'>View Detail</a>
                <a href='" . route('xmen.destroy', $row->id) . "' class='btn btn-danger btn-delete'
                data-type='DESTROY'>Hapus</a>";
                return $btn;
            })
            ->rawColumns(['actions'])
            ->make(true);
        }

        // if (!empty($request)) {
            //     $detail = SuperHero::with('skill')->where('id', $request->id)->first();
            // }
            $detail = SuperHero::with('skill')->first();

            $hero = SuperHero::get();
            $skill = Skill::whereIn('superhero_id', $request)->get();

            return view('superhero.index', [
                'url' => $request->url(),
                'detail' => $detail,
                'hero' => $hero,
                'skill' => $skill
            ]);
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
            $data = new SuperHero;
            $data->nama = $request->nama;
            $data->jenis_kelamin = $request->jenis_kelamin;
            $data->save();

            return redirect()->back()->with('success-hero', 'Hero berhasil di simpan');
        }

        /**
        * Display the specified resource.
        *
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
        public function show($id)
        {
            $data = SuperHero::with('skill')->find($id);
            return view('superhero.detail', compact('data'));
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
            $data = SuperHero::find($id);
            $data->nama = $request->nama;
            $data->jenis_kelamin = $request->jenis_kelamin;
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
            $data = SuperHero::find($id);
            $data->delete();
            // return redirect()->back()->with('success-delete', 'hero berhasil di delete');
        }

        public function export(Request $request){
            return Excel::download(new DataExport($request), 'data-export.xlsx');
        }

        public function exportPdf()
        {
            $data = SuperHero::with('skill')->get();
            $pdf = PDF::loadView('superhero.pdf', compact('data'));
            return $pdf->download('superhero.pdf');
        }

    }
