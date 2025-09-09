<?php

namespace App\Controller\Admin;

use App\Entity\Listing;
use App\Entity\ProperType;
use App\Entity\TransactionType;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;

#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
{
    public function index(): Response
    {
       
 
         return $this->render('admin/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('SuperFMDH');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
         yield MenuItem::linkToCrud('listing', 'fas fa-list', entityFqcn: Listing::class);
         yield MenuItem::linkToCrud('ProperType', 'fas fa-list', entityFqcn: ProperType::class);
         yield MenuItem::linkToCrud('TransactionType', 'fas fa-list', entityFqcn: TransactionType::class);
        yield MenuItem::linkToCrud('user', 'fas fa-list', entityFqcn: User::class);

         
    }
}
