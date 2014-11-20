<?php

namespace Books\Repositories;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Zend\Stdlib\ParametersInterface;
use Books\Repositories\Exception;

/**
 * Description of BookRepository
 *
 * @author Akinyemi Odunlami <akinyemiodunlami@yahoo.co.uk>
 */
class BookRepository extends EntityRepository {

    public function fetchBooks( ParametersInterface $criteria, $resultType = Query::HYDRATE_ARRAY ) {

        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb->select(array('b', 'a'))
                ->from('Books\Entities\Book', 'b', 'b.id')
                ->leftJoin('b.authors', 'a')
                ->orderBy('b.title')
                ->addOrderBy('a.lastname')
                ->addOrderBy('a.firstname'); 
        
        if ( isset($criteria['id']) && strlen($criteria['id']) > 0 ) {
            $qb->andWhere($qb->expr()->eq('b.id', ':id'))->setParameter('id', $criteria['id']);
        }
        
        if ( isset($criteria['isbn']) && strlen($criteria['isbn']) > 0 ) {
            $qb->andWhere($qb->expr()->eq('b.isbn', ':isbn'))->setParameter('isbn', $criteria['isbn']);
        }
        
        if ( isset($criteria['title']) && strlen($criteria['title']) > 0 ) {
            $qb->andWhere($qb->expr()->eq('b.title', ':title'))->setParameter('title', $criteria['title']);
        }
        
        if ( isset($criteria['rating']) && strlen($criteria['rating']) > 0 ) {
            $qb->andWhere($qb->expr()->eq('b.rating', ':rating'))->setParameter('rating', $criteria['rating']);
        }
        
        if ( isset($criteria['firstname']) && strlen($criteria['firstname']) > 0 ) {
            $qb->andWhere($qb->expr()->like('a.firstname', ':firstname'))->setParameter('firstname', $criteria['firstname']);
        }
        
        if ( isset($criteria['lastname']) && strlen($criteria['lastname']) > 0 ) {
            $qb->andWhere($qb->expr()->eq('a.lastname', ':lastname'))->setParameter('lastname', $criteria['lastname']);
        }       
        
        if ( isset($criteria['startdate']) && $criteria['startdate'] instanceof \DateTime ) {
            $qb->andWhere($qb->expr()->gte('b.startdate', ':startdate'))->setParameter('startdate', $criteria['startdate']->format('Y-m-d H:i:s'));
        }
        
        if ( isset($criteria['enddate']) && $criteria['enddate'] instanceof \DateTime ) {
            $qb->andWhere($qb->expr()->lte('b.enddate', ':enddate'))->setParameter('enddate', $criteria['enddate']->format('Y-m-d H:i:s'));
        }
        
        if ( isset($criteria['offset']) && strlen($criteria['offset']) > 0  ) {
            $qb->setFirstResult($criteria['offset']);
        }
        
        if ( isset($criteria['limit']) && strlen($criteria['limit']) > 0  ) {
            $qb->setMaxResults($criteria['limit']);
        }
        
        try {

            $query      = $qb->getQuery();
            $results    = $query->getResult($resultType);
            
        } catch (\Exception $e) {
            throw new Exception\QueryRuntimeException( sprintf('%s experienced an error running query: %s', __METHOD__, 
                    $qb->getDQL()), null, $e);
        }

        return $results; 
        
    }
    
}

