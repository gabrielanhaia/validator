<?php

namespace Vendor\Rules;

use Validator\Contract\Rule;

/**
 * Class Required
 * @package Vendor\Rules
 */
class Required implements Rule
{
    /**
     * @return string
     */
    public static function getName(): string
    {
        return 'required';
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

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return 'test';
    }
}