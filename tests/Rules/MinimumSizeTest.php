<?php

namespace Tests\Rules;

use Validator\Rules\MinimumSize;

/**
 * Class MinimumSizeTest
 *
 * @author Gabriel Anhaia <gabriel@mestredev.com.br>
 * @package Tests\Rules
 */
class MinimumSizeTest extends \Tests\TestCase
{
    /**
     * @dataProvider minimumSizeSuccessDataProvider
     */
    public function testMinimumSizeSuccess($minimumSize, $data)
    {
        $minimumSizeRule = new MinimumSize();
        $minimumSizeRule->setParameters([$minimumSize]);

        $this->assertTrue($minimumSizeRule->applyRule($data));
    }

    /**
     * @dataProvider minimumSizeErrorDataProvider
     */
    public function testMinimumSizeError($minimumSize, $data)
    {
        $minimumSizeRule = new MinimumSize();
        $minimumSizeRule->setParameters([$minimumSize]);

        $this->assertFalse($minimumSizeRule->applyRule($data));
    }

    /**
     * @return array
     */
    public function minimumSizeSuccessDataProvider()
    {
        return [
            [
                'minimumSize' => 3,
                'data' => 'abc'
            ],
            [
                'minimumSize' => 50,
                'data' => 'abcabcabcaabcabcabcaabcabcabcaabcabcabcaabcabcabcaa'
            ],
            [
                'minimumSize' => 1,
                'data' => ' '
            ],
            [
                'minimumSize' => 1,
                'data' => 0
            ],
            [
                'minimumSize' => 0,
                'data' => ''
            ],
        ];
    }

    /**
     * @return array
     */
    public function minimumSizeErrorDataProvider()
    {
        return [
            [
                'minimumSize' => 3,
                'data' => 'ab'
            ],
            [
                'minimumSize' => 1,
                'data' => ''
            ],
        ];
    }
}