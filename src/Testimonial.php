<?php      
namespace Concrete\Package\HwSimpleTestimonials\Src;

use Concrete\Core\Foundation\Object as Object;
use Database;

use Concrete\Package\HwSimpleTestimonials\Src\TestimonialArrayList;

defined('C5_EXECUTE') or die(_("Access Denied."));
class Testimonial extends Object
{
	 public static function getByID($sID) {
        $db = Database::get();
        $data = $db->GetRow("SELECT * FROM bthwsimpletestimonial WHERE sID=?",$sID);
        if(!empty($data)){
            $testimonial = new Testimonial();
            $testimonial->setPropertiesFromArray($data);
        }
        return($testimonial instanceof Testimonial) ? $testimonial : false;
    }  
	
	
}