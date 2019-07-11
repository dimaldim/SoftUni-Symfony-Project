<?php

namespace App\Controller\Shop;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(Request $request)
    {
        return $this->render(
            'shop/home/index.html.twig',
            [
                'controller_name' => 'HomeController',
            ]
        );
    }
}
