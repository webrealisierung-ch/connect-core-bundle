<?php

namespace Wr\Connect\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table("tl_wr_status")
 * @package Wr\Connect\CoreBundle\Entity
 */
class Status
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $pid;

    /**
     * @ORM\Column(type="integer")
     */
    private $tstamp;

    /**
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @ORM\Column(type="string")
     */
    private $alias;
    /**
     * @ORM\Column(type="blob")
     */
    private $sorting;

    /**
     * @ORM\Column(type="string")
     */
    private $color;

    /**
     * @ORM\Column(type="integer")
     */
    private $showIfProjectIsClosed;

    /**
     * @ORM\Column(type="integer")
     */
    private $isDefault;

    /**
     * @ORM\Column(type="integer")
     */
    private $showTodosAfterDays;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getPid()
    {
        return $this->pid;
    }

    /**
     * @param mixed $pid
     */
    public function setPid($pid)
    {
        $this->pid = $pid;
    }

    /**
     * @return mixed
     */
    public function getTstamp()
    {
        return $this->tstamp;
    }

    /**
     * @param mixed $tstamp
     */
    public function setTstamp($tstamp)
    {
        $this->tstamp = $tstamp;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @param mixed $alias
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;
    }

    /**
     * @return mixed
     */
    public function getSorting()
    {
        return $this->sorting;
    }

    /**
     * @param mixed $sorting
     */
    public function setSorting($sorting)
    {
        $this->sorting = $sorting;
    }

    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param mixed $color
     */
    public function setColor($color)
    {
        $this->color = $color;
    }

    /**
     * @return mixed
     */
    public function getisDefault()
    {
        return $this->isDefault;
    }

    /**
     * @param mixed $isDefault
     */
    public function setIsDefault($isDefault)
    {
        $this->isDefault = $isDefault;
    }

    /**
     * @return mixed
     */
    public function getShowIfProjectIsClosed()
    {
        return $this->showIfProjectIsClosed;
    }

    /**
     * @param mixed $showIfProjectIsClosed
     */
    public function setShowIfProjectIsClosed($showIfProjectIsClosed)
    {
        $this->showIfProjectIsClosed = $showIfProjectIsClosed;
    }

    /**
     * @return mixed
     */
    public function getShowTodosAfterDays()
    {
        return $this->showTodosAfterDays;
    }

    /**
     * @param mixed $showTodosAfterDays
     */
    public function setShowTodosAfterDays($showTodosAfterDays)
    {
        $this->showTodosAfterDays = $showTodosAfterDays;
    }
}
