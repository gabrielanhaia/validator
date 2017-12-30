<?php

namespace Validator\Rules;

use Validator\Contract\Rule;

/**
 * Class MaximumSize.
 *
 * @author Gabriel Anhaia <gabriel@mestredev.com.br>
 * @package Vendor\Rules
 */
class MaximumSize extends Rule
{
    /**
     * {@inheritdoc}
     */
    public static function getName(): string
    {
        return 'max';
    }

    /**
     * {@inheritdoc}
     */
    public function applyRule($data): bool
    {
        $maximumSize = (int) $this->getParameter();

        if (strlen($data) > $maximumSize) {
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
            'en' => 'The size has exceeded the character limit.',
            'pt-br' => 'O tamanho ultrapassa o limite de caracteres.'
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function hasParameter()
    {
        return true;
    }
}