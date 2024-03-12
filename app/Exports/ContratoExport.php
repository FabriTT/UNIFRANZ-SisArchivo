<?php

namespace App\Exports;

use App\Models\Contrato;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Reader\Xml\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Facades\DB;

class ContratoExport implements FromView, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $docentes = DB::select('
        select * from docentes d 
        join contratos c 
        on(d.Id_doc=c.Id_doc)
        where Estado_con =1
        ');

        return view('docente.excelContrato', [
            'docentes' => $docentes,
        ]);
    }

    public function styles(Worksheet $sheet)
    {
        // Aplicar estilos a la tabla
        $sheet->getColumnDimension('A')->setWidth(18); // Establecer el ancho de la columna A a 15
        $sheet->getColumnDimension('B')->setWidth(18); // Establecer el ancho de la columna B a 20
        $sheet->getColumnDimension('C')->setWidth(18); // Establecer el ancho de la columna A a 15
        $sheet->getColumnDimension('D')->setWidth(13); // Establecer el ancho de la columna B a 20
        $sheet->getColumnDimension('E')->setWidth(23); // Establecer el ancho de la columna A a 15
        

        $sheet->getStyle($sheet->calculateWorksheetDimension())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Establecer estilos para la fila de encabezado
        $sheet->getStyle('A1:E1')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '000000']],
        ]);

        // Más estilos según sea necesario

        return [
            // Puedes agregar más estilos aquí
        ];
    }
}
