<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Dompdf\Dompdf;
use Dompdf\Options;

class PanierController extends AbstractController
{

    /**
     * @Route("/panier", name="panier_index")
     */
    public function index(SessionInterface $session, ProduitRepository $repo)
    {
        $panier = $session->get('panier', []);

        $panierWithData = [];

        foreach ($panier as $id => $quantite) {
            $panierWithData[] = [
                'id'=>$id,
                'produit' => $repo->find($id),
                'quantite' => $quantite
            ];
        }
        //dd($panierWithData);
        return $this->render('panier/index.html.twig', [
            'items' => $panierWithData
        ]);
    }


    /**
     * @Route("/panier/add/{id}", name="panier_add")
     */
    public function add($id, SessionInterface $session) // SessionInterface permet de récupérer la session
    {
        $panier = $session->get('panier', []); // si pas encore de panier dans la session on affecte un panier vide

        if (!empty($panier[$id])) {
            $panier[$id]++;
        } else {
            $panier[$id] = 1;
        }

        $session->set('panier', $panier); // on injecte dans la session le panier modifié
        //dd($session->get('panier'));
//        return $this->redirectToRoute("produits_index");
        return $this->redirectToRoute("home");
    }

    /**
     * @Route("/panier/remove/{id}", name="panier_remove")
     */
    public function remove($id, SessionInterface $session)
    {
        $panier = $session->get('panier', []);
        if (!empty($panier[$id])) {
            unset($panier[$id]);
        }
        $session->set('panier', $panier);
        return $this->redirectToRoute("panier_index");
    }

    /**
     * @Route("/pdf", name="panier_pdf")
     */
    public function pdf(SessionInterface $session, ProduitRepository $repo)
    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');

        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);

        $panier = $session->get('panier', []);
        foreach ($panier as $id => $quantite) {
            $panierWithData[] = [
                'id'=>$id,
                'produit' => $repo->find($id),
                'quantite' => $quantite
            ];
        }
        $html = $this->render('panier/pdf.html.twig', [
            'items' => $panierWithData
        ]);
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (inline view)
        $dompdf->stream("liste.pdf", [
            "Attachment" => true
        ]);
    }

}
