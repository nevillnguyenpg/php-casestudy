<?php

use COG\Recruiting\Service\HotelServiceFactory;
use COG\Recruiting\Service\PartnerService;
use COG\Recruiting\Validator\PartnerValidation;

class Test extends PHPUnit_Framework_TestCase
{
    private $data;
    private $dataOrdered;

    function setUp(){
        global $data, $dataOrdered;

        $this->data = $data;
        $this->dataOrdered = $dataOrdered;
    }

    function testShowListHotel() {

        // Implement a basic PartnerService
        $partnerService = new PartnerService($this->data);
        $listHotel = $partnerService->getResultForCityId(15475);

        $this->assertInternalType('array',$listHotel);
    }

    function testValidate(){
        // Implement a basic PartnerService
        $partnerService = new PartnerService($this->data);
        $listHotel = $partnerService->getResultForCityId(15475);

        // Build a basic validator for the Partner Entity

        $hotel = $listHotel[0];
        $partners = $hotel->getPartner();
        $partner = $partners[0];
        $validate = new PartnerValidation();
        $errorMessage = $validate->validate($partner);
        if(isset($errorMessage['name'])){
            $this->assertEquals($errorMessage['name'], 'The name field should not be more than 1 characters');
        }
    }

    function testOrderPartner(){

        $partnerService = new PartnerService($this->data);
        // Implement a way to get different implementations of the HotelServiceInterface
        $hotelServiceFactory = new HotelServiceFactory($partnerService);

        // ORDERED by partner name
        $type = ORDERED;
        $orderedHotelService = $hotelServiceFactory->getHotelService($type);
        $orderedHotel = $orderedHotelService->getHotelsForCity('Düsseldorf');



        $partnerServiceOrdered = new PartnerService($this->dataOrdered);
        // Implement a way to get different implementations of the HotelServiceInterface
        $hotelOrderedServiceFactory = new HotelServiceFactory($partnerServiceOrdered);

        // UNORDERED by partner name
        $type = UNORDERED;
        $unorderedHotelService = $hotelOrderedServiceFactory->getHotelService($type);
        $unorderedHotel = $unorderedHotelService->getHotelsForCity('Düsseldorf');

        $this->assertEquals($orderedHotel, $unorderedHotel, "\$canonicalize = true", $delta = 0.0, $maxDepth = 10, $canonicalize = true);
    }
}