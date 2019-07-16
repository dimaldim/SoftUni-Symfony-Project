<?php

namespace App\Controller;

use App\Entity\Products;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/product/{slug}", name="view_product")
     * @param Products $product
     * @return Response
     */
    public function viewProduct(Products $product)
    {
        return $this->render(
            'product/view.html.twig',
            [
                'product' => $product,
            ]
        );
    }
}
