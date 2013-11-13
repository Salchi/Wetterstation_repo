<?php
return array(
    'navigation' => array(
        'default' => array(
            array(
                'label' => 'Home',
                'route' => 'home',
                'class' => 'nav',
                'id' => 'navHome',
            ),
            array(
                'label' => 'Heute',
                'route' => 'today',
                'class' => 'nav',
                'id' => 'navToday',
            ),
            array(
                'label' => 'Archiv',
                'route' => 'archive',
                'class' => 'nav',
                'id' => 'navArchive',
            ),
            array(
                'label' => 'About us',
                'route' => 'aboutUs',
                'class' => 'nav',
                'id' => 'navAboutUs',
            ),
        ),
    ),
    'service_manager' => array(
                'factories' => array(
                    'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
                ),
            ),     
);


?>
