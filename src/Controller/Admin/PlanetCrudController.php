<?php

namespace App\Controller\Admin;

use App\Entity\Planet;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PlanetCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Planet::class;
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
