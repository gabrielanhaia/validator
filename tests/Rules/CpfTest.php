<?php

namespace Tests\Rules;

use Validator\Rules\Cpf;

/**
 * Class CpfTest
 *
 * @author Gabriel Anhaia <gabriel@mestredev.com.br>
 * @package Tests\Rules
 */
class CpfTest extends \Tests\TestCase
{
    /**
     * @dataProvider cpfSuccessDataProvider
     */
    public function testCpfSuccess($data)
    {
        $cpfRule = new Cpf();

        $this->assertTrue($cpfRule->applyRule($data));
    }

    /**
     * @dataProvider cpfFailDataProvider
     */
    public function testCpfFail($data)
    {
        $cpfRule = new Cpf();

        $this->assertFalse($cpfRule->applyRule($data));
    }

    /**
     * @return array
     */
    public function cpfSuccessDataProvider()
    {
        return [
            [
                'data' => '68412074084',
            ],
            [
                'data' => '742.005.630-70',
            ],
        ];
    }

    /**
     * @return array
     */
    public function cpfFailDataProvider()
    {
        return [
            [
                'data' => '84686332088',
            ],
            [
                'data' => '13245678',
            ],
        ];
    }
}