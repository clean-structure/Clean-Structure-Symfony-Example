<?php

declare(strict_types=1);

namespace CleanStructure\UserManagement\Application\UseCase;

use CleanStructure\UserManagement\Application\Command\UserCreateCommand;
use CleanStructure\UserManagement\Domain\Event\UserCreated;
use CleanStructure\UserManagement\Domain\Exception\UserExistException;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Throwable;

final readonly class UserManagerUseCase
{
    public function __construct(
        private UserCreateCommand $command,
        private EventDispatcherInterface $dispatcher
    ) {
    }

    /**
     * Создание нового пользователя
     *
     * @throws UserExistException
     * @throws Throwable
     */
    public function create(string $username): void
    {
        try {
            $this->dispatcher->dispatch(
                new UserCreated($this->command->create($username), $username)
            );
        } catch (Throwable $exception) {
            if ($exception->getCode() === '23000') {
                throw new UserExistException($exception->getMessage());
            }

            throw $exception;
        }
    }
}
