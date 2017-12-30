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

    /** @var Profile $profile */
    private $profile;

    /** @var array $validationFailures */
    protected $validationFailures = [];

    /**
     * Executor constructor.
     * @param array $rules
     * @param array $messages
     * @param array $rulesMap
     * @param Profile $profile
     */
    public function __construct(array $rules, array $messages, array $rulesMap, Profile $profile)
    {
        $this->rulesMap = $rulesMap;
        $this->rules = $rules;
        $this->messages = $messages;
        $this->profile = $profile;
    }

    /**
     * Execute validator.
     */
    public function execute()
    {
        foreach ($this->rules as $fieldName => $rulesName) {
            foreach ($rulesName as $ruleData) {

                $ruleName = $ruleData['ruleName'];
                $parameter = $ruleData['parameter'];

                if (!isset($this->rulesMap[$ruleName])) {
                    throw new RuleNotFound($ruleName);
                }

                $classNamespace = $this->rulesMap[$ruleName];

                if (!isset($this->loadedRules[$classNamespace])) {
                    $this->loadedRules[$ruleName] = new $classNamespace;

                    if ($this->loadedRules[$ruleName]->hasParameter()) {
                        $this->loadedRules[$ruleName]->setParameter($parameter);
                    }
                }

                $data = isset($_REQUEST[$fieldName]) ? $_REQUEST[$fieldName] : null;

                if (!$this->loadedRules[$ruleName]->applyRule($data)) {
                    $customErrorMessage = $this->getMessage($this->loadedRules[$ruleName]->getMessage());

                    if (isset($this->messages[$fieldName][$ruleName])) {
                        $customErrorMessage = $this->messages[$fieldName][$ruleName];
                    }

                    $this->validationFailures[$fieldName][] = $customErrorMessage;
                }
            }
        }

        ~r($this->validationFailures);
    }

    /**
     * @param array|string $message
     * @return string
     */
    private function getMessage($message): string
    {
        if (is_array($message)) {
            return $message[$this->profile->getLanguage()];
        }

        return $message;
    }
}