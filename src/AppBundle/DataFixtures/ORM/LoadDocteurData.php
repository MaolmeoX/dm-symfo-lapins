<?php
/**
 * Created by PhpStorm.
 * User: MaolmeoX
 * Date: 29/04/2017
 * Time: 17:47
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Docteur;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadDocteurData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $docteur = new Docteur();
        $docteur->setPrenom('Buffalo');
        $docteur->setNom('Grill');
        $docteur->addEspece($this->getReference('cheval'));
        $docteur->addEspece($this->getReference('chat'));
        $manager->persist($docteur);

        $docteur2 = new Docteur();
        $docteur2->setPrenom('Ricky');
        $docteur2->setNom('Mustang');
        $docteur2->addEspece($this->getReference('cheval'));
        $docteur2->addEspece($this->getReference('lapin'));
        $manager->persist($docteur2);

        $docteur3 = new Docteur();
        $docteur3->setPrenom('Fox');
        $docteur3->setNom('Malin');
        $docteur3->addEspece($this->getReference('cheval'));
        $docteur3->addEspece($this->getReference('lapin'));
        $docteur3->addEspece($this->getReference('chien'));
        $docteur3->addEspece($this->getReference('chat'));
        $manager->persist($docteur3);


        $manager->flush();
    }

    public function getOrder()
    {
        return 4;
    }

}