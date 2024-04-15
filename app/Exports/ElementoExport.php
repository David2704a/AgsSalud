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

class ElementoExport implements  FromView, ShouldAutoSize, WithEvents ,WithStyles
{


    protected $filtros;

    public function __construct($filtros)
    {
        $this->filtros = $filtros;
    }

    public function view(): View
    {
        // Inicializar la consulta sin filtro
        $query = Elemento::query();

        // Aplicar los filtros proporcionados
        foreach ($this->filtros as $clave => $valor) {
            if ($valor) {
                if ($clave === 'idTipoProcedimiento') {
                    // Si es el filtro por idTipoProcedimiento, aplicar la condición en la relación
                    $query->whereHas('procedimiento.tipoProcedimiento', function ($subquery) use ($valor) {
                        $subquery->where('idTipoProcedimiento', $valor);
                    });
                } elseif ($clave === 'idElemento') {
                    // Si es el filtro por nombreProcedimiento, aplicar la condición en el modelo principal
                    $query->where('idElemento', 'like', "%$valor%");
                } else {
                    $query->where($clave, $valor);
                }
            }
        }

        // Obtener los resultados
        $elementos = $query->get();


        return view('elementos.elemento.Informes.excel', [
            'elementos' => $elementos,
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


        Image::make(public_path('imgs/logos/Ags.png'))->resize(330, 130)->save(public_path('imgs/logos/ags-export.png'));
        Image::make(public_path('imgs/logos/iso.png'))->resize(80, 80)->save(public_path('imgs/logos/iso-export.png'));
        Image::make(public_path('imgs/logos/Logo-IQNet.png'))->resize(100, 100)->save(public_path('imgs/logos/iqnet-export.png'));
        Image::make(public_path('imgs/logos/escudo.png'))->resize(80, 80)->save(public_path('imgs/logos/escudo-export.png'));
        Image::make(public_path('imgs/logos/Logo_Enterritorio.png'))->resize(80, 120)->save(public_path('imgs/logos/enterritorio-export.png'));
        Image::make(public_path('imgs/logos/logo_fondo.png'))->resize(100, 100)->save(public_path('imgs/logos/fondo-export.png'));
        Image::make(public_path('imgs/logos/logo-sena.png'))->resize(80, 80)->save(public_path('imgs/logos/sena-export.png'));


        return [
            AfterSheet::class => function (AfterSheet $event) {
                $fechaActual = Carbon::now()->format('d/m/Y');

                $event->sheet->getColumnDimension('A')->setWidth('33')->setAutoSize(false);
                $event->sheet->getColumnDimension('B')->setWidth('19.5')->setAutoSize(false);
                $event->sheet->getRowDimension(1)->setRowHeight(23);
                $event->sheet->getRowDimension(2)->setRowHeight(25);
                $event->sheet->getRowDimension(4)->setRowHeight(25);
                $event->sheet->getRowDimension(7)->setRowHeight(38);
                $event->sheet->setTitle('Inventario');

                //combinacion de celdas
                $event->sheet->mergeCells('A1:B5');
                $event->sheet->mergeCells('C1:H2');
                $event->sheet->mergeCells('C3:H4');
                $event->sheet->mergeCells('C5:E5');
                $event->sheet->mergeCells('F5:H5');
                $event->sheet->mergeCells('I1:I5');
                $event->sheet->mergeCells('J1:O5');

                //insercion en las celdas combinadas
                $event->sheet->setCellValue('C1', 'TICS E INNOVACIÓN');
                $event->sheet->setCellValue('C3', 'INVENTARIO DE DISPOSITIVOS TECNOLÓGICOS');
                $event->sheet->setCellValue('C5', 'Código: TEI-F-13 ');
                $event->sheet->setCellValue('F5', 'Versión:04');
                $event->sheet->setCellValue('I1', 'Fecha de Modificación: 29/11/2023');


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
