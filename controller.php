<?php      
namespace Concrete\Package\HwSimpleTestimonials;
use Package;
use BlockType;
use SinglePage;
use View;
use Loader;
use Route;

defined('C5_EXECUTE') or die(_("Access Denied."));

class Controller extends Package {

	protected $pkgHandle = 'hw_simple_testimonials';
	protected $appVersionRequired = '5.7.4';
	protected $pkgVersion = '1.0.0';
			
	public function on_start()
	{
		Route::register('/hwsimpletestimonials/sortorder', '\Concrete\Package\HwSimpleTestimonials\Controller\SinglePage\Dashboard\SortTestimonialOrder::SortOrder');
	}
 	
	public function getPackageName() 
	{
		return t("HonestWebsites Simple testimonials");
	}

	public function getPackageDescription() 
	{
		return t("Show multiple testimonials on your site");
	}

	public function install() 
	{
		$pkg = parent::install();

		// install block
		BlockType::installBlockTypeFromPackage('hw_simple_testimonials', $pkg);
		
		//Install dashboard pages
		$page1 = SinglePage::add('/dashboard/hw_simple_testimonials', $pkg);
        $page1->updateCollectionName(t('HW Simple Testimonials'));
		
		$page2 = SinglePage::add('/dashboard/hw_simple_testimonials/addtestimonials', $pkg);
		$page2->updateCollectionName(t('Add Testimonial'));
		
		
		$page3 = SinglePage::add('/testimonials', $pkg);
		$page3->setAttribute('exclude_nav', 1);

		
		return $pkg;
	}
	public function uninstall() {
		parent::uninstall();
		$db = Loader::db();
		$db->Execute('DROP TABLE bthwsimpletestimonialblock');
	}

}