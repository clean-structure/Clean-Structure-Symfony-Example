<?php

declare(strict_types=1);

namespace CleanStructure\WelcomePage\Presentation\Http\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class WelcomeController extends AbstractController
{
    #[Route('/welcome', methods: ['GET'])]
    public function page(): Response
    {
        return $this->render('@WelcomePage/welcome_page.html.twig');
    }
}
