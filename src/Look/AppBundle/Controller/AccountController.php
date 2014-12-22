<?php

namespace Look\AppBundle\Controller;

use Look\AppBundle\Form\LoginType;
use Look\AppBundle\Form\RegisterType;
use Look\AppBundle\Entity\User;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Session\Session;

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
        // if there is already a user logged in, redirect to home page
        if ($request->getSession()->get('user/credential')) {
            return $this->redirect($this->generateUrl('index'));
        }

        $form = $this->createForm(new LoginType());
        $form->handleRequest($request);
        
        // check if this form is submitted
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
                $session = $request->getSession();
                $session->set('user/credential', $persistedUser);
                return $this->redirect($session->get('user/loginRedirect'));
            } else {
                throw new Exception("Invalid password.");
            }
        }
        
        // save referer url in session
        $request->getSession()->set('user/loginRedirect', $request->server->get('HTTP_REFERER'));

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
            
            $persistedUser = $form->getData();
            $plainPassword = $persistedUser->getPassword();
            $encryptedPass = hash("tiger192,4", self::SALT.$plainPassword);
            $persistedUser->setPassword($encryptedPass);
            
            $em->persist($form->getData());
            $em->flush();
            
            return $this->redirect($this->generateUrl("account_login"));
        }
        
        return array('form' => $form->createView());
}
    }
