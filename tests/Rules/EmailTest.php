<?php

namespace Tests\Rules;

use Validator\Rules\Email;

/**
 * Class EmailTest
 *
 * @author Gabriel Anhaia <gabriel@mestredev.com.br>
 * @package Tests\Rules
 */
class EmailTest extends \Tests\TestCase
{
    /**
     * @dataProvider emailSuccessDataProvider
     */
    public function testEmailSuccess($data)
    {
        $emailRule = new Email();

        $this->assertTrue($emailRule->applyRule($data));
    }

    /**
     * @dataProvider emailFailDataProvider
     */
    public function testEmailFail($data)
    {
        $emailRule = new Email();

        $this->assertFalse($emailRule->applyRule($data));
    }

    /**
     * @return array
     */
    public function emailSuccessDataProvider()
    {
        return [
            [
                'data' => 'gabriel@mestredev.com.br',
            ],
            [
                'data' => 'a@b.c'
            ]
        ];
    }

    /**
     * @return array
     */
    public function emailFailDataProvider()
    {
        return [
            [
                'data' => 'test',
            ],
            [
                'data' => 'testtest.com'
            ],
            [
                'data' => 'test@'
            ],
            [
                'data' => 'test@test'
            ],
            [
                'data' => '@test.com'
            ]
        ];
    }
}