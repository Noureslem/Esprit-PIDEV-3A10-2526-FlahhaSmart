<?php

namespace App\Command;

use App\Service\GeminiChatService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'chatbot:test',
    description: 'Test the Gemini chatbot service',
)]
final class ChatbotTestCommand extends Command
{
    public function __construct(
        private readonly GeminiChatService $chatService,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addArgument('message', InputArgument::OPTIONAL, 'Message to send to chatbot', 'What is the best soil for tomatoes?');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $message = $input->getArgument('message');

        $io->title('🤖 Gemini Chatbot Test');
        $io->section('Configuration');
        $io->text([
            '<info>API Endpoint:</info> ' . getenv('GEMINI_API_ENDPOINT'),
            '<info>API Key:</info> ' . (getenv('GEMINI_API_KEY') ? '***configured***' : '<error>NOT CONFIGURED</error>'),
            '<info>Chatbot Enabled:</info> ' . (getenv('GEMINI_CHATBOT_ENABLED') ? 'Yes' : 'No'),
        ]);

        $io->section('Test Message');
        $io->text('<info>Sending:</info> ' . $message);
        $io->newLine();

        $io->write('Processing... ');
        try {
            $response = $this->chatService->ask($message);
            $io->writeln('<info>✓ Success!</info>');
            $io->newLine();
            $io->section('Response');
            $io->text($response);
            return Command::SUCCESS;
        } catch (\Throwable $e) {
            $io->writeln('<error>✗ Failed!</error>');
            $io->newLine();
            $io->error('Error: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }
}
