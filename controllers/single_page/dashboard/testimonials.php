<?php

namespace Concrete\Package\HwSimpleTestimonials\Controller\SinglePage\Dashboard;

use HwSimpleTestimonials\Entity\Testimonial;
use HwSimpleTestimonials\Entity\TestimonialList;
use Request;
use Core;
use URL;

class Testimonials extends \Concrete\Core\Page\Controller\DashboardPageController
{
    public function view()
    {
        $list = new TestimonialList();
        $pagination = $list->getPagination();
        $entries = $pagination->getCurrentPageResults();
        $this->set('list', $list);
        $this->set('pagination', $pagination);
        $this->set('entries', $entries);
    }

    public function add()
    {
        $this->set('pageTitle', t('Add Testimonial'));
        $testimonial = new Testimonial();
        $this->set('testimonials', $testimonial);

    }

    public function edit($id = 0)
    {
        $this->set('pageTitle', t('Edit Testimonial'));
        $testimonial = Testimonial::getByID($id);
        $this->set('sID', $testimonial->getSID());
        $this->set('author', $testimonial->getAuthor());
        $this->set('company', $testimonial->getCompany());
        $this->set('testimonial', $testimonial->getTestimonial());
        $this->set('extra', $testimonial->getExtra());
    }

    public function submit()
    {
        $data = $this->post();
        if (!$this->token->validate('submit')) {
            $this->error->add($this->token->getErrorMessage());
        }
        if (!$this->error->has() && $this->isPost()) {
            if ($this->post('sID')) {
                $testimonial = Testimonial::getByID($this->post('sID'));
            } else {
                $testimonial = new Testimonial();
            }
            $testimonial->setAuthor($this->post('author'));
            $testimonial->setCompany($this->post('company'));
            $testimonial->setTestimonial($this->post('testimonial'));
            $testimonial->setExtra($this->post('extra'));
            $testimonial->save();

            $this->redirect('/dashboard/testimonials', 'saved');
        }
    }

    public function SortOrder()
    {

        $uats = $_REQUEST['tID'];

        if (is_array($uats)) {
            $uats = array_filter($uats, 'is_numeric');
        }

        if (count($uats)) {
            $db = $this->app->make('database')->connection();
            for ($i = 0; $i < count($uats); $i++) {
                $v = array($uats[$i]);
                $db->query("update bthwsimpletestimonial set SortOrder = {$i} where sID = ?", $v);
            }
        }
    }

    public function saved()
    {
        $this->set('message', t('Testimonial saved successfully.'));
        $this->view();
    }

    public function deleted()
    {
        $this->set('message', t('Testimonial deleted successfully.'));
        $this->view();
    }

    public function delete()
    {
        if (!$this->token->validate('delete')) {
            $this->error->add($this->token->getErrorMessage());
        }
        if (!$this->error->has() && $this->isPost()) {
            $e = Testimonial::getByID($this->post('sID'));
            if (is_object($e)) {
                $e->delete();
            }
            $this->redirect('/dashboard/testimonials', 'deleted');
        }
        $this->view();
    }
}