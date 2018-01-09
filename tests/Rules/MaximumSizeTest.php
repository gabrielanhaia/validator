<?php

namespace Tests\Rules;

use Validator\Rules\MaximumSize;

/**
 * Class MaximumSizeTest
 *
 * @author Gabriel Anhaia <gabriel@mestredev.com.br>
 * @package Tests\Rules
 */
class MaximumSizeTest extends \Tests\TestCase
{
    /**
     * @dataProvider maximumSizeSuccessDataProvider
     */
    public function testMaximumSizeSuccess($maximumSize, $data)
    {
        $maximumSizeRule = new MaximumSize();
        $maximumSizeRule->setParameters([$maximumSize]);

        $this->assertTrue($maximumSizeRule->applyRule($data));
    }

    /**
     * @dataProvider maximumSizeErrorDataProvider
     */
    public function testMaximumSizeError($maximumSize, $data)
    {
        $maximumSizeRule = new MaximumSize();
        $maximumSizeRule->setParameters([$maximumSize]);

        $this->assertFalse($maximumSizeRule->applyRule($data));
    }

    /**
     * @return array
     */
    public function maximumSizeSuccessDataProvider()
    {
        return [
            [
                'maximumSize' => 3,
                'data' => 'ab'
            ],
            [
                'maximumSize' => 50,
                'data' => 'abcabcabcaabcabcabcaabcabcabcaabcabcabcaabcabcabca'
            ],
            [
                'maximumSize' => 1,
                'data' => ''
            ],
            [
                'maximumSize' => 0,
                'data' => ''
            ],
        ];
    }

    /**
     * @return array
     */
    public function maximumSizeErrorDataProvider()
    {
        return [
            [
                'maximumSize' => 3,
                'data' => 'abcd'
            ],
            [
                'maximumSize' => 0,
                'data' => 0
            ],
        ];
    }
}