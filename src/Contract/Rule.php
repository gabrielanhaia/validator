<?php

namespace Validator\Contract;

/**
 * Rule class interface.
 *
 * @author Gabriel Anhaia <gabriel@mestredev.com.br>
 * @package Validator\Contract
 */
abstract class Rule
{
    /** @var array $parameter */
    protected $parameters;

    /**
     * Method that applies the rule.
     * @param mixed $data Data to be applied rule.
     * @return bool
     */
    abstract public function applyRule($data): bool;

    /**
     * Returns the identifier of the rule.
     * @return string
     */
    abstract public static function getName(): string;

    /**
     * Returns the rule validation failure message.
     * @return array|string
     */
    abstract public function getMessage();

    /**
     * Defines whether the validation rule has parameters.
     * @return bool
     */
    public function hasParameters()
    {
        return false;
    }

    /**
     * @param $position
     * @return string
     */
    public function getParameter($position): string
    {
        return $this->parameters[$position];
    }

    /**
     * @param array $parameters
     * @return Rule
     */
    public function setParameters($parameters): Rule
    {
        $this->parameters = $parameters;
        return $this;
    }
}