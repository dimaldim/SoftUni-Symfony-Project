<?php

namespace App\Controller;

use App\Entity\Categories;
use Doctrine\Common\Collections\Criteria;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RelatedProductsController extends AbstractController
{
    public function getRelatedProducts($categoryId, $limit = 10)
    {
        $repo = $this->getDoctrine()->getRepository(Categories::class);
        $category = $repo->find($categoryId);
        $products = $category->getProducts();
        $criteria = Criteria::create()
            ->setMaxResults($limit);
        $products = $products->matching($criteria)->toArray();
        shuffle($products);

        return $this->render(
            'related_products.html.twig',
            [
                'products' => $products,
            ]
        );
    }
}
