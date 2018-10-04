<?php

namespace HwSimpleTestimonials\Entity;

use Doctrine\ORM\Mapping as ORM;
use Concrete\Core\Database;
use Concrete\Core;

/**
 * @ORM\Entity
 * @ORM\Table(name="bthwsimpletestimonial")
 */
class Testimonial
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $sID;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $Author;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $Company;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $Testimonial;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $Extra;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $SortOrder;


    /**
     * @return mixed
     */
    public function getSID()
    {
        return $this->sID;
    }
    /**
     * @param mixed $sID
     */
    public function setSID($sID)
    {
        $this->sID = $sID;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->Author;
    }
    /**
     * @param mixed $Author
     */
    public function setAuthor($Author)
    {
        $this->Author = $Author;
    }

    /**
     * @return mixed
     */
    public function getCompany()
    {
        return $this->Company;
    }
    /**
     * @param mixed $Company
     */
    public function setcompany($Company)
    {
        $this->Company = $Company;
    }

    /**
     * @return mixed
     */
    public function getTestimonial()
    {
        return $this->Testimonial;
    }
    /**
     * @param mixed $Testimonial
     */
    public function setTestimonial($Testimonial)
    {
        $this->Testimonial = $Testimonial;
    }

    /**
     * @return mixed
     */
    public function getExtra()
    {
        return $this->Extra;
    }
    /**
     * @param mixed $extra
     */
    public function setExtra($Extra)
    {
        $this->Extra = $Extra;
    }

    /**
     * @return mixed
     */
    public function getSortOrder()
    {
        return $this->SortOrder;
    }
    /**
     * @param mixed $SortOrder
     */
    public function setSortOrder($SortOrder)
    {
        $this->SortOrder = $SortOrder;
    }

    public static function getByID($sID)
    {
        $em = \ORM::entityManager();
        return $em->getRepository('\HwSimpleTestimonials\Entity\Testimonial')
            ->find($sID);
    }

    public function save()
    {
        $em = \ORM::entityManager();
        $em->persist($this);
        $em->flush();
    }
    public function delete()
    {
        $em = \ORM::entityManager();
        $em->remove($this);
        $em->flush();
    }

}
