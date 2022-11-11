<?php
require_once 'third-party/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

class PdfGen
{

    public function generarPdf($html, $orientacion, $nombre) {

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();

        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', $orientacion);

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream($nombre.".pdf", ['Attachment' => 0]);

    }
}