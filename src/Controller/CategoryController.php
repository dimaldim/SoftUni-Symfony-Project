<?php

namespace App\Controller;

use App\Entity\Categories;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    public function getAll($limit = null)
    {
        $repo = $this->getDoctrine()->getRepository(Categories::class);
        $categories = $repo->findBy([], [], $limit);

        return $this->render(
            'categories.html.twig',
            [
                'categories' => $categories,
            ]
        );
    }
}
