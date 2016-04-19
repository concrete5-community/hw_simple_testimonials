<?php        
namespace Concrete\Package\HwSimpleTestimonials\Controller\SinglePage\Dashboard\HwSimpleTestimonials;
use \Concrete\Core\Page\Controller\DashboardPageController;
use Loader;
use \Concrete\Core\User\EditResponse as UserEditResponse;

defined('C5_EXECUTE') or die(_("Access Denied."));
class Addtestimonials extends DashboardPageController {
	

	

	public function view() 
	{
		        $this->requireAsset('core/file-manager');
        $this->requireAsset('core/sitemap');
        $this->requireAsset('redactor');
		$html = Loader::helper('html');
		$this->set('form',Loader::helper('form'));
	}
	
	public function edit($sID)
	{
		$html = Loader::helper('html');
		$this->set('form',Loader::helper('form'));
		
		$testimonial = $sID;
		
		$db = Loader::db();
		$q = "SELECT sID, author, company, testimonial, extra FROM bthwsimpletestimonial WHERE sID = '{$sID}'";
		$r = $db->query($q);
		if ($r) {
			 $row = $r->fetchRow();

			$this->set('hwAuthor', $row['author']);
			$this->set('hwCompany', $row['company']);
			$this->set('hwTestimonial', $row['testimonial']);
			$this->set('hwExtra', $row['extra']);
			
			$this->set('testimonial', $testimonial);
		}
	}
	

	public function edit_testimonials($sID)
	{
		$Author = $_POST['hwAuthor'];
		$Company = $_POST['hwCompany'];
		$Testimonail = $_POST['hwTestimonial'];
		$Extra = $_POST['hwExtra'];
		
		
		if (strlen($Author) > 255) {
			$this->error->add(t('Author Name field has too many characters'));
        }
		if (strlen($Company) > 255) {
			$this->error->add(t('The Company field has too many characters'));
        }
		
		if (!$this->error->has()) {
			$db = Loader::db();
			$data = array(
				'author' => $_POST['hwAuthor'],
				'company' => $_POST['hwCompany'],
				'testimonial' => $_POST['hwTestimonial'],
				'extra' => $_POST['hwExtra']

			);
			$db->update('bthwsimpletestimonial', $data, array('sID' => $sID));
			
			$this->redirect('/dashboard/hw_simple_testimonials', 'testimonial_updated');
			
			} else {
				$sr = new UserEditResponse();
                $sr->setError($this->error);
        }
		
	}
	
	public function add_testimonials()
	{
		$Author = $_POST['hwAuthor'];
		$Company = $_POST['hwCompany'];

		
		if (strlen($Author) > 255) {
			$this->error->add(t('Author field has too many characters'));
        }
		if (strlen($Company) > 255) {
			$this->error->add(t('The Company field has too many characters'));
        }
		
		if (!$this->error->has()) {
			$db = Loader::db();
			$so = $db->GetOne('select max(sortOrder) from bthwsimpletestimonial');
			$so++;
			$db->Execute(
				'INSERT INTO bthwsimpletestimonial VALUES(?, ?, ?, ?, ?, ?)',
				array(
					NULL,
					$_POST['hwAuthor'],
					$_POST['hwCompany'],
					$_POST['hwTestimonial'],
					$_POST['hwExtra'],
					$so
				)
			);
	
			$this->redirect('/dashboard/hw_simple_testimonials', 'testimonial_added');
	
		} else {
				$sr = new UserEditResponse();
                $sr->setError($this->error);
        }
    }
}
?>