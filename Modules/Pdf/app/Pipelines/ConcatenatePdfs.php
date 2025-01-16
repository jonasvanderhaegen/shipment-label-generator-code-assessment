<?php

namespace Modules\Pdf\Pipelines;

use Closure;
use setasign\Fpdi\Fpdi;

use Spatie\LaravelPdf\Enums\Format;
use Spatie\LaravelPdf\Facades\Pdf;
use Modules\Shipments\Models\Shipment;

use Illuminate\Support\Str;

class ConcatenatePdfs
{
    public function handle(Shipment $shipment, Closure $next)
    {
        $this->ConcatenatePdfs($shipment);
        $next($shipment);
    }

    private function ConcatenatePdfs(Shipment $shipment): void
    {
        $pdf = new Fpdi();

        $pdf->AddPage('L', 'A4'); // Add a landscape A4 page
        $name = Str::replace('#', '', $shipment->order_number); // Desired file name without extension

        $leftPath = storage_path("app/public/pdfs/temporary/${name}-left.pdf" );
        $pdf->setSourceFile($leftPath);
        $tplIdx1 = $pdf->importPage(1);
        $pdf->useTemplate($tplIdx1, 0, 0, 148); // Place on the left half (A5 width is 148mm)

        $rightPath = storage_path("app/public/pdfs/temporary/${name}-right.pdf" );
        $pdf->setSourceFile($rightPath);
        $tplIdx2 = $pdf->importPage(1);
        $pdf->useTemplate($tplIdx2, 148, 0, 148); // Place on the right half

        $outputPath = storage_path("app/public/pdfs/${name}.pdf" );
        $pdf->Output('F', $outputPath);

        $shipment->update([
            'pdf_path' => "pdfs/${name}.pdf",
            'pdf_filename' => config('app.name') . "-shipment-${name}.pdf"
        ]);
    }
}
