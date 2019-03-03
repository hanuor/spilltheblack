<?php
/**
 * Created by PhpStorm.
 * User: maskas
 * Date: 16.12.30
 * Time: 23.48
 */

namespace AdvancedFs;


class PathNotFoundException extends \Exception
{
    public function __construct($path) {
        parent::__construct("Path doesn't exist: " . $path);
    }
}
