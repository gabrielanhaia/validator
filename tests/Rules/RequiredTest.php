<?php

namespace Tests\Rules;

use Validator\Rules\Required;

class RequiredTest extends \Tests\TestCase
{
    /**
     * @dataProvider requiredSuccessDataProvider
     */
    public function testRequiredSuccess($data)
    {
        $requiredRule = new Required();

        $this->assertTrue($requiredRule->applyRule($data));
    }

    /**
     * @dataProvider requiredFailDataProvider
     */
    public function testRequiredFail($data)
    {
        $requiredRule = new Required();

        $this->assertFalse($requiredRule->applyRule($data));
    }

    /**
     * @return array
     */
    public function requiredFailDataProvider()
    {
        return [
            [
                'data' => '',
            ], [
                'data' => null
            ]
        ];
    }

    /**
     * @return array
     */
    public function requiredSuccessDataProvider()
    {
        return [
            [
                'data' => 'test',
            ], [
                'data' => 0
            ]
        ];
    }
}