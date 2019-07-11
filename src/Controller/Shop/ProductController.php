<?php

namespace App\Controller\Shop;

use App\Entity\Products;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/product/{slug}", name="view_product")
     */
    public function viewProduct(Products $product)
    {
        return $this->render(
            'shop/product/view.html.twig',
            [

            ]
        );
    }
}
