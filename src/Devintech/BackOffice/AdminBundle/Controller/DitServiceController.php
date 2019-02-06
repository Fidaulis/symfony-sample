<?php
/**
 * Created by PhpStorm.
 * User: jul
 * Date: 1/28/19
 * Time: 12:54 PM
 */

namespace App\Devintech\BackOffice\AdminBundle\Controller;


use App\Devintech\Service\MetierManagerBundle\Entity\DitService;
use App\Devintech\Service\MetierManagerBundle\Form\DitServiceType;
use App\Devintech\Service\MetierManagerBundle\Utils\ServiceName;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DitServiceController extends Controller
{

    public function getServiceManager()
    {
        return $this->get(ServiceName::SRV_METIER_SERVICE);
    }

    /**
     * @return mixed
     */
    public function indexAction()
    {
        $_service_list = $this->getServiceManager()->getAllService();

        return $this->render('AdminBundle:DitService:index.html.twig', array(
            'services' =>  $_service_list,
        ));
    }

    public function newAction(Request $_request)
    {

        $_service = new DitService();
        $_form = $this->createCreateForm($_service);
        $_form->handleRequest($_request);

        if ($_form->isSubmitted() && $_form->isValid()):
            try {
                $this->getServiceManager()->saveService($_service, 'new');
            } catch (OptimisticLockException $e) {
            } catch (ORMException $e) {
            }
            $this->getServiceManager()->setFlash('success','Service ajouté');
            return $this->redirect($this->generateUrl('service_index'));
            endif;

            return $this->render('AdminBundle:DitService:add.html.twig',array(
                'service' => $_service,
                'form'    => $_form->createView()
            ));
    }

    public function editAction()
    {

    }

    /**
     * Création formulaire d'édition rôle
     * @param DitService $_role The entity
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(DitService $_role)
    {
        $_form = $this->createForm(DitServiceType::class, $_role, array(
            'action' => $this->generateUrl('service_new'),
            'method' => 'POST'
        ));

        return $_form;
    }

    private function createDeleteForm()
    {

    }

    public function deleteAction(){

    }
}




