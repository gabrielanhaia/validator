<?php

namespace Validator\Entity;

/**
 * Class Error
 * @package Validator\Entity
 */
class Error
{
    /** @var string $fieldName */
    protected $fieldName;

    /** @var string $errorMessage */
    protected $errorMessage;

    /**
     * Error constructor.
     * @param $fieldName
     * @param $errorMessage
     */
    public function __construct($fieldName, $errorMessage)
    {
        $this->fieldName = $fieldName;
        $this->errorMessage = $errorMessage;
    }

    /**
     * @return mixed
     */
    public function getFieldName()
    {
        return $this->fieldName;
    }

    /**
     * @param mixed $fieldName
     * @return Error
     */
    public function setFieldName($fieldName)
    {
        $this->fieldName = $fieldName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * @param mixed $errorMessage
     * @return Error
     */
    public function setErrorMessage($errorMessage)
    {
        $this->errorMessage = $errorMessage;
        return $this;
    }
}