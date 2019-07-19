<?php

namespace App\Controller;

use App\Entity\Products;
use App\Service\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    private $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * @Route("/cart/add/{id}/{qty}", name="cart_add_product")
     * @param Products $product
     * @param $qty
     * @return JsonResponse
     */
    public function addToCart(Products $product = null, $qty)
    {
        if ($product == null) {
            return new JsonResponse(
                [
                    'error' => 'No product found.',
                ], 404
            );
        }
        $session = new Session();
        $this->cartService->addToCart($product, $qty);

        return new JsonResponse(
            [
                'data' => $session->get('shopping_cart'),
            ]
        );
    }

    /**
     * @Route("/cart/remove/{id}")
     * @return JsonResponse
     */
    public function removeFromCart($id)
    {
        $session = new Session();
        $cart = $session->get('shopping_cart');

        if ($cart === null) {
            return new JsonResponse(['error' => 'No products in cart'], 500);
        }

        if (array_key_exists($id, $cart)) {
            unset($cart[$id]);
        }

        $session->set('shopping_cart', $cart);

        return $this->getShoppingCart();
    }

    /**
     * @Route("/cart/get")
     * @return JsonResponse
     */
    public function getShoppingCart()
    {
        return new JsonResponse(
            [
                'totalItems' => $this->cartService->getShoppingCartInfo()['totalItems'],
                'totalPrice' => $this->cartService->getShoppingCartInfo()['totalPrice'],
                'products' => $this->cartService->getShoppingCartInfo()['products'],
            ]
        );
    }
}
