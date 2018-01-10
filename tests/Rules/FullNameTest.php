<?php

namespace Tests\Rules;

use Validator\Rules\FullName;

/**
 * Class FullNameTest
 *
 * @author Gabriel Anhaia <gabriel@mestredev.com.br>
 * @package Tests\Rules
 */
class FullNameTest extends \Tests\TestCase
{
    /**
     * @dataProvider fullNameSuccessDataProvider
     */
    public function testFullNameSuccess($data)
    {
        $fullNameRule = new FullName();

        $this->assertTrue($fullNameRule->applyRule($data));
    }

    /**
     * @dataProvider fullNameFailDataProvider
     */
    public function testFullNameFail($data)
    {
        $fullNameRule = new FullName();

        $this->assertFalse($fullNameRule->applyRule($data));
    }

    /**
     * @return array
     */
    public function fullNameFailDataProvider()
    {
        return [
            [
                'data' => '',
            ],
            [
                'data' => null
            ],
            [
                'data' => 'test'
            ]
        ];
    }

    /**
     * @return array
     */
    public function fullNameSuccessDataProvider()
    {
        return [
            [
                'data' => 'Gabriel Anhaia',
            ],
            [
                'data' => 'Test Test Test'
            ],
            [
                'data' => ' Test Test2 '
            ]
        ];
    }
}