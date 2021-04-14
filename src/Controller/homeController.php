<?php 

namespace App\Controller;

use App\Entity\User;
use App\Entity\Message;
use App\Repository\UserRepository;
use App\Repository\MessageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

Class homeController extends AbstractController 
{
    /**
    * @Route("/", name="home")
    * @param MessageReository $messageRepository
    * @param UserRepository $userRepository
    * @param Request $request
    * @return Response
    */

    public function home(Request $request, MessageRepository $messageRepository,UserRepository $userRepository)
    {
        if($request->isMethod('POST'))
        {
            $data = $request->request->all();
            
            $msg = new Message();
            $msg->setBody($data["commentaire"]);
            $msg->setSender_Id($data["sender"]);

            $em = getDoctrine()->getManager();
            $em->persist($msg);
            $em->flush();
            
        }
        
        return $this->render("forum.html.twig",[
        "messages"=> $messageRepository->findAll(),
        "users" => $userRepository->findAll()
        
        ]);
    
    }
    
    /**
    * @Route("/connexion", name="login", methods={"GET","POST"})
    * @param Request $request
    * @return Response
    */
    
    public function connexion(Request $request, UserRepository $userRepository, MessageRepository $messageRepository):Response
    {
        if($request->isMethod('POST'))
        {
            $data = $request->request->all();
            
            $user1 = $userRepository->findOneBy(array('userName'=>$data['userName'],
                'userPassword'=>$data['userPassword']));
            if (!$user1)
            {
                $this->get('session')->getFlashBag()->add('info',
                    'Email ou mot de passe Incorrecte Vérifier les svp !');
            }
            else
            {
                   
                    return $this->render('forum(2).html.twig', [
                         'userActif'=>$user1,
                         "messages"=> $messageRepository->findAll(),
                         "users" => $userRepository->findAll()
                     ]);
                    
            }
        }
        
        
        return $this->render("connexion.html.twig");
    }

   
}
