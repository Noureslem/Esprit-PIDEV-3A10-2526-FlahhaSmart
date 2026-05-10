<?php

namespace App\Service;

use App\Entity\Operation;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Twig\Environment;

class OperationPdfExporter
{
    public function __construct(
        private Environment $twig,
        #[Autowire('%kernel.project_dir%')]
        private string $projectDir,
    ) {}

    /**
     * @return array<string, string>
     */
    public static function availableColumns(): array
    {
        return [
            'type_operation' => 'operation.export.column.type_operation',
            'equipement' => 'operation.export.column.equipement',
            'date_debut' => 'operation.export.column.date_debut',
            'date_fin' => 'operation.export.column.date_fin',
            'statut' => 'operation.export.column.statut',
        ];
    }

    /**
     * @return list<string>
     */
    public static function defaultColumns(): array
    {
        return ['type_operation', 'equipement', 'date_debut', 'date_fin', 'statut'];
    }

    /**
     * @param list<Operation> $operations
     * @param list<string> $columns
     */
    public function generateOperationsPdf(array $operations, array $columns, string $locale): string
    {
        $allowedColumns = array_keys(self::availableColumns());
        $normalizedColumns = array_values(array_intersect($allowedColumns, $columns));

        if ($normalizedColumns === []) {
            $normalizedColumns = self::defaultColumns();
        }

        $html = $this->twig->render('frontend/operation/pdf/export.html.twig', [
            'operations' => $operations,
            'columns' => $normalizedColumns,
            'columnLabels' => self::availableColumns(),
            'logoDataUri' => $this->buildLogoDataUri(),
            'generatedAt' => new \DateTimeImmutable(),
            'locale' => $locale,
        ]);

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $options->set('defaultFont', 'DejaVu Sans');

        $dompdf = new Dompdf($options);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->render();

        return $dompdf->output();
    }

    private function buildLogoDataUri(): ?string
    {
        $logoPath = $this->projectDir.'/logo.png';
        if (!is_file($logoPath)) {
            return null;
        }

        $binary = @file_get_contents($logoPath);
        if ($binary === false) {
            return null;
        }

        $extension = strtolower((string) pathinfo($logoPath, PATHINFO_EXTENSION));
        $mime = ($extension === 'jpg' || $extension === 'jpeg') ? 'image/jpeg' : 'image/png';

        return sprintf('data:%s;base64,%s', $mime, base64_encode($binary));
    }
}
