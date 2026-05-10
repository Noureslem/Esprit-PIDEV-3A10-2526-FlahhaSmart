<?php
namespace App\Service;

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;

class QrCodeService
{
    private string $uploadDir;

    public function __construct(string $projectDir)
    {
        $this->uploadDir = $projectDir . '/public/uploads/qrcodes';
        if (!is_dir($this->uploadDir)) {
            mkdir($this->uploadDir, 0777, true);
        }
    }

    public function generateQrCode(string $content, string $filename): string
    {
        $filePath = $this->uploadDir . '/' . $filename . '.png';

        $result = Builder::create()
            ->writer(new PngWriter())
            ->data($content)
            ->encoding(new Encoding('UTF-8'))               // ✅ objet Encoding
            ->errorCorrectionLevel(new ErrorCorrectionLevelHigh()) // ✅ objet High
            ->size(200)
            ->margin(10)
            ->build();

        $result->saveToFile($filePath);
        return '/uploads/qrcodes/' . $filename . '.png';
    }
}