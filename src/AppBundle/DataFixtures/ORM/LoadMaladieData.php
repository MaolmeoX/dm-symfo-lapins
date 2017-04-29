<?php
/**
 * Created by PhpStorm.
 * User: MaolmeoX
 * Date: 29/04/2017
 * Time: 17:27
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Maladie;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadMaladieData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $maladie = new Maladie();
        $maladie->setNom('cancer de la truffe');
        $maladie->addEspece($this->getReference('chien'));
        $manager->persist($maladie);

        $maladie2 = new Maladie();
        $maladie2->setNom('cirrhose des moustaches');
        $maladie2->addEspece($this->getReference('chat'));
        $maladie2->addEspece($this->getReference('lapin'));
        $manager->persist($maladie2);

        $maladie3 = new Maladie();
        $maladie3->setNom('crise cardiaque');
        $maladie3->addEspece($this->getReference('lapin'));
        $manager->persist($maladie3);

        $maladie4 = new Maladie();
        $maladie4->setNom('tuberculose du poil');
        $maladie4->addEspece($this->getReference('chat'));
        $maladie4->addEspece($this->getReference('lapin'));
        $maladie4->addEspece($this->getReference('chien'));
        $manager->persist($maladie4);

        $manager->flush();

        $this->addReference('truffe', $maladie);
        $this->addReference('moustaches', $maladie2);
        $this->addReference('cardiaque', $maladie3);
        $this->addReference('tuberculose', $maladie4);
    }

    public function getOrder()
    {
        return 2;
    }
}