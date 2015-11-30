<?php

namespace ComitBlogBundle\Controller;

use ComitBlogBundle\Entity\Category;
use ComitBlogBundle\Entity\Product;
use ComitBlogBundle\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class MyController extends Controller
{
//    public function indexAction($name)
//    {
//        return $this->render('', array('name' => $name));
//    }

    /**
     * @return Response
     * @Route("products/test")
     */

    public function Test()
    {
        return $this->render('default/products.html.twig');
    }


    /**
     * @return Response
     * @Route("/products/add")
     */

    public function addAction()
    {
        $product = new Product();
        $product->setName('Telefon');
        $product->setPrice(19.99);
        $product->setDescription('Nokia 3310');

        //entity manager -> insert and fetch objects from/in database.
        //get the container, get the doctrine service, then call getManager on it.
        $em = $this->getDoctrine()->getManager();

        $em->persist($product);
        $em->flush();

        return new Response('Created product id' . $product->getId());
    }

    /**
     * @param $id
     * @Route("/products/show/{id}")
     *
     */
    public function showAction($id)
    {
        $product = $this->getDoctrine()
            ->getRepository('ComitBlogBundle:Product')
            ->find($id);
        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        //dump($product->getDescription());
    }

    /**
     * @param $id
     * @Route("/products/show2/{id}")
     */
    public function showAction2($id)
    {
        // ...->getRepository('bundle_name:entity_name');
        $repository = $this->getDoctrine()->getRepository('ComitBlogBundle:Product');

               // query by the primary key (usually "id")
        $products1 = $repository->find($id);
        // dynamic method names to find based on a column value
        $products2 = $repository->findOneById($id);
        $products3 = $repository->findOneByName('Telefon');
        // find *all* products
        $products4 = $repository->findAll();
        // find a group of products based on an arbitrary column value
        $products5 = $repository->findByPrice(19.99);

        $products6 = $repository->findOneBy(
            array('name' => 'Telefon', 'price' => 19.99)
        );
        $products7 = $repository->findBy(
            array('name' => 'Telefon'),
            array('price' => 'ASC')
        );

        //dump($products4);
        return new Response(dump($products4));
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route("/products/edit/{id}")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('ComitBlogBundle:Product')->find($id);
        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        $product->setDescription('Samsung');
        $em->flush();
        return new Response('Object property changed to'. " " .$product->getDescription());
        //return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/products/repository/finder")
     *
     */
    public function findUsingRepository()
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('ComitBlogBundle:Product')
                ->findAllOrderedByName();
        return $this->render('default/products.html.twig', array(
        'products' => $product,
    ));
//        return new Response($view);
    }
    //<-------------------------------------- RELATIONS -------->
    /**
     * @return Response
     * @Route("/products/product&category/")
     */
    public function createProductAction()
    {
        $category = new Category();
        $category->setName('Telefoni');

        $product = new Product();
        $product->setName('Xperia');
        $product->setPrice(23.16);
        $product->setDescription('Fontele i po');

        $product->setCategory($category);

        $em = $this->getDoctrine()->getManager();
        $em->persist($category);
        $em->persist($product);
        $em->flush();

        return new Response(
            'Created product id' .$product->getId()

            . " "

            .'and category id' .$category->getId()
        );
    }

    //<----------------- FORMS---------------------------------->
    /**
     * @return Response
     * @Route("/products/add-new")
     */
    public function addNewProductForm(Request $request)
    {
        $product = new Product();

        $form = $this->createFormBuilder($product)
            ->add('name','text')
            ->add('price', 'number')
            ->add('description', 'text')
            ->add('category', 'entity', array(
                'class' => 'ComitBlogBundle:Category',
                'choices' => $product->getCategory()
            ))
            ->add('save', 'submit')
            ->getForm();

        // handleRequest() = When the user submits the form,
        // handleRequest() recognizes this and immediately writes the
        // submitted data back $product
        $form->handleRequest($request);
        if($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();
            return new Response('Product added successfuly');
        }

        return $this->render('default/new.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @return Response
     * @Route("/products/add/new")
     */
    public function addProductAction(Request $request)
    {
        $product = new Product();
        $form = $this->createForm(new ProductType(), $product);
        $form->handleRequest($request);

        if($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();
        }
        $session = $this->get('session');
        $session->getFlashBag()->add('message', 'Product added successfuly');

        return $this->render('default/form.html.twig', array(
            'form' => $form->createView()
        ));

    }

//    public function Test()
//    {
//        return $this->render();
//    }


}
