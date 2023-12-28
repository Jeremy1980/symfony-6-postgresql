<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\Persistence\ManagerRegistry;

use App\Entity\Post;


#[Route("/api", "api_")]
class PostController extends AbstractController
{

    #[Route('/posts', name: 'posts', methods: ["GET"])]
    public function index(ManagerRegistry $doctrine): JsonResponse
    {
        $entityManager = $doctrine->getManager();
        $posts = $entityManager->getRepository(Post::class)->findAll();

        $data = array();
        foreach($posts as $item) { $data[] = $item->asArray(); }

        return $this->json($data);
    }
}
?>