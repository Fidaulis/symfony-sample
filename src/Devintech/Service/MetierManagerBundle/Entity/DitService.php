<?php
/**
 * Created by PhpStorm.
 * User: jul
 * Date: 1/28/19
 * Time: 12:57 PM
 */

namespace App\Devintech\Service\MetierManagerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DitService
 *
 * @ORM\Table(name="dit_service")
 * @ORM\Entity
 */
class DitService
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="service_name", type="string", length=45, nullable=true)
     */
    private $serviceName;

    /**
     * @var string
     *
     * @ORM\Column(name="service_photo", type="string", length=255, nullable=true)
     */
    private $servicePhoto;

    /**
     * @var string
     *
     * @ORM\Column(name="service_price", type="string", length=255, nullable=true)
     */
    private $servicePrice;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getServiceName()
    {
        return $this->serviceName;
    }

    /**
     * @param string $serviceName
     */
    public function setServiceName($serviceName)
    {
        $this->serviceName = $serviceName;
    }

    /**
     * @return string
     */
    public function getServicePhoto()
    {
        return $this->servicePhoto;
    }

    /**
     * @param string $servicePhoto
     */
    public function setServicePhoto($servicePhoto)
    {
        $this->servicePhoto = $servicePhoto;
    }

    /**
     * @return string
     */
    public function getServicePrice()
    {
        return $this->servicePrice;
    }

    /**
     * @param string $servicePrice
     */
    public function setServicePrice($servicePrice)
    {
        $this->servicePrice = $servicePrice;
    }


}