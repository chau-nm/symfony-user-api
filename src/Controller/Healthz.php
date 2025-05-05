<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class Healthz
{
    #[Route('/healthz', name: 'healthz')]
    public function checkHealth(): Response
    {
        return new Response("OK");
    }
}