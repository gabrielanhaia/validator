<?php

namespace Vendor\Rules;

use Validator\Contract\Rule;

/**
 * Class MinimumSize.
 *
 * @author Gabriel Anhaia <gabriel@mestredev.com.br>
 * @package Vendor\Rules
 */
class MinimumSize extends Rule
{
    /**
     * {@inheritdoc}
     */
    public static function getName(): string
    {
        return 'min';
    }

    /**
     * {@inheritdoc}
     */
    public function applyRule($data): bool
    {
        $minimumSize = (int) $this->getParameter();

        if (strlen($data) < $minimumSize) {
            return false;
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function getMessage(): string
    {
        return 'Size did not reach expected number of characters.';
    }

    /**
     * {@inheritdoc}
     */
    public function hasParameter()
    {
        return true;
    }
}