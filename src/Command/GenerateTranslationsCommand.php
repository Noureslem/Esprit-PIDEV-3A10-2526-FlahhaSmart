<?php

namespace App\Command;

use App\Service\TranslatorService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Yaml\Yaml;

#[AsCommand(
    name: 'app:translations:generate',
    description: 'Generate Symfony translations YAML using Azure Translator (offline).'
)]
final class GenerateTranslationsCommand extends Command
{
    public function __construct(
        private readonly TranslatorService $translatorService,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('input', InputArgument::REQUIRED, 'Input YAML file (e.g. translations/messages.fr.yaml)')
            ->addArgument('to', InputArgument::REQUIRED, 'Target locale (fr|en|ar)')
            ->addOption('from', null, InputOption::VALUE_REQUIRED, 'Source locale (fr|en|ar)', 'fr')
            ->addOption('output', 'o', InputOption::VALUE_REQUIRED, 'Output YAML file (default: input with locale replaced)', '')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $inputFile = (string) $input->getArgument('input');
        $to = (string) $input->getArgument('to');
        $from = (string) $input->getOption('from');
        $outputFile = (string) $input->getOption('output');

        if (!is_file($inputFile)) {
            $io->error(sprintf('Input file not found: %s', $inputFile));
            return Command::FAILURE;
        }

        if ($outputFile === '') {
            $outputFile = $this->defaultOutputPath($inputFile, $to);
        }

        $data = Yaml::parseFile($inputFile);
        if (!is_array($data)) {
            $io->error('Input YAML is empty or invalid.');
            return Command::FAILURE;
        }

        $io->note(sprintf('Translating %s → %s', $from, $to));

        $count = 0;
        $translated = $this->translateRecursive($data, $to, $from, $count);

        $yaml = Yaml::dump($translated, 8, 2, Yaml::DUMP_MULTI_LINE_LITERAL_BLOCK);
        $dir = dirname($outputFile);
        if (!is_dir($dir)) {
            @mkdir($dir, 0777, true);
        }

        file_put_contents($outputFile, $yaml);

        $io->success(sprintf('Generated %s (%d string(s) translated).', $outputFile, $count));

        return Command::SUCCESS;
    }

    private function defaultOutputPath(string $inputFile, string $to): string
    {
        // Best effort: replace .<locale>.yaml by .<to>.yaml
        $outputFile = preg_replace('/\\.[a-z]{2}\\.ya?ml$/i', '.' . $to . '.yaml', $inputFile);
        if (is_string($outputFile) && $outputFile !== $inputFile) {
            return $outputFile;
        }

        return preg_replace('/\\.ya?ml$/i', '.' . $to . '.yaml', $inputFile) ?: ($inputFile . '.' . $to . '.yaml');
    }

    /**
     * @param mixed $value
     * @return mixed
     */
    private function translateRecursive(mixed $value, string $to, string $from, int &$count): mixed
    {
        if (is_array($value)) {
            $out = [];
            foreach ($value as $k => $v) {
                $out[$k] = $this->translateRecursive($v, $to, $from, $count);
            }
            return $out;
        }

        if (is_string($value)) {
            $count++;
            return $this->translatorService->translate($value, $to, $from);
        }

        return $value;
    }
}
