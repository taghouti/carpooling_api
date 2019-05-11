<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rider
 *
 * @ORM\Table(name="rider", indexes={@ORM\Index(name="IDX_EA411035A76ED395", columns={"user_id"}), @ORM\Index(name="IDX_EA411035302A8A70", columns={"ride_id"})})
 * @ORM\Entity
 */
class Rider
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
     * @var bool
     *
     * @ORM\Column(name="is_accepted", type="boolean", nullable=false)
     */
    private $isAccepted;

    /**
     * @var \Ride
     *
     * @ORM\ManyToOne(targetEntity="Ride")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ride_id", referencedColumnName="id")
     * })
     */
    private $ride;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;


}
