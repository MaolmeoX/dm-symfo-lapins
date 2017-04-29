<?php
/**
 * Created by PhpStorm.
 * User: MaolmeoX
 * Date: 30/04/2017
 * Time: 00:50
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Client;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadClientData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $client = new Client();
        $client->setNom('Ricky');
        $client->setCouleur('rose');
        $client->setEspece($this->getReference('chien'));
        $manager->persist($client);

        $client2 = new Client();
        $client2->setNom('Bobby');
        $client2->setCouleur('pourpre');
        $client2->setEspece($this->getReference('chat'));
        $manager->persist($client2);

        $client3 = new Client();
        $client3->setNom('Igloo');
        $client3->setCouleur('blanc');
        $client3->setEspece($this->getReference('lapin'));
        $manager->persist($client3);

        $client4 = new Client();
        $client4->setNom('Hydra');
        $client4->setCouleur('marron');
        $client4->setEspece($this->getReference('cheval'));
        $manager->persist($client4);


        $manager->flush();
    }

    public function getOrder()
    {
        return 5;
    }
}