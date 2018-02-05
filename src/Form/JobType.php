<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JobType extends AbstractType
{
  /**
   * {@inheritdoc}
   */
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('receivedData', TextareaType::class, array(
        'label' => 'Текст',
        'label_attr' => [
          'class' => 'control-label'
        ],
        'required' => false,
        'attr' => [
          'class' => 'form-control form-control-sm controls',
          'placeholder' => 'Введите текст',
//          'style' => 'height: 200px;'
        ]
      ))
      ->add('submit', SubmitType::class, [
        'label' => 'Отправить на обработку',
        'attr' => [
          'class' => 'btn btn-sm btn-primary',
          'style' => 'display: flex;'
        ]
      ])
    ;
  }

  /**
   * {@inheritdoc}
   */
  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'App\Entity\Job'
    ));
  }

  /**
   * {@inheritdoc}
   */
  public function getBlockPrefix()
  {
    return 'job';
  }
}
