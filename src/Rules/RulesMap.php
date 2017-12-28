<?php
/**
 * Created by PhpStorm.
 * User: gabrielanhaia
 * Date: 27/12/17
 * Time: 17:57
 */

namespace Vendor\Rules;

class RulesMap
{
    public function getMap()
    {
        return [
            Required::getName() => Required::class,
        ];
    }
}