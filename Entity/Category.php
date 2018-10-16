<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 12/10/2018
 * Time: 12:17
 */

namespace ScyLabs\ApimoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="ScyLabs\ApimoBundle\Repository\CategoryRepository")
 * @ORM\Table(name="scylabs_apimo_category")
 */
class Category
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




    public function __construct(){
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