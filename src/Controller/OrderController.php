<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\ProductOrder;
use App\Entity\Products;
use App\Form\CheckoutType;
use App\Service\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    private $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * @Route("/checkout", name="checkout")
     */
    public function checkout(Request $request, CartService $cartService)
    {
        $cart = $this->cartService->getShoppingCartInfo();

        $order = new Order();
        $form = $this->createForm(CheckoutType::class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($order);

            $repo = $em->getRepository(Products::class);
            foreach ($cart['products'] as $products) {
                $product = $repo->find($products['id']);
                $productOrder = new ProductOrder();
                $productOrder->setCheckout($order);
                $productOrder->setQty($products['qty']);
                $productOrder->setProduct($product);
                $productOrder->setPrice($products['price']);

                $em->persist($productOrder);
            }
            $em->flush();
            $cartService->resetCart();

									return $this->render(
									'order/successfull.html.twig',
									[
									'cart' => $cart,
									'form' => $form->createView(),
									]
									);
        }

        return $this->render(
            'order/index.html.twig',
            [
                'cart' => $cart,
                'form' => $form->createView(),
            ]
        );
    }
}
