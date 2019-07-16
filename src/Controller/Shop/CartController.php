<?php

namespace App\Controller\Shop;

use App\Entity\Products;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/cart/add/{id}", name="cart_add_product")
     * @param Products $product
     * @return Response
     */
    public function addToCart(Products $product = null)
    {
        if ($product == null) {
            return new JsonResponse(
                [
                    'error' => 'No product found.',
                ]
            );
        }
        $session = new Session();
        $cart = $session->get('shopping_cart');
        if (isset($cart[$product->getId()])) {
            $cart[$product->getId()]['qty']++;
        } else {
            $cart[$product->getId()] = ['price' => $product->getPrice(), 'qty' => 1];
        }
        $session->set('shopping_cart', $cart);


        return new JsonResponse(
            [
                'data' => $cart = $session->get('shopping_cart'),
            ]
        );
    }
}
