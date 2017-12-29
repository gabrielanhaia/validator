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
    /** @var string $parameter */
    protected $parameter;

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
     * @return string
     */
    abstract public function getMessage(): string;

    /**
     * Defines whether the validation rule has parameters.
     * @return bool
     */
    public function hasParameter()
    {
        return false;
    }

    /**
     * @return string
     */
    public function getParameter(): string
    {
        return $this->parameter;
    }

    /**
     * @param string $parameter
     * @return Rule
     */
    public function setParameter(string $parameter): Rule
    {
        $this->parameter = $parameter;
        return $this;
    }
}