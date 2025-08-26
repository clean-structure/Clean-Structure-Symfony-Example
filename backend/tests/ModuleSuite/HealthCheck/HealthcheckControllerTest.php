<?php

declare(strict_types=1);

namespace CleanStructure\Tests\ModuleSuite\HealthCheck;

use CleanStructure\HealthCheck\Presentation\Http\Controller\HealthcheckController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class HealthcheckControllerTest extends WebTestCase
{
    /**
     * Тестируем выполнение проверки работоспособности сервера
     *
     * @see HealthcheckController::check
     */
    public function testStatus(): void
    {
        $client = self::createClient();

        $crawler = $client->request('GET', '/healthcheck');

        self::assertResponseIsSuccessful();
        self::assertEquals('ok', $crawler->text());
    }
}
