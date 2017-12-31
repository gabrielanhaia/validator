<?php

namespace Validator\Rules;

use Validator\Contract\Rule;

/**
 * Class Interval.
 *
 * @author Gabriel Anhaia <gabriel@mestredev.com.br>
 * @package Vendor\Rules
 */
class Interval extends Rule
{
    /**
     * {@inheritdoc}
     */
    public static function getName(): string
    {
        return 'interval';
    }

    /**
     * {@inheritdoc}
     */
    public function applyRule($data): bool
    {
        $startInterval = (int) $this->getParameter(0);

        $endInterval = (int) $this->getParameter(1);

        if ($data < $startInterval || $data > $endInterval) {
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
            'en' => 'The number entered is not in range.',
            'pt-br' => 'O número informado não está entre o intervalo.'
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function hasParameters()
    {
        return true;
    }
}