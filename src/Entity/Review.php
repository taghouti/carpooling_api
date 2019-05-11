<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Review
 *
 * @ORM\Table(name="review", indexes={@ORM\Index(name="IDX_794381C6302A8A70", columns={"ride_id"})})
 * @ORM\Entity
 */
class Review
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
     * @var int
     *
     * @ORM\Column(name="starts", type="integer", nullable=false)
     */
    private $starts;

    /**
     * @var string|null
     *
     * @ORM\Column(name="comment", type="text", length=0, nullable=true)
     */
    private $comment;

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
