<?php

namespace App\Controller;

use App\Form\CertificateType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     * @param Request $request
     * @param Session $session
     * @return Response
     */
    public function index(Request $request, Session $session)
    {
        $form = $this->createForm(CertificateType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $session->set('contactInfo', $data);
            return $this->redirectToRoute('generate');
        }

        return $this->render('main/index.html.twig', [
            'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/generate", name="generate")
     * @param Session $session
     * @return Response
     */
    public function generatePdf(Session $session)
    {
        if (empty($session->get('contactInfo')))
        {
            return $this->redirectToRoute('homepage');
        }

        $data = $session->get('contactInfo');

        return $this->render('main/generate.html.twig', [
            'data'=> $data
        ]);

    }
}
