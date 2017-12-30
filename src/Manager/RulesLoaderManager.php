<?php

namespace Validator\Manager;

use Validator\Contract\Rule;
use Validator\Exceptions\RuleNotFound;
use Validator\Rules\RulesMap;

/**
 * Class LoadedRulesManager
 * @package Validator\Manager
 */
class RulesLoaderManager
{
    /** @var Rule[] $loadedRules */
    protected $loadedRules;

    /** @var Rule[] $loadedCustomRules */
    protected $loadedCustomRules;

    /** @var Rule[] $rulesMap */
    private $rulesMap;

    /**
     * LoadedRulesManager constructor.
     */
    public function __construct()
    {
        $this->rulesMap = (new RulesMap)->getMap();
    }

    /**
     * @param Rule[] $rules
     */
    public function includeCustomRules($rules = null)
    {
        if (empty($rules)) {
            return;
        }

        foreach ($rules as $rule) {
            $this->loadedCustomRules[$rule::getName()] = $rule;
        }
    }

    /**
     * @param $ruleName
     * @return bool
     */
    public function ruleIsLoaded(string $ruleName)
    {
        if (!empty($this->loadedRules[$ruleName]) || !empty($this->loadedCustomRules[$ruleName])) {
            return true;
        }
    }

    /**
     * @param string $ruleName
     * @return Rule|null
     * @throws RuleNotFound
     */
    public function getRule(string $ruleName)
    {
        if (!empty($this->loadedCustomRules[$ruleName])) {
            return $this->loadedCustomRules[$ruleName];
        }

        if (!empty($this->loadedRules[$ruleName])) {
            return $this->loadedRules[$ruleName];
        } else if (isset($this->rulesMap[$ruleName])) {
            $classNamespace = $this->rulesMap[$ruleName];

            $this->loadedRules[$ruleName] = new $classNamespace;

            return $this->loadedRules[$ruleName];
        } else {
            throw new RuleNotFound($ruleName);
        }
    }
}