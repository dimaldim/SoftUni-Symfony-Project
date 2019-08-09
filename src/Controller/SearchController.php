<?php

namespace App\Controller;

use App\Entity\Products;
use Doctrine\ORM\AbstractQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="search")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $keyword = $request->request->get('keyword');
        $products = $this->getDoctrine()->getRepository(Products::class)
        ->createQueryBuilder('p')
        ->where("p.name LIKE '%$keyword%'")
        ->getQuery()
        ->getResult(AbstractQuery::HYDRATE_OBJECT);

        return $this->render(
        'search/index.html.twig',
        [
        'products' => $products,
        'keyword' => $keyword,
        ]
        );
    }
}
