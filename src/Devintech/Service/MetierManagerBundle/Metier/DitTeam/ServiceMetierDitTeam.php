<?php
/**
 * Created by PhpStorm.
 * User: jul
 * Date: 1/25/19
 * Time: 6:17 PM
 */

namespace App\Devintech\Service\MetierManagerBundle\Metier\DitTeam;


use App\Devintech\Service\MetierManagerBundle\Utils\EntityName;
use App\Devintech\Service\MetierManagerBundle\Utils\RoleName;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;

class ServiceMetierDitTeam
{
    private $_entity_manager;
    private $_container;

    public function __construct(EntityManager $_entity_manager, Container $_container)
    {
        $this->_entity_manager  = $_entity_manager;
        $this->_container       = $_container;
    }

    /**
     * Ajouter un message flash
     * @param string $_type
     * @param string $_message
     * @return mixed
     */
    public function setFlash($_type, $_message) {
        return $this->_container->get('session')->getFlashBag()->add($_type, $_message);
    }

    /**
     * Récuperer le repository utilisateur
     * @return array
     */
    public function getRepository()
    {
        return $this->_entity_manager->getRepository(EntityName::USER);
    }

    public function getAllTeam()
    {
        // Rôle superadmin
        $_array_type = array(
            'ditRole' => array(
                RoleName::ID_ROLE_TEAM,
            )
        );

        return $this->getRepository()->findBy($_array_type, array('id' => 'DESC'));
    }
}