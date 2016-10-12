<?php
namespace AppBundle\DataFixtures\ORM;

use AppBunlde\Entity\Album;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Nelmio\Alice\Fixtures;

class LoadFixtures implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        /*$album = new Album();
        $album->setName('The beatles');
		$album->setDescription('super bien !');
		$album->setIsPublish(1);

        $manager->persist($album);
        $manager->flush();*/

        /*$objects = Fixtures::load(__DIR__.'/fixtures.yml', $manager);*/
        $objects = Fixtures::load( __DIR__.'/fixtures.yml', $manager,
            [
                'providers' => [$this] 
            ]
        );
    }

    public function category(){
        
        $pouf=[
            'Electro',
            'Pop',
            'Punk'
        ];
        $key = array_rand($pouf);
        return $pouf[$key];
    }
}