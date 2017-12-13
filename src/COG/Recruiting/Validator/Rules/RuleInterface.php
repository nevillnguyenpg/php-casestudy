<?php

namespace COG\Recruiting\Validator\Rules;


interface RuleInterface
{
    /**
     * Check Rule
     *
     * @param $input
     * @param $value
     * @param null $message
     * @return mixed
     */
    public function check($input, $value, $message = null);
}