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
                                'label' => 'gesamter Verlauf',
                                'route' => 'archive',
                                'action' => 'totalprocess',
                                'id' => 'navTotalProcess',
                                'class' => 'nav',
                            ),
                            array(
                                'label' => 'Monatsverlauf',
                                'route' => 'archive',
                                'action' => 'monthprocess',
                                'id' => 'navMonthProcess',
                                'class' => 'nav',
                            ),
                            array(
                                'label' => 'Jahresverlauf',
                                'route' => 'archive',
                                'action' => 'yearprocess',
                                'id' => 'navYearProcess',
                                'class' => 'nav',
                            ),
                            array(
                                'label' => 'zwischen 2 Daten',
                                'route' => 'archive',
                                'action' => 'betweentwodates',
                                'id' => 'navBetween2Dates',
                                'class' => 'nav',
                            ),
                            array(
                                'label' => '2 Datenreihen vergleichen',
                                'route' => 'archive',
                                'action' => 'compare',
                                'id' => 'navCompare',
                                'class' => 'nav',
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
