<?php
/*
*   07.11.2025
*   GuestMenu.php
*/
namespace App\Http\Menus;

use App\MenuBuilder;

interface MenuInterface
{
    public function get(string $roles);
}