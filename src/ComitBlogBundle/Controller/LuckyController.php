<?php

namespace ComitBlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class LuckyController extends Controller
{
    /**
     * @Route("/")
     */

    public function helloAction()
    {
    return new Response('Ya, man! This is my home route');
    }

    /**
     *  @Route("/lucky/number")
     */

    public function numberAction()
    {
        $number = rand(0,100);

        return new Response('<html><body>Lucky Number:' .$number. '</body></html>');
    }

    /**
     * @return Response
     * @Route*("/api/lucky/number/")
     */

    public function apiNumberAction()
    {
        $data = array(
            'lucky_number' => rand(0, 100),
        );
        //dump($data);
        return new Response(json_encode($data),
                            200,
                            array('Content-Type' => 'application/json')
        );
//

    }

    /**
     * @return Response
     * @Route*("/api/lucky/number/json/")
     */

    public function apiNumberAction2()
    {
        $data = array(
            'lucky_number' => rand(0, 100),
        );
        return new JsonResponse($data);
    }

    /**
     * @Route("/lucky/number/{count}")
     */
    public function numberAction3($count)
    {
        $numbers = array();
        for ($i = 0; $i < $count; $i++) {
            $numbers[] = rand(0, 100);
        }
        $numbersList = implode(', ', $numbers);
//        dump($numbersList);
        return new Response(
            '<html><body>Lucky numbers: '.$numbersList.'</body></html>'
        );
    }

    /**
     * @Route("lucky/number/twig/{count}")
     */
    public function numberAction4($count)
    {
        $numbers = array();
        for ($i = 0; $i < $count; $i++) {
            $numbers[] = rand(0, 100);
        }

        $numbersList = implode(', ', $numbers);

        $html = $this->container->get('templating')
                                ->render('lucky/number.html.twig',
                                array('luckyNumberList' => $numbersList)
            );
        return new Response($html);
    }

}
