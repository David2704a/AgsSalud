<?php

namespace App\Exports;

use App\Models\Procedimiento;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Intervention\Image\Facades\Image;
use PhpOffice\PhpSpreadsheet\Style\Borders;
use PhpOffice\PhpSpreadsheet\Style\BorderStyle;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Style\Color;

class ProcedimientoExport implements FromView, ShouldAutoSize, WithEvents ,WithStyles
{

    use Exportable;

    protected $filtros;


    public function __construct($filtros)
    {
        $this->filtros = $filtros;
    }



 public function view(): View
   {



    $query = Procedimiento::query();

    // Aplicar los filtros proporcionados
    // foreach ($this->filtros as $clave => $valor) {
    //     if ($valor) {

    //             $query->where($clave, $valor);

    //     }
    // }



    foreach ($this->filtros as $clave => $valor) {
        if ($valor !== null) {
            if ($clave === 'fechaInicio') {
                $fechaInicio = date('Y-m-d', strtotime($valor));
                $query->whereDate('fechaInicio', '>=', $fechaInicio);
            } elseif ($clave === 'fechaFin') {
                $fechaFin = date('Y-m-d', strtotime($valor));
                $query->whereDate('fechaFin', '<=', $fechaFin);
            }elseif ($clave === 'idProcedimiento') {
                $query->where('idProcedimiento', 'like', "%$valor%");
             } else {
                $query->where($clave, $valor);
            }
        }
    }

    $query->where('idTipoProcedimiento', 3);

    // Obtener los resultados

    $procedimientos = $query->get();
    return view('procedimientos.procedimiento.informesP.excel', [
        'procedimientos' => $procedimientos,
    ]);
}



   public function styles(Worksheet $sheet)
   {
       $styleArray = [
           'fill' => [
               'fillType' => Fill::FILL_SOLID,
               'color' => ['rgb' => '01A497'], // Color de fondo
           ],
           'borders' => [
               'allBorders' => [
                   'borderStyle' => Border::BORDER_THIN,
               ],
           ],
           'font' => [
               'name' => 'Arial',
           ],
           'alignment' => [
               'horizontal' => Alignment::HORIZONTAL_CENTER,
               'vertical' => Alignment::VERTICAL_CENTER,
           ],
       ];
   }

   public function registerEvents(): array
   {


       Image::make(public_path('imgs/logos/Ags.png'))->resize(180, 70)->save(public_path('imgs/logos/ags-export.png'));
       Image::make(public_path('imgs/logos/iso.png'))->resize(80, 80)->save(public_path('imgs/logos/iso-export.png'));
       Image::make(public_path('imgs/logos/logo-IQNet.png'))->resize(80, 80)->save(public_path('imgs/logos/iqnet-export.png'));
       Image::make(public_path('imgs/logos/escudo.png'))->resize(80, 80)->save(public_path('imgs/logos/escudo-export.png'));
       Image::make(public_path('imgs/logos/logo_Enterritorio.png'))->resize(100, 80)->save(public_path('imgs/logos/enterritorio-export.png'));
       Image::make(public_path('imgs/logos/logo_fondo.png'))->resize(100, 100)->save(public_path('imgs/logos/fondo-export.png'));
       Image::make(public_path('imgs/logos/logo-sena.png'))->resize(80, 80)->save(public_path('imgs/logos/sena-export.png'));


       return [
           AfterSheet::class => function (AfterSheet $event) {
               $fechaActual = Carbon::now()->format('d/m/Y');

               $event->sheet->getColumnDimension('A')->setWidth('14.5')->setAutoSize(false);
               $event->sheet->getColumnDimension('B')->setWidth('14.5')->setAutoSize(false);
               $event->sheet->getColumnDimension('C')->setWidth('12')->setAutoSize(false);
               $event->sheet->getColumnDimension('D')->setWidth('22')->setAutoSize(false);
               $event->sheet->getColumnDimension('E')->setWidth('12')->setAutoSize(false);
               $event->sheet->getColumnDimension('F')->setWidth('20')->setAutoSize(false);
               $event->sheet->getColumnDimension('G')->setWidth('14.5')->setAutoSize(false);
               $event->sheet->getColumnDimension('H')->setWidth('14.5')->setAutoSize(false);
               $event->sheet->getColumnDimension('I')->setWidth('14.5')->setAutoSize(false);
               $event->sheet->getColumnDimension('J')->setWidth('14.5')->setAutoSize(false);
               $event->sheet->getColumnDimension('K')->setWidth('22')->setAutoSize(false);
               $event->sheet->getRowDimension(1)->setRowHeight(15);
               $event->sheet->getRowDimension(2)->setRowHeight(8);
               $event->sheet->getRowDimension(3)->setRowHeight(15);
               $event->sheet->getRowDimension(4)->setRowHeight(8);
               $event->sheet->getRowDimension(5)->setRowHeight(15);
               $event->sheet->getRowDimension(6)->setRowHeight(8);
               $event->sheet->getRowDimension(7)->setRowHeight(38);
               $event->sheet->setTitle('Prestamos');

               //combinacion de celdas
               $event->sheet->mergeCells('A1:B5');
               $event->sheet->mergeCells('C1:J2');
               $event->sheet->mergeCells('C3:J4');
               $event->sheet->mergeCells('C5:F5');
               $event->sheet->mergeCells('G5:J5');
               $event->sheet->mergeCells('K1:K5');
               $event->sheet->mergeCells('A6:K6');

               //insercion en las celdas combinadas
               $event->sheet->setCellValue('C1', 'TICS Y ELEMENTOS');
               $event->sheet->setCellValue('C3', 'REGISTRO PRESTAMO DE DISPOSITIVOS TECNOLÓGICOS Y ELEMENTOS');
               $event->sheet->setCellValue('C5', 'Código: TEI-F-06 ');
               $event->sheet->setCellValue('G5', 'Versión:04');
               $event->sheet->setCellValue('K1', 'Fecha de Modificación: ' . $fechaActual);


               $event->sheet->getRowDimension(7)->setRowHeight(-1);
               $event->sheet->getStyle('7:7')->getAlignment()->setWrapText(true);
               $event->sheet->getStyle('K1:K5')->getAlignment()->setWrapText(true);
               $event->sheet->getRowDimension(7)->setRowHeight(-1);

               $whiteColor = new Color(Color::COLOR_WHITE);
               $event->sheet->getStyle('7:7')->getFont()->setColor($whiteColor);

               $event->sheet->getStyle('7:7')->getFont()->setSize(10); // Ajusta el tamaño según tus necesidades


               $event->sheet->getStyle('A1:B5')->applyFromArray([
                   'alignment' => [
                       'horizontal' => Alignment::HORIZONTAL_CENTER,
                       'vertical' => Alignment::VERTICAL_CENTER,
                   ],
                   'font' =>  [
                       'size' => 14, // Tamaño de la fuente
                   ],
                   'borders' => [
                       'allBorders' => [
                           'borderStyle' => Border::BORDER_THIN,
                           'color' => ['rgb' => '000000'], // Color negro
                       ],
                   ],
               ]);

               $event->sheet->getStyle('C1:J2')->applyFromArray([
                   'alignment' => [
                       'horizontal' => Alignment::HORIZONTAL_CENTER,
                       'vertical' => Alignment::VERTICAL_CENTER,
                   ],
                   'font' => [
                       'size' => 14, // Tamaño de la fuente
                   ],
                   'borders' => [
                       'allBorders' => [
                           'borderStyle' => Border::BORDER_THIN,
                           'color' => ['rgb' => '000000'], // Color negro
                       ],
                   ],
               ]);

               $event->sheet->getStyle('C3:J4')->applyFromArray([
                   'alignment' => [
                       'horizontal' => Alignment::HORIZONTAL_CENTER,
                       'vertical' => Alignment::VERTICAL_CENTER,
                   ],
                   'font' => [
                       'size' => 14, // Tamaño de la fuente
                   ],
                   'borders' => [
                       'allBorders' => [
                           'borderStyle' => Border::BORDER_THIN,
                           'color' => ['rgb' => '000000'], // Color negro
                       ],
                   ],
               ]);

               $event->sheet->getStyle('C5:F5')->applyFromArray([
                   'alignment' => [
                       'horizontal' => Alignment::HORIZONTAL_CENTER,
                       'vertical' => Alignment::VERTICAL_CENTER,
                   ],
                   'font' => [
                       'size' => 10, // Tamaño de la fuente
                   ],
                   'borders' => [
                       'allBorders' => [
                           'borderStyle' => Border::BORDER_THIN,
                           'color' => ['rgb' => '000000'], // Color negro
                       ],
                   ],
               ]);

               $event->sheet->getStyle('F5:J5')->applyFromArray([
                   'alignment' => [
                       'horizontal' => Alignment::HORIZONTAL_CENTER,
                       'vertical' => Alignment::VERTICAL_CENTER,
                   ],
                   'font' => [
                       'size' => 10, // Tamaño de la fuente
                   ],
                   'borders' => [
                       'allBorders' => [
                           'borderStyle' => Border::BORDER_THIN,
                           'color' => ['rgb' => '000000'], // Color negro
                       ],
                   ],
               ]);

               $event->sheet->getStyle('K1:K5')->applyFromArray([
                   'alignment' => [
                       'horizontal' => Alignment::HORIZONTAL_CENTER,
                       'vertical' => Alignment::VERTICAL_CENTER,
                   ],
                   'font' => [
                       'size' => 10, // Tamaño de la fuente
                   ],
                   'borders' => [
                       'allBorders' => [
                           'borderStyle' => Border::BORDER_THIN,
                           'color' => ['rgb' => '000000'], // Color negro
                       ],
                   ],
               ]);

               //darle estilo al foter
           $lastRow = $event->sheet->getHighestRow();
           $event->sheet->mergeCells('A' . $lastRow . ':K' . $lastRow);

           // Establecer el estilo para la última fila
           $event->sheet->getStyle('A' . $lastRow . ':K' . $lastRow)->applyFromArray([
               'font' => [
                   'bold' => true, // Hacer el texto en negrita
                   'color' => ['rgb' => 'FF0000'], // Color rojo (ajusta según tus necesidades)
               ],
               'fill' => [
                   'fillType' => Fill::FILL_SOLID,
                   'color' => ['rgb' => 'FFFFFF'], // Color de fondo
               ],
               'borders' => [
                   'allBorders' => [
                       'borderStyle' => Border::BORDER_THIN,
                       'color' => ['rgb' => '000000'], // Color negro (ajusta según tus necesidades)
                   ],
               ],
           ]);

           },

       ];
   }


}
