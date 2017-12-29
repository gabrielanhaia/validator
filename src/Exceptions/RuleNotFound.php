<?php

namespace Validator\Exception;

/**
 * Class RuleNotFound
 * @package Validator\Exception
 */
class RuleNotFound extends \Exception
{
    /** @var string $ruleName Rule name.  */
    protected $ruleName;

    /**
     * RuleNotFound constructor.
     * @param string $ruleName
     * @param string $message
     * @param int $code
     * @param \Throwable|null $previous
     */
    public function __construct(
        string $ruleName,
        string $message = '',
        integer $code = 0,
        \Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);

        $this->ruleName = $ruleName;
    }

    /**
     * @return string
     */
    public function getRuleName(): string
    {
        return $this->ruleName;
    }

    /**
     * @param string $ruleName
     * @return RuleNotFound
     */
    public function setRuleName(string $ruleName): RuleNotFound
    {
        $this->ruleName = $ruleName;
        return $this;
    }
}