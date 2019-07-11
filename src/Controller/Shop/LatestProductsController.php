<?php

namespace App\Controller\Shop;

use App\Entity\Products;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LatestProductsController extends AbstractController
{
    public function getLatestProducts($limit = 10)
    {
        $repository = $this->getDoctrine()->getRepository(Products::class);
        //Find last products and sort them by date added desc
        $latestProducts = $repository->findBy([], ['dateAdded' => 'desc'], $limit);

        return $this->render(
            'shop/latest_products.html.twig',
            [
                'products' => $latestProducts,
            ]
        );
    }
}
