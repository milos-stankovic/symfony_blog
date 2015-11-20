<?php

namespace ComitBlogBundle\Controller;

use ComitBlogBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

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
}
