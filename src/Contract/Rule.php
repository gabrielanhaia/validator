<?php

namespace Validator\Contract;

/**
 * Rule class interface.
 *
 * @author Gabriel Anhaia <gabriel@mestredev.com.br>
 * @package Validator\Contract
 */
interface Rule
{
    /**
     * Method that applies the rule.
     * @param mixed $data Data to be applied rule.
     * @return bool
     */
    public function applyRule($data): bool;

    /**
     * Returns the identifier of the rule.
     * @return string
     */
    public static function getName(): string;

    /**
     * Returns the rule validation failure message.
     * @return string
     */
    public function getMessage(): string;
}