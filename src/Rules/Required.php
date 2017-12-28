<?php

namespace Vendor\Rules;

use Validator\Contract\Rule;

/**
 * Class Required.
 *
 * @author Gabriel Anhaia <gabriel@mestredev.com.br>
 * @package Vendor\Rules
 */
class Required implements Rule
{
    /**
     * {@inheritdoc}
     */
    public static function getName(): string
    {
        return 'required';
    }

    /**
     * {@inheritdoc}
     */
    public function applyRule($data): bool
    {
        if (empty($data)) {
            return false;
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function getMessage(): string
    {
        return 'test';
    }
}