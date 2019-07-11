<?php

namespace App\Controller\Shop;

use App\Entity\Products;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LatestProductsController extends AbstractController
{
    public function getLatestProducts($limit = 10)
    {
        $repository = $this->getDoctrine()->getRepository(Products::class);
        $latestProducts = $repository->findBy([], ['dateAdded' => 'desc'], $limit);

        return $this->render(
            'latest_products.html.twig',
            [
                'products' => $latestProducts,
            ]
        );
    }
}
