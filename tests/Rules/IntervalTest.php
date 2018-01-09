<?php

namespace Tests\Rules;

use Validator\Rules\Interval;

/**
 * Class IntervalTest
 *
 * @author Gabriel Anhaia <gabriel@mestredev.com.br>
 * @package Tests\Rules
 */
class IntervalTest extends \Tests\TestCase
{
    /**
     * @dataProvider intervalSuccessDataProvider
     */
    public function testIntervalSuccess($startInterval, $endInterval, $data)
    {
        $intervalRule = new Interval();
        $intervalRule->setParameters([$startInterval, $endInterval]);

        $this->assertTrue($intervalRule->applyRule($data));
    }

    /**
     * @return array
     */
    public function intervalSuccessDataProvider()
    {
        return [
            [
                'startInterval' => 10,
                'endInterval' => 20,
                'data' => 15
            ],
            [
                'startInterval' => 10,
                'endInterval' => 20,
                'data' => 10
            ],
            [
                'startInterval' => 10,
                'endInterval' => 20,
                'data' => 20
            ],
        ];
    }

    /**
     * @dataProvider intervalErrorDataProvider
     */
    public function testIntervalError($startInterval, $endInterval, $data)
    {
        $intervalRule = new Interval();
        $intervalRule->setParameters([$startInterval, $endInterval]);

        $this->assertFalse($intervalRule->applyRule($data));
    }

    /**
     * @return array
     */
    public function intervalErrorDataProvider()
    {
        return [
            [
                'startInterval' => 10,
                'endInterval' => 20,
                'data' => 25
            ],
            [
                'startInterval' => 10,
                'endInterval' => 20,
                'data' => 8
            ],
        ];
    }
}