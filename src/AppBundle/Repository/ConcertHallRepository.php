<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ConcertHallRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ConcertHallRepository extends EntityRepository
{
	public function alphabeticalQueryBuilder(){
		return $this->createQueryBuilder('ch')
			->orderBy('ch.name', 'ASC');
	}
}
