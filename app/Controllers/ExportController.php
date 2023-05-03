<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Shared\File;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Controllers;
use App\Models\Ollas;
use App\Models\OllasSimple;
use App\Models\Junta;
use App\Models\Distritos;

Class ExportController extends Controller {
    
    

    public function ExporTotal($request, $response, $args) {

        $data = Ollas::select('tb_ollas_excel.*', 'tb_distritos.distrito as nomdis')
                        ->join('tb_distritos', 'tb_ollas_excel.distrito', '=', 'tb_distritos.idDist')
                        ->where('tb_ollas_excel.estado', '=', 2)
                        ->orderBy('tb_ollas_excel.id', 'ASC')->get();

        $styleArray = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ];

        $styleArrayHead = [
            'font' => [
                'bold' => true,
                'size' => 13,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ];

        $spreadsheet = new Spreadsheet();


        $sheet = $spreadsheet->getActiveSheet();

         $sheet->setCellValue('A1', 'Distrito ')->getColumnDimension('A')->setWidth(40);
        $sheet->setCellValue('B1', 'Zona/Eje')->getColumnDimension('B')->setWidth(30);
        $sheet->setCellValue('C1', 'AAHH')->getColumnDimension('C')->setWidth(40);
        $sheet->setCellValue('D1', '¿Dónde se ubica la olla común?')->getColumnDimension('D')->setWidth(50);
        $sheet->setCellValue('E1', 'Nombre de la olla común')->getColumnDimension('E')->setWidth(50);
        $sheet->setCellValue('F1', '¿Cuentan con padrones?')->getColumnDimension('F')->setWidth(25);
        $sheet->setCellValue('G1', 'Cuentan con Comedor Popular/Vaso de Leche')->getColumnDimension('G')->setWidth(25);
        
        $sheet->setCellValue('H1', '¿Cuentan con Comité anticovid o articulan con MINSA?')->getColumnDimension('H')->setWidth(25);
        $sheet->setCellValue('I1', 'Nombre de contacto principal')->getColumnDimension('I')->setWidth(25);
        $sheet->setCellValue('J1', 'Cargo de contacto principal*')->getColumnDimension('J')->setWidth(25);
        $sheet->setCellValue('K1', 'Celular de contacto principal')->getColumnDimension('K')->setWidth(30);
        $sheet->setCellValue('L1', 'Nombre de contacto secundario')->getColumnDimension('L')->setWidth(40);
        $sheet->setCellValue('M1', 'Cargo de contacto secundario')->getColumnDimension('M')->setWidth(25);
        $sheet->setCellValue('N1', 'Celular de contacto secundario')->getColumnDimension('N')->setWidth(45);
        $sheet->setCellValue('O1', 'Acceso a agua')->getColumnDimension('O')->setWidth(25);
        $sheet->setCellValue('P1', 'Acceso a luz')->getColumnDimension('P')->setWidth(30);
        
        $sheet->setCellValue('Q1', '¿Cuenta con la presencia de la Municipalidad distrital ?')->getColumnDimension('Q')->setWidth(35);
        $sheet->setCellValue('R1', 'Tipo de espacio usado para la olla común')->getColumnDimension('R')->setWidth(35);

        $sheet->setCellValue('S1', 'Estado del espacio usado para la olla común')->getColumnDimension('S')->setWidth(25);
        $sheet->setCellValue('T1', 'Tipo de combustible usado para la olla común')->getColumnDimension('T')->setWidth(25);
        $sheet->setCellValue('U1', 'En el espacio de la olla común cuentan con: ¿Techo en buen estado?')->getColumnDimension('U')->setWidth(25);
        $sheet->setCellValue('V1', 'En el espacio de la olla común cuentan con: ¿Punto de lavado?')->getColumnDimension('V')->setWidth(25);
        $sheet->setCellValue('W1', '¿Reciben o cuentan con KITS de Higiene?')->getColumnDimension('W')->setWidth(25);
        $sheet->setCellValue('X1', '¿Cuenta con los equipos e instrumentos necesarios para implementar la olla?')->getColumnDimension('X')->setWidth(25);
        $sheet->setCellValue('Y1', '¿Cómo obtiene insumos para la olla común?')->getColumnDimension('Y')->setWidth(25);

        $sheet->setCellValue('Z1', '¿Cuál es el nombre de la organización que los ayuda?')->getColumnDimension('Z')->setWidth(60);
        $sheet->setCellValue('AA1', '¿Cuántos días a la semana atiende la olla común?')->getColumnDimension('AA')->setWidth(15);
        $sheet->setCellValue('AB1', '¿Cuántas comidas al día prepara la olla común?')->getColumnDimension('AB')->setWidth(50);
        $sheet->setCellValue('AC1', 'Número de raciones que distribuye')->getColumnDimension('AC')->setWidth(25);
        $sheet->setCellValue('AD1', 'Precio por ración')->getColumnDimension('AD')->setWidth(25);
        $sheet->setCellValue('AE1', '¿Cuántas raciones del total son pagadas?')->getColumnDimension('AE')->setWidth(25);
        $sheet->setCellValue('AF1', 'Zonas a las cuales beneficia la olla común')->getColumnDimension('AF')->setWidth(40);
        $sheet->setCellValue('AG1', 'Número de familias beneficiadas')->getColumnDimension('AG')->setWidth(25);
        
        $sheet->setCellValue('AH1', 'Número de niños beneficiados (Menores de 5 años)')->getColumnDimension('AH')->setWidth(25);
        $sheet->setCellValue('AI1', 'Número de adultos mayores beneficiados (Mayores de 60 años)')->getColumnDimension('AI')->setWidth(25);
        $sheet->setCellValue('AJ1', 'Número de personas discapacitadas beneficiadas')->getColumnDimension('AJ')->setWidth(25);
        $sheet->setCellValue('AK1', 'Número de mujeres embarazadas beneficiadas')->getColumnDimension('AK')->setWidth(25);
        $sheet->setCellValue('AL1', 'Número de personas con enfermedades crónicas beneficiadas')->getColumnDimension('AL')->setWidth(25);
        $sheet->setCellValue('AM1', 'Número total de personas beneficiadas')->getColumnDimension('AM')->setWidth(25);
        $sheet->setCellValue('AN1', 'Agrega alguna observación')->getColumnDimension('AN')->setWidth(40);
        
         $sheet->setCellValue('AO1', 'Población Migrante extranjera')->getColumnDimension('AO')->setWidth(25);
         $sheet->setCellValue('AP1', '¿Tienen interés en tener un huerto en la comunidad?')->getColumnDimension('AP')->setWidth(25);
         $sheet->setCellValue('AQ1', '¿En la comunidad cuentan con espacio comunitario para la implementación?')->getColumnDimension('AQ')->setWidth(25);
         $sheet->setCellValue('AR1', '"¿La comunidad cuenta con personas que podrían asumir el liderazgo de un proyecto de este tipo?')->getColumnDimension('AR')->setWidth(25);
         $sheet->setCellValue('AS1', '¿Han recibido capacitaciones sobre la inocuidad para la preparación de los alimentos?')->getColumnDimension('AS')->setWidth(25);
         $sheet->setCellValue('AT1', '¿Han recibido capacitaciones sobre protocolos sanitarios?')->getColumnDimension('AT')->setWidth(25);
         $sheet->setCellValue('AU1', '¿Han recibido otro tipo de capacitaciones?')->getColumnDimension('AU')->setWidth(25);
         $sheet->setCellValue('AV1', 'Latitud')->getColumnDimension('AV')->setWidth(25);
         $sheet->setCellValue('AW1', 'Longitud')->getColumnDimension('AW')->setWidth(25);
         $sheet->setCellValue('AX1', 'Fecha de registro')->getColumnDimension('AX')->setWidth(25);


        $spreadsheet->getActiveSheet()->getStyle('A1:AX1')->applyFromArray($styleArrayHead);


        $row = 2;
        $startRow = -1;
        $previousKey = '';
        foreach ($data as $index => $value) {
            if ($startRow == -1) {
                $startRow = $row;
                $previousKey = $value['id'];
            }
           $sheet->setCellValue('A' . $row, $value['nomdis']);
            $sheet->setCellValue('B' . $row, $value['zona']);
            $sheet->setCellValue('C' . $row, $value['aahh']);
            $sheet->setCellValue('D' . $row, $value['ubicacion']);
            $sheet->setCellValue('E' . $row, $value['nombre_olla']);
            $sheet->setCellValue('F' . $row, $value['padrones']);
            $sheet->setCellValue('G' . $row, $value['comedorpopular']);
            
            $sheet->setCellValue('H' . $row, $value['comite']);
            $sheet->setCellValue('I' . $row, $value['nombre_contacto']);
            $sheet->setCellValue('J' . $row, $value['cargo_contacto']);
            $sheet->setCellValue('K' . $row, $value['celular_contacto']);
            $sheet->setCellValue('L' . $row, $value['nombre_contacto_secundario']);
            $sheet->setCellValue('M' . $row, $value['cargo_contacto_secundario']);
            $sheet->setCellValue('N' . $row, $value['celular_contacto_secundario']);
            $sheet->setCellValue('O' . $row, $value['agua']);
             $sheet->setCellValue('P' . $row, $value['luz']);
            $sheet->setCellValue('Q' . $row, $value['presencia_muni']);
            
            $sheet->setCellValue('R' . $row, $value['tipo_espacio']);
            $sheet->setCellValue('S' . $row, $value['estado_espacio']);
            $sheet->setCellValue('T' . $row, $value['combustible']);
            $sheet->setCellValue('U' . $row, $value['techo']);
            $sheet->setCellValue('V' . $row, $value['lavado']);
            $sheet->setCellValue('W' . $row, $value['higiene']);
            $sheet->setCellValue('X' . $row, $value['instrumentos']);
            $sheet->setCellValue('Y' . $row, $value['insumos']);
            $sheet->setCellValue('Z' . $row, $value['org_ayuda']);

            $sheet->setCellValue('AA' . $row, $value['dias_atencion']);
            $sheet->setCellValue('AB' . $row, $value['comidas_dia']);
            $sheet->setCellValue('AC' . $row, $value['raciones']);
            $sheet->setCellValue('AD' . $row, $value['precio_racion']);
            $sheet->setCellValue('AE' . $row, $value['raciones_pagadas']);
            $sheet->setCellValue('AF' . $row, $value['zonas_beneficiadas']);
            $sheet->setCellValue('AG' . $row, $value['familias_beneficiadas']);
            $sheet->setCellValue('AH' . $row, $value['ninos_beneficiadas']);
            
            $sheet->setCellValue('AI' . $row, $value['adultos_beneficiadas']);
            $sheet->setCellValue('AJ' . $row, $value['disca_beneficiadas']);
            $sheet->setCellValue('AK' . $row, $value['emba_beneficiadas']);
            $sheet->setCellValue('AL' . $row, $value['enfercro_beneficiadas']);
            $sheet->setCellValue('AM' . $row, $value['total_beneficiadas']);
            $sheet->setCellValue('AN' . $row, $value['observaciones']);
            $sheet->setCellValue('AO' . $row, $value['extranjera']);
            $sheet->setCellValue('AP' . $row, $value['huerto']);
            $sheet->setCellValue('AQ' . $row, $value['espacio_huerto']);
            $sheet->setCellValue('AR' . $row, $value['liderazgo']);
            $sheet->setCellValue('AS' . $row, $value['inocuidad']);
            $sheet->setCellValue('AT' . $row, $value['protocolos']);
            $sheet->setCellValue('AU' . $row, $value['otro_cap']);
            $sheet->setCellValue('AV' . $row, $value['latitud']);
            $sheet->setCellValue('AW' . $row, $value['longitud']);
            $sheet->setCellValue('AX' . $row, $value['created_at']);
            
            $spreadsheet->getActiveSheet()->getStyle('A' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('B' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('C' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('D' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('E' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('F' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('G' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('H' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('I' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('J' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('K' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('L' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('M' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('N' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('O' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('P' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('Q' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('R' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('S' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('T' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('U' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('V' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('W' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('X' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('Y' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('Z' . $row)->applyFromArray($styleArray);
            
            $spreadsheet->getActiveSheet()->getStyle('AA' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AB' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AC' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AD' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AE' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AF' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AG' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AH' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AI' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AJ' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AK' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AL' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AM' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AN' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AO' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AP' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AQ' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AR' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AS' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AT' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AU' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AV' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AW' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AX' . $row)->applyFromArray($styleArray);

            $row++;
        }

        $excelWriter = new Xlsx($spreadsheet);

        $tempFile = tempnam(File::sysGetTempDir(), 'phpxltmp');
        $tempFile = $tempFile ?: __DIR__ . '/temp.xlsx';
        $excelWriter->save($tempFile);


        $response = $response->withHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response = $response->withHeader('Content-Disposition', 'attachment; filename="OllasComunes.xlsx"');

        $stream = fopen($tempFile, 'r+');

        return $response->withBody(new \Slim\Http\Stream($stream));
    }

     public function ExporDesactivadas($request, $response, $args) {

        $data = Ollas::select('tb_ollas_excel.*', 'tb_distritos.distrito as nomdis')
                        ->join('tb_distritos', 'tb_ollas_excel.distrito', '=', 'tb_distritos.idDist')
                        ->where('tb_ollas_excel.estado', '=', 3)
                        ->orderBy('tb_ollas_excel.id', 'ASC')->get();

        $styleArray = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ];

        $styleArrayHead = [
            'font' => [
                'bold' => true,
                'size' => 13,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ];

        $spreadsheet = new Spreadsheet();


        $sheet = $spreadsheet->getActiveSheet();

         $sheet->setCellValue('A1', 'Distrito ')->getColumnDimension('A')->setWidth(40);
        $sheet->setCellValue('B1', 'Zona/Eje')->getColumnDimension('B')->setWidth(30);
        $sheet->setCellValue('C1', 'AAHH')->getColumnDimension('C')->setWidth(40);
        $sheet->setCellValue('D1', '¿Dónde se ubica la olla común?')->getColumnDimension('D')->setWidth(50);
        $sheet->setCellValue('E1', 'Nombre de la olla común')->getColumnDimension('E')->setWidth(50);
        $sheet->setCellValue('F1', '¿Cuentan con padrones?')->getColumnDimension('F')->setWidth(25);
        $sheet->setCellValue('G1', 'Cuentan con Comedor Popular/Vaso de Leche')->getColumnDimension('G')->setWidth(25);
        
        $sheet->setCellValue('H1', '¿Cuentan con Comité anticovid o articulan con MINSA?')->getColumnDimension('H')->setWidth(25);
        $sheet->setCellValue('I1', 'Nombre de contacto principal')->getColumnDimension('I')->setWidth(25);
        $sheet->setCellValue('J1', 'Cargo de contacto principal*')->getColumnDimension('J')->setWidth(25);
        $sheet->setCellValue('K1', 'Celular de contacto principal')->getColumnDimension('K')->setWidth(30);
        $sheet->setCellValue('L1', 'Nombre de contacto secundario')->getColumnDimension('L')->setWidth(40);
        $sheet->setCellValue('M1', 'Cargo de contacto secundario')->getColumnDimension('M')->setWidth(25);
        $sheet->setCellValue('N1', 'Celular de contacto secundario')->getColumnDimension('N')->setWidth(45);
        $sheet->setCellValue('O1', 'Acceso a agua')->getColumnDimension('O')->setWidth(25);
        $sheet->setCellValue('P1', 'Acceso a luz')->getColumnDimension('P')->setWidth(30);
        
        $sheet->setCellValue('Q1', '¿Cuenta con la presencia de la Municipalidad distrital ?')->getColumnDimension('Q')->setWidth(35);
        $sheet->setCellValue('R1', 'Tipo de espacio usado para la olla común')->getColumnDimension('R')->setWidth(35);

        $sheet->setCellValue('S1', 'Estado del espacio usado para la olla común')->getColumnDimension('S')->setWidth(25);
        $sheet->setCellValue('T1', 'Tipo de combustible usado para la olla común')->getColumnDimension('T')->setWidth(25);
        $sheet->setCellValue('U1', 'En el espacio de la olla común cuentan con: ¿Techo en buen estado?')->getColumnDimension('U')->setWidth(25);
        $sheet->setCellValue('V1', 'En el espacio de la olla común cuentan con: ¿Punto de lavado?')->getColumnDimension('V')->setWidth(25);
        $sheet->setCellValue('W1', '¿Reciben o cuentan con KITS de Higiene?')->getColumnDimension('W')->setWidth(25);
        $sheet->setCellValue('X1', '¿Cuenta con los equipos e instrumentos necesarios para implementar la olla?')->getColumnDimension('X')->setWidth(25);
        $sheet->setCellValue('Y1', '¿Cómo obtiene insumos para la olla común?')->getColumnDimension('Y')->setWidth(25);

        $sheet->setCellValue('Z1', '¿Cuál es el nombre de la organización que los ayuda?')->getColumnDimension('Z')->setWidth(60);
        $sheet->setCellValue('AA1', '¿Cuántos días a la semana atiende la olla común?')->getColumnDimension('AA')->setWidth(15);
        $sheet->setCellValue('AB1', '¿Cuántas comidas al día prepara la olla común?')->getColumnDimension('AB')->setWidth(50);
        $sheet->setCellValue('AC1', 'Número de raciones que distribuye')->getColumnDimension('AC')->setWidth(25);
        $sheet->setCellValue('AD1', 'Precio por ración')->getColumnDimension('AD')->setWidth(25);
        $sheet->setCellValue('AE1', '¿Cuántas raciones del total son pagadas?')->getColumnDimension('AE')->setWidth(25);
        $sheet->setCellValue('AF1', 'Zonas a las cuales beneficia la olla común')->getColumnDimension('AF')->setWidth(40);
        $sheet->setCellValue('AG1', 'Número de familias beneficiadas')->getColumnDimension('AG')->setWidth(25);
        
        $sheet->setCellValue('AH1', 'Número de niños beneficiados (Menores de 5 años)')->getColumnDimension('AH')->setWidth(25);
        $sheet->setCellValue('AI1', 'Número de adultos mayores beneficiados (Mayores de 60 años)')->getColumnDimension('AI')->setWidth(25);
        $sheet->setCellValue('AJ1', 'Número de personas discapacitadas beneficiadas')->getColumnDimension('AJ')->setWidth(25);
        $sheet->setCellValue('AK1', 'Número de mujeres embarazadas beneficiadas')->getColumnDimension('AK')->setWidth(25);
        $sheet->setCellValue('AL1', 'Número de personas con enfermedades crónicas beneficiadas')->getColumnDimension('AL')->setWidth(25);
        $sheet->setCellValue('AM1', 'Número total de personas beneficiadas')->getColumnDimension('AM')->setWidth(25);
        $sheet->setCellValue('AN1', 'Agrega alguna observación')->getColumnDimension('AN')->setWidth(40);
        
         $sheet->setCellValue('AO1', 'Población Migrante extranjera')->getColumnDimension('AO')->setWidth(25);
         $sheet->setCellValue('AP1', '¿Tienen interés en tener un huerto en la comunidad?')->getColumnDimension('AP')->setWidth(25);
         $sheet->setCellValue('AQ1', '¿En la comunidad cuentan con espacio comunitario para la implementación?')->getColumnDimension('AQ')->setWidth(25);
         $sheet->setCellValue('AR1', '"¿La comunidad cuenta con personas que podrían asumir el liderazgo de un proyecto de este tipo?')->getColumnDimension('AR')->setWidth(25);
         $sheet->setCellValue('AS1', '¿Han recibido capacitaciones sobre la inocuidad para la preparación de los alimentos?')->getColumnDimension('AS')->setWidth(25);
         $sheet->setCellValue('AT1', '¿Han recibido capacitaciones sobre protocolos sanitarios?')->getColumnDimension('AT')->setWidth(25);
         $sheet->setCellValue('AU1', '¿Han recibido otro tipo de capacitaciones?')->getColumnDimension('AU')->setWidth(25);
         $sheet->setCellValue('AV1', 'Latitud')->getColumnDimension('AV')->setWidth(25);
         $sheet->setCellValue('AW1', 'Longitud')->getColumnDimension('AW')->setWidth(25);
         $sheet->setCellValue('AX1', 'Fecha de registro')->getColumnDimension('AX')->setWidth(25);
         
        $spreadsheet->getActiveSheet()->getStyle('A1:AW1')->applyFromArray($styleArrayHead);

        $row = 2;
        $startRow = -1;
        $previousKey = '';
        foreach ($data as $index => $value) {
            if ($startRow == -1) {
                $startRow = $row;
                $previousKey = $value['id'];
            }
           $sheet->setCellValue('A' . $row, $value['nomdis']);
            $sheet->setCellValue('B' . $row, $value['zona']);
            $sheet->setCellValue('C' . $row, $value['aahh']);
            $sheet->setCellValue('D' . $row, $value['ubicacion']);
            $sheet->setCellValue('E' . $row, $value['nombre_olla']);
            $sheet->setCellValue('F' . $row, $value['padrones']);
            $sheet->setCellValue('G' . $row, $value['comedorpopular']);
            
            $sheet->setCellValue('H' . $row, $value['comite']);
            $sheet->setCellValue('I' . $row, $value['nombre_contacto']);
            $sheet->setCellValue('J' . $row, $value['cargo_contacto']);
            $sheet->setCellValue('K' . $row, $value['celular_contacto']);
            $sheet->setCellValue('L' . $row, $value['nombre_contacto_secundario']);
            $sheet->setCellValue('M' . $row, $value['cargo_contacto_secundario']);
            $sheet->setCellValue('N' . $row, $value['celular_contacto_secundario']);
            $sheet->setCellValue('O' . $row, $value['agua']);
             $sheet->setCellValue('P' . $row, $value['luz']);
            $sheet->setCellValue('Q' . $row, $value['presencia_muni']);
            
            $sheet->setCellValue('R' . $row, $value['tipo_espacio']);
            $sheet->setCellValue('S' . $row, $value['estado_espacio']);
            $sheet->setCellValue('T' . $row, $value['combustible']);
            $sheet->setCellValue('U' . $row, $value['techo']);
            $sheet->setCellValue('V' . $row, $value['lavado']);
            $sheet->setCellValue('W' . $row, $value['higiene']);
            $sheet->setCellValue('X' . $row, $value['instrumentos']);
            $sheet->setCellValue('Y' . $row, $value['insumos']);
            $sheet->setCellValue('Z' . $row, $value['org_ayuda']);

            $sheet->setCellValue('AA' . $row, $value['dias_atencion']);
            $sheet->setCellValue('AB' . $row, $value['comidas_dia']);
            $sheet->setCellValue('AC' . $row, $value['raciones']);
            $sheet->setCellValue('AD' . $row, $value['precio_racion']);
            $sheet->setCellValue('AE' . $row, $value['raciones_pagadas']);
            $sheet->setCellValue('AF' . $row, $value['zonas_beneficiadas']);
            $sheet->setCellValue('AG' . $row, $value['familias_beneficiadas']);
            $sheet->setCellValue('AH' . $row, $value['ninos_beneficiadas']);
            
            $sheet->setCellValue('AI' . $row, $value['adultos_beneficiadas']);
            $sheet->setCellValue('AJ' . $row, $value['disca_beneficiadas']);
            $sheet->setCellValue('AK' . $row, $value['emba_beneficiadas']);
            $sheet->setCellValue('AL' . $row, $value['enfercro_beneficiadas']);
            $sheet->setCellValue('AM' . $row, $value['total_beneficiadas']);
            $sheet->setCellValue('AN' . $row, $value['observaciones']);
            $sheet->setCellValue('AO' . $row, $value['extranjera']);
            $sheet->setCellValue('AP' . $row, $value['huerto']);
            $sheet->setCellValue('AQ' . $row, $value['espacio_huerto']);
            $sheet->setCellValue('AR' . $row, $value['liderazgo']);
            $sheet->setCellValue('AS' . $row, $value['inocuidad']);
            $sheet->setCellValue('AT' . $row, $value['protocolos']);
            $sheet->setCellValue('AU' . $row, $value['otro_cap']);
            $sheet->setCellValue('AV' . $row, $value['latitud']);
            $sheet->setCellValue('AW' . $row, $value['longitud']);
            $sheet->setCellValue('AX' . $row, $value['created_at']);
            
            $spreadsheet->getActiveSheet()->getStyle('A' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('B' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('C' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('D' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('E' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('F' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('G' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('H' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('I' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('J' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('K' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('L' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('M' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('N' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('O' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('P' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('Q' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('R' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('S' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('T' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('U' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('V' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('W' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('X' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('Y' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('Z' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AA' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AB' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AC' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AD' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AE' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AF' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AG' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AH' . $row)->applyFromArray($styleArray);
            
             $spreadsheet->getActiveSheet()->getStyle('AI' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AJ' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AK' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AL' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AM' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AN' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AO' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AP' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AQ' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AR' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AS' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AT' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AU' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AV' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AW' . $row)->applyFromArray($styleArray);
           
            $row++;
        }

        $excelWriter = new Xlsx($spreadsheet);

        $tempFile = tempnam(File::sysGetTempDir(), 'phpxltmp');
        $tempFile = $tempFile ?: __DIR__ . '/temp.xlsx';
        $excelWriter->save($tempFile);


        $response = $response->withHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response = $response->withHeader('Content-Disposition', 'attachment; filename="OllasComunes.xlsx"');

        $stream = fopen($tempFile, 'r+');

        return $response->withBody(new \Slim\Http\Stream($stream));
    }

     public function ExporNuevas($request, $response, $args) {

        $data = Ollas::select('tb_ollas_excel.*', 'tb_distritos.distrito as nomdis')
                        ->join('tb_distritos', 'tb_ollas_excel.distrito', '=', 'tb_distritos.idDist')
                        ->where('tb_ollas_excel.estado', 1)
                        ->orderBy('tb_ollas_excel.id', 'ASC')->get();

        $styleArray = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ];

        $styleArrayHead = [
            'font' => [
                'bold' => true,
                'size' => 13,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ];

        $spreadsheet = new Spreadsheet();


        $sheet = $spreadsheet->getActiveSheet();

         $sheet->setCellValue('A1', 'Distrito ')->getColumnDimension('A')->setWidth(40);
        $sheet->setCellValue('B1', 'Zona/Eje')->getColumnDimension('B')->setWidth(30);
        $sheet->setCellValue('C1', 'AAHH')->getColumnDimension('C')->setWidth(40);
        $sheet->setCellValue('D1', '¿Dónde se ubica la olla común?')->getColumnDimension('D')->setWidth(50);
        $sheet->setCellValue('E1', 'Nombre de la olla común')->getColumnDimension('E')->setWidth(50);
        $sheet->setCellValue('F1', '¿Cuentan con padrones?')->getColumnDimension('F')->setWidth(25);
        $sheet->setCellValue('G1', 'Cuentan con Comedor Popular/Vaso de Leche')->getColumnDimension('G')->setWidth(25);
        
        $sheet->setCellValue('H1', '¿Cuentan con Comité anticovid o articulan con MINSA?')->getColumnDimension('H')->setWidth(25);
        $sheet->setCellValue('I1', 'Nombre de contacto principal')->getColumnDimension('I')->setWidth(25);
        $sheet->setCellValue('J1', 'Cargo de contacto principal*')->getColumnDimension('J')->setWidth(25);
        $sheet->setCellValue('K1', 'Celular de contacto principal')->getColumnDimension('K')->setWidth(30);
        $sheet->setCellValue('L1', 'Nombre de contacto secundario')->getColumnDimension('L')->setWidth(40);
        $sheet->setCellValue('M1', 'Cargo de contacto secundario')->getColumnDimension('M')->setWidth(25);
        $sheet->setCellValue('N1', 'Celular de contacto secundario')->getColumnDimension('N')->setWidth(45);
        $sheet->setCellValue('O1', 'Acceso a agua')->getColumnDimension('O')->setWidth(25);
        $sheet->setCellValue('P1', 'Acceso a luz')->getColumnDimension('P')->setWidth(30);
        
        $sheet->setCellValue('Q1', '¿Cuenta con la presencia de la Municipalidad distrital ?')->getColumnDimension('Q')->setWidth(35);
        $sheet->setCellValue('R1', 'Tipo de espacio usado para la olla común')->getColumnDimension('R')->setWidth(35);

        $sheet->setCellValue('S1', 'Estado del espacio usado para la olla común')->getColumnDimension('S')->setWidth(25);
        $sheet->setCellValue('T1', 'Tipo de combustible usado para la olla común')->getColumnDimension('T')->setWidth(25);
        $sheet->setCellValue('U1', 'En el espacio de la olla común cuentan con: ¿Techo en buen estado?')->getColumnDimension('U')->setWidth(25);
        $sheet->setCellValue('V1', 'En el espacio de la olla común cuentan con: ¿Punto de lavado?')->getColumnDimension('V')->setWidth(25);
        $sheet->setCellValue('W1', '¿Reciben o cuentan con KITS de Higiene?')->getColumnDimension('W')->setWidth(25);
        $sheet->setCellValue('X1', '¿Cuenta con los equipos e instrumentos necesarios para implementar la olla?')->getColumnDimension('X')->setWidth(25);
        $sheet->setCellValue('Y1', '¿Cómo obtiene insumos para la olla común?')->getColumnDimension('Y')->setWidth(25);

        $sheet->setCellValue('Z1', '¿Cuál es el nombre de la organización que los ayuda?')->getColumnDimension('Z')->setWidth(60);
        $sheet->setCellValue('AA1', '¿Cuántos días a la semana atiende la olla común?')->getColumnDimension('AA')->setWidth(15);
        $sheet->setCellValue('AB1', '¿Cuántas comidas al día prepara la olla común?')->getColumnDimension('AB')->setWidth(50);
        $sheet->setCellValue('AC1', 'Número de raciones que distribuye')->getColumnDimension('AC')->setWidth(25);
        $sheet->setCellValue('AD1', 'Precio por ración')->getColumnDimension('AD')->setWidth(25);
        $sheet->setCellValue('AE1', '¿Cuántas raciones del total son pagadas?')->getColumnDimension('AE')->setWidth(25);
        $sheet->setCellValue('AF1', 'Zonas a las cuales beneficia la olla común')->getColumnDimension('AF')->setWidth(40);
        $sheet->setCellValue('AG1', 'Número de familias beneficiadas')->getColumnDimension('AG')->setWidth(25);
        
        $sheet->setCellValue('AH1', 'Número de niños beneficiados (Menores de 5 años)')->getColumnDimension('AH')->setWidth(25);
        $sheet->setCellValue('AI1', 'Número de adultos mayores beneficiados (Mayores de 60 años)')->getColumnDimension('AI')->setWidth(25);
        $sheet->setCellValue('AJ1', 'Número de personas discapacitadas beneficiadas')->getColumnDimension('AJ')->setWidth(25);
        $sheet->setCellValue('AK1', 'Número de mujeres embarazadas beneficiadas')->getColumnDimension('AK')->setWidth(25);
        $sheet->setCellValue('AL1', 'Número de personas con enfermedades crónicas beneficiadas')->getColumnDimension('AL')->setWidth(25);
        $sheet->setCellValue('AM1', 'Número total de personas beneficiadas')->getColumnDimension('AM')->setWidth(25);
        $sheet->setCellValue('AN1', 'Agrega alguna observación')->getColumnDimension('AN')->setWidth(40);
        
         $sheet->setCellValue('AO1', 'Población Migrante extranjera')->getColumnDimension('AO')->setWidth(25);
         $sheet->setCellValue('AP1', '¿Tienen interés en tener un huerto en la comunidad?')->getColumnDimension('AP')->setWidth(25);
         $sheet->setCellValue('AQ1', '¿En la comunidad cuentan con espacio comunitario para la implementación?')->getColumnDimension('AQ')->setWidth(25);
         $sheet->setCellValue('AR1', '"¿La comunidad cuenta con personas que podrían asumir el liderazgo de un proyecto de este tipo?')->getColumnDimension('AR')->setWidth(25);
         $sheet->setCellValue('AS1', '¿Han recibido capacitaciones sobre la inocuidad para la preparación de los alimentos?')->getColumnDimension('AS')->setWidth(25);
         $sheet->setCellValue('AT1', '¿Han recibido capacitaciones sobre protocolos sanitarios?')->getColumnDimension('AT')->setWidth(25);
         $sheet->setCellValue('AU1', '¿Han recibido otro tipo de capacitaciones?')->getColumnDimension('AU')->setWidth(25);
         $sheet->setCellValue('AV1', 'Latitud')->getColumnDimension('AV')->setWidth(25);
         $sheet->setCellValue('AW1', 'Longitud')->getColumnDimension('AW')->setWidth(25);
         $sheet->setCellValue('AX1', 'Fecha de registro')->getColumnDimension('AX')->setWidth(25);
         
        $spreadsheet->getActiveSheet()->getStyle('A1:AW1')->applyFromArray($styleArrayHead);

        $row = 2;
        $startRow = -1;
        $previousKey = '';
        foreach ($data as $index => $value) {
            $sheet->setCellValue('A' . $row, $value['nomdis']);
            $sheet->setCellValue('B' . $row, $value['zona']);
            $sheet->setCellValue('C' . $row, $value['aahh']);
            $sheet->setCellValue('D' . $row, $value['ubicacion']);
            $sheet->setCellValue('E' . $row, $value['nombre_olla']);
            $sheet->setCellValue('F' . $row, $value['padrones']);
            $sheet->setCellValue('G' . $row, $value['comedorpopular']);
            
            $sheet->setCellValue('H' . $row, $value['comite']);
            $sheet->setCellValue('I' . $row, $value['nombre_contacto']);
            $sheet->setCellValue('J' . $row, $value['cargo_contacto']);
            $sheet->setCellValue('K' . $row, $value['celular_contacto']);
            $sheet->setCellValue('L' . $row, $value['nombre_contacto_secundario']);
            $sheet->setCellValue('M' . $row, $value['cargo_contacto_secundario']);
            $sheet->setCellValue('N' . $row, $value['celular_contacto_secundario']);
            $sheet->setCellValue('O' . $row, $value['agua']);
            $sheet->setCellValue('P' . $row, $value['luz']);
            $sheet->setCellValue('Q' . $row, $value['presencia_muni']);
            
            $sheet->setCellValue('R' . $row, $value['tipo_espacio']);
            $sheet->setCellValue('S' . $row, $value['estado_espacio']);
            $sheet->setCellValue('T' . $row, $value['combustible']);
            $sheet->setCellValue('U' . $row, $value['techo']);
            $sheet->setCellValue('V' . $row, $value['lavado']);
            $sheet->setCellValue('W' . $row, $value['higiene']);
            $sheet->setCellValue('X' . $row, $value['instrumentos']);
            $sheet->setCellValue('Y' . $row, $value['insumos']);
            $sheet->setCellValue('Z' . $row, $value['org_ayuda']);

            $sheet->setCellValue('AA' . $row, $value['dias_atencion']);
            $sheet->setCellValue('AB' . $row, $value['comidas_dia']);
            $sheet->setCellValue('AC' . $row, $value['raciones']);
            $sheet->setCellValue('AD' . $row, $value['precio_racion']);
            $sheet->setCellValue('AE' . $row, $value['raciones_pagadas']);
            $sheet->setCellValue('AF' . $row, $value['zonas_beneficiadas']);
            $sheet->setCellValue('AG' . $row, $value['familias_beneficiadas']);
            $sheet->setCellValue('AH' . $row, $value['ninos_beneficiadas']);
            
            $sheet->setCellValue('AI' . $row, $value['adultos_beneficiadas']);
            $sheet->setCellValue('AJ' . $row, $value['disca_beneficiadas']);
            $sheet->setCellValue('AK' . $row, $value['emba_beneficiadas']);
            $sheet->setCellValue('AL' . $row, $value['enfercro_beneficiadas']);
            $sheet->setCellValue('AM' . $row, $value['total_beneficiadas']);
            $sheet->setCellValue('AN' . $row, $value['observaciones']);
            $sheet->setCellValue('AO' . $row, $value['extranjera']);
            $sheet->setCellValue('AP' . $row, $value['huerto']);
            $sheet->setCellValue('AQ' . $row, $value['espacio_huerto']);
            $sheet->setCellValue('AR' . $row, $value['liderazgo']);
            $sheet->setCellValue('AS' . $row, $value['inocuidad']);
            $sheet->setCellValue('AT' . $row, $value['protocolos']);
            $sheet->setCellValue('AU' . $row, $value['otro_cap']);
            $sheet->setCellValue('AV' . $row, $value['latitud']);
            $sheet->setCellValue('AW' . $row, $value['longitud']);
            $sheet->setCellValue('AX' . $row, $value['created_at']);
            
             $spreadsheet->getActiveSheet()->getStyle('A' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('B' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('C' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('D' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('E' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('F' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('G' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('H' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('I' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('J' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('K' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('L' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('M' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('N' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('O' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('P' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('Q' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('R' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('S' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('T' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('U' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('V' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('W' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('X' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('Y' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('Z' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AA' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AB' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AC' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AD' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AE' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AF' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AG' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AH' . $row)->applyFromArray($styleArray);
            
             $spreadsheet->getActiveSheet()->getStyle('AI' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AJ' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AK' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AL' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AM' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AN' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AO' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AP' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AQ' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AR' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AS' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AT' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AU' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AV' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AW' . $row)->applyFromArray($styleArray);
            
            $row++;
        }

        $excelWriter = new Xlsx($spreadsheet);
        $tempFile = tempnam(File::sysGetTempDir(), 'phpxltmp');
        $tempFile = $tempFile ?: __DIR__ . '/temp.xlsx';
        
        $excelWriter->save($tempFile);


        $response = $response->withHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response = $response->withHeader('Content-Disposition', 'attachment; filename="OllasComunes(Nuevas).xlsx"');

        $stream = fopen($tempFile, 'r+');

        return $response->withBody(new \Slim\Http\Stream($stream));
    }

    
    public function ExporSimple($request, $response, $args) {

        $data = OllasSimple::select('tb_ollas_simple.*', 'tb_distritos.distrito as nomdis')
                        ->join('tb_distritos', 'tb_ollas_simple.distrito', '=', 'tb_distritos.idDist')
                        ->orderBy('tb_ollas_simple.codigo', 'ASC')->get();

        $styleArray = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ];

        $styleArrayHead = [
            'font' => [
                'bold' => true,
                'size' => 13,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ];

        $spreadsheet = new Spreadsheet();


        $sheet = $spreadsheet->getActiveSheet();

         $sheet->setCellValue('A1', 'Distrito ')->getColumnDimension('A')->setWidth(40);
        $sheet->setCellValue('B1', 'Nombre de ollas')->getColumnDimension('B')->setWidth(30);
        $sheet->setCellValue('C1', 'Nombre de contacto')->getColumnDimension('C')->setWidth(40);
        $sheet->setCellValue('D1', 'Celular contacto')->getColumnDimension('D')->setWidth(50);
        $sheet->setCellValue('E1', 'Raciones')->getColumnDimension('E')->setWidth(50);
        $sheet->setCellValue('F1', 'Fecha')->getColumnDimension('F')->setWidth(25);

        $spreadsheet->getActiveSheet()->getStyle('A1:F1')->applyFromArray($styleArrayHead);


        $row = 2;
        $startRow = -1;
        $previousKey = '';
        foreach ($data as $index => $value) {
            if ($startRow == -1) {
                $startRow = $row;
                $previousKey = $value['id'];
            }
            $sheet->setCellValue('A' . $row, $value['nomdis']);
            $sheet->setCellValue('B' . $row, $value['nombre_olla']);
            $sheet->setCellValue('C' . $row, $value['nombre_contacto']);
            $sheet->setCellValue('D' . $row, $value['celular_contacto']);
            $sheet->setCellValue('E' . $row, $value['raciones']);
            $sheet->setCellValue('F' . $row, $value['created_at']);

            $row++;
        }

        $excelWriter = new Xlsx($spreadsheet);

        $tempFile = tempnam(File::sysGetTempDir(), 'phpxltmp');
        $tempFile = $tempFile ?: __DIR__ . '/temp.xlsx';
        $excelWriter->save($tempFile);


        $response = $response->withHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response = $response->withHeader('Content-Disposition', 'attachment; filename="OllasComunes.xlsx"');

        $stream = fopen($tempFile, 'r+');

        return $response->withBody(new \Slim\Http\Stream($stream));
    }

    
    public function ExporActivos($request, $response, $args) {

        $data = Ollas::select('tb_ollas_excel.*', 'tb_distritos.distrito as nomdis')
                        ->join('tb_distritos', 'tb_ollas_excel.distrito', '=', 'tb_distritos.idDist')
                        ->where('tb_ollas_excel.estado', '=', 2)
                        ->orderBy('tb_ollas_excel.id', 'ASC')->get();

        $styleArray = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ];

        $styleArrayHead = [
            'font' => [
                'bold' => true,
                'size' => 13,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ];

        $spreadsheet = new Spreadsheet();


        $sheet = $spreadsheet->getActiveSheet();

         $sheet->setCellValue('A1', 'Distrito ')->getColumnDimension('A')->setWidth(40);
        $sheet->setCellValue('B1', 'Nombre de la olla común')->getColumnDimension('B')->setWidth(50);
        $sheet->setCellValue('C1', 'Representante')->getColumnDimension('C')->setWidth(25);
        $sheet->setCellValue('D1', 'Celular de contacto principal')->getColumnDimension('D')->setWidth(30);
        $sheet->setCellValue('E1', 'Número de raciones que distribuye')->getColumnDimension('E')->setWidth(25);
        $sheet->setCellValue('F1', 'Latitud')->getColumnDimension('F')->setWidth(25);
        $sheet->setCellValue('G1', 'Longitud')->getColumnDimension('G')->setWidth(25);
        $spreadsheet->getActiveSheet()->getStyle('A1:G1')->applyFromArray($styleArrayHead);

        $row = 2;
        $startRow = -1;
        $previousKey = '';
        foreach ($data as $index => $value) {
            if ($startRow == -1) {
                $startRow = $row;
                $previousKey = $value['id'];
            }
           $sheet->setCellValue('A' . $row, $value['nomdis']);
            $sheet->setCellValue('B' . $row, $value['nombre_olla']);
            $sheet->setCellValue('C' . $row, $value['nombre_contacto']);
            $sheet->setCellValue('D' . $row, $value['celular_contacto']);
            $sheet->setCellValue('E' . $row, $value['raciones']);
            $sheet->setCellValue('F' . $row, $value['latitud']);
            $sheet->setCellValue('G' . $row, $value['longitud']);
            
            $spreadsheet->getActiveSheet()->getStyle('AA' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AB' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AC' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AD' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AE' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AF' . $row)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('AG' . $row)->applyFromArray($styleArray);

            $row++;
        }

        $excelWriter = new Xlsx($spreadsheet);

        $tempFile = tempnam(File::sysGetTempDir(), 'phpxltmp');
        $tempFile = $tempFile ?: __DIR__ . '/temp.xlsx';
        $excelWriter->save($tempFile);


        $response = $response->withHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response = $response->withHeader('Content-Disposition', 'attachment; filename="ListaDeOllasComunes.xlsx"');

        $stream = fopen($tempFile, 'r+');

        return $response->withBody(new \Slim\Http\Stream($stream));
    }
    
}
