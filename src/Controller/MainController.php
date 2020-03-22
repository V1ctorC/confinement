<?php

namespace App\Controller;

use App\Form\CertificateType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index(Request $request)
    {
        $form = $this->createForm(CertificateType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            var_dump($data);
        }

        return $this->render('main/index.html.twig', [
            'form'=>$form->createView()
        ]);
    }
}
