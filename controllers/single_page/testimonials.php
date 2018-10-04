<?php

namespace Concrete\Package\HwSimpleTestimonials\Controller\SinglePage;

use \Concrete\Core\Page\Controller\PageController;
use HwSimpleTestimonials\Entity\TestimonialList;
use \Concrete\Core\Attribute\Key\CollectionKey as CollectionAttributeKey;
use Concrete\Core\Page\page;
use Concrete\Core;

defined('C5_EXECUTE') or die(("Access Denied."));

class Testimonials extends PageController
{
    public $helpers = array('form');

    public function view()
    {

        $c = Page::getCurrentPage();

        $metaT = t('Testimonial');
        $metaD = t('Companies Testimonials');

        $mtitle = CollectionAttributeKey::getByHandle('meta_title');
        $c->setAttribute($mtitle, $metaT);

        $mdesc = CollectionAttributeKey::getByHandle('meta_description');
        $c->setAttribute($mdesc, $metaD);


        $list = new TestimonialList();
        $pagination = $list->getPagination();
        $entries = $pagination->getCurrentPageResults();
        $this->set('list', $list);
        $this->set('pagination', $pagination);
        $this->set('entries', $entries);

        $this->requireAsset('css', 'hw_testimonials');
    }

}
