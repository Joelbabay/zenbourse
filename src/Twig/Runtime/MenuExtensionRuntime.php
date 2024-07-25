<?php

namespace App\Twig\Runtime;

use Twig\Extension\RuntimeExtensionInterface;

class MenuExtensionRuntime implements RuntimeExtensionInterface
{
    const MENUS = [
        "home" => [
            "" => [
                "title" => "accueil",
                "url" => "app_home"
            ],
            "methodes" => [
                "title" => "methodes",
                "slug" => "methodes",
                "url" => "app_methode"
            ],
            "le-perdant" => [
                "title" => "le perdant",
                "url" => "app_perdant"
            ],
            "citation" => [
                "title" => "citation",
                "url" => "app_citation"
            ],
            "bien-debuter" => [
                "title" => "bien debuter",
                "url" => "app_bien_debuter"
            ],
            "performance" => [
                "title" => "performance",
                "url" => "app_performance"
            ],
            "contact" => [
                "title" => "contact",
                "url" => "app_contact"
            ]

        ],
        "investisseur" => [
            "presentation" => [
                "title" => "Presentation",
                "url" => "app_investisseur_presentation",
                "subMenus" => []
            ],
            "la-methode" => [
                "title" => "La methode",
                "url" => "app_investisseur_methode",
                "subMenus" => [
                    [
                        "title" => "Vague d'elliot",
                        "url" => "app_investisseur_methode_vagues_elliott",
                    ],
                    [
                        "title" => "cycles boursiers",
                        "url" => "app_investisseur_methode_cycles_boursiers",
                    ],
                    [
                        "title" => "Boites / Bulles",
                        "url" => "app_investisseur_methode_boites_bulles",
                    ],
                    [
                        "title" => "Indicateurs",
                        "url" => "app_investisseur_methode_indicateurs",
                    ]
                ]
            ],
            "bibliotheque" => [
                "title" => "Bibliotheque",
                "url" => "app_investisseur_bibliotheque",
                "subMenus" => [
                    [
                        "title" => "pics de volumes",
                        "url" => "app_investisseur_bibliotheque_pics_volumes",
                    ],
                    [
                        "title" => "ramassage",
                        "url" => "app_investisseur_bibliotheque_ramasssage"
                    ],
                    [
                        "title" => "ramassage + pic",
                        "url" => "app_investisseur_bibliotheque_ramasssage_pic"
                    ],
                    [
                      "title" => "pic + ramassage",
                        "url" => "app_investisseur_bibliotheque_pic_ramassage"
                    ],
                    [
                        "title" => "volumes faibles",
                        "url" => "app_investisseur_bibliotheque_volumes_faibles"
                    ],
                    [
                        "title" => "introductions",
                        "url" => "app_investisseur_bibliotheque_introduction"
                    ]
                ]
            ],
            "outils" => [
                "title" => "Outils",
                "url" => "app_investisseur_outils",
                "subMenus" => []
            ],
            "Gestion" => [
                "title" => "Gestion",
                "url" => "app_investisseur_gestion",
                "subMenus" => []
            ],
            "Introduction" => [
                "title" => "Introduction",
                "url" => "app_investisseur_introduction",
                "subMenus" => []
            ]
        ],
        "intraday"=> [
            "home" => [
                "title" => "Accueil",
                "url" => "app_intraday",
            ],
            "presentation" => [
                "title" => "presentation",
                "url" => "app_intraday_presentation",
            ],
            "methode" => [
                "title" => "la methode",
                "url" => "app_intraday_methode",
            ],
            "bibliotheque" => [
                "title" => "bibliotheque",
                "url" => "app_intraday_bibliotheque",
            ]
        ]
    ];

    public function __construct()
    {
        // Inject dependencies if needed

    }

    public function getMenus($value): array
    {
        return self::MENUS[$value];
    }

    public function getSubMenus($parent, $value): array {
        return self::MENUS[$parent][$value];
    }
}
