<?php

namespace Validator;

use Validator\Exceptions\ParameterNotFound;
use Validator\Manager\MessageManager;
use Validator\Manager\RulesLoaderManager;

/**
 * Class Executor
 * @package Validator
 */
class Executor
{

    /** @var array $rules */
    private $rules;

    /** @var Profile $profile */
    private $profile;

    /** @var array $validationFailures */
    protected $validationFailures = [];

    /** @var RulesLoaderManager $rulesLoader */
    private $rulesLoader;

    /** @var MessageManager $messageManager */
    private $messageManager;

    /**
     * Executor constructor.
     * @param array $rules
     * @param array $messages
     * @param array $aliasFields
     * @param Profile $profile
     */
    public function __construct(array $rules, array $messages, array $aliasFields, Profile $profile)
    {
        $this->rulesLoader = new RulesLoaderManager();

        $this->rulesLoader->includeCustomRules($profile->getCustomRules());

        $this->messageManager = new MessageManager($messages, $aliasFields, $profile->getLanguage());

        $this->rules = $rules;

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
                $parameters = $ruleData['parameter'];

                $rule = $this->rulesLoader->getRule($ruleName);

                if ($rule->hasParameters()) {
                    if ($parameters === null) {
                        throw new ParameterNotFound($ruleName);
                    }

                    $rule->setParameters($parameters);
                }

                $data = isset($_REQUEST[$fieldName]) ? $_REQUEST[$fieldName] : null;

                if (!$rule->applyRule($data)) {
                    $errorMessage = $this->messageManager->getMessage($fieldName, $ruleName, $rule->getMessage());

                    $this->validationFailures[$fieldName][] = $errorMessage;
                }
            }
        }

        ~r($this->validationFailures);
    }
}