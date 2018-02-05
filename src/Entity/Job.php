<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource
 * @ORM\Entity(repositoryClass="App\Repository\JobRepository")
 */
class Job
{
  /**
   * @ORM\Id
   * @ORM\GeneratedValue
   * @ORM\Column(type="integer")
   */
  private $id;

  /**
   * @var string
   *
   * @ORM\Column(type="json", nullable=true)
   */
  private $receivedData;

  /**
   * @var string
   *
   * @ORM\Column(type="text", nullable=true)
   */
  private $handledData;

  /**
   * @var array
   *
   * @ORM\Column(type="array", nullable=true)
   */
  private $methods;

  /**
   * @ORM\Column(type="datetime", nullable=false)
   * @var \DateTime
   */
  private $dateOfCreation;

  /**
   * @ORM\Column(type="datetime", nullable=false)
   * @var \DateTime
   */
  private $dateOfChange;

  /**
   * Job constructor
   */
  public function __construct()
  {
    $currentDate = new \DateTime('NOW');
    $this->dateOfCreation = $currentDate;
    $this->dateOfChange = $currentDate;
  }

  /**
   * @return mixed
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * @return null|string
   */
  public function getReceivedData(): ?string
  {
    return $this->receivedData;
  }

  /**
   * @param null|string $receivedData
   */
  public function setReceivedData(?string $receivedData)
  {
    $this->receivedData = $receivedData;
  }

  /**
   * @return null|string
   */
  public function getHandledData(): ?string
  {
    return $this->handledData;
  }

  /**
   * @param null|string $handledData
   */
  public function setHandledData(?string $handledData)
  {
    $this->handledData = $handledData;
  }

  /**
   * @return array|null
   */
  public function getMethods(): ?array
  {
    return $this->methods;
  }

  /**
   * @param array|null $methods
   */
  public function setMethods(?array $methods)
  {
    $this->methods = $methods;
  }

  /**
   * @return \DateTime
   */
  public function getDateOfCreation()
  {
    return $this->dateOfCreation;
  }

  /**
   * @param \DateTime $dateOfCreation
   */
  public function setDateOfCreation($dateOfCreation)
  {
    $this->dateOfCreation = $dateOfCreation;
  }

  /**
   * @return \DateTime
   */
  public function getDateOfChange()
  {
    return $this->dateOfChange;
  }

  /**
   * @param \DateTime $dateOfChange
   */
  public function setDateOfChange($dateOfChange)
  {
    $this->dateOfChange = $dateOfChange;
  }
}
