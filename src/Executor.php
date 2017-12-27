<?php
/**
 * Created by PhpStorm.
 * User: gabrielanhaia
 * Date: 27/12/17
 * Time: 16:47
 */

namespace Validator;

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

    /**
     * Executor constructor.
     * @param array $rules
     * @param array $messages
     */
    public function __construct(array $rules, array $messages)
    {
        $this->rules = $rules;
        $this->messages = $messages;
    }

    /**
     * Execute validator.
     */
    public function execute()
    {
        foreach ($this->rules as $fieldName => $rule) {
            //if (!isset())
        }
    }
}