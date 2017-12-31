<?php

namespace Validator;

use Validator\Exceptions\ParameterNotFound;
use Validator\Manager\RulesLoaderManager;

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

    /** @var Profile $profile */
    private $profile;

    /** @var array $validationFailures */
    protected $validationFailures = [];

    /** @var RulesLoaderManager $rulesLoader */
    private $rulesLoader;

    /**
     * Executor constructor.
     * @param array $rules
     * @param array $messages
     * @param Profile $profile
     */
    public function __construct(array $rules, array $messages, Profile $profile)
    {
        $this->rulesLoader = new RulesLoaderManager();
        $this->rulesLoader->includeCustomRules($this->profile->getCustomRules());

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

                $rule = $this->rulesLoader->getRule($ruleName);

                if ($rule->hasParameter()) {
                    if ($parameter === null) {
                        throw new ParameterNotFound($ruleName);
                    }

                    $rule->setParameter($parameter);
                }

                $data = isset($_REQUEST[$fieldName]) ? $_REQUEST[$fieldName] : null;

                if (!$rule->applyRule($data)) {
                    $customErrorMessage = $this->getMessage($rule->getMessage());

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