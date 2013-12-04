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
                'pages' => array(
                    array(
                        'label' => 'Wochenverlauf',
                        'route' => 'archive',
                        'action' => 'weekprocess',
                        'id' => 'navWeekProcess',
                        'class' => 'nav',
                        'resource' => 'Application\Controller\Exercise',
                    ),
                    array(
                        'label' => 'Monatsverlauf',
                        'route' => 'archive',
                        'action' => 'monthprocess',
                        'id' => 'navMonthProcess',
                        'class' => 'nav',
                        'resource' => 'Application\Controller\Exercise',
                    ),
                    array(
                        'label' => 'Jahresverlauf',
                        'route' => 'archive',
                        'action' => 'yearprocess',
                        'id' => 'navYearProcess',
                        'class' => 'nav',
                        'resource' => 'Application\Controller\Exercise',
                    ),
                    array(
                        'label' => 'zwischen 2 Daten',
                        'route' => 'archive',
                        'action' => 'betweentwodates',
                        'id' => 'navBetween2Dates',
                        'class' => 'nav',
                        'resource' => 'Application\Controller\Exercise',
                    ),
                ),
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
