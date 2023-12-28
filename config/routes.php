<?php
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $routes) {
    $routes->add('app_logout', '/logout')
        ->methods(['GET'])
    ;

    $routes->add('homepage', '/')
        ->controller([MainController::class, 'homepage'])
    ;
};
?>