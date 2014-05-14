<?php

namespace Cubbyhole\WebSiteBundle\Controller;

use Cubbyhole\WebApiBundle\Entity\Plan;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
    public function formAction()
    {
        $plan = new Plan();
        $plan->setName("the plan");
        $form = $this->createFormBuilder($plan)
            ->add('name', 'text')
            ->add('price', 'date')
            ->add('bandwidthDownload', 'text')
            ->add('bandwidthUpload', 'text')
            ->add('space', 'text')
            ->add('shareQuota', 'text')
            ->add('Envoyer', 'submit')
            ->getForm();
        return ["form" => $form->createView()];
    }   
}
