<?php

namespace Wr\Connect\CoreBundle\Entity;

use \Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="tl_wr_project")
 */

class Project
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
     * @ORM\Column(type="integer")
     */
    private $author;

    /**
     * @ORM\Column(type="integer")
     */
    private $owner;

    /**
     * @ORM\Column(type="blob")
     */
    private $workers;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="binary", length=16, options={"fixed": true})
     */
    private $projectDir;

    /**
     * @ORM\Column(type="integer")
     */
    private $active;

    /**
     * @ORM\Column(type="integer")
     */
    private $start;

    /**
     * @ORM\Column(type="integer")
     */
    private $stop;
}
