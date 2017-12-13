<?php

namespace COG\Recruiting\Validator\Rules;


class MaxChars implements RuleInterface
{
    private $message = 'Exceeds allowed characters';

    /**
     * Check Rule
     *
     * @param $input
     * @param $value
     * @param null $message
     * @return bool|null|string
     */
    public function check($input, $value, $message = null)
    {
        if(strlen($input) > $value){
            return !is_null($message) ? $message : $this->message;
        } else {
            return true;
        }
    }
}