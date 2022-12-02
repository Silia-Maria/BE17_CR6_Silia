<?php

namespace App\Form;

use App\Entity\Events;
use App\Entity\Organisers;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, ["attr" => ["placeholder" => "Name", "class" => "form-control mb-4"]])

            ->add('description', TextareaType::class, ["attr" => ["placeholder" => "Short description", "class" => "form-control mb-4"]])

            ->add('image', TextType::class, ["attr" => ["placeholder" => "Image URL", "class" => "form-control mb-4"]])

            ->add('date', DateType::class, ["attr" => ["placeholder" => "Date", "class" => "form-control mb-4"]])

            ->add('time', TimeType::class, ["attr" => ["placeholder" => "Time", "class" => "form-control mb-4"]])

            ->add('capacity', IntegerType::class, ["attr" => ["placeholder" => "Capacity", "class" => "form-control mb-4"]])

            ->add('url', TextType::class, ["attr" => ["placeholder" => "Event URL", "class" => "form-control mb-4"]])

            ->add('type', ChoiceType::class, [
                'choices'  => [
                    'Art' => "art",
                    'Theater' => "theater",
                    'Music' => "music",

                ], "attr" => ["class" => "form-control mb-4"]
            ])

            ->add('fk_organizer', EntityType::class, ["label" => "Organizer", "class" => Organisers::class, "choice_label" => "name"], ["attr" => ["class" => "form-control mb-5"]])

            ->add('Finished', SubmitType::class,  ["attr" => ["class" => "button mt-5 w-100", "value" => "Create/Edit"]]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => Events::class]);
    }
}
