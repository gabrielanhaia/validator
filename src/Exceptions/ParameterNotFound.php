<?php

namespace Validator\Exceptions;

/**
 * Class ParameterNotFound
 * @package Validator\Exceptions
 */
class ParameterNotFound extends \Exception
{
    /** @var string $ruleName Rule name.  */
    protected $ruleName;

    /**
     * ParameterNotFound constructor.
     * @param string $ruleName
     * @param string $message
     * @param int $code
     * @param \Throwable|null $previous
     */
    public function __construct(
        $ruleName,
        $message = '',
        $code = 0,
        \Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);

        $this->setRuleName($ruleName);
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
     */
    public function setRuleName(string $ruleName)
    {
        $this->ruleName = $ruleName;
    }
}