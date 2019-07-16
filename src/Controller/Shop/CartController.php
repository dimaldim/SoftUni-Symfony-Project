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
     * @Route("/cart/add/{id}/{qty}", name="cart_add_product")
     * @param Products $product
     * @param $qty
     * @return Response
     */
    public function addToCart(Products $product = null, $qty)
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
            $cart[$product->getId()]['qty'] += $qty;
        } else {
            $cart[$product->getId()] = [
                'productName' => $product->getName(),
                'price' => $product->getPrice(),
                'qty' => $qty,
            ];
        }
        $session->set('shopping_cart', $cart);


        return new JsonResponse(
            [
                'data' => $cart = $session->get('shopping_cart'),
            ]
        );
    }

    public function getHeaderCartInfo()
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

        return $this->render(
            'shop/cart.html.twig',
            [
                'totalItems' => $totalItems,
                'totalPrice' => $totalPrice,
            ]
        );
    }
}
