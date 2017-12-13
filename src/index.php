<?php
require "../vendor/autoload.php";
require './COG/Config/constant.php';

use COG\Recruiting\Service\HotelServiceFactory;
use COG\Recruiting\Service\PartnerService;
use COG\Recruiting\Validator\PartnerValidation;

// Get data from data source
$str = file_get_contents("../data/15475.json");
$data = json_decode($str, true);

// Implement a basic PartnerService
$partnerService = new PartnerService($data);
$listHotel = $partnerService->getResultForCityId(15475);

// Build a basic validator for the Partner Entity
foreach ($listHotel as $hotel){
    $partners = $hotel->getPartner();
    foreach ($partners as $partner){
        $validate = new PartnerValidation();
        $errorMessage = $validate->validate($partner);
        if(count($errorMessage) > 0){
            // Show message when has error and stop
//            print_r($errorMessage);
//            exit;
        }
    }
}

// Implement a way to get different implementations of the HotelServiceInterface
$hotelServiceFactory = new HotelServiceFactory($partnerService);

// ORDERED by partner name
// Type is 'unordered' or 'ordered'
$type = ORDERED;
$orderedHotelService = $hotelServiceFactory->getHotelService($type);
$orderedHotel = $orderedHotelService->getHotelsForCity('Düsseldorf');
echo json_encode($orderedHotel);

//// UNORDERED by partner name
//$type = UNORDERED;
//$unorderedHotelService = $hotelServiceFactory->getHotelService($type);
//$unorderedHotel = $unorderedHotelService->getHotelsForCity('Düsseldorf');
//echo json_encode($unorderedHotel);




