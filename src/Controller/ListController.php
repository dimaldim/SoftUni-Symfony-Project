<?php

namespace App\Controller;

use App\Entity\Brands;
use App\Entity\Categories;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListController extends AbstractController
{
    /**
     * @Route("/category/{slug}", name="list")
     * @param Categories $category
     * @return Response
     */
    public function listProducts(Categories $category)
    {
        $allCategories = $this->getDoctrine()->getRepository(Categories::class)->findAll();
        $allbrands = $this->getDoctrine()->getRepository(Brands::class)->findAll();

        return $this->render(
        'list/index.html.twig',
        [
        'current_category' => $category,
        'all_categories' => $allCategories,
        'brands' => $allbrands,
        ]
        );
    }
}
