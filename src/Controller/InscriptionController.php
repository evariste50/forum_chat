<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class InscriptionController extends AbstractController
{
    /**
    * @Route("/inscription", name="registration", methods={"GET","POST"})
    * @param Request $request
    * @return Response
    */
    
    public function inscription(Request $request, EntityManagerInterface $em):Response
    {
        
        if($request->isMethod('POST'))
        {
            $data = $request->request->all();
            
            $user = new User();
            // $user->setUserSurname($data['userSurname']);
            $user->setUserName($data['userName']);
            $user->setUserEmail($data['userEmail']);
            // $user->setUserDate($data['userDate']);
            $user->setUserSexe($data['userSexe']);
            $user->setUserPassword($data['userPassword']);
        
            $em->persist($user);
            $em->flush();
            
            return $this->redirectToRoute('home');
        }
        
        
        return $this->render("inscription.html.twig");
    }


}



?>
