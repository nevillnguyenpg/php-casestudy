<?php

namespace COG\Recruiting\Service;


use Exception;

class HotelServiceFactory extends AbstractHotelFactory
{

    protected $partnerService;

    /**
     * PartnerNameOrderedHotelService constructor.
     * @param PartnerServiceInterface $partnerService
     */
    public function __construct(PartnerServiceInterface $partnerService)
    {
        $this->partnerService = $partnerService;
    }


    /**
     * @param string $type
     * @return OrderedHotelService|UnorderedHotelService
     * @throws Exception
     */
    public function getHotelService($type = '')
    {
        switch ($type) {
            case ORDERED:
                return new OrderedHotelService($this->partnerService);
                break;
            case UNORDERED:
                return new UnorderedHotelService($this->partnerService);
                break;
            default:
                throw new Exception(ORDER_TYPE_NOT_FOUND);
        }
    }
}