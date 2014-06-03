<?php

namespace Cubbyhole\UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\SecurityContext;
use Cubbyhole\WebApiBundle\Entity\Account;
use Symfony\Component\HttpFoundation\Session\Session;

class SecurityController extends Controller {

    /**
     * @Route("/secured/login", name="login")
     * @Template()
     */
    public function loginAction(Request $request) {
        // Si le visiteur est déjà identifié, on le redirige vers l'accueil
        try {
            if ($this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
                return $this->redirect($this->generateUrl('/'));
            }
        } catch (\Exception $ex) {   
        } 
        // On vérifie s'il y a des erreurs d'une précédente soumission du formulaire
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $request->getSession()->get(SecurityContext::AUTHENTICATION_ERROR);
            $request->getSession()->remove(SecurityContext::AUTHENTICATION_ERROR);
        }
        return array(
            // Valeur du précédent nom d'utilisateur entré par l'internaute
            'last_username' => $request->getSession()->get(SecurityContext::LAST_USERNAME),
            'error' => $error,
        );
    }
    
    /**
     * @Route("/login_check", name="login_check")
     */
    public function loginCheckAction(Request $request) {
        $session = new Session();
        $session->start();
        $account = $this->get('api.account')->whoami(
                $request->request->get('username'),
                $request->request->get('password'));   
        $id= $account->getId();
        $username=$account->getUsername();
      //return new Response($id != "null" ? "ok" : "not ok");
    if ($id!=null){
        $session->set('username',$username);
        $session->get('username');
        return $this->redirect("/plans");
    }else{
        return new Response("pas ok");
    }
    }

     /**
     * @Route("/register")
     * @Template() 
     */
    public function registerAction(Request $request) {
        $account = new Account();
        $form = $this->createFormBuilder($account)
                ->add('username', 'text')
                ->add('password', 'password')
                ->add('Envoyer', 'submit')
                ->getForm();
        $form->handleRequest($request);
        if ($form->isValid()) {
            $account = $form->getData();
            $account->setLevel(10);
            $account->setPlan(4); //TODO Changer l'id du plan
            $this->get("api.account")->create($account);
            return [
                "message" => "L'objet a bien été reçu",
                "objectJson" => var_export($form->getData(), true),
                "form" => false
              
            ];
        } else {
            return [
                "message" => "Veuillez remplir les informations demandées:",
                "objectJson" => "",
                "form" => $form->createView()
            ];
        }
        $url = $this->generateUrl('/','');
        $this->redirect($url);
    }
    
     /**
     * @Route("/secured")
     * @Template() 
     */
     function securedAction(){
         return  ['name'=>'ok'];
     }
}
