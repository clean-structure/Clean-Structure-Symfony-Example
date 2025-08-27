<?php

declare(strict_types=1);

namespace CleanStructure\Tests\ModuleSuite\UserManagement;

use CleanStructure\UserManagement\Presentation\Console\CreateUser;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

final class CreateUserCommandTest extends KernelTestCase
{
    /**
     * @see CreateUser::__invoke
     */
    public function testExecute(): void
    {
        $application = new Application(self::bootKernel());

        $command = $application->find('app:create-user');
        $commandTester = new CommandTester($command);
        $commandTester->execute(['username' => 'Test Name']);

        $commandTester->assertCommandIsSuccessful();

        $output = $commandTester->getDisplay();
        self::assertStringContainsString('User successfully generated', $output);
    }
}
