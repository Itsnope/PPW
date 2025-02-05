<?php
require('./vendor/setasign/fpdf/fpdf.php');

class RegistrationPDF extends FPDF {
    function Header() {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'FORMULIR PENDAFTARAN SSB', 0, 1, 'C');
        $this->Ln(5);
    }
}

function generatePDF($data) {
    // Create PDF instance
    $pdf = new RegistrationPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 11);
    
    // Left margin for labels
    $labelX = 20;
    // Starting Y position
    $currentY = 30;
    // Space between lines
    $lineSpace = 10;
    
    // Add form fields
    $fields = [
        ['NAMA', $data['nama']],
        ['TEMPAT / TGL. LAHIR', $data['tempat_lahir'] . ' / ' . $data['tanggal_lahir']],
        ['USIA', $data['usia']],
        ['JENIS KELAMIN', $data['jenis_kelamin']],
        ['NAMA ORANG TUA', $data['nama_ortu']],
        ['NO TELP / HP', $data['no_telp']],
    ];
    
    foreach ($fields as $field) {
        $pdf->SetXY($labelX, $currentY);
        $pdf->Cell(50, 7, $field[0], 0);
        $pdf->SetX($labelX + 50);
        $pdf->Cell(5, 7, ':', 0);
        $pdf->SetX($labelX + 55);
        $pdf->Cell(0, 7, $field[1], 0);
        $currentY += $lineSpace;
    }
    
    // Address section
    $pdf->SetXY($labelX, $currentY);
    $pdf->Cell(50, 7, 'ALAMAT', 0);
    $pdf->SetX($labelX + 50);
    $pdf->Cell(5, 7, ':', 0);
    $pdf->SetX($labelX + 55);
    $pdf->Cell(0, 7, 'Dsn. ' . $data['alamat'], 0);
    $currentY += $lineSpace;
    
    // RT/RW
    $pdf->SetXY($labelX + 55, $currentY);
    $pdf->Cell(0, 7, 'RT. ' . $data['rt'] . '    RW. ' . $data['rw'], 0);
    $currentY += $lineSpace;
    
    // Desa
    $pdf->SetXY($labelX + 55, $currentY);
    $pdf->Cell(0, 7, 'Desa ' . $data['desa'], 0);
    $currentY += $lineSpace;
    
    // Kecamatan
    $pdf->SetXY($labelX + 55, $currentY);
    $pdf->Cell(0, 7, 'Kecamatan ' . $data['kecamatan'], 0);
    
    // Add photo if exists
    if (isset($data['foto']) && file_exists('uploads/' . $data['foto'])) {
        // Get image dimensions
        list($width, $height) = getimagesize('uploads/' . $data['foto']);
        
        // Calculate scaling to fit in 40x50mm box (convert mm to pixels)
        $maxWidth = 40;
        $maxHeight = 50;
        
        $scaleWidth = $maxWidth / ($width / 25.4);
        $scaleHeight = $maxHeight / ($height / 25.4);
        $scale = min($scaleWidth, $scaleHeight);
        
        // Add image
        $pdf->Image('uploads/' . $data['foto'], 150, 140, 40, 50, '', '', '', false, 300);
    } else {
        // If no photo, draw empty box
        $pdf->Rect(150, 140, 40, 50);
        $pdf->SetXY(150, 190);
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(40, 10, 'Foto 4 x 6', 0, 0, 'C');
    }
    
    // Generate unique filename for PDF
    $pdfFilename = 'admin/registrasi_' . preg_replace('/[^A-Za-z0-9]/', '', $data['nama']) . '_' . date('Ymd') . '.pdf';
    
    // Save PDF
    $pdf->Output('F', $pdfFilename);
    
    return $pdfFilename;
}