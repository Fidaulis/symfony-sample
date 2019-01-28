<?php
/**
 * Created by PhpStorm.
 * User: jul
 * Date: 1/28/19
 * Time: 1:23 PM
 */

namespace App\Devintech\Service\MetierManagerBundle\Metier\DitService;


use App\Devintech\Service\MetierManagerBundle\Utils\EntityName;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;

class ServiceMetierDitService
{

    private $_entity_manager;
    private $_container;

    /**
     * ServiceMetierDitService constructor.
     * @param EntityManager $_entity_manager
     * @param Container $_container
     */
    public function __construct(EntityManager $_entity_manager,Container $_container)
    {
        $this->_entity_manager = $_entity_manager;
        $this->_container = $_container;
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
     * @return \Doctrine\Common\Persistence\ObjectRepository|\Doctrine\ORM\EntityRepository
     */
    public function getRepository()
    {
        return $this->_entity_manager->getRepository(EntityName::DIT_SERVICE);
    }

    /**
     * @return array
     */
    public function getAllService()
    {
        return $this->getRepository()->findBy(array(), array('id' => 'ASC'));
    }

    public function getServiceById($_id)
    {
        return $this->getRepository()->find($_id);
    }
    /**
     * @param $_service
     * @param $_action
     * @return bool
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function saveService($_service,$_action)
    {
        if ($_action === 'new'){
            $this->_entity_manager->persist($_service);
        }

        $this->_entity_manager->flush();
        return true;
    }

    /**
     * @param $_service
     * @return bool
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function deleteService($_service)
    {
        $this->_entity_manager->remove($_service);
        $this->_entity_manager->flush();

        return true;
    }

    /**
     * @param $_ids
     * @return bool
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function deleteGroup($_ids)
    {
        if (count($_ids)):
            foreach ($_ids as $_id)
            {
                $_service = $this->getServiceById($_id);
                $this->deleteService($_service);
            }
        endif;
            return true;
    }


}