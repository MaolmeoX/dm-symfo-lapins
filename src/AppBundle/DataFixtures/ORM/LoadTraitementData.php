<?php
/**
 * Created by PhpStorm.
 * User: MaolmeoX
 * Date: 29/04/2017
 * Time: 17:43
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Traitement;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadTraitementData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $traitement = new Traitement();
        $traitement->setNom('ablation de la zone atteinte');
        $traitement->setMaladie($this->getReference('truffe'));
        $manager->persist($traitement);

        $traitement2 = new Traitement();
        $traitement2->setNom('tremper les moustache dans un bain d’acide sulfurique');
        $traitement2->setMaladie($this->getReference('moustaches'));
        $manager->persist($traitement2);

        $traitement3 = new Traitement();
        $traitement3->setNom('arrêter d’avoir peur');
        $traitement3->setMaladie($this->getReference('cardiaque'));
        $manager->persist($traitement3);

        $traitement4 = new Traitement();
        $traitement4->setNom('incurable');
        $traitement4->setMaladie($this->getReference('tuberculose'));
        $manager->persist($traitement4);

        $manager->flush();

    }

    public function getOrder()
    {
        return 3;
    }
}