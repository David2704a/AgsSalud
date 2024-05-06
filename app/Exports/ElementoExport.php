<?php

namespace App\Exports;

use App\Models\Elemento;
use Illuminate\Contracts\View\View;
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
use Illuminate\Support\Facades\Storage;


class ElementoExport implements  FromView, ShouldAutoSize, WithEvents ,WithStyles
{


    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
            // dd($this->data);
            $data = [];

            foreach ($this->data as $item) {
                $obj = (object) $item;
                $data[] = $obj;
            }

            // dd($data);
        return view('elementos.elemento.Informes.excel', [
            'elementos' => $data,
        ]);
    }


    public function styles(Worksheet $sheet)
    {
        $styleArray = [
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => ['rgb' => '666699'], // Color de fondo
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

        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getColumnDimension('A')->setWidth('28')->setAutoSize(false);
                $event->sheet->getColumnDimension('B')->setWidth('28')->setAutoSize(false);
                $event->sheet->getColumnDimension('C')->setWidth('20')->setAutoSize(false);
                $event->sheet->getColumnDimension('D')->setWidth('20')->setAutoSize(false);
                $event->sheet->getColumnDimension('E')->setWidth('33')->setAutoSize(false);
                $event->sheet->getColumnDimension('B')->setWidth('19.5')->setAutoSize(false);
                $event->sheet->getColumnDimension('j')->setWidth('20')->setAutoSize(false);
                $event->sheet->getColumnDimension('k')->setWidth('38')->setAutoSize(false);
                $event->sheet->getColumnDimension('i')->setWidth('38')->setAutoSize(false);
                $event->sheet->getColumnDimension('Q')->setWidth('60')->setAutoSize(false);
                $event->sheet->getRowDimension(1)->setRowHeight(23);
                $event->sheet->getRowDimension(2)->setRowHeight(25);
                $event->sheet->getRowDimension(4)->setRowHeight(25);
                $event->sheet->getRowDimension(5)->setRowHeight(20);
                $event->sheet->setTitle('Inventario');

                //combinacion de celdas
                $event->sheet->mergeCells('A1:B5');
                $event->sheet->mergeCells('C1:H2');
                $event->sheet->mergeCells('C3:H4');
                $event->sheet->mergeCells('C5:E5');
                $event->sheet->mergeCells('F5:H5');
                $event->sheet->mergeCells('I1:I5');
                $event->sheet->mergeCells('J1:Q5');

                $event->sheet->mergeCells('A6:A7');
                $event->sheet->mergeCells('B6:B7');
                $event->sheet->mergeCells('C6:C7');
                $event->sheet->mergeCells('D6:D7');
                $event->sheet->mergeCells('E6:E7');
                $event->sheet->mergeCells('F6:I6');
                $event->sheet->mergeCells('J6:K6');
                $event->sheet->mergeCells('L6:L7');
                $event->sheet->mergeCells('L6:L7');
                $event->sheet->mergeCells('M6:M7');
                $event->sheet->mergeCells('N6:N7');
                $event->sheet->mergeCells('O6:O7');
                $event->sheet->mergeCells('P6:P7');
                $event->sheet->mergeCells('Q6:Q7');



                //insercion en las celdas combinadas
                $event->sheet->setCellValue('C1', 'TICS E INNOVACIÓN');
                $event->sheet->setCellValue('C3', 'INVENTARIO DE DISPOSITIVOS TECNOLÓGICOS');
                $event->sheet->setCellValue('C5', 'Código: TEI-F-13 ');
                $event->sheet->setCellValue('F5', 'Versión:03');
                $event->sheet->setCellValue('I1', 'Fecha de Modificación: 31/08/2021');


                $event->sheet->setCellValue('A6', 'ID');
                $event->sheet->setCellValue('B6', 'DISPOSITIVO');
                $event->sheet->setCellValue('C6', 'MARCA');
                $event->sheet->setCellValue('D6', 'REFERENCIA');
                $event->sheet->setCellValue('E6', 'SERIAL');
                $event->sheet->setCellValue('F6', 'CARACTERISTICAS');
                $event->sheet->setCellValue('F7', 'PROCESADOR');
                $event->sheet->setCellValue('G7', 'RAM');
                $event->sheet->setCellValue('H7', 'DISCO DURO');
                $event->sheet->setCellValue('I7', 'TARJETA GRAFICA');
                $event->sheet->setCellValue('J6', 'RESPONSABLE');
                $event->sheet->setCellValue('J7', 'DOCUMENTO');
                $event->sheet->setCellValue('K7', 'NOMBRES Y APELLIDOS');
                $event->sheet->setCellValue('L6', 'FECHA DE COMPRA');
                $event->sheet->setCellValue('M6', 'GARANTIA');
                $event->sheet->setCellValue('N6', 'NUMERO FACTURA');
                $event->sheet->setCellValue('O6', 'PROVEEDOR');
                $event->sheet->setCellValue('P6', 'ESTADO');
                $event->sheet->setCellValue('Q6', 'OBSERVACION');


                // ajustes del encavezado de la tabla o header
                $event->sheet->getStyle('A6:Q7')->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => [
                            'rgb' => '343D7C', // Color azul
                        ],
                    ],'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'], // Color negro
                        ],
                    ],'font' => [
                        'color' => ['rgb' => 'FFFFFF'], // Color blanco
                        'size' => 11, // Tamaño de la letra
                        'bold' => true, // Negrita
                    ],
                ]);








                $style = $event->sheet->getStyle('A1');

                $event->sheet->getStyle('I1')->getAlignment()->setWrapText(true);
                $whiteColor = new Color(Color::COLOR_WHITE);
                $event->sheet->getStyle('7:7')->getFont()->setColor($whiteColor);


                $event->sheet->getStyle('A1:B5')->applyFromArray([
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                    'font' => [
                        'size' => 16, // Tamaño de la fuente
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'], // Color negro
                        ],
                    ],
                ]);

                $event->sheet->getStyle('C1:H2')->applyFromArray([
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                    'font' => [
                        'size' => 18, // Tamaño de la fuente
                        'name' => 'Arial',
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'], // Color negro
                        ],
                    ],
                ]);

                $event->sheet->getStyle('C3:H4')->applyFromArray([
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                    'font' => [
                        'size' => 18, // Tamaño de la fuente
                        'name' => 'Arial',
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'], // Color negro
                        ],
                    ],
                ]);

                $event->sheet->getStyle('C5:E5')->applyFromArray([
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                    'font' => [
                        'size' => 12, // Tamaño de la fuente
                        'italic' => true,
                        'name' => 'Arial',
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'], // Color negro
                        ],
                    ],
                ]);

                $event->sheet->getStyle('F5:H5')->applyFromArray([
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                    'font' => [
                        'size' => 12, // Tamaño de la fuente
                        'italic' => true,
                        'name' => 'Arial',
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'], // Color negro
                        ],
                    ],
                ]);

                $event->sheet->getStyle('I1:I5')->applyFromArray([
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                    'font' => [
                        'size' => 14, // Tamaño de la fuente
                        'italic' => true,
                        'name' => 'Arial', // Fuente Arial
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'], // Color negro
                        ],
                    ],
                ]);

            },
        ];
    }
}
