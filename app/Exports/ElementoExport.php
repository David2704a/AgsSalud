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

        return [
            AfterSheet::class => function (AfterSheet $event) {
                $fechaActual = Carbon::now()->format('d/m/Y');

                $event->sheet->getColumnDimension('A')->setWidth('33')->setAutoSize(false);
                $event->sheet->getColumnDimension('B')->setWidth('19.5')->setAutoSize(false);
                $event->sheet->getColumnDimension('j')->setWidth('43.5')->setAutoSize(false);
                $event->sheet->getRowDimension(1)->setRowHeight(23);
                $event->sheet->getRowDimension(2)->setRowHeight(25);
                $event->sheet->getRowDimension(4)->setRowHeight(25);
                $event->sheet->getRowDimension(7)->setRowHeight(38);
                $event->sheet->getRowDimension(6)->setRowHeight(0);
                $event->sheet->setTitle('Inventario');

                //combinacion de celdas
                $event->sheet->mergeCells('A1:B5');
                $event->sheet->mergeCells('C1:H2');
                $event->sheet->mergeCells('C3:H4');
                $event->sheet->mergeCells('C5:E5');
                $event->sheet->mergeCells('F5:H5');
                $event->sheet->mergeCells('I1:I5');
                $event->sheet->mergeCells('J1:T5');

                //insercion en las celdas combinadas
                $event->sheet->setCellValue('C1', 'TICS E INNOVACIÓN');
                $event->sheet->setCellValue('C3', 'INVENTARIO DE DISPOSITIVOS TECNOLÓGICOS');
                $event->sheet->setCellValue('C5', 'Código: TEI-F-13 ');
                $event->sheet->setCellValue('F5', 'Versión:03');
                $event->sheet->setCellValue('I1', 'Fecha de Modificación: 31/08/2021');


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
                        'size' => 16, // Tamaño de la fuente
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
                        'size' => 16, // Tamaño de la fuente
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
                        'size' => 16, // Tamaño de la fuente
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
                        'size' => 16, // Tamaño de la fuente
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
                        'size' => 16, // Tamaño de la fuente
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
