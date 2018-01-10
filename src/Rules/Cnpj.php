<?php

namespace Validator\Rules;

use Validator\Contract\Rule;

/**
 * Class Cnpj.
 *
 * @author Gabriel Anhaia <gabriel@mestredev.com.br>
 * @package Vendor\Rules
 */
class Cnpj extends Rule
{
    /**
     * {@inheritdoc}
     */
    public static function getName(): string
    {
        return 'cnpj';
    }

    /**
     * {@inheritdoc}
     */
    public function applyRule($data): bool
    {
        $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
        
        if (strlen($cnpj) != 14) {
            return false;
        }
        
        for ($i = 0, $j = 5, $sum = 0; $i < 12; $i++) {
            $sum += $cnpj{$i} * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        
        $rest = $sum % 11;
        if ($cnpj{12} != ($rest < 2 ? 0 : 11 - $rest)) {
            return false;
        }

        for ($i = 0, $j = 6, $sum = 0; $i < 13; $i++) {
            $sum += $cnpj{$i} * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }

        $rest = $sum % 11;

        return $cnpj{13} == ($rest < 2 ? 0 : 11 - $rest);
    }

    /**
     * {@inheritdoc}
     */
    public function getMessage()
    {
        return [
            'en' => 'Is not a valid CNPJ.',
            'pt-br' => 'Não é um CNPJ em formato válido.'
        ];
    }
}