<?php

namespace Look\AppBundle\Controller;

use Look\AppBundle\Form\ProductType;
use Look\AppBundle\Entity\Product;
use Look\AppBundle\Entity\CartProduct;
use Look\AppBundle\Entity\Cart;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Form\FormError;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{

    /**
     * @Route("/products", name="show_products")
     * @Template
     */ 
    public function showProductsAction(Request $request)
    {
        $user = $request->getSession()->get('user/credential');
        if ($user) {
            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('LookAppBundle:Product');
            $products = $repository->findAll();
            return $this->render('LookAppBundle:Product:show_products.html.twig',
                                 array('products' => $products));
        }
        return $this->redirect($this->generateUrl("account_login"));
    }

    /**
     * @Route("/cart", name="show_cart")
     * @Template
     */ 
    public function cartAction(Request $request)
    {
        $user = $request->getSession()->get('user/credential');
        if ($user) {
            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('LookAppBundle:Cart');
            $cart = $repository->findOneBy(
                array('user' => $user->getId(), 'is_cart' => true)
            );
            return $this->render('LookAppBundle:Product:cart.html.twig',
                                 array('cart' => $cart));
        }
        return $this->redirect($this->generateUrl("account_login"));
    }

    /**
     * @Route("/addToCard/{product_id}", name="add_to_cart")
     * @Template
     */ 
    public function addToCartAction(Request $request, $product_id)
    {
        $user = $request->getSession()->get('user/credential');
        if ($user) {
            $em = $this->getDoctrine()->getManager();

            $cart = $em->getRepository('LookAppBundle:Cart')->findOneBy(
                array('user' => $user->getId(), 'is_cart' => true)
            );
            $cartProduct = $em->getRepository('LookAppBundle:CartProduct')->findOneBy(
                array('cart' => $cart->getId(), 'product' => $product_id)
            );
            $product = $em->getRepository('LookAppBundle:Product')
                ->find($product_id);

            if (!$cartProduct) {
                $cartProduct = new CartProduct();
                $cartProduct->setProduct($product);
                $cartProduct->setCart($cart);
                $cartProduct->setQuantity(1);
                $em->persist($cartProduct);
                $em->flush();
            } else {
                $newQuantity = $cartProduct->getQuantity() + 1;
                $cartProduct->setQuantity($newQuantity);
                $em->persist($cartProduct);
                $em->flush();
            }
            return $this->redirect($this->generateUrl("show_cart"));
        }
        return $this->redirect($this->generateUrl("account_login"));
    }

    /**
     * @Route("/buy", name="buy")
     * @Template
     */ 
    public function buyAction(Request $request)
    {
        $user = $request->getSession()->get('user/credential');
        if ($user) {
            $em = $this->getDoctrine()->getManager();

            $cart = $em->getRepository('LookAppBundle:Cart')->findOneBy(
                array('user' => $user->getId(), 'is_cart' => true)
            );

            foreach ($cart->getCartProducts() as $cartProduct) {
                $product = $cartProduct->getProduct();
                $newStock = $product->getStock() - $cartProduct->getQuantity();
                $product->setStock($newStock);
                $em->persist($product);
            }

            $cart->setIsCart(false);
            $em->persist($cart);

            $newCart = new Cart();
            $newCart->setIsCart(true);
            $dbUser = $em->getRepository('LookAppBundle:User')->find($user->getId());
            $newCart->setUser($dbUser);
            $em->persist($newCart);

            $em->flush();

            return $this->redirect($this->generateUrl("show_cart"));
        }
        return $this->redirect($this->generateUrl("account_login"));
    }
}
