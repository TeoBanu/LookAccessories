<?php

namespace Look\AppBundle\Controller;

use Look\AppBundle\Form\LoginType;
use Look\AppBundle\Form\RegisterType;
use Look\AppBundle\Form\PasswordUpdateType;
use Look\AppBundle\Form\AccountUpdateType;
use Look\AppBundle\Entity\User;
use Look\AppBundle\Entity\Cart;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Form\FormError;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ExceptionController extends Controller
{

	/**
     * @Template
     */ 
    public function showExceptionAction(Request $request) {
        return $this->render('LookAppBundle:Static:error.html.twig');
    }
}
