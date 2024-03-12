<?php

namespace App\Exports;

use App\Models\Docente;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Reader\Xml\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Facades\DB;

class DocenteExport implements FromView, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $docentes = DB::select('
        SELECT
            docentes.*,Nombre_nac,Nombre_ban,
            GROUP_CONCAT(DISTINCT tc.Descripcion_tit ) AS titulos,
            GROUP_CONCAT(DISTINCT dc.Descripcion_com) AS documentos
        FROM
            docentes
        LEFT JOIN
            nacionalidads n  ON docentes.Id_nac = n.Id_nac
        LEFT JOIN
            bancos b  ON docentes.Id_ban = b.Id_ban
        LEFT JOIN
            titulos_complementarios tc ON docentes.Id_doc = tc.Id_doc
        LEFT JOIN
            documentos_complementarios dc ON docentes.Id_doc = dc.Id_doc
        GROUP BY
            docentes.Id_doc
        ');

        return view('docente.excel', [
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
        $sheet->getColumnDimension('F')->setWidth(13); // Establecer el ancho de la columna B a 20
        $sheet->getColumnDimension('G')->setWidth(5); // Establecer el ancho de la columna A a 15
        $sheet->getColumnDimension('H')->setWidth(30); // Establecer el ancho de la columna B a 20
        $sheet->getColumnDimension('I')->setWidth(18); // Establecer el ancho de la columna A a 15
        $sheet->getColumnDimension('J')->setWidth(13); // Establecer el ancho de la columna B a 20
        $sheet->getColumnDimension('K')->setWidth(30); // Establecer el ancho de la columna A a 15
        $sheet->getColumnDimension('L')->setWidth(30); // Establecer el ancho de la columna B a 20
        $sheet->getColumnDimension('M')->setWidth(20); // Establecer el ancho de la columna A a 15
        $sheet->getColumnDimension('N')->setWidth(30); // Establecer el ancho de la columna B a 20
        $sheet->getColumnDimension('O')->setWidth(40); // Establecer el ancho de la columna A a 15
        $sheet->getColumnDimension('P')->setWidth(20);
        $sheet->getColumnDimension('Q')->setWidth(30);
        $sheet->getColumnDimension('R')->setWidth(30);
        $sheet->getColumnDimension('S')->setWidth(15);
        $sheet->getColumnDimension('T')->setWidth(35);
        $sheet->getColumnDimension('U')->setWidth(35);
        $sheet->getColumnDimension('V')->setWidth(25);
        $sheet->getColumnDimension('W')->setWidth(35);
        $sheet->getColumnDimension('X')->setWidth(35);
        $sheet->getColumnDimension('Y')->setWidth(35);
        $sheet->getColumnDimension('Z')->setWidth(35);
        $sheet->getColumnDimension('AA')->setWidth(35);
        $sheet->getColumnDimension('AB')->setWidth(35);
        $sheet->getColumnDimension('AC')->setWidth(35);
        $sheet->getColumnDimension('AD')->setWidth(35);
        $sheet->getColumnDimension('AE')->setWidth(35);
        $sheet->getColumnDimension('AF')->setWidth(35);
        $sheet->getColumnDimension('AG')->setWidth(35);
        $sheet->getColumnDimension('AH')->setWidth(35);
        $sheet->getColumnDimension('AI')->setWidth(35);
        $sheet->getColumnDimension('AJ')->setWidth(35);
        $sheet->getColumnDimension('AK')->setWidth(15);

        $sheet->getStyle($sheet->calculateWorksheetDimension())->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Establecer estilos para la fila de encabezado
        $sheet->getStyle('A1:AK1')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '000000']],
        ]);

        // Más estilos según sea necesario

        return [
            // Puedes agregar más estilos aquí
        ];
    }
}
