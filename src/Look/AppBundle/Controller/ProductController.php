<?php

namespace Look\AppBundle\Controller;

use Look\AppBundle\Form\ProductType;
use Look\AppBundle\Entity\Product;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{

    /**
     * @Route("/products", name="show_products")
     * @Template
     */ 
    public function showProductsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('LookAppBundle:Product');
        $products = $repository->findAll();

        return $this->render('LookAppBundle:Product:show_products.html.twig',
                             array('products' => $products));
    }

    /**
     * @Route("/addProduct", name="add_product")
     * @Template
     */
    public function addProductAction(Request $request)
    {
        $product = new Product();
        $form = $this->createForm(new ProductType(), $product);
        $form->handleRequest($request);

        if ($form->isValid()) {
            // Get the entity manager
            $em = $this->getDoctrine()->getManager();

            // Save product to database
            $givenProduct = $form->getData();
            $em->persist($form->getData());
            $em->flush();

            return $this->redirect($this->generateUrl("show_products"));
        }

        return array('form' => $form->createView());
    }
}
