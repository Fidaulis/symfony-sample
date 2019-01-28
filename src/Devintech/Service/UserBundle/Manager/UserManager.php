<?php

namespace App\Devintech\Service\UserBundle\Manager;

use App\Devintech\Service\UserBundle\Entity\User;
use Doctrine\ORM\EntityManager;
use App\Devintech\Service\MetierManagerBundle\Utils\EntityName;
use App\Devintech\Service\MetierManagerBundle\Utils\ServiceName;
use App\Devintech\Service\MetierManagerBundle\Utils\RoleName;
use Symfony\Component\DependencyInjection\Container;
use FOS\UserBundle\Model\UserInterface;

/**
 * Class UserManager
 * @package App\Devintech\Service\UserBundle\Manager
 */
class UserManager
{
    private $_entity_manager;
    private $_container;

    /**
     * UserManager constructor.
     * @param EntityManager $_entity_manager
     * @param Container $_container
     */
    public function __construct(EntityManager $_entity_manager, Container $_container)
    {
        $this->_entity_manager  = $_entity_manager;
        $this->_container       = $_container;
    }

    /**
     * @param $_type
     * @param $_message
     * @return mixed
     * @throws \Exception
     */
    public function setFlash($_type, $_message) {
        return $this->_container->get('session')->getFlashBag()->add($_type, $_message);
    }

    /**
     * @return \Doctrine\Common\Persistence\ObjectRepository|\Doctrine\ORM\EntityRepository
     */
    public function getRepository()
    {
        return $this->_entity_manager->getRepository(EntityName::USER);
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getAllUser()
    {
        // Récupérer l'utilisateur connecté
        $_user_connected = $this->_container->get('security.token_storage')->getToken()->getUser();
        $_id_user        = $_user_connected->getId();
        $_user_role      = $_user_connected->getDitRole()->getId();

        // Rôle superadmin
        $_array_type = array(
            'ditRole' => array(
                RoleName::ID_ROLE_SUPERADMIN,
                RoleName::ID_ROLE_ADMIN,
                RoleName::ID_ROLE_TEAM,
            )
        );

        // Rôle admin
        if ($_user_role == RoleName::ID_ROLE_ADMIN)
            $_array_type = array(
                'ditRole' => array(
                    RoleName::ID_ROLE_ADMIN,
                    RoleName::ID_ROLE_TEAM
                )
            );

        // Rôle client
        if ($_user_role == RoleName::ID_ROLE_TEAM)
            $_array_type = array(
                'id'     => $_id_user,
                'ditRole' => array(
                    RoleName::ID_ROLE_TEAM
                )
            );

        return $this->getRepository()->findBy($_array_type, array('id' => 'DESC'));
    }

    /**
     * Récuperer tout les utilisateurs par ordre
     * @param array $_order
     * @return array
     */
    public function getAllUserByOrder($_order)
    {
        return $this->getRepository()->findBy(array(), $_order);
    }

    /**
     * @param $_id
     * @return object|null
     */
    public function getUserById($_id)
    {
        return $this->getRepository()->find($_id);
    }

    /**
     * Tester l'existence username
     * @param string $_username
     * @return boolean
     */
    public function isUsernameExist($_username): bool
    {
        $_exist = $this->getRepository()->findByUsername($_username);
        if ($_exist) {
            return true;
        }
        return false;
    }

    /**
     * Tester l'existence email
     * @param string $_email
     * @return boolean
     */
    public function isEmailExist($_email): bool
    {
        $_exist = $this->getRepository()->findByEmail($_email);
        if ($_exist) {
            return true;
        }
        return false;
    }

    /**
     * @return UploadManager|object
     * @throws \Exception
     */
    public function getUploadManager()
    {
        return $this->_container->get(ServiceName::SRV_METIER_USER_UPLOAD);
    }

    /**
     * @param $_user
     * @param $_form
     * @throws \Exception
     */
    public function addUser($_user, $_form) {
        // Récupérer manager

        // Activer par défaut
        $_user->setEnabled(1);

        // Traitement rôle utilisateur
        $_type      = $_form['ditRole']->getData();
        $_user_role = RoleName::$ROLE_TYPE[$_type->getRlName()];
        $_user->setRoles(array($_user_role));

        // Traitement du photo
        $_img_photo = $_form['usrPhoto']->getData();
        if ($_img_photo) {
            $this->getUploadManager()->upload($_user,$_img_photo);
        }

        $this->saveUser($_user, 'new');
    }

    /**
     * @param $_user
     * @param $_form
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Exception
     */
    public function updateUser($_user, $_form) {
        $_img_photo = $_form['usrPhoto']->getData();
        if ($_img_photo) {
            $this->getUploadManager()->deleteOnlyImageById($_user->getId());
            $this->getUploadManager()->upload($_user,$_img_photo);
        }

        // Traitement rôle utilisateur
        $_type      = $_form['ditRole']->getData();
        $_user_role = RoleName::$ROLE_TYPE[$_type->getRlName()];
        $_user->setRoles(array($_user_role));

        $_user->setUsrDateUpdate(new \DateTime());

        // Mise à jour mot de passe
        $_fos_user_manager = $this->_container->get('fos_user.user_manager');
        $_fos_user_manager->updatePassword($_user);

        $this->saveUser($_user, 'update');
    }

    /**
     * @param $_user
     * @param $_action
     * @return mixed
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function saveUser($_user, $_action)
    {
        if ($_action === 'new') {
            $this->_entity_manager->persist($_user);
        }
        $this->_entity_manager->flush();

        return $_user;
    }

    /**
     * @param $_user
     * @return bool
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function deleteUser($_user)
    {
        $this->_entity_manager->remove($_user);
        $this->_entity_manager->flush();

        return true;
    }

    /**
     * @param $_ids
     * @return bool
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function deleteGroupUser($_ids)
    {
        if (count($_ids)) {
            foreach ($_ids as $_id) {
                $this->getUploadManager()->deleteImageById($_id);
                // Suppression utilisateur
                $_user = $this->getUserById($_id);
                $this->deleteUser($_user);
            }
        }

        return true;
    }

    /**
     * Récuperer un utilisateur par email
     * @param string $_email
     * @return array
     */
    public function getUserByEmail($_email)
    {
        $_user = $this->getRepository()->findByEmail($_email);

        if ($_user)
            return $_user[0];

        return false;
    }

    /**
     * @param $_email
     * @return bool
     */
    public function isUserNotClient($_email): bool
    {
        $_user = $this->getRepository()->findByEmail($_email);

        $_is_user_admin = false;
        if ($_user) {
            $_id_role = $_user[0]->getDitRole()->getId();
            if ($_id_role !== RoleName::ID_ROLE_CLIENT)
                $_is_user_admin = true;
        }

        return $_is_user_admin;
    }

    /**
     * @param $_user_email
     * @return bool
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Twig\Error\Error
     */
    public function resettingPassword($_user_email)
    {
        $_entity_user = $this->getRepository()->findBy(array('email' => $_user_email));
        if (count($_entity_user) == 0)
            return false;
        $_generated_password = $this->generatePassword(9);
        $_entity_user[0]->setPlainPassword($_generated_password);
        $_user_manager = $this->_container->get('fos_user.user_manager');
        $_user_manager->updatePassword($_entity_user[0]);
        $this->saveUser($_entity_user, 'update');

        $this->sendEmailUserResettingPassword(
            array(
                'username' => $_user_email,
                'password' => $_generated_password
            ),
            $_user_email,
            $_entity_user[0]
        );

        return true;
    }

    /**
     * @param array $_data
     * @param $_mail_to
     * @param null $_user
     * @return bool
     * @throws \Twig\Error\Error
     */
    public function sendEmailUserResettingPassword(array $_data, $_mail_to, $_user = null)
    {
        $_template   = 'UserBundle:Email:email_resetting_password.html.twig';
        $_email_body = $this->_container->get('templating')->renderResponse($_template, array(
            'data' => $_data,
            'user' => $_user
        ));

        $_from_email_address = $this->_container->getParameter('from_email_address');
        $_from_firstname     = $this->_container->getParameter('from_firstname');

        $_email_body = implode("\n", array_slice(explode("\n", $_email_body), 4));
        $_message   =  (new \Swift_Message('Devintech: Récupération mot de passe oublié'))
            ->setFrom(array( $_from_email_address => $_from_firstname))
            ->setTo($_mail_to)
            ->setBody($_email_body);

        $_message->setContentType('text/html');
        $_result = $this->_container->get('mailer')->send($_message);

        $_headers = $_message->getHeaders();
        $_headers->addIdHeader('Message-ID', uniqid() . '@domain.com');
        $_headers->addTextHeader('MIME-Version', '1.0');
        $_headers->addTextHeader('X-Mailer', 'PHP v' . PHP_VERSION);
        $_headers->addParameterizedHeader('Content-type', 'text/html', ['charset' => 'utf-8']);

        if($_result){
            return true;
        }

        return false;
    }

    /**
     * Génération mot de passe
     * @param integer $_length
     * @return string
     */
    public function generatePassword($_length)
    {
        $_caracter         = str_split('abcdefghijklmnopqrstuvwxyz'.'ABCDEFGHIJKLMNOPQRSTUVWXYZ'.'0123456789');
        $_special_caracter = str_split('!/\@#$^&*()?');

        shuffle($_caracter);
        shuffle($_special_caracter);

        $_rand            = '';
        $_merged_caracter = array();
        foreach (array_rand($_caracter, ($_length-1)) as $_k) $_merged_caracter[] = $_caracter[$_k];
        $_merged_caracter[] = $_special_caracter[array_rand($_special_caracter, 1)];
        shuffle($_merged_caracter);
        foreach (array_rand($_merged_caracter, $_length) as $_i) $_rand .= $_merged_caracter[$_i];

        return $_rand ;
    }
}
