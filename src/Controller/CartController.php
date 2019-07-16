<?php

namespace App\Controller;

use App\Entity\Products;
use App\Service\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/cart/add/{id}/{qty}", name="cart_add_product")
     * @param CartService $cartService
     * @param Products $product
     * @param $qty
     * @return Response
     */
    public function addToCart(CartService $cartService, Products $product = null, $qty)
    {
        if ($product == null) {
            return new JsonResponse(
                [
                    'error' => 'No product found.',
                ], 404
            );
        }
        $session = new Session();
        $cartService->addToCart($product, $qty);

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
            'cart.html.twig',
            [
                'totalItems' => $totalItems,
                'totalPrice' => $totalPrice,
            ]
        );
    }
}
