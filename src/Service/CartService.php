<?php

namespace App\Service;

use App\Entity\Products;
use Symfony\Component\HttpFoundation\Session\Session;

class CartService
{
    public function addToCart(Products $product, $qty)
    {
        $session = new Session();
        $cart = $session->get('shopping_cart');
        if (isset($cart[$product->getId()])) {
            $cart[$product->getId()]['qty'] += $qty;
        } else {
            $cart[$product->getId()] = [
                'productName' => $product->getName(),
                'price' => $product->getPrice(),
                'qty' => $qty,
            ];
        }
        $session->set('shopping_cart', $cart);
    }
}
