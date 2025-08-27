<?php

declare(strict_types=1);

namespace CleanStructure\UserManagement\Presentation\Console;

use CleanStructure\UserManagement\Application\UseCase\UserManagerUseCase;
use Symfony\Component\Console\Attribute\Argument;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Output\OutputInterface;
use Throwable;

#[AsCommand(name: 'app:create-user', description: 'Creates a new user')]
final readonly class CreateUser
{
    public function __construct(
        private UserManagerUseCase $userManager
    ) {
    }

    /**
     * Создание нового пользователя
     */
    public function __invoke(
        #[Argument('The username of the user')] string $username,
        OutputInterface $output
    ): int {
        $output->writeln([
            'User Creator',
            '============',
            '',
        ]);

        $output->writeln([
            'Username: ' . $username,
            '',
        ]);

        try {
            $this->userManager->create($username);
        } catch (Throwable $exception) {
            $output->writeln('ERROR: ' . $exception->getMessage());

            return Command::FAILURE;
        }

        $output->writeln('User successfully generated!');

        return Command::SUCCESS;
    }
}
