<?php

namespace App\Exports;

use App\Models\SuperHero;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
// use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use DB;

class DataExport extends DefaultValueBinder implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public $request;

    function __construct($request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        $request = $this->request;

        $hero = SuperHero::with('skill')->get();
        // \Log::info($hero);
        return $hero->map(function($item) {
            return [
                'Nama Hero' => $item->nama,
                'Jenis Kelamin' => $item->jenis_kelamin,
                'skill' => $item->skill->map(function($items){
                    return [
                        'skill' => $items->skill
                    ];
                })
            ];
        });
    }

    public function headings(): array
    {
        return [
            // header
            'Nama Hero',
            'Jenis Kelamin',
            'Skill'
        ];
    }
}


