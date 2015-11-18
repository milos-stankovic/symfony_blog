<?php

namespace ComitBlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class LuckyController extends Controller
{
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
        return new Response(json_encode($data),
                            200,
                            array('Content-Type' => 'application/json')
        );
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
        return new Response(
            '<html><body>Lucky numbers: '.$numbersList.'</body></html>'
        );
    }


}
