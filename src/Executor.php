<?php

namespace Validator;

use Validator\Contract\Rule;
use Validator\Exception\RuleNotFound;

/**
 * Class Executor
 * @package Validator
 */
class Executor
{
    /** @var array $messages */
    private $messages;

    /** @var array $rules */
    private $rules;

    /** @var array $rulesMap */
    private $rulesMap;

    /** @var Rule[] $loadedRules */
    private $loadedRules = [];

    /** @var array $validationFailures */
    protected $validationFailures = [];

    /**
     * Executor constructor.
     * @param array $rules
     * @param array $messages
     * @param array $rulesMap
     */
    public function __construct(array $rules, array $messages, array $rulesMap)
    {
        $this->rulesMap = $rulesMap;
        $this->rules = $rules;
        $this->messages = $messages;
    }

    /**
     * Execute validator.
     */
    public function execute()
    {
        foreach ($this->rules as $fieldName => $rulesName) {
            foreach ($rulesName as $ruleName) {
                if (!isset($this->rulesMap[$ruleName])) {
                    throw new RuleNotFound($ruleName);
                }

                $classNamespace = $this->rulesMap[$ruleName];

                if (!isset($this->loadedRules[$classNamespace])) {
                    $this->loadedRules[$ruleName] = new $classNamespace;
                }

                $data = isset($_REQUEST[$fieldName]) ? $_REQUEST[$fieldName] : null;

                if (!$this->loadedRules[$ruleName]->applyRule($data)) {
                    $customErrorMessage = $this->loadedRules[$ruleName]->getMessage();

                    if (isset($this->messages[$fieldName])) {
                        $customErrorMessage = $this->messages[$fieldName];
                    }

                    $this->validationFailures[$fieldName][] = $customErrorMessage;
                }
            }
        }

        ~r($this->validationFailures);
    }
}