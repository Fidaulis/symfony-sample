<?php

namespace App\Devintech\FrontSiteOffice\FrontSiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Devintech\Service\MetierManagerBundle\Utils\ServiceName;
use Symfony\Component\Validator\Tests\Fixtures\ToString;

/**
 * Class DitHomeController
 */
class DitHomeController extends Controller
{
    /**
     * Afficher la page accueil
     * @return string
     */
    public function indexAction()
    {
        // Récupérer manager
        $_slide_manager          = $this->get(ServiceName::SRV_METIER_SLIDE);
        $_user_manager = $this->get(ServiceName::SRV_METIER_TEAM);

        $_slides          = $_slide_manager->getAllDitSlide();
        $_user_list = $_user_manager->getAllTeam();
        $_team_list = [];

        foreach ($_user_list as $key => $_team) {
            $_team_list[$key]['id'] = $_team->getId();
            $_team_list[$key]['name'] = $_team->getUsrFirstname();
            $_team_list[$key]['lastName'] = $_team->getUsrLastname();
            $_team_list[$key]['fullName'] = ($_team->getUsrLastname() .' '. $_team->getUsrFirstname());
            $_team_list[$key]['photo'] = $_team->getUsrPhoto();
        }
//        dump($_team_list,$_user_list);die();

        return $this->render('FrontSiteBundle:DitHome:index.html.twig', array(
            'slides'          => $_slides,
            'team_liste'      => $_team_list
        ));
    }
}
