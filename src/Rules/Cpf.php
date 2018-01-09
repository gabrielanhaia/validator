<?php

namespace Validator\Rules;

use Validator\Contract\Rule;

/**
 * Class Cpf.
 *
 * @author Gabriel Anhaia <gabriel@mestredev.com.br>
 * @package Vendor\Rules
 */
class Cpf extends Rule
{
    /**
     * {@inheritdoc}
     */
    public static function getName(): string
    {
        return 'cpf';
    }

    /**
     * {@inheritdoc}
     */
    public function applyRule($data): bool
    {
        $cpf = preg_replace('/[^0-9]/', '', (string) $data);

        if (strlen($cpf) != 11) {
            return false;
        }

        for ($i = 0, $j = 10, $sum = 0; $i < 9; $i++, $j--) {
            $sum += $cpf{$i} * $j;
        }

        $rest = $sum % 11;

        if ($cpf{9} != ($rest < 2 ? 0 : 11 - $rest)) {
            return false;
        }

        for ($i = 0, $j = 11, $sum = 0; $i < 10; $i++, $j--) {
            $sum += $cpf{$i} * $j;
        }

        $rest = $sum % 11;

        return $cpf{10} == ($rest < 2 ? 0 : 11 - $rest);
    }

    /**
     * {@inheritdoc}
     */
    public function getMessage()
    {
        return [
            'en' => 'Is not a valid CPF.',
            'pt-br' => 'Não é um CPF em formato válido.'
        ];
    }
}