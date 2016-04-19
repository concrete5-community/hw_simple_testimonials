<?php          
namespace Concrete\Package\HwSimpleTestimonials\Block\HwSimpleTestimonials;
use Package;
use View;
use Loader;
use Page;
use Core;
use \Concrete\Core\Block\BlockController;
use \Concrete\Package\HwSimpleTestimonials\Src\TestimonialSingleList;

defined('C5_EXECUTE') or die(_("Access Denied."));

class Controller extends BlockController {
	

		protected $btTable = 'bthwsimpletestimonialblock';
		protected $btInterfaceWidth = "400";
		protected $btInterfaceHeight = "425";
		
		public $num = "";
		public $paginate = "1";

	public function getBlockTypeDescription()
    {
        return t("Simple Testimonials Block. Displays a random Testimonial to a page.");
    }

    public function getBlockTypeName()
    {
        return t("HW Simple Testimonials");
    }

	    public function view()
    {
		$pkg = Package::getByHandle('hw_simple_testimonials');    
        $packagePath = $pkg->getRelativePath();
		$this->addHeaderItem(Core::make('helper/html')->css($packagePath.'/css/testimonial.css','testimonial')); 
	
			$testimonialList = new TestimonialSingleList();
			$testimonialList = $testimonialList->getResults();
			$this->set('testimonialslist', $testimonialList);
    }
	
	
	public function save($data) {
						
		parent::save($args);

	}
	
}
?>