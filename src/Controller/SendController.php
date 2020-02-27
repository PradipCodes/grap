<?php


namespace App\Controller;


use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class SendController extends Controller
{
    /**
     * @Route("/send",name="send")
     */
    public function sendAction(Request $request)
    {
        if ($request->isMethod('POST')) {
            if ($request->request->get('action') == 'Send') {
                $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465,'ssl'))
                    ->setUsername('pradip.thapa.7374@gmail.com')
                    ->setPassword('xczmxpjmzfvdlxuu');

                /*
                You could alternatively use a different transport such as Sendmail:

                // Sendmail
                $transport = new Swift_SendmailTransport('/usr/sbin/sendmail -bs');
                */

// Create the Mailer using your created Transport
                $mailer = new Swift_Mailer($transport);

// Create a message
                $to = $request->request->get('email');
                $subject = $request->request->get('subject');
                $message = $request->request->get('message');
                print_r($to);
                print_r($subject);
                print_r($message);
                $message = (new Swift_Message($subject))
                    ->setFrom(['pradip.thapa.7374@gmail.com' => 'Pradip Thapa'])
                    ->setTo([$to])
                    ->setBody($message);

// Send the message
                $result = $mailer->send($message);
                if($result)
                {
                    $this->get('session')->getFlashBag()->add(
                        'success',
                        'Message Succesfully sent'
                    );

                }
            }

        }
        return $this->render('home/send.html.twig', []);

    }
}