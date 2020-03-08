<?php

// namespace
// App provient de composer.json
namespace App\Controller;

use App\Repository\DecouverteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\DecouverteType;
use App\Entity\Decouverte;

class DecouverteController extends AbstractController
{
    /**
     * @Route("/decouverte/", name="decouverte.index")
     */
    public function index(Request $request, DecouverteRepository $decouverteRepository):Response
    {
        $listeDecouverte = $decouverteRepository->findAll();

//        dd($listeDecouverte);
        return $this->render('decouverte/index.html.twig', [
            'decouvertes' => $listeDecouverte
        ]);
    }
    
    
    /**
     * @Route("/decouverte/delete/{id}", name="decouverte.delete")
     */
    public function delete(Request $request, DecouverteRepository $decouverteRepository, EntityManagerInterface $entityManager, int $id)
    {
        $decouverte = $decouverteRepository->find($id);
        $entityManager->remove($decouverte);
        $entityManager->flush();
        unset($id);
        
        return $this->redirectToRoute('decouverte.index');
    }
    
    /**
     * @Route("/decouverte/add", name="decouverte.add")
     * @Route("/decouverte/update/{id}", name="decouverte.update")
     */
    public function form(Request $request, EntityManagerInterface $entityManager, int $id = null, DecouverteRepository $decouverteRepository)
    {
            // affichage d'un formulaire
            $type = DecouverteType::class;
            $model = $id ? $decouverteRepository->find($id) : new Decouverte();
            $form = $this->createForm($type, $model);
            $form->handleRequest($request);

            // si le formulaire est valide
            if($form->isSubmitted() && $form->isValid()){
                    //dd($model);
                $id ? null : $entityManager->persist($model);
                $entityManager->flush();

                // message de confirmation
                $message = $id ? "La découverte a été modifiée" : "La découverte a été ajoutée";
                $this->addFlash('notice', $message);

                // redirection
                return $this->redirectToRoute('decouverte.index');
            }

            return $this->render('decouverte/form.html.twig', [
                'form' => $form->createView()
            ]);
    }
    
    /**
     * @Route("/decouverte/{id}", name="decouverte.detail")
     */
    public function detail(Request $request, DecouverteRepository $decouverteRepository, int $id):Response
    {
        $decouverte = $decouverteRepository->find($id);

//        dd($decouverte);
        return $this->render('decouverte/detail.html.twig', [
            'decouverte' => $decouverte
        ]);
    }
    

}








