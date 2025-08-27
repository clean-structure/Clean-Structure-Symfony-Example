<?php

declare(strict_types=1);

namespace CleanStructure\Tests\ModuleSuite\WelcomePage;

use CleanStructure\WelcomePage\Presentation\Http\Controller\WelcomeController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class WelcomeControllerTest extends WebTestCase
{
    /**
     * Проверим генерацию шаблона
     *
     * @see WelcomeController::page
     */
    public function testWelcomePage(): void
    {
        $client = self::createClient();

        $client->request('GET', '/');

        self::assertResponseIsSuccessful();
        self::assertSelectorTextContains('h1', 'Welcome to Symfony');
    }
}
