<?php

namespace App\Controller;

use App\Form\DateFormatType;
use App\Service\DateFormatter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DateFormatController extends AbstractController
{
    /**
     * @Route("/date-format/create")
     * @param Request $request
     * @return Response
     */
    public function create(Request $request, DateFormatter $dateFormatter): Response
    {
        $form = $this->createForm(DateFormatType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $dateInfo = $dateFormatter->format($form->getData());

            return $this->render('date_format/view.html.twig', ['dateInfo' => $dateInfo]);
        }

        return $this->render('date_format/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
