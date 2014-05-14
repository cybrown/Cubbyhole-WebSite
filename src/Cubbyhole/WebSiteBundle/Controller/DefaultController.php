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
     * @Route("/plans")
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
    public function planUpdtAction($id)
    {
          return ['plan' => $this->get("api.plan")->findOne($id)];
    }
    
    /**
     * @Route("/form")
     * @Template()
     */
    public function formAction(Request $request)
    {
        $plan = new Plan();
        $plan->setName("the plan");
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
}
