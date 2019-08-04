<?php

namespace App\Service;

use App\Entity\Products;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartService
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }
    public function resetCart()
    {
        $this->session->set('shopping_cart', []);
    }
    public function addToCart(Products $product, $qty)
    {
        $cart = $this->session->get('shopping_cart');
        if (isset($cart[$product->getId()])) {
            $cart[$product->getId()]['qty'] += $qty;
        } else {
            $cart[$product->getId()] = [
            'id' => $product->getId(),
            'productName' => $product->getName(),
            'price' => $product->getPrice(),
            'qty' => $qty,
            'image' => $product->getImg(),
            ];
        }
        $this->session->set('shopping_cart', $cart);
    }

    public function getShoppingCartInfo()
    {
        $cart = $this->session->get('shopping_cart');
        $totalItems = 0;
        $totalPrice = 0.00;
        $products = [];
        if ($cart) {
            foreach ($cart as $key => $value) {
                $totalItems += $cart[$key]['qty'];
                $totalPrice += $cart[$key]['price'] * $cart[$key]['qty'];
                $products[] = [
                'id' => $cart[$key]['id'],
                'name' => $cart[$key]['productName'],
                'price' => $cart[$key]['price'],
                'qty' => $cart[$key]['qty'],
                'image' => $cart[$key]['image'],
                ];
            }
        }

        return [
        'totalItems' => $totalItems,
        'totalPrice' => $totalPrice,
        'products' => $products,
        ];
    }
}
