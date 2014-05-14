<?php

namespace Cubbyhole\WebSiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

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
    
    }
