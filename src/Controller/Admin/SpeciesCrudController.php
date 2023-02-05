<?php

namespace App\Controller\Admin;

use App\Entity\Species;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SpeciesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Species::class;
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
