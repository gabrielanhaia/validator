<?php
/**
 * Created by PhpStorm.
 * User: gabrielanhaia
 * Date: 27/12/17
 * Time: 16:47
 */

namespace Validator;
use Validator\Contract\Rule;

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
        foreach ($this->rules as $fieldName => $ruleName) {
            if (!isset($this->rulesMap[$ruleName])) {
                throw new \Exception('No rule');
            }

            $classNamespace = $this->rulesMap[$ruleName];

            if (!isset($this->loadedRules[$classNamespace])) {
                $this->loadedRules[$ruleName] = new $classNamespace;
            }

            $data = isset($_REQUEST[$fieldName]) ? $_REQUEST[$fieldName] : null;

        }
    }
}