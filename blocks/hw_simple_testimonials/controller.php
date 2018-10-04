<?php

namespace Concrete\Package\HwSimpleTestimonials\Block\HwSimpleTestimonials;

use \Concrete\Core\Block\BlockController;
use HwSimpleTestimonials\Entity\TestimonialList;

defined('C5_EXECUTE') or die("Access Denied.");

class Controller extends BlockController
{
    /**
     * @var string
     */
    protected $btTable = 'bthwsimpletestimonialblock';
    /**
     * @var string
     */
    protected $btInterfaceWidth = "400";
    /**
     * @var string
     */
    protected $btInterfaceHeight = "425";

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
        $testimonialLimit = $this->pageQty;

        $testimonialList = new TestimonialList();
        $testimonialList->setLimit($testimonialLimit);
        $testimonialList->setRandom(1);
        $testimonialList = $testimonialList->getResults();
        $this->set('testimonialslist', $testimonialList);

        $this->requireAsset('css', 'hw_testimonials');

    }

    public function save($data)
    {
        parent::save($data);
    }

}