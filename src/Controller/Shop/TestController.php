<?php

namespace App\Controller\Shop;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    /**
     * @Route("/test", name="test")
     */
    public function index()
    {
        return $this->render(
            'shop/test/index.html.twig',
            [
                'controller_name' => 'TestController',
            ]
        );
    }
}
