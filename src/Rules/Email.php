<?php

namespace Vendor\Rules;

use Validator\Contract\Rule;

/**
 * Class Email.
 *
 * @author Gabriel Anhaia <gabriel@mestredev.com.br>
 * @package Vendor\Rules
 */
class Email implements Rule
{
    /**
     * {@inheritdoc}
     */
    public static function getName(): string
    {
        return 'email';
    }

    /**
     * {@inheritdoc}
     */
    public function applyRule($data): bool
    {
        if (!filter_var($data, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function getMessage(): string
    {
        return 'Is not a valid email.';
    }
}