<?php

namespace Cubbyhole\WebSiteBundle\Controller;

use Cubbyhole\WebApiBundle\Entity\Plan;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        return array('name' => "ok");
    }

    /**
     * @Route("/plans", name="plans")
     * @Template()
     */
    public function planAction()
    {
       return ['plans' => $this->get("api.plan")->findAll()];
    }
    
    /**
     *  @Route ("/plans/{id}", name="planupdt")
     * @Template()
     */
    public function planUpdtAction(Request $request, $id)
    {
        $plan = $this->get("api.plan")->findOne($id);
        //$plan->setName("the plan");
        $form = $this->createFormBuilder($plan)
            ->add('name', 'text')
            ->add('price', 'number')
            ->add('bandwidthDownload', 'number')
            ->add('bandwidthUpload', 'number')
            ->add('space', 'number')
            ->add('shareQuota', 'number')
            ->add('Envoyer', 'submit')
            ->getForm();
        $form->handleRequest($request);
        if ($form->isValid()) {
             $this->get("api.plan")->update($form->getData());
            return [
                "message" => "L'objet a bien été reçu",
                "objectJson" => var_export($form->getData(), true),
                "form" => false
            ];
        } else {
            return [
                "message" => "Veuillez entrer un objet",
                "objectJson" => "",
                "form" => $form->createView()
            ];
        }
    }

    /**
     * @Route("/addPlan")
     * @Template()
     */
    public function addPlanAction(Request $request) {
        $plan = new Plan();
        $form = $this->createFormBuilder($plan)
                ->add('Name', 'text')
                ->add('Price', 'number')
                ->add('BandwidthDownload', 'number')
                ->add('BandwidthUpload', 'number')
                ->add('Space', 'number')
                ->add('ShareQuota', 'number')
                ->add('Envoyer', 'submit')
                ->getForm();
        $form->handleRequest($request);
        if ($form->isValid()) {
           $this->get("api.plan")->create($form->getData());
            return [
                "message" => "L'objet a bien été reçu",
                "objectJson" => var_export($form->getData(), true),
                "form" => false
              
            ];
        } else {
            return [
                "message" => "Veuillez entrer un objet",
                "objectJson" => "",
                "form" => $form->createView()
            ];
        }
        $url = $this->generateUrl('/','');
        $this->redirect($url);
    }
    
     /**
     *  @Route ("/plans/delete/{id}", name="plandelete")
     * @Template()
     */
    public function planDeleteAction(Request $request, $id)
    {
        $plan = $this->get("api.plan")->findOne($id);
        $form = $this->createFormBuilder($plan)
            ->add('name', 'text')
            ->add('price', 'number')
            ->add('bandwidthDownload', 'number')
            ->add('bandwidthUpload', 'number')
            ->add('space', 'number')
            ->add('shareQuota', 'number')
            ->add('Envoyer', 'submit')
            ->getForm();
        $form->handleRequest($request);
        //if ($form->isValid()) {
             $this->get("api.plan")->delete($form->getData());
      return [
                "message" => "L'objet a bien été supprimer",
                //"objectJson" => var_export($form->getData(), true),
//                "form" => false
           ];
//        } else {
//            return [
//                "message" => "Erreur suppression du plan",
//                "objectJson" => "",
//                "form" => $form->createView()
//            ];
//        }
    }

}
