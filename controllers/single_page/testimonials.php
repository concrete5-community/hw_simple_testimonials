<?php         
namespace Concrete\Package\HwSimpleTestimonials\Controller\SinglePage;
use Loader;
use \Concrete\Core\Page\Controller\PageController;
use \Concrete\Package\HwSimpleTestimonials\Src\TestimonialPageList;
use \Concrete\Core\Attribute\Key\CollectionKey as CollectionAttributeKey;
use Page;
use Core;
use Package;
use View;

defined('C5_EXECUTE') or die(_("Access Denied."));
class Testimonials extends PageController
{
	public $helpers = array('form');
	    public function view()
    {
		
		    $c = Page::getCurrentPage();
            
            $metaT = t('Testimonial');
            $metaD = t('Companies Testimonials');
            
            $mtitle = CollectionAttributeKey::getByHandle('meta_title');
            $c->setAttribute($mtitle,$metaT);
            
            $mdesc = CollectionAttributeKey::getByHandle('meta_description');
            $c->setAttribute($mdesc,$metaD);
			  
 
        $testimonialList = new TestimonialPageList();       
        $testimonialList->setItemsPerPage(20);
        $paginator = $testimonialList->getPagination();
        $pagination = $paginator->renderDefaultView();
        $this->set('testimonialslist',$paginator->getCurrentPageResults());  
        $this->set('pagination',$pagination);
        $this->set('paginator', $paginator);  
		
			$pkg = Package::getByHandle('hw_simple_testimonials');
			$packagePath = $pkg->getRelativePath();

			$this->addHeaderItem(Core::make('helper/html')->css($packagePath.'/css/testimonial.css','testimonial')); 
    }

}
