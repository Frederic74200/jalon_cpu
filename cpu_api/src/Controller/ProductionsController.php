<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\CpuProduction;
use App\Form\LigneProductionType;


class ProductionsController extends AbstractController
{
    #[Route('/production',  name: "production")]
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

    #[Route('/add', name: "add")]
    public function add(Request $request, EntityManagerInterface $em): Response
    {
        $ligneProduction = new CpuProduction();

        $form = $this->createForm(LigneProductionType::class, $ligneProduction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($ligneProduction);
            $em->flush();

            return $this->redirectToRoute('production');
        }

        return $this->render('add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/modify/{id}', name: "modify")]
    public function modify(Request $request, EntityManagerInterface $em, int $id): Response
    {
        $ligneProduction = $em->getRepository(CpuProduction::class)->find($id);

        if (!$ligneProduction) {
            throw $this->createNotFoundException('Ligne de production introuvable');
        }

        $form = $this->createForm(LigneProductionType::class, $ligneProduction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            return $this->redirectToRoute('production');
        }

        return $this->render('modify.html.twig', [
            'form' => $form->createView(),
            'ligneProduction' => $ligneProduction,
        ]);
    }

    #[Route('/delete/{id}', name: "delete_production")]
    public function deleteProduction(EntityManagerInterface $em, int $id): Response
    {
        $ligneProduction = $em->getRepository(CpuProduction::class)->find($id);

        if (!$ligneProduction) {
            throw $this->createNotFoundException('Ligne de production introuvable');
        }

        $em->remove($ligneProduction);
        $em->flush();

        // Message de confirmation (à adapter selon vos besoins)
        $this->addFlash('success', 'Ligne de production supprimée avec succès !');

        return $this->redirectToRoute('production');
    }
}
