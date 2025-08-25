<?php

declare(strict_types=1);

namespace Lk2\Tests\ModuleSuite\HealthCheck;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class PingControllerTest extends WebTestCase
{
    public function testPing(): void
    {
        $client = self::createClient();

        $crawler = $client->request('GET', '/ping');

        self::assertResponseIsSuccessful();
        self::assertEquals('pong', $crawler->text());
    }
}
