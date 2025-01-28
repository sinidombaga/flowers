<?php

namespace App\Controller\Admin;

use App\Entity\Comment;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CommentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Comment::class;
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('content')->setLabel('Commentaire')
            ->setFormTypeOptions([
                'attr' => ['rows' => 10],

            ])
            ->setTemplatePath('admin/fields/textarea.html.twig'), // Optional: Custom template for better display,
            TextField::new('verified')->setLabel('Accepté'),
            DateTimeField::new('createdAt')
                ->setFormTypeOptions([
                    'widget' => 'single_text',
                    'html5' => true,
                    'required' => false,
                ])
                ->setFormat('yyyy-MM-dd HH:mm:ss')
                ->setFormTypeOption('input', 'datetime_immutable')
                ->setLabel('Date'),

        ];
    }
}