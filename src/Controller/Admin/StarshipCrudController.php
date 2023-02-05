<?php

namespace App\Controller\Admin;

use App\Entity\Starship;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class StarshipCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Starship::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
