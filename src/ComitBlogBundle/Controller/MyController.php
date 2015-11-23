<?php

namespace ComitBlogBundle\Controller;

use ComitBlogBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class MyController extends Controller
{
//    public function indexAction($name)
//    {
//        return $this->render('', array('name' => $name));
//    }

    public function createAction()
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
     * @Route("/mycontroller/show{id}")
     *
     */
    public function showAction($id, $repository)
    {
        $product = $this->getDoctrine()
            ->getRepository('ComitBlog:Product')
            ->find($id);
        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        // query by the primary key (usually "id")
        $product2 = $repository->find($id);
        // dynamic method names to find based on a column value
        $product3 = $repository->findOneById($id);
        $product4 = $repository->findOneByName('foo');
        // find *all* products
        $products5 = $repository->findAll();
        // find a group of products based on an arbitrary column value
        $products6 = $repository->findByPrice(19.99);


        dump($product);
    }

    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('ComitBlog:Product')->find($id);
        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        $product->setName('New product name!');
        $em->flush();
        return $this->redirectToRoute('homepage');
    }

}
