<?php

namespace Vendor\Rules;

use Validator\Contract\Rule;

/**
 * Class Email.
 *
 * @author Gabriel Anhaia <gabriel@mestredev.com.br>
 * @package Vendor\Rules
 */
class Email extends Rule
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
    public function getMessage(): array
    {
        return [
            'en' => 'Is not a valid email.',
            'pt-br' => 'Não é um e-mail em fomato válido.'
        ];
    }
}