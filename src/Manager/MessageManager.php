<?php

namespace Validator\Manager;

/**
 * Class MessageManager
 * @package Validator\Manager
 */
class MessageManager
{
    /** @var string $language */
    private $language;

    /** @var array $customMessages */
    private $customMessages;

    /** @var array $aliasFields */
    private $aliasFields;

    /**
     * MessageManager constructor.
     * @param array $customMessages
     * @param array $aliasFields
     * @param string $language
     */
    public function __construct(array $customMessages = [], array $aliasFields, string $language = 'en')
    {
        $this->customMessages = $customMessages;
        $this->aliasFields = $aliasFields;
        $this->language = $language;
    }

    /**
     * @param $fieldName
     * @param $ruleName
     * @param array|string $message
     * @return string
     */
    public function getMessage($fieldName, $ruleName, $message): string
    {
        if (is_array($message)) {
            $message = $message[$this->language];
        }

        if (isset($this->customMessages[$fieldName][$ruleName])) {
            $message = $this->customMessages[$fieldName][$ruleName];
        }

        $message = str_replace('_fieldName_', $fieldName, $message);

        if (isset($this->aliasFields[$fieldName])) {
            $message = str_replace('_fieldAlias_', $this->aliasFields[$fieldName], $message);
        }

        return $message;
    }
}