<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 19/10/2018
 * Time: 15:16
 */

namespace ScyLabs\ApimoBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="ScyLabs\ApimoBundle\Repository\PropertyTypeRepository")
 * @ORM\Table(name="scylabs_apimo_property_type")
 */
class PropertyType
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $idApi;
    /**
     * @ORM\Column(type="string")
     */
    private $culture;
    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="ScyLabs\ApimoBundle\Entity\Property",mappedBy="type")
     */
    private $properties;

    public function __construct(){
        $this->properties = new ArrayCollection();
    }
    /**
     * @return Collection|Property[]
     */
    public function getProperties(): Collection
    {
        return $this->properties;
    }

    public function addProperty(Property $property): self
    {
        if (!$this->properties->contains($property)) {
            $this->properties[] = $property;
            $property->setType($this);
        }

        return $this;
    }
    public function removePage(Property $property): self
    {
        if ($this->properties->contains($property)) {
            $this->properties->removeElement($property);
            // set the owning side to null (unless already changed)
            if ($property->getType() === $this) {
                $property->setType(null);
            }
        }

        return $this;
    }
    public function getId() : ?int {
        return $this->id;
    }

    public function getIdApi() :int{
        return $this->idApi;
    }
    public function setIdApi(int $idApi) : self{
        $this->idApi = $idApi;
        return $this;
    }
    public function getCulture() :string{
        return $this->culture;
    }
    public function setCulture(string $culture) : self{
        $this->culture = $culture;
        return $this;
    }
    public function getName() : string{
        return $this->name;
    }
    public function setName(string $name) : self{
        $this->name = $name;
        return $this;
    }

}