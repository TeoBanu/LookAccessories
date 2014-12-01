<?php

namespace Look\AppBundle\Controller;

use Look\AppBundle\Form\LoginType;
use Look\AppBundle\Form\RegisterType;
use Look\AppBundle\Entity\User;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Config\Definition\Exception\Exception;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class AccountController extends Controller
{

    const SALT = "1300513860358";
    
    /**
     * @Route("/login", name="account_login")
     * @Template
     */ 
    public function loginAction(Request $request)
    {
        $form = $this->createForm(new LoginType());
        $form->handleRequest($request);
        
        if ($form->isValid()) {
            $username = $form->get('username')->getData();
            $plainPassword = $form->get('password')->getData();
            
            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository("LookAppBundle:User");
            $persistedUser = $repository->findOneBy(
                array('username' => $username)
            );
            
            if(!$persistedUser) {
                throw new Exception("Invalid username.");
            }
            
            $encryptedPass = hash("tiger192,4", self::SALT.$plainPassword);
            if ($encryptedPass === $persistedUser->getPassword()) {
                throw new Exception("Good password.");
            } else {
                throw new Exception("Invalid password.");
            }
        }
        
        return array('form' => $form->createView());
    }
    
    /**
     * @Route("/register", name="account_register")
     * @Template
     */ 
    public function registerAction(Request $request) {
        $user = new User();
        $form = $this->createForm(new RegisterType(), $user);
        $form->handleRequest($request);
        
        if ($form->isValid()) {
            // get the entity manager
            $em = $this->getDoctrine()->getManager();
            
            $persistentUser = $form->getData();
            $plainPassword = $persistentUser->getPassword();
            $encryptedPass = hash("tiger192,4", self::SALT.$plainPassword);
            $persistentUser->setPassword($encryptedPass);
            
            $em->persist($form->getData());
            $em->flush();
            
            return $this->redirect($this->generateUrl("account_login"));
        }
        
        return array('form' => $form->createView());
}
    }
