<?php


namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

// Include Dompdf required namespaces
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Component\Routing\Annotation\Route;


class PdfController
{
    /**
     * @Route("/pdf", name="pdf")
     */
    public function index()
    {
        // Configure Dompdf according to your needs

    }


}



