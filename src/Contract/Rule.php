<?php

namespace Validator\Contract;

/**
 * Interface Rule
 * @package Validator\Contract
 */
interface Rule
{
    /**
     * @param $data
     * @return bool
     */
    public function applyRule($data): bool;

    /**
     * @return string
     */
    public static function getName(): string;

    /**
     * @return string
     */
    public function getMessage(): string;
}