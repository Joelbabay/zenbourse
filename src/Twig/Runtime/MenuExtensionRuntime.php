<?php

namespace App\Twig\Runtime;

use Twig\Extension\RuntimeExtensionInterface;

class MenuExtensionRuntime implements RuntimeExtensionInterface
{
    const MENUS = [
        "home" => [
            "accueil" => [
                "title" => "Accueil",
                "url" => "app_home"
            ],
            "methodes" => [
                "title" => "Methodes",
                "url" => "app_methode"
            ],
            "leperdant" => [
                "title" => "Le perdant",
                "url" => "app_perdant"
            ],
            "citation" => [
                "title" => "Citation",
                "url" => "app_citation"
            ],
            "biendebuter" => [
                "title" => "Bien debuter",
                "url" => "app_bien_debuter"
            ],
            "performance" => [
                "title" => "Performance",
                "url" => "app_performance"
            ],
            "contact" => [
                "title" => "Contact",
                "url" => "app_contact"
            ]

        ],
        "investisseur" => [
            "presentation" => [
                "title" => "Presentation",
                "url" => "app_investisseur_presentation",
                "subMenus" => []
            ],
            "lamethode" => [
                "title" => "La methode",
                "url" => "app_investisseur_methode",
                "subMenus" => [
                    [
                        "title" => "Vague d'elliot",
                        "url" => "app_investisseur_methode",
                    ],
                    [
                        "title" => "cycles boursiers",
                        "url" => "app_investisseur_methode",
                    ],
                    [
                        "title" => "Boites / Bulles",
                        "url" => "app_investisseur_methode",
                    ],
                    [
                        "title" => "Indicateurs",
                        "url" => "app_investisseur_methode",
                    ]
                ]
            ],
            "bibliotheque" => [
                "title" => "Biblioteque",
                "url" => "app_investisseur_methode",
                "subMenus" => []
            ],
            "outils" => [
                "title" => "Outils",
                "url" => "app_investisseur_methode",
                "subMenus" => []
            ],
            "Gestion" => [
                "title" => "Gestion",
                "url" => "app_investisseur_methode",
                "subMenus" => []
            ],
            "Introduction" => [
                "title" => "Introduction",
                "url" => "app_investisseur_methode",
                "subMenus" => []
            ]
        ],
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
