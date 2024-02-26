<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;


class ProductionsController extends AbstractController
{
    #[Route('/production')]
    public function index(EntityManagerInterface $em): Response
    {
        // Récupération de l'intégralité de la table productionCpu
        $productions = $em->getRepository('App\Entity\CpuProduction')->createQueryBuilder('p')
            ->innerJoin('p.cpu', 'c')
            ->select('p, c')
            ->getQuery()
            ->getResult();

        // Rendu du fichier productions.html.twig avec les productions
        return $this->render('production.html.twig', [
            'productions' => $productions,
        ]);
    }
}
