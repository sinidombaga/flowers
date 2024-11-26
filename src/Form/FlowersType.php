<?php

namespace App\Form;

use App\Entity\Flowers;
use PhpParser\Node\Stmt\Label;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class FlowersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                "label"=> "Nom", "attr"=>["placeholder"=>"Nom de bouquet"],
                 "constraints" => [
                new NotBlank([
                    "message" =>"Entrez un nom",
                ])
            ]
            ])
            ->add('description', TextareaType::class,[ 
            "label"=> "Description", "attr"=>["placeholder"=>"Description"
            ]])
             ->add('price', NumberType::class,[ 
            "label"=> "Prix", "attr"=>["placeholder"=>"Prix", "scale"=>2
            ]])
             ->add('image', TextType::class, [
                "label"=> "Image", "attr"=>["placeholder"=>"Image"]
            ])
            ->add("submit", SubmitType::class,[
                "label"=>"Enregistrez","attr"=>["class"=>"btn btn-success"]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Flowers::class,
        ]);
    }
}