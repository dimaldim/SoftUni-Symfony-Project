<?php

namespace App\Controller\Shop;

use App\Entity\Brands;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BrandsController extends AbstractController
{
    public function getBrandsAction()
    {
        $repository = $this->getDoctrine()->getRepository(Brands::class);
        $brands = $repository->findAll();

        return $this->render(
            'shop/brands.html.twig',
            [
                'brands' => $brands,
            ]
        );
    }
}
