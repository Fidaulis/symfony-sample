<?php
/**
 * Created by PhpStorm.
 * User: jul
 * Date: 1/28/19
 * Time: 1:04 PM
 */

namespace App\Devintech\Service\MetierManagerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DitServiceType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder,array $options){
        $builder
            ->add('serviceName',TextType::class,array(
               'label' => 'Nom du service',
                'required' => true,
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
            ->add('servicePhoto',FileType::class,array(
                'label' => false,
                'required' => false,
            ))
            ->add('servicePrice',TextType::class,array(
                'label' => 'Prix de service',
                'required' => true,
                'attr' => array(
                    'class' => 'form-control'
                )
            ))
        ;
    }

    /**
     * @param OptionsResolver $optionsResolver
     */
    public function configureOptions(OptionsResolver $optionsResolver)
    {
        $optionsResolver->setDefaults(array(
            'data_class' => 'App\Devintech\Service\MetierManagerBundle\Entity\DitService'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'dit_service_metiermanagerbundle_service';
    }
}