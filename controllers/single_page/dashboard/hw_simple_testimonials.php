<?php         
namespace Concrete\Package\HwSimpleTestimonials\Controller\SinglePage\Dashboard;
use \Concrete\Core\Page\Controller\DashboardPageController;
use Loader;
use \Concrete\Package\HwSimpleTestimonials\Src\TestimonialPageList;

defined('C5_EXECUTE') or die(_("Access Denied."));
class HwSimpleTestimonials extends DashboardPageController {
	public $helpers = array('form');

	    public function view()
    {
        $testimonialList = new TestimonialPageList();       
        $testimonialList->setItemsPerPage(25);
        $paginator = $testimonialList->getPagination();
        $pagination = $paginator->renderDefaultView();
        $this->set('testimonialslist',$paginator->getCurrentPageResults());  
        $this->set('pagination',$pagination);
        $this->set('paginator', $paginator);     
    }


	
	public function delete_check($sID) {
		$db = Loader::db();
		$db->Execute(
			'DELETE FROM bthwsimpletestimonial WHERE sID = ' . $sID
		);
		$this->set('success', t("Testimonial Deleted."));
		$this->view();
	}
	
	public function testimonial_added()
    {
        $this->set('success', t("Testimonial Added."));
        $this->view();
    }
	
	public function testimonial_updated()
    {
        $this->set('success', t("Testimonial Updated."));
        $this->view();
    }
	public function sortorder() {
		
	}
}

?>