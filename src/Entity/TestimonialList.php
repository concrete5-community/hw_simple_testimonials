<?php

namespace HwSimpleTestimonials\Entity;

use Concrete\Core\Search\ItemList\Database\ItemList;
use Concrete\Core\Search\Pagination\Pagination;
use Pagerfanta\Adapter\DoctrineDbalAdapter;

class TestimonialList extends ItemList
{
    /**
     * Create base query
     */
    public function createQuery()
    {
        $this->query->select('e.sID')
            ->from('bthwsimpletestimonial', 'e')
            ->orderBy('SortOrder', 'ASC');
    }

    public function finalizeQuery(\Doctrine\DBAL\Query\QueryBuilder $query)
    {

        if ($this->randomSort > 0) {
            $this->query->orderBy('RAND()');
        }

        if ($this->limit > 0) {
            $this->query->setMaxResults($this->limit);
        }
        return $this->query;
    }

    public function setLimit($limit = 0)
    {
        $this->limit = $limit;
    }

    public function setRandom($randomSort = 0)
    {
        $this->randomSort = $randomSort;
    }

    /**
     * Returns the total results in this list.
     * @return int
     */
    public function getTotalResults()
    {
        $query = $this->deliverQueryObject();
        return $query->select('count(e.sID)')
            ->setMaxResults(1)
            ->execute()
            ->fetchColumn();
    }

    /**
     * Gets the pagination object for the query.
     * @return Pagination
     */
    protected function createPaginationObject()
    {
        $adapter = new DoctrineDbalAdapter($this->deliverQueryObject(), function ($query) {
            $query->select('count(e.sID)')->setMaxResults(1);
        });
        $pagination = new Pagination($this, $adapter);
        return $pagination;
    }

    /**
     * Object mapping
     *
     * @param $queryRow
     * @return \HwSimpleTestimonials\Entity\Testimonial
     */
    public function getResult($queryRow)
    {
        $ai = Testimonial::getByID($queryRow['sID']);
        return $ai;
    }
}