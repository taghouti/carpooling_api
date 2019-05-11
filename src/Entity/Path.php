<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Path
 *
 * @ORM\Table(name="path", indexes={@ORM\Index(name="IDX_B548B0F302A8A70", columns={"ride_id"})})
 * @ORM\Entity
 */
class Path
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var \Ride
     *
     * @ORM\ManyToOne(targetEntity="Ride")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ride_id", referencedColumnName="id")
     * })
     */
    private $ride;


}
