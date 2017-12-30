<?php

namespace Validator;

use Validator\Contract\Rule;

/**
 * Class Profile
 * @package Validator
 */
class Profile
{
    /** @var string $language Language of validation failure messages. */
    private $language;

    /** @var Rule[] $customRules */
    private $customRules;

    /**
     * Profile constructor.
     * @param string $language Language of validation failure messages.
     * @param array $customRules
     */
    public function __construct(string $language = 'en', array $customRules = [])
    {
        $this->language = $language;
        $this->customRules = $customRules;
    }

    /**
     * @param Rule $rule
     */
    public function addCustomRule(Rule $rule)
    {
        $this->customRules[] = $rule;
    }

    /**
     * @return Rule[]
     */
    public function getCustomRules(): array
    {
        return $this->customRules;
    }

    /**
     * @param Rule[] $customRules
     * @return Profile
     */
    public function setCustomRules(array $customRules): Profile
    {
        $this->customRules = $customRules;
        return $this;
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