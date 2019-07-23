<?php

namespace App\Controller;

use App\Entity\ProductReviews;
use App\Entity\Products;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ReviewController extends AbstractController
{
    /**
     * @Route("/review/create", name="create_review")
     * @param Request $request
     * @return RedirectResponse
     */
    public function addReview(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $url = $request->headers->get('referer');

        $review = new ProductReviews();
        $product = $this->getDoctrine()->getRepository(Products::class)->find($request->request->get('product'));

        $review->setCustomer($request->request->get('customer'));
        $review->setEmail($request->request->get('email'));
        $review->setRating($request->request->get('rating'));
        $review->setProduct($product);
        $review->setText($request->request->get('text'));

        $em->persist($review);
        $em->flush();

        return $this->redirect($url);
    }
}
