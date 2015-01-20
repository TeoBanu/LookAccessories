<?php

namespace Look\AppBundle\Controller;

use Look\AppBundle\Form\ProductType;
use Look\AppBundle\Entity\Product;
use Look\AppBundle\Entity\CartProduct;
use Look\AppBundle\Entity\Cart;
use Look\AppBundle\Entity\User;
use Look\AppBundle\Entity\Address;

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
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('LookAppBundle:Product');
        $products = $repository->findAll();
        return $this->render('LookAppBundle:Product:show_products.html.twig',
                             array('products' => $products));
    }

    /**
     * @Route("/products/{category}", name="show_filtered_products")
     * @Template
     */ 
    public function showFilteredProductsAction($category, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('LookAppBundle:Product');
        $products = $repository->findBy(
            array('category' => $category)
        );
        return $this->render('LookAppBundle:Product:show_products.html.twig',
                             array('products' => $products));
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

            if (count($cart->getCartProducts()) > 0) {
                $errorEmpty = false;
                foreach ($cart->getCartProducts() as $cartProduct) {
                    $product = $cartProduct->getProduct();
                    $newStock = $product->getStock() - $cartProduct->getQuantity();
                    $product->setStock($newStock);
                    $em->persist($product);
                }

                $cart->setIsCart(false);
                $em->persist($cart);

                // send email
                $dbUser = $em->getRepository('LookAppBundle:User')->findOneBy(
                    array('id' => $user->getId())
                );
                $this->sendEmail($cart, $dbUser, $dbUser->getAddress());

                $newCart = new Cart();
                $newCart->setIsCart(true);
                $dbUser = $em->getRepository('LookAppBundle:User')->find($user->getId());
                $newCart->setUser($dbUser);
                $em->persist($newCart);

                $em->flush();
            } else {
                $this->get('session')->getFlashBag()->set('error', 'Cannot order before adding products to your cart');
            }


            return $this->redirect($this->generateUrl("show_cart"));
        }
        return $this->redirect($this->generateUrl("account_login"));
    }

    private function sendEmail(Cart $cart, User $user, Address $address) {
        $order = '497232'.$cart->getId();
        $address = $this->addressString($address);
        $details = $this->personalDetails($user);

        $mailer = $this->get('mailer');
        $message = $mailer->createMessage()
        ->setSubject('Order number '.$order)
        ->setFrom('look.accessories.romania@gmail.com')
        ->setTo($user->getEmail())
        ->setBody(
            $this->renderView(
                'LookAppBundle:Static:email.html.twig',
                array(
                    'firstname' => $user->getFirstName(),
                    'order' => $order,
                    'cart' => $cart,
                    'address' => $address,
                    'details' => $details,
                )
            )
        )
        ->setContentType("text/html")
    ;
        $mailer->send($message); 
    }

    private function addressString(Address $address) {
        return $address->getNumber()." ".$address->getStreet().", apt. ".$address->getApartment()
                    .", ".$address->getCity().", ".$address->getRegion().", ".$address->getCountry();
    }

    private function personalDetails(User $user) {
        return $user->getFirstName()." ".$user->getLastName()." tel:".$user->getPhoneNumber();
    }
}
