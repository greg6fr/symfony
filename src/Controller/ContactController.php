<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use App\Services\FormattedContact;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    public function __construct(private RequestStack $requestStack, private EntityManagerInterface $entityManager)
    {
    }

    #[Route('/contact', name: 'contact.index')]
    public function index(): Response
    {   $entity =  new Contact();
        $type = ContactType::class;
        $form = $this->createForm($type, $entity);
        $form->handleRequest($this->requestStack->getMainRequest());
        if ($form->isSubmitted() && $form->isValid()) {
            // message de confirmation
            $message = 'Your email has been sent';
            $formattedContact = new FormattedContact();
            ;
            $this->entityManager->persist($formattedContact->transform($entity));
            $this->entityManager->flush();

            // message flash : message stocké en session, supprimé suite à son affichage
            $this->addFlash('notice', $message);

            // redirection vers la page d'accueil de l'admin
            return $this->redirectToRoute('contact.index');
        }
        return $this->render('contact/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

}
