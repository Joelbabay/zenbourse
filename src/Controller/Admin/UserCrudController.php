<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Service\SubscriptionService;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\BooleanFilter;
use http\Env\Response;
use phpDocumentor\Reflection\Types\Parent_;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserCrudController extends AbstractCrudController
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher, private SubscriptionService $subscriptionService)
    {

    }

    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'Users')
            ->setEntityLabelInSingular('User')
            ->setEntityLabelInPlural('Users');
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('Email'),
            TextField::new('name'),
            TextField::new('lastname'),
            TextField::new('password')->onlyOnForms(),
            ChoiceField::new('roles')
                ->allowMultipleChoices()
                ->renderAsBadges([
                    'ROLE_ADMIN' => 'success',
                    'ROLE_INVITE' => 'danger',
                    'ROLE_CLIENT' => 'info',
                ])
                ->setChoices([
                    'Admin' => 'ROLE_ADMIN',
                    'Invité' => 'ROLE_INVITE',
                    'Client' => 'ROLE_CLIENT'
                ])->onlyOnIndex(),
            TextField::new('phone'),
            TextField::new('city'),
            BooleanField::new('isInvestisseurClient', 'Investisseur')->setFormTypeOptions([
                'mapped' => true,
                'attr' => [
                    'class' => 'js-investisseur-checkbox'
                ]
            ]),
            BooleanField::new('isIntradayClient', 'Intraday')->setFormTypeOptions([
                'mapped' => true,
                'attr' => [
                    'class' => 'js-intraday-checkbox'
                ]
            ]),
        ];
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $user = $entityInstance;
        $plainPassword = $user->getPassword();
        $hashedPassword = $this->passwordHasher->hashPassword($user, $plainPassword);

        $user->setPassword($hashedPassword);

        parent::persistEntity($entityManager, $entityInstance);
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(BooleanFilter::new('isInvestisseurApproved', 'Approbation Investisseur'))
            ->add(BooleanFilter::new('isIntradayApproved', 'Approbation Intraday'));
    }

}
