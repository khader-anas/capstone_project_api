<?php

namespace Core\Controllers;

use Core\Base\Controller;

class Front extends Controller
{
    function render()
    {
        require_once dirname(__DIR__, 2) . "/resources/views/sellings.php";
    }
}
