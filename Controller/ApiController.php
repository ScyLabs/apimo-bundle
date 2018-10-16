<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 12/10/2018
 * Time: 12:06
 */

namespace ScyLabs\ApimoBundle\Controller;


use ScyLabs\ApimoBundle\Entity\Category;
use ScyLabs\ApimoBundle\Entity\Property;
use ScyLabs\ApimoBundle\Services\ApimoService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends Controller
{

    private $apimoService;

    public function __construct(ApimoService $apimoService){
        $this->apimoService = $apimoService;
    }

    /**
     * @Route("api/apimo/maj",name="scylabs_apimo/maj")
     */
    public function majElementsAction(){
      if(!$this->apimoService->majElements()){
          $this->sendErrorMail('Une erreur est survenue lors de la mise a jour des données de l\'API d\'APIMO , sur le site '.$_SERVER['HTTP_HOST']);
          return $this->json(['success'=>true,'message'=> 'Une erreur est survenue lors de la mise a jour des données','status'=>304],304);
      }
      return $this->json(['success'=>true,'message'=> 'La mise à jour des données de Apimo à bien été faite','status'=>201],201);
    }


    private function sendErrorMail($error){

        $mailer = $this->get('mailer');
        $contact = $this->getParameter('scy_labs_apimo.api.errors_contact_mail');
        $message = (new \Swift_Message("Une erreur est survenue sur le domaine : ".$_SERVER['HTTP_HOST']))
            ->setFrom($contact)
            ->setTo($contact)
            ->setBody($error,'text/html');
        $mailer->send($message);
    }
    /**
     * @Route("api/apimo/request/{type}")
     */
    public function requestAction($type){
        $result = $this->apimoService->find($type);
        if($result === -1){
            $this->sendErrorMail('Une erreur est survenue lors de la mise a jour des données de l\'API d\'APIMO , sur le site '.$_SERVER['HTTP_HOST']);
            return $this->json(['success'=>false,'status'=>400,'message'=>'Aucune URL trouvée pour la key : '.$type]);
        }
        elseif($result === false){
            $this->sendErrorMail('Une erreur est survenue lors de la mise a jour des données de l\'API d\'APIMO , sur le site '.$_SERVER['HTTP_HOST']);
            return $this->json(['success'=>true,'message'=> 'Une erreur est survenue lors de la mise a jour des données (certainement une mauvaise configuration)','status'=>500],500);
        }

        return $this->json($result);

    }

}