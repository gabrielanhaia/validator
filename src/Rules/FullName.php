<?php

namespace Validator\Rules;

use Validator\Contract\Rule;

/**
 * Class FullName.
 *
 * @author Gabriel Anhaia <gabriel@mestredev.com.br>
 * @package Vendor\Rules
 */
class FullName extends Rule
{
    /**
     * {@inheritdoc}
     */
    public static function getName(): string
    {
        return 'full_name';
    }

    /**
     * {@inheritdoc}
     */
    public function applyRule($data): bool
    {
        $data = trim($data);

        if (!preg_match('|^\S{1,}\s{1}\S{1,}(\s{1}\S{1,}){0,}$|', $data)) {
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
            'en' => 'It\'s not a full name.',
            'pt-br' => 'Não é um nome completo.'
        ];
    }
}