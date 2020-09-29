<?php

declare(strict_types=1);

namespace App\Form;

use App\DTO\ManufacturerDto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataMapperInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ManufacturerType extends AbstractType implements DataMapperInterface
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
            'data_class' => ManufacturerDto::class,
            'empty_data' => null,
        ]);
    }

    public function mapDataToForms($manufacturerDto, iterable $forms): void
    {
        $forms = iterator_to_array($forms);
        $forms['name']->setData($manufacturerDto ? $manufacturerDto->getName() : '');
    }

    public function mapFormsToData(iterable $forms, &$manufacturerDto)
    {
        $forms = iterator_to_array($forms);
        $manufacturerDto = new ManufacturerDto($forms['name']->getData());
    }
}
