<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionBagInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(EntityManagerInterface $manager, ProduitRepository $produitRepository,PaginatorInterface $paginator,Request $request,SessionInterface $session): Response
    {
        $produits=$paginator->paginate($produitRepository->findAll(),$request->query->getInt('page',1),8);

        return $this->render('home/index.html.twig',[
            'produits'=>$produits
        ]);
    }
}
