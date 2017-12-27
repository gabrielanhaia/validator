<?php

namespace Vendor\Rules;

use Validator\Contract\Rule;

/**
 * Class Required
 * @package Vendor\Rules
 */
class Required implements Rule
{
    /** @var string $ruleName */
    private $ruleName = 'required';

    /**
     * @return string
     */
    public function getRuleName(): string
    {
        return $this->ruleName;
    }

    /**
     * @param mixed $data
     * @return bool
     */
    public function applyRule($data): bool
    {
        if (empty($data)) {
            return false;
        }

        return true;
    }
}