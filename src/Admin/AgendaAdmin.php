<?php
/**
 * Created by PhpStorm.
 * User: heshamelarj
 * Date: 4/26/19
 * Time: 12:45 PM
 */

namespace App\Admin;


use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Route\RouteCollection;

final class AgendaAdmin extends AbstractAdmin
{
    protected $baseRouteName = "agenda";
    protected $baseRoutePattern ="agenda";

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->clearExcept(['list'])
                    ->add('fetchOneDayTachesJson','');
    }
}