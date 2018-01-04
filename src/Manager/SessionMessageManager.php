<?php

namespace Validator\Manager;
use Validator\Entity\Error;

/**
 * Class SessionMessageManager
 * @package Validator\Manager
 */
class SessionMessageManager
{
    /**
     * @param Error[] $erros
     */
    public function writeErrors($erros)
    {
        if (empty($erros)) {
            return;
        }

        session_start();
        unset($_SESSION['error_validator']);
        foreach ($erros as $error) {
            if (!($error instanceof Error)) {
                session_write_close();
                throw new \Exception('Not an instance of the "Validator\Error" class');
            }

            $this->writeError($error);
        }
        session_write_close();
    }

    /**
     * @param Error $error
     */
    private function writeError(Error $error)
    {
        $_SESSION['error_validator'][$error->getFieldName()][] = $error->getErrorMessage();
    }
}