<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Doctrine\Persistence\ManagerRegistry;

class MainController extends AbstractController
{
    public function homepage(ManagerRegistry $doctrine): Response
    {
        return $this->redirectToRoute('app_lista');
    }
}
?>