<?php

namespace Validator;

/**
 * Class RequestValidator
 * @package Validator
 */
abstract class RequestValidator
{
    /**
     * RequestValidator constructor.
     */
    public function __construct()
    {
        $executor = new Executor($this->getRules(), $this->getMessages());
        $executor->execute();
    }

    /**
     * @return array
     */
    abstract public function getRules(): array;

    /**
     * @return array
     */
    public function getMessages(): array
    {
        return $this->getDefaultMessages();
    }

    /**
     * @return array
     */
    private function getDefaultMessages(): array
    {
        return [
            'numeric' => 'Deve ser um número.',
            'required' => 'Campo obrigatório',
            'text' => 'Deve ser um texto.'
        ];
    }
}