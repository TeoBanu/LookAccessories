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

class StaticController extends Controller
{

    /**
     * @Route( "/")
     * @Template
     */ 
    public function indexAction()
    {
        return $this->render('LookAppBundle:Static:index.html.twig');
    }

	/**
     * @Route( "/about")
     * @Template
     */ 
    public function aboutAction(Request $request)
    {
    	return $this->render('LookAppBundle:Static:about.html.twig');
    }
    
}
