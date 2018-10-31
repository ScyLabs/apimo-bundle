<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 15/10/2018
 * Time: 16:56
 */

namespace ScyLabs\ApimoBundle\Services;

use Doctrine\ORM\EntityManagerInterface;
use ScyLabs\ApimoBundle\Entity\Category;
use ScyLabs\ApimoBundle\Entity\Property;
use ScyLabs\ApimoBundle\Entity\PropertyType;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ApimoService
{
    private $baseUrl;
    private $token;
    private $provider;
    private $agency;
    private $urls;

    /*
     * Injections
     */
    private $container;
    private $em;


    public function __construct(ContainerInterface $container,EntityManagerInterface $entityManager){
        $this->container = $container;
        $this->em = $entityManager;

        $this->token = $this->getParameter('scy_labs_apimo.api.token');
        $this->baseUrl = $this->getParameter('scy_labs_apimo.api.baseurl');
        $this->provider = $this->getParameter('scy_labs_apimo.api.provider');
        $this->agency = $this->getParameter('scy_labs_apimo.api.agency');
        $this->urls = $this->getParameter('scy_labs_apimo.api.urls');
    }



    public function majElements($lang = 'fr_FR'){
        $properties = $this->request('properties',$lang);

        if(!$this->resultIsValid($properties)){
            return false;
        }
        $this->clearProperties();
        $this->clearCategories();
        $this->clearPropertyType();
        if(!$this->majCategories())
            return false;
        if(!$this->majPropertyTypes())
            return false;
        if(!$this->majProperties())
            return false;

        return true;

    }

    public function find($type){

        if(!array_key_exists($type,$this->urls)){
            return -1;
        }
        if(!$this->resultIsValid($result = $this->request($type)))
            return false;
        return $this->request($type);

    }

    private function majPropertyTypes(string $lang = 'fr_FR') : bool{
        $propertyTypes = $this->request('property_type',$lang);
        if(!$this->resultIsValid($propertyTypes)){
            return false;
        }
        foreach ($propertyTypes as $propertyType){
            $propertyTypeObj = new PropertyType();
            $propertyTypeObj
                ->setCulture($propertyType['culture'])
                ->setIdApi($propertyType['id'])
                ->setName($propertyType['name']);
            $this->em->persist($propertyTypeObj);
        }
        $this->em->flush();
        return true;
    }

    private function majCategories(string $lang = 'fr_FR') :bool {

        $categories = $this->request('categories',$lang);
        if(!$this->resultIsValid($categories)){
            return false;
        }

        foreach ($categories as $category){

            $categoryObject = new Category();
            $categoryObject
                ->setCulture($category['culture'])
                ->setIdApi($category['id'])
                ->setName($category['name'])
            ;
            $this->em->persist($categoryObject);
        }
        $this->em->flush();
        return true;
    }

    private function majProperties(string $lang = 'fr_FR') :bool {

        $properties = $this->request('properties',$lang);
        if(!$this->resultIsValid($properties)){
            return false;
        }

        foreach ($properties['properties'] as $property){

            if(is_array($property)){
                $property['category'] = $this->em->getRepository(Category::class)->findOneBy(array(
                    'idApi' => $property['category']
                ));
                $property['type'] = $this->em->getRepository(PropertyType::class)->findOneBy(array(
                    'idApi' => $property['type']
                ));
                $propertyObject = new Property($property);
                if(empty($propertyObject->getReference())){
                    $propertyObject->setReference('1');
                }

                $this->em->persist($propertyObject);
            }
        }
        $this->em->flush();
        return true;
    }



    private function resultIsValid(array $result){
        if(isset($result['status']) && $result['status'] != 200){
            return false;
        }
        return true;
    }

    private function request(string $categories,$lang = 'fr_FR'){

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->baseUrl.$this->urls[$categories]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, $this->provider.':'.$this->token);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_POSTFIELDS, '{"culture":"'.$lang.'"}');


        $output = curl_exec($ch);
        curl_close($ch);

        return json_decode($output, true);
    }

    private function getParameter(string $parameter){
        return $this->container->getParameter($parameter);
    }

    private function clearCategories(){
        $repo = $this->em->getRepository(Category::class);
        $categories = $repo->findAll();

        foreach ($categories as $category){
            $this->em->remove($category);
        }
        $this->em->flush();
    }
    private function clearProperties(){

        $repo = $this->em->getRepository(Property::class);
        $properties = $repo->findAll();

        foreach ($properties as $property){
            $this->em->remove($property);
        }
        $this->em->flush();
    }
    private function clearPropertyType(){

        $repo = $this->em->getRepository(PropertyType::class);
        $properties = $repo->findAll();

        foreach ($properties as $property){
            $this->em->remove($property);
        }
        $this->em->flush();
    }

}