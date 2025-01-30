<?php

namespace Modules\Pdf\Pipelines;

use Closure;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Modules\Shipments\Models\Shipment;
use setasign\Fpdi\Fpdi;

class StoreTemporaryPdf
{
    public function handle(Shipment $shipment, Closure $next): Closure
    {
        $base64String = $shipment->base64String;
        unset($shipment->base64String);

        $name = Str::replace('#', '', $shipment->order_number); // Desired file name without extension
        $this->saveBase64Pdf($base64String, $name);

        return $next($shipment);
    }

    private function saveBase64Pdf(string $base64String, string $name): void
    {
        $pdfData = base64_decode($base64String);
        $fileName = $name.'-right.pdf';
        $filePath = 'pdfs/temporary/'.$fileName;
        Storage::disk('public')->put("temp-${name}.pdf", $pdfData);

        $pdf = new Fpdi;

        $tempFilePath = storage_path("app/public/temp-${name}.pdf");

        $pageCount = $pdf->setSourceFile($tempFilePath);
        $templateId = $pdf->importPage(1);
        $pdf->addPage();
        $pdf->useTemplate($templateId, 0, 0, 148.5, 210);

        $size = $pdf->getTemplateSize($templateId);

        $outputPath = storage_path('app/public/pdfs/temporary/'.$fileName);

        $pdf->Output('F', $outputPath);
    }
}
