<?php
/**
 * Created by PhpStorm.
 * User: MaolmeoX
 * Date: 29/04/2017
 * Time: 17:10
 */

namespace AppBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Espece;

class LoadEspeceData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // TODO: Implement load() method.
        $espece = new Espece();
        $espece->setNom('chien');
        $manager->persist($espece);

        $espece2 = new Espece();
        $espece2->setNom('chat');
        $manager->persist($espece2);

        $espece3 = new Espece();
        $espece3->setNom('lapin');
        $manager->persist($espece3);

        $espece4 = new Espece();
        $espece4->setNom('cheval');
        $manager->persist($espece4);

        $manager->flush();

        $this->addReference('chien', $espece);
        $this->addReference('chat', $espece2);
        $this->addReference('lapin', $espece3);
        $this->addReference('cheval', $espece4);
    }

    public function getOrder()
    {
        return 1;
    }

}