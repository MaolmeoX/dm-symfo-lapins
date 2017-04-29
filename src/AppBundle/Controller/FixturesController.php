<?php
/**
 * Created by PhpStorm.
 * User: MaolmeoX
 * Date: 29/04/2017
 * Time: 18:55
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Console\Output\NullOutput;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FixturesController extends Controller
{

    /**
     * @Route("/remplissage", name="remplissage_bdd", options={"expose"=true})
     * @Method("GET")
     */
    public function populateAction()
    {
        $kernel = $this->get('kernel');
        $application = new Application($kernel);
        $application->setAutoExit(false);

        $input = new ArrayInput(array(
            'command' => 'doctrine:fixtures:load','-q'
        ));

        // You can use NullOutput() if you don't need the output
        $output = new NullOutput();
        $application->run($input, $output);

        return new Response('La base de données à été mise à jour.', 200);
    }
}