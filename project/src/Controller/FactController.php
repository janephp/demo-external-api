<?php

namespace App\Controller;

use CatFacts\Api\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FactController extends AbstractController
{
    public function index(Client $client)
    {
        return $this->render('fact.html.twig', [
            'fact' => $client->randomFact(),
        ]);
    }
}
