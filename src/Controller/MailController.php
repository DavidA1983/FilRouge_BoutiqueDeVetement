<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class MailController extends AbstractController
{
    #[Route('/mail', name: 'app_mail')]
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();

            $email = (new Email())
                ->from($data['email'])
                ->to('admin@site.com')
                ->subject($data['sujet'])
                ->text($data['message'])
                ->html("
                    <p><strong>Message de :</strong> {$data['prenom']} {$data['nom']}</p>
                    <p><strong>Email :</strong> {$data['email']}</p>
                    <hr>
                    <p>{$data['message']}</p>
                ");

            $mailer->send($email);

            $this->addFlash('success', 'Votre message a bien été envoyé !');

            return $this->redirectToRoute('app_mail');
        }

        return $this->render('mail/index.html.twig', [
            'form' => $form,
        ]);
    }
}
