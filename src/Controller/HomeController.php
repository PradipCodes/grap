<?php

namespace App\Controller;

use App\Form\Type\ProfileType;
use App\Model\DataCountryQuery;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


// Include PhpSpreadsheet required namespaces
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;


class HomeController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function indexAction(Request $request)
    {

        return $this->render('home/index.html.twig', []);
    }

    /**
     * @Route("/change-password", name="change_password")
     */
    public function passwordAction(Request $request)
    {
        $user = $this->getUser();

        $form = $this->createForm(
            ProfileType::class,
            $user
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userManager = $this->container->get('fos_user.user_manager');
            $userManager->updateUser($user);

            $this->get('session')->getFlashBag()->add(
                'success',
                'Password was successfully updated.'
            );

            return $this->redirect($this->generateUrl('change_password'));
        }

        return $this->render('home/password.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/graph", name="graph")
     */
    public function graphAction(Request $request)
    {

        $dtact = array();
        $dtaco = array();
        $ctry = array();
        $ct = array();
        $dta = DataCountryQuery::create()->limit(10)->find();
        if ($request->isMethod('POST')) {
            if ($request->request->get('action') == 'Filter') {
                $start = $request->request->get('start');
                $end = $request->request->get('end');
                $start = strtotime($start);
                $start = date('Y-m-d', $start);
                print_r($start);
                $end = strtotime($end);
                $end = date('Y-m-d', $end);
                print_r($end);
                $dta = DataCountryQuery::create()->filterByDate(array("min" => $start, "max" => $end))->limit(10)->find();

            }
        }

        foreach ($dta as $dtas) {
            $dtact[] = $dtas->getCountry();
            $dtaco[] = $dtas->getCount();
            $date[] = $dtas->getDate()->format('Y-m-d');

        }
        if ($request->request->get('action') == 'Export') {
            $start = $request->request->get('start');
            $end = $request->request->get('end');
            $spreadsheet = new Spreadsheet();
            /* @var $sheet \PhpOffice\PhpSpreadsheet\Writer\Xlsx\Worksheet */
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1', 'Country');
            $sheet->setCellValue('B1', 'Count');

            //cell column value set to 1
            $i = 1;
            foreach ($dta as $kas) {
                //will increase cells column vallue by 1
                $i = $i + 1;
                $ctry[$i] = $kas->getCountry();
                $ct[$i] = $kas->getCount();
                //will set cell with A1,A2 and add value according to array
                $sheet->setCellValue('A' . $i, $ctry[$i]);
                //will set cell with A1,A2 and add value according to array
                $sheet->setCellValue('B' . $i, $ct[$i]);


            }
            $sheet->setTitle("My First Worksheet");

            // Create your Office 2007 Excel (XLSX Format)
            $writer = new Xlsx($spreadsheet);

            // Create a Temporary file in the system
            $fileName = 'data.xlsx';
            $temp_file = tempnam(sys_get_temp_dir(), $fileName);

            // Create the excel file in the tmp directory of the system
            $writer->save($temp_file);

            // Return the excel file as an attachment
            return $this->file($temp_file, $fileName, ResponseHeaderBag::DISPOSITION_INLINE);
        }


        $dtact = implode('","', $dtact);
        $dtact = sprintf('%s%s%s', '"', $dtact, '"');
        $dtaco = implode(',', $dtaco);
        //$date= implode('","',$date);
        // $date = sprintf('%s%s%s', '"', $date, '"');

        //print_r($date);


        return $this->render('home/graph.html.twig', ['country' => $dtact, 'count' => $dtaco]);
    }

    /**
     * @Route("/export", name="export")
     */
    public function exportAction(Request $request)
    {
        if ($request->isMethod('POST')) {
            $spreadsheet = new Spreadsheet();
            /* @var $sheet \PhpOffice\PhpSpreadsheet\Writer\Xlsx\Worksheet */
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1', 'Hello World !');
            $sheet->setCellValue('A2', 'Hell');

            $sheet->setTitle("My First Worksheet");

            // Create your Office 2007 Excel (XLSX Format)
            $writer = new Xlsx($spreadsheet);

            // Create a Temporary file in the system
            $fileName = 'my_first_excel_symfony4.xlsx';
            $temp_file = tempnam(sys_get_temp_dir(), $fileName);

            // Create the excel file in the tmp directory of the system
            $writer->save($temp_file);

            // Return the excel file as an attachment
            return $this->file($temp_file, $fileName, ResponseHeaderBag::DISPOSITION_INLINE);
        }
    }


}
