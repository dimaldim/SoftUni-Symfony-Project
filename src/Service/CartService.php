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

    public function getCartHeaderInfo()
    {
        $session = new Session();
        $cart = $session->get('shopping_cart');
        $totalItems = 0;
        $totalPrice = 0.00;
        if ($cart) {
            foreach ($cart as $key => $value) {
                $totalItems += $cart[$key]['qty'];
                $totalPrice += $cart[$key]['price'] * $cart[$key]['qty'];
            }
        }

        return [
            'totalItems' => $totalItems,
            'totalPrice' => $totalPrice,
        ];
    }
}
