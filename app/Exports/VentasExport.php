<?php

namespace App\Exports;

use App\Models\Comercio\Venta;
use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Comercio\VentaController;

class VentasExport extends VentaController implements FromView, ShouldAutoSize, WithTitle, WithColumnFormatting 
{
    function __construct($request) {
        $this->request = $request;
    }
    /**
    * @return \Illuminate\Support\Collection
    */


    public function view(): View
    {
       
        $filas = $this->getVentas();

        return view('excel.ventas', [
            'filas' => $filas,
            'rucemisor' => @$_GET['rucemisor'],
            'tipo'=>'retencion'
        ]);
    }

    // public function collection()
    // {
    //     return var_dump($this->request);
    //     $u = User::find(auth()->user()->admin_id);
    //     $ventas = $u->ventas()->tipoDoc($this->request->tipodoc)->where(function ($query)
    //     {

    //     })->orderBy(@$_GET['orderBy'] ? @$_GET['orderBy'] : 'id',@$_GET['orderDesc'] ? @$_GET['orderDesc'] : 'desc')->paginate(@$_GET['perPage'])->get();

    //     return $ventas;
    // }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_TEXT,
            'B' => NumberFormat::FORMAT_TEXT,
            'C' => NumberFormat::FORMAT_TEXT,
            'D' => NumberFormat::FORMAT_TEXT,
            'E' => NumberFormat::FORMAT_TEXT,
            'F' => NumberFormat::FORMAT_NUMBER,
            'G' => NumberFormat::FORMAT_TEXT,
            'H' => NumberFormat::FORMAT_TEXT,
            'I' => NumberFormat::FORMAT_NUMBER,
            'J' => NumberFormat::FORMAT_NUMBER,
            'K' => NumberFormat::FORMAT_NUMBER,
            'L' => NumberFormat::FORMAT_NUMBER,
            'M' => NumberFormat::FORMAT_NUMBER,




        ];
    }

    public function title(): string
    {
        return 'reporte-retenciones';
    }
       
    public function headings(): array
    {
        return [
            ['Title'],
            [
                'col_1',
                'col_2',
                'col_3',
            ]
        ];
    }
        
    }

  
