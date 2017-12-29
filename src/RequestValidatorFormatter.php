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
                $ruleSplited = preg_split('|{|', $rule);

                $parameter = isset($ruleSplited[1]) ? $ruleSplited[1] : null;
                $parameter = str_replace('}', '', $parameter);

                $formattedRules[$fieldName][] = [
                    'ruleName' => $ruleSplited[0],
                    'parameter' => $parameter
                ];
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