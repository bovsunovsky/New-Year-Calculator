<?php

declare(strict_types=1);

namespace App\Form;

use App\DTO\CategoryDto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataMapperInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryType extends AbstractType implements DataMapperInterface
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setAction($options['action'])
            ->add('name', TextType::class, [
                'attr' => [
                    'placeholder' => 'Name',
                ],
            ])
            ->setDataMapper($this);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CategoryDto::class,
            'empty_data' => null,
        ]);
    }

    public function mapDataToForms($categoryDto, iterable $forms)
    {
        $forms = iterator_to_array($forms);
        $forms['name']->setData($categoryDto ? $categoryDto->getName() : '');
    }

    public function mapFormsToData(iterable $forms, &$categoryDto)
    {
        $forms = iterator_to_array($forms);
        $categoryDto = new CategoryDto($forms['name']->getData());
    }
}
