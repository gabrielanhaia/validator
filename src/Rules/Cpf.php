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

        for ($i = 0, $j = 10, $soma = 0; $i < 9; $i++, $j--) {
            $soma += $cpf{$i} * $j;
        }

        $resto = $soma % 11;

        if ($cpf{9} != ($resto < 2 ? 0 : 11 - $resto)) {
            return false;
        }

        for ($i = 0, $j = 11, $soma = 0; $i < 10; $i++, $j--) {
            $soma += $cpf{$i} * $j;
        }

        $resto = $soma % 11;

        return $cpf{10} == ($resto < 2 ? 0 : 11 - $resto);
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