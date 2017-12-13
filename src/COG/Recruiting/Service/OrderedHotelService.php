<?php

namespace COG\Recruiting\Service;


class OrderedHotelService implements HotelServiceInterface
{
    /**
     * @var PartnerServiceInterface
     */
    private $partnerService;

    /**
     * Maps from city name to the id for the partner service.
     *
     * @var array
     */
    private $cityToIdMapping = array(
        "Düsseldorf" => 15475
    );


    /**
     * OrderedHotelService constructor.
     * @param PartnerServiceInterface $partnerService
     */
    public function __construct(PartnerServiceInterface $partnerService)
    {
        $this->partnerService = $partnerService;
    }

    /**
     * Get list hotel by city
     *
     * @inherited
     */
    public function getHotelsForCity($cityName)
    {
        if (!isset($this->cityToIdMapping[$cityName]))
        {
            throw new \InvalidArgumentException(sprintf('Given city name [%s] is not mapped.', $cityName));
        }

        $cityId = $this->cityToIdMapping[$cityName];
        $listHotel = $this->partnerService->getResultForCityId($cityId);

        foreach ($listHotel as $key => $hotel) {
            $listHotel[$key]->partners = array_values($this->array_sort($hotel->partners, 'name', SORT_ASC));
        }

        return $listHotel;
    }

    /**
     * Sort alphabetically name of partner
     *
     * @param $array
     * @param $on
     * @param int $order
     * @return array
     */
    private function array_sort($array, $on, $order=SORT_ASC){

        $new_array = array();
        $sortable_array = array();

        if (count($array) > 0) {
            foreach ($array as $k => $v) {
                if (is_array($v)) {
                    foreach ($v as $k2 => $v2) {
                        if ($k2 == $on) {
                            $sortable_array[$k] = $v2;
                        }
                    }
                } else {
                    $sortable_array[$k] = $v;
                }
            }

            switch ($order) {
                case SORT_ASC:
                    asort($sortable_array);
                    break;
                case SORT_DESC:
                    arsort($sortable_array);
                    break;
            }

            foreach ($sortable_array as $k => $v) {
                $new_array[$k] = $array[$k];
            }
        }

        return $new_array;
    }

}