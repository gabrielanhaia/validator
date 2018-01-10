<?php

namespace Tests\Rules;

use Validator\Rules\Cnpj;

/**
 * Class CnpjTest
 *
 * @author Gabriel Anhaia <gabriel@mestredev.com.br>
 * @package Tests\Rules
 */
class CnpjTest extends \Tests\TestCase
{
    /**
     * @dataProvider cnpjSuccessDataProvider
     */
    public function testCnpjSuccess($data)
    {
        $cnpjRule = new Cnpj();

        $this->assertTrue($cnpjRule->applyRule($data));
    }

    /**
     * @dataProvider cnpjFailDataProvider
     */
    public function testCnpjFail($data)
    {
        $cnpjRule = new Cnpj();

        $this->assertFalse($cnpjRule->applyRule($data));
    }

    /**
     * @return array
     */
    public function cnpjSuccessDataProvider()
    {
        return [
            [
                'data' => '90443309000149',
            ],
            [
                'data' => '51.169.939/0001-15',
            ],
        ];
    }

    /**
     * @return array
     */
    public function cnpjFailDataProvider()
    {
        return [
            [
                'data' => '84686332088',
            ],
            [
                'data' => '51.169.839/0001-15',
            ],
        ];
    }
}