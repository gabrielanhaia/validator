<?php

namespace Validator;

/**
 * Class Profile
 * @package Validator
 */
class Profile
{
    /** @var string $language Language of validation failure messages. */
    private $language;

    /**
     * Profile constructor.
     * @param string $language Language of validation failure messages.
     */
    public function __construct(string $language = 'en')
    {
        $this->language = $language;
    }

    /**
     * @return string Language of validation failure messages.
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * @param string $language Language of validation failure messages.
     * @return Profile
     */
    public function setLanguage(string $language): Profile
    {
        $this->language = $language;
        return $this;
    }
}