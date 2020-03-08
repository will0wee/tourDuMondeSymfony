<?php

// namespace
// App provient de composer.json
namespace App\Controller;

use App\Repository\DecouverteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    /**
     * @Route("/", name="homepage.index")
     */
    public function index(Request $request, DecouverteRepository $decouverteRepository):Response
    {
        $listDecouverte = $decouverteRepository->getlast4Decouverte();
        
//        dd($listDecouverte);
        return $this->render('homepage/index.html.twig', [
            'decouvertes' => $listDecouverte
        ]);
    }
}








