<?php      
namespace Concrete\Package\HwSimpleTestimonials\Src;

use Database;
use Concrete\Core\Search\Pagination\Pagination;
use Concrete\Core\Search\ItemList\Database\ItemList as DatabaseItemList;
use Pagerfanta\Adapter\DoctrineDbalAdapter;

use Concrete\Package\HwSimpleTestimonials\Src;
use Concrete\Package\HwSimpleTestimonials\Src\Testimonial;

class TestimonialPageList extends DatabaseItemList {
	
	
	 public function createQuery()
    {
        $this->query
        ->select('t.sID')
        ->from('bthwsimpletestimonial','t')
        ->orderBy('sortOrder', 'ASC');
    }
	
	public function getResult($queryRow)
    {
        return Testimonial::getByID($queryRow['sID']);
    }
	
	protected function createPaginationObject()
    {
        $adapter = new DoctrineDbalAdapter($this->deliverQueryObject(), function ($query) {
            $query->select('count(distinct t.sID)')->setMaxResults(1);
        });
        $pagination = new Pagination($this, $adapter);
        return $pagination;
    }
	
	public function getTotalResults()
    {
        $query = $this->deliverQueryObject();
        return $query->select('count(distinct t.sID)')->setMaxResults(1)->execute()->fetchColumn();
    }
	
}
?>