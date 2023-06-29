<?php
namespace App\Controller\Api;

use App\Service\DeliveryCalculator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DeliveryController extends AbstractController
{
    /**
     * @Route("/api/calculate-price", methods={"POST"})
     */
    public function calculatePrice(Request $request, DeliveryCalculator $calculator)
    {
        $data = json_decode($request->getContent(), true);

        $weight = $data['weight'];
        $slug = $data['slug'];

        $price = $calculator->calculatePrice($weight, $slug);

        if ($price !== null) {
            return new JsonResponse(['price' => $price]);
        } else {
            return new JsonResponse(['error' => 'Invalid transport company'], 400);
        }
    }
}