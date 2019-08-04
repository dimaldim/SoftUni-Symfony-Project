<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ListController extends AbstractController
{
    /**
     * @Route("/category/{slug}", name="list")
     */
    public function index()
    {
        return $this->render('list/index.html.twig', [
            'controller_name' => 'ListController',
        ]);
    }
}
