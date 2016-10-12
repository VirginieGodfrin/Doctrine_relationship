<?php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Album;

class LoadFixtures implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $album = new Album();
        $album->setName('The beatles');
		$album->setDescription('super bien !');
		$album->setIsPublish(1);

        $manager->persist($album);
        $manager->flush();
    }
}