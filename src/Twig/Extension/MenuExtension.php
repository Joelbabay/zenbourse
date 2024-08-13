<?php

namespace App\Twig\Extension;

use App\Twig\Runtime\MenuExtensionRuntime;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class MenuExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('get_menus', [MenuExtensionRuntime::class, 'getMenus']),
            new TwigFunction('get_sub_menus', [MenuExtensionRuntime::class, 'getSubMenus']),
        ];
    }
}
