<?php

namespace COG\Recruiting\Service;


abstract class AbstractHotelFactory
{
    /**
     * Get hotel service
     *
     * @param $type
     * @return mixed
     */
    abstract public function getHotelService($type);
}