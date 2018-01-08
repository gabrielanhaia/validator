<?php

namespace Tests\Rules;

use Validator\Rules\Required;

class RequiredTest extends \Tests\TestCase
{
    public function testRequiredSuccess()
    {
        $requiredRule = new Required();

        $this->assertTrue($requiredRule->applyRule('test'));
    }

    public function testRequiredFail()
    {
        $requiredRule = new Required();

        $this->assertFalse($requiredRule->applyRule(''));
        $this->assertFalse($requiredRule->applyRule(null));
    }
}