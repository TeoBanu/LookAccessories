<?php

namespace Look\AppBundle\Controller;

use Look\AppBundle\Form\ProductType;
use Look\AppBundle\Form\CategoryType;
use Look\AppBundle\Entity\Product;
use Look\AppBundle\Entity\Category;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Form\FormError;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{

    /**
     * @Route("/products_admin", name="products_admin")
     * @Template
     */ 
    public function showProductsAction(Request $request)
    {
        $user = $request->getSession()->get('user/credential');
        if ($user) {
            if ($user->getIsAdmin()) {
                $em = $this->getDoctrine()->getManager();
                $repository = $em->getRepository('LookAppBundle:Product');
                $products = $repository->findAll();
                return $this->render('LookAppBundle:Admin:show_products.html.twig',
                                     array('products' => $products));
            }
        }
        return $this->redirect($this->generateUrl('index'));
    }

    /**
     * @Route("/addProduct", name="add_product")
     * @Template
     */
    public function addProductAction(Request $request, $category_id = null)
    {
        $user = $request->getSession()->get('user/credential');
        if ($user) {
            if ($user->getIsAdmin()) {
                $product = new Product();
                $form = $this->createForm(new ProductType(), $product);
                $form->handleRequest($request);
                if ($form->isValid()) {
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($form->getData());
                    $em->flush();
                    return $this->redirect($this->generateUrl("products_admin"));
                }
                return array('form' => $form->createView());
            }
        }
        return $this->redirect($this->generateUrl('index'));
    }

    /**
     * @Route("/deleteProduct/{product_id}", name="delete_product")
     * @Template
     */
    public function deleteProductAction(Request $request, $product_id)
    {
        $user = $request->getSession()->get('user/credential');
        if ($user) {
            if ($user->getIsAdmin()) {
                $em = $this->getDoctrine()->getManager();
                $repository = $em->getRepository('LookAppBundle:Product');
                $product = $repository->find($product_id);
                if ($product) {
                    $em->remove($product);
                    $em->flush();
                    return $this->redirect($this->generateUrl("products_admin"));
                } else {
                    return new Response("<html><body>Product doesn't exist</body></html>");
                }
            }
        }
        return $this->redirect($this->generateUrl('index'));
    }

    /**
     * @Route("/updateProduct/{product_id}", name="update_product")
     * @Template
     */
    public function updateProductAction(Request $request, $product_id)
    {
        $user = $request->getSession()->get('user/credential');
        if ($user) {
            if ($user->getIsAdmin()) {
                $em = $this->getDoctrine()->getManager();
                $repository = $em->getRepository('LookAppBundle:Product');
                $product = $repository->find($product_id);
                if ($product) {
                    $form = $this->createForm(new ProductType(), $product);
                    $form->handleRequest($request);
                    if ($form->isValid()) {
                        $em = $this->getDoctrine()->getManager();
                        $em->persist($form->getData());
                        $em->flush();
                        return $this->redirect($this->generateUrl("products_admin"));
                    }
                    return array('form' => $form->createView(), 'product_id' => $product_id);
                } else {
                    return new Response("<html><body>Product doesn't exist</body></html>");
                }
            }
        }
        return $this->redirect($this->generateUrl('index'));
    }

    /**
     * @Route("/categories_admin", name="categories_admin")
     * @Template
     */ 
    public function showCategoriesAction(Request $request)
    {
        $user = $request->getSession()->get('user/credential');
        if ($user) {
            if ($user->getIsAdmin()) {
                $em = $this->getDoctrine()->getManager();
                $repository = $em->getRepository('LookAppBundle:Category');
                $categories = $repository->findAll();
                return $this->render('LookAppBundle:Admin:show_categories.html.twig',
                                     array('categories' => $categories));
            }
        }
        return $this->redirect($this->generateUrl('index'));
    }

    /**
     * @Route("/orders_admin", name="orders_admin")
     * @Template
     */ 
    public function showOrdersAction(Request $request)
    {
        $user = $request->getSession()->get('user/credential');
        if ($user) {
            if ($user->getIsAdmin()) {
                $orders = $this->getDoctrine()->getManager()
                    ->getRepository('LookAppBundle:Cart')
                    ->findBy(array('is_cart' => false));
                return $this->render('LookAppBundle:Admin:show_orders.html.twig',
                                     array('orders' => $orders));
            }
        }
        return $this->redirect($this->generateUrl('index'));
    }

    /**
     * @Route("/addCategory", name="add_category")
     * @Template
     */
    public function addCategoryAction(Request $request)
    {
        $user = $request->getSession()->get('user/credential');
        if ($user) {
            if ($user->getIsAdmin()) {
                $category = new Category();
                $form = $this->createForm(new CategoryType(), $category);
                $form->handleRequest($request);
                if ($form->isValid()) {
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($form->getData());
                    $em->flush();
                    return $this->redirect($this->generateUrl("categories_admin"));
                }
                return array('form' => $form->createView());
            }
        }
        return $this->redirect($this->generateUrl('index'));
    }

    /**
     * @Route("/updateCategory/{category_id}", name="update_category")
     * @Template
     */
    public function updateCategoryAction(Request $request, $category_id)
    {
        $user = $request->getSession()->get('user/credential');
        if ($user) {
            if ($user->getIsAdmin()) {
                $em = $this->getDoctrine()->getManager();
                $repository = $em->getRepository('LookAppBundle:Category');
                $category = $repository->find($category_id);
                if ($category) {
                    $form = $this->createForm(new CategoryType(), $category);
                    $form->handleRequest($request);
                    if ($form->isValid()) {
                        $em = $this->getDoctrine()->getManager();
                        $em->persist($form->getData());
                        $em->flush();
                        return $this->redirect($this->generateUrl("categories_admin"));
                    }
                    return array('form' => $form->createView(), 'category_id' => $category_id);
                } else {
                    return new Response("<html><body>Category doesn't exist</body></html>");
                }
            }
        }
        return $this->redirect($this->generateUrl('index'));
    }

    /**
     * @Route("/deleteCategory/{category_id}", name="delete_category")
     * @Template
     */
    public function deleteCategoryAction(Request $request, $category_id)
    {
        $user = $request->getSession()->get('user/credential');
        if ($user) {
            if ($user->getIsAdmin()) {
                $em = $this->getDoctrine()->getManager();
                $repository = $em->getRepository('LookAppBundle:Category');
                $category = $repository->find($category_id);
                if ($category) {
                    $em->remove($category);
                    $em->flush();
                    return $this->redirect($this->generateUrl("categories_admin"));
                } else {
                    return new Response("<html><body>Category doesn't exist</body></html>");
                }
            }
        }
        return $this->redirect($this->generateUrl('index'));
    }
}
