<?php

namespace App\Controller;

use App\Entity\Brands;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BrandsController extends AbstractController
{
    public function getBrands()
    {
        $repository = $this->getDoctrine()->getRepository(Brands::class);
        $brands = $repository->findAll();

        return $this->render(
            'brands.html.twig',
            [
                'brands' => $brands,
            ]
        );
    }
}
