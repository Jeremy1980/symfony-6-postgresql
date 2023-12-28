<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\Persistence\ManagerRegistry;

use App\Entity\Post;

class ListaController extends AbstractController
{
    #[Route('/lista', name: 'app_lista')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $data = array();
        $user_id = $this->getUser()->getId();

        $entityManager = $doctrine->getManager();
        $posts = $entityManager->getRepository(Post::class)->findAll();

        foreach($posts as $item) { $data[] = $item->asArray(); }

        return $this->render('lista/index.html.twig', [
            'controller_name' => 'ListaController',
            'fields' => (empty($data) ? array() :array_keys($data[0])),
            'data' => $data,
            'warning' => (empty($data) ? 'Brak danych do wyświetlenia.' :'')
        ]);
    }

    #[Route('/lista/usun/{id}')]
    public function remove(ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $post = $entityManager->getRepository(Post::class)->find($id);

        if ($post)
        {
            $entityManager->remove($post);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_lista');
    }
}
