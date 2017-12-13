<?php

namespace COG\Recruiting\Service;

use COG\Recruiting\Entity\Hotel;
use COG\Recruiting\Entity\Partner as PartnerEntity;
use COG\Recruiting\Entity\Price;

class PartnerService implements PartnerServiceInterface
{
    protected $data;

    /**
     * PartnerService constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Get list hotel object by cityID
     *
     * @param int $cityId
     * @return array
     */
    public function getResultForCityId($cityId)
    {
        $listHotel = array();

        if ($this->data['id'] === $cityId) {
            // Loop for init hotels entity
            foreach ($this->data['hotels'] as $hotels) {
                $hotelEntity = new Hotel();

                $hotelEntity->setName($hotels['name']);
                $hotelEntity->setAdr($hotels['adr']);
                $listPartner = array();
                // Loop for init partners entity
                foreach ($hotels['partners'] as $partner) {
                    if (is_array($partner) || is_object($partner)) {
                        $partnerEntity = new PartnerEntity();
                        $partnerEntity->setName($partner['name']);
                        $partnerEntity->setHomePage($partner['url']);
                        $partnerEntity->setPrices($partner['prices']);

                        $listPrice = array();
                        // Loop for init prices entity
                        foreach ($partner['prices'] as $price) {
                            $priceEntity = new Price();
                            $priceEntity->setDescription($price['description']);
                            $priceEntity->setAmount($price['amount']);
                            $priceEntity->setFromDate($price['from']);
                            $priceEntity->setToDate($price['to']);
                            array_push($listPrice, $priceEntity);
                        }
                        $partnerEntity->setPrices($listPrice);
                        array_push($listPartner, $partnerEntity);
                    }
                }
                $hotelEntity->setPartner($listPartner);
                array_push($listHotel, $hotelEntity);
            }
        }
        return $listHotel;
    }
}

