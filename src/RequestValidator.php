<?php

namespace Validator;

use Vendor\{
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
    /**
     * RequestValidator constructor.
     */
    public function __construct()
    {
        $rulesMap = new RulesMap();
        $executor = new Executor(
            $this->formatRules($this->getRules()),
            $this->getMessages(),
            $rulesMap->getMap()
        );
        $executor->execute();
    }

    /**
     * Abstract method that should return a list with field names and their rules.
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

    /**
     * @param array $rules
     */
    private function formatRules(array $rules = [])
    {
        if (empty($rules)) {
            return [];
        }

        $formattedRules = [];
        foreach ($rules as $fieldName => $definedRules) {
            $definedRules = explode(';', $definedRules);

            foreach ($definedRules as $rule) {
                $formattedRules[$fieldName][] = $rule;
            }
        }

        return $formattedRules;
    }
}