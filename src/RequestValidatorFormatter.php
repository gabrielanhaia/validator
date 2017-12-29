<?php

namespace Validator;

/**
 * Trait RequestValidatorFormatter
 * @package Validator
 */
trait RequestValidatorFormatter
{
    /**
     * @param array $rules
     * @return array
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

    /**
     * @param array $customMessages
     * @return array
     */
    private function formatCustomMessages(array $customMessages = [])
    {
        if (empty($customMessages)) {
            return [];
        }

        $formattedMessages = [];
        foreach ($customMessages as $fieldNameAndRule => $message) {
            $fieldNameAndRule = explode('.', $fieldNameAndRule);

            $formattedMessages[$fieldNameAndRule[0]][$fieldNameAndRule[1]] = $message;
        }

        return $formattedMessages;
    }
}