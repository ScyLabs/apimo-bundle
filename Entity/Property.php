<?php

namespace ScyLabs\ApimoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="ScyLabs\ApimoBundle\Repository\PropertyRepository")
 * @ORM\Table(name="scylabs_apimo_property")
 */
class Property
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer",nullable = true)
     */
    private $idApi;

    /**
     * @ORM\Column(type="string", length=255,nullable = true)
     */
    private $reference;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $user = [];

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $step;

    /**
     * @ORM\Column(type="integer", nullable=true, nullable=true)
     */
    private $parent;


    /**
     * @ORM\ManyToOne(targetEntity="ScyLabs\ApimoBundle\Entity\Category",inversedBy="properties")
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $subcategory;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="ScyLabs\ApimoBundle\Entity\PropertyType",inversedBy="properties")
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $subtype;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $agreement = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $block_name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address_more;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $publish_address;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $country;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $city = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $district = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $longitude;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $latitude;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $radius;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $area = [];

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $rooms;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $bedrooms;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $sleeps;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $price = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $residence = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $view = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $floor = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $heating = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $water = [];

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $propertyCondition;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $standing;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $style = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $construction_year;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $renovation_year;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $avaible_at;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $delivred_at;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $activities = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $orientations = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $services = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $proximities = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $tags = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $tag_customized = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $pictures = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $medias = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $comments = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $areas = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $regulations = [];

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $created_at;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $updated_at;

    public function __construct(array $tab = array()){
        foreach ($this as $key => $value){
            if(isset($tab[$key])){
                if($key == 'id'){
                    $this->idApi = $tab['id'];
                }
                else{
                    $this->$key = $tab[$key];
                }
            }
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdApi(): ?int
    {
        return $this->idApi;
    }

    public function setIdApi(int $idApi): self
    {
        $this->idApi = $idApi;

        return $this;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getUser(): ?array
    {
        return $this->user;
    }

    public function setUser(array $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getStep(): ?int
    {
        return $this->step;
    }

    public function setStep(int $step): self
    {
        $this->step = $step;

        return $this;
    }

    public function getParent(): ?int
    {
        return $this->parent;
    }

    public function setParent(?int $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getSubcategory(): ?string
    {
        return $this->subcategory;
    }

    public function setSubcategory(string $subcategory): self
    {
        $this->subcategory = $subcategory;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getType(): ?PropertyType
    {
        return $this->type;
    }

    public function setType(PropertyType $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getSubtype(): ?string
    {
        return $this->subtype;
    }

    public function setSubtype(string $subtype): self
    {
        $this->subtype = $subtype;

        return $this;
    }

    public function getAgreement(): ?array
    {
        return $this->agreement;
    }

    public function setAgreement(array $agreement): self
    {
        $this->agreement = $agreement;

        return $this;
    }

    public function getBlockName(): ?string
    {
        return $this->block_name;
    }

    public function setBlockName(string $block_name): self
    {
        $this->block_name = $block_name;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getAddressMore(): ?string
    {
        return $this->address_more;
    }

    public function setAddressMore(string $address_more): self
    {
        $this->address_more = $address_more;

        return $this;
    }

    public function getPublishAddress(): ?string
    {
        return $this->publish_address;
    }

    public function setPublishAddress(string $publish_address): self
    {
        $this->publish_address = $publish_address;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getCity(): ?array
    {
        return $this->city;
    }

    public function setCity(array $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getDistrict(): ?array
    {
        return $this->district;
    }

    public function setDistrict(array $district): self
    {
        $this->district = $district;

        return $this;
    }

    public function getLongitude(): ?string
    {
        return $this->longitude;
    }

    public function setLongitude(string $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getLatitude(): ?string
    {
        return $this->latitude;
    }

    public function setLatitude(string $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getRadius(): ?string
    {
        return $this->radius;
    }

    public function setRadius(string $radius): self
    {
        $this->radius = $radius;

        return $this;
    }

    public function getArea(): ?array
    {
        return $this->area;
    }

    public function setArea(array $area): self
    {
        $this->area = $area;

        return $this;
    }

    public function getRooms(): ?float
    {
        return $this->rooms;
    }

    public function setRooms(float $rooms): self
    {
        $this->rooms = $rooms;

        return $this;
    }

    public function getBedrooms(): ?int
    {
        return $this->bedrooms;
    }

    public function setBedrooms(?int $bedrooms): self
    {
        $this->bedrooms = $bedrooms;

        return $this;
    }

    public function getSleeps(): ?int
    {
        return $this->sleeps;
    }

    public function setSleeps(?int $sleeps): self
    {
        $this->sleeps = $sleeps;

        return $this;
    }

    public function getPrice(): ?array
    {
        return $this->price;
    }

    public function setPrice(?array $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getResidence(): ?array
    {
        return $this->residence;
    }

    public function setResidence(?array $residence): self
    {
        $this->residence = $residence;

        return $this;
    }

    public function getView(): ?array
    {
        return $this->view;
    }

    public function setView(?array $view): self
    {
        $this->view = $view;

        return $this;
    }

    public function getFloor(): ?array
    {
        return $this->floor;
    }

    public function setFloor(?array $floor): self
    {
        $this->floor = $floor;

        return $this;
    }

    public function getHeating(): ?array
    {
        return $this->heating;
    }

    public function setHeating(?array $heating): self
    {
        $this->heating = $heating;

        return $this;
    }

    public function getWater(): ?array
    {
        return $this->water;
    }

    public function setWater(?array $water): self
    {
        $this->water = $water;

        return $this;
    }

    public function getPropertyCondition(): ?string
    {
        return $this->propertyCondition;
    }

    public function setPropertyCondition(?string $propertyCondition): self
    {
        $this->propertyCondition = $propertyCondition;

        return $this;
    }

    public function getStanding(): ?string
    {
        return $this->standing;
    }

    public function setStanding(?string $standing): self
    {
        $this->standing = $standing;

        return $this;
    }

    public function getStyle(): ?array
    {
        return $this->style;
    }

    public function setStyle(?array $style): self
    {
        $this->style = $style;

        return $this;
    }

    public function getConstructionYear(): ?string
    {
        return $this->construction_year;
    }

    public function setConstructionYear(?string $construction_year): self
    {
        $this->construction_year = $construction_year;

        return $this;
    }

    public function getRenovationYear(): ?string
    {
        return $this->renovation_year;
    }

    public function setRenovationYear(?string $renovation_year): self
    {
        $this->renovation_year = $renovation_year;

        return $this;
    }

    public function getAvaibleAt(): ?\DateTimeInterface
    {
        return $this->avaible_at;
    }

    public function setAvaibleAt(?\DateTimeInterface $avaible_at): self
    {
        $this->avaible_at = $avaible_at;

        return $this;
    }

    public function getDelivredAt(): ?\DateTimeInterface
    {
        return $this->delivred_at;
    }

    public function setDelivredAt(?\DateTimeInterface $delivred_at): self
    {
        $this->delivred_at = $delivred_at;

        return $this;
    }

    public function getActivities(): ?array
    {
        return $this->activities;
    }

    public function setActivities(?array $activities): self
    {
        $this->activities = $activities;

        return $this;
    }

    public function getOrientations(): ?array
    {
        return $this->orientations;
    }

    public function setOrientations(?array $orientations): self
    {
        $this->orientations = $orientations;

        return $this;
    }

    public function getServices(): ?array
    {
        return $this->services;
    }

    public function setServices(?array $services): self
    {
        $this->services = $services;

        return $this;
    }

    public function getProximities(): ?array
    {
        return $this->proximities;
    }

    public function setProximities(?array $proximities): self
    {
        $this->proximities = $proximities;

        return $this;
    }

    public function getTags(): ?array
    {
        return $this->tags;
    }

    public function setTags(?array $tags): self
    {
        $this->tags = $tags;

        return $this;
    }

    public function getTagCustomized(): ?array
    {
        return $this->tag_customized;
    }

    public function setTagCustomized(?array $tag_customized): self
    {
        $this->tag_customized = $tag_customized;

        return $this;
    }

    public function getPictures(): ?array
    {
        return $this->pictures;
    }

    public function setPictures(?array $pictures): self
    {
        $this->pictures = $pictures;

        return $this;
    }

    public function getMedias(): ?array
    {
        return $this->medias;
    }

    public function setMedias(?array $medias): self
    {
        $this->medias = $medias;

        return $this;
    }

    public function getComments(): ?array
    {
        return $this->comments;
    }

    public function setComments(?array $comments): self
    {
        $this->comments = $comments;

        return $this;
    }

    public function getAreas(): ?array
    {
        return $this->areas;
    }

    public function setAreas(?array $areas): self
    {
        $this->areas = $areas;

        return $this;
    }

    public function getRegulations(): ?array
    {
        return $this->regulations;
    }

    public function setRegulations(?array $regulations): self
    {
        $this->regulations = $regulations;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }
    
}
