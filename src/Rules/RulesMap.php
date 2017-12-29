<?php

namespace Vendor\Rules;

use Validator\Contract\Rule;

/**
 * Map of validation rules and their implementations.
 *
 * @author Gabriel Anhaia <gabriel@mestredev.com.br>
 * @package Vendor\Rules
 */
class RulesMap
{
    /**
     * Return the map of validation rules and their implementations.
     * @return Rule[]
     */
    public function getMap()
    {
        return [
            Required::getName() => Required::class,
            Email::getName() => Email::class,
            MaximumSize::getName() => MaximumSize::class
        ];
    }
}