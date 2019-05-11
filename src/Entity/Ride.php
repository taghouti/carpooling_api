<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ride
 *
 * @ORM\Table(name="ride", indexes={@ORM\Index(name="IDX_9B3D7CD0A76ED395", columns={"user_id"})})
 * @ORM\Entity
 */
class Ride
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
     * @var \DateTime|null
     *
     * @ORM\Column(name="date", type="datetime", nullable=true)
     */
    private $date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time", type="time", nullable=false)
     */
    private $time;

    /**
     * @var string
     *
     * @ORM\Column(name="depart", type="string", length=255, nullable=false)
     */
    private $depart;

    /**
     * @var string
     *
     * @ORM\Column(name="destination", type="string", length=255, nullable=false)
     */
    private $destination;

    /**
     * @var string
     *
     * @ORM\Column(name="car_brand", type="string", length=255, nullable=false)
     */
    private $carBrand;

    /**
     * @var string
     *
     * @ORM\Column(name="car_color", type="string", length=255, nullable=false)
     */
    private $carColor;

    /**
     * @var int
     *
     * @ORM\Column(name="places", type="integer", nullable=false)
     */
    private $places;

    /**
     * @var bool
     *
     * @ORM\Column(name="male", type="boolean", nullable=false, options={"default"="1"})
     */
    private $male = '1';

    /**
     * @var bool
     *
     * @ORM\Column(name="female", type="boolean", nullable=false, options={"default"="1"})
     */
    private $female = '1';

    /**
     * @var bool
     *
     * @ORM\Column(name="smoking", type="boolean", nullable=false)
     */
    private $smoking = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="animals", type="boolean", nullable=false)
     */
    private $animals = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="music", type="boolean", nullable=false, options={"default"="1"})
     */
    private $music = '1';

    /**
     * @var bool
     *
     * @ORM\Column(name="air_conditioning", type="boolean", nullable=false)
     */
    private $airConditioning = '0';

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
