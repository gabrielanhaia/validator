<?php

namespace Validator;

use Validator\{
    Rules\RulesMap
};

/**
 * Class RequestValidator
 *
 * @author Gabriel Anhaia <gabriel@mestredev.com.br>
 * @package Validator
 */
abstract class RequestValidator
{
    use RequestValidatorFormatter;

    /**
     * RequestValidator constructor.
     * @param Profile|null $profile
     */
    public function __construct(Profile $profile = null)
    {
        if (empty($profile)) {
            $profile = new Profile();
        }

        $rulesMap = new RulesMap();
        $executor = new Executor(
            $this->formatRules($this->getRules()),
            $this->formatCustomMessages($this->getMessages()),
            $rulesMap->getMap(),
            $profile
        );
        $executor->execute();
    }

    /**
     * Method that should return a list with field names and their rules.
     * @return array
     */
    abstract public function getRules(): array;

    /**
     * Returns a custom list with the fields and error messages in the validations.
     * @return array
     */
    public function getMessages(): array
    {
        return [];
    }
}