<?php

namespace Validator\Rules;

use Validator\Contract\Rule;

/**
 * Class Required.
 *
 * @author Gabriel Anhaia <gabriel@mestredev.com.br>
 * @package Vendor\Rules
 */
class Required extends Rule
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
    public function getMessage()
    {
        return [
            'en' => 'Not specified.',
            'pt-br' => 'Campo de preenchimento obrigatório.'
        ];
    }
}