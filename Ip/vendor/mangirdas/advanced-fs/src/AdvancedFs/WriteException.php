<?php
/**
 * Created by PhpStorm.
 * User: maskas
 * Date: 16.12.30
 * Time: 23.48
 */

namespace AdvancedFs;


class WriteException extends \Exception
{
    public function __construct($path) {
        parent::__construct("Directory is not writable: " . $path);
    }
}
