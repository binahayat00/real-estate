<?php

namespace App\Services;

use App\Enums\PostCode;
use App\Services\Interfaces\MapServiceInterface;

/**
 * Class MapService
 * @package App\Services
 */
class MapService implements MapServiceInterface
{
    protected $postCodeService;
    protected $graphhopperService;

    public function __construct()
    {
        $this->postCodeService = new PostCodeService();
        $this->graphhopperService = new GraphhopperService();
    }
    public function calculateDistancesForAppointmentTable(string $zipcode){
        $result['distance_from_realestate'] = ($zipcode ?? false) ? $this->postCodeService->distanceFromRealestate($zipcode) : 0;
        
        $Location = $this->postCodeService->getDetailOfPostCode($zipcode)['result'];
        $realtorLocation = $this->postCodeService->getDetailOfPostCode(PostCode::realtorZipcode->default())['result'];
        
        $matrixDistanceAndTime = $this->graphhopperService->matrixDistanceAndTime(
            $realtorLocation['latitude'] . ',' . $realtorLocation['longitude'],
            $Location['latitude'] . ',' . $Location['longitude']
        );
        
        $result['arriving_estimated_time'] = $matrixDistanceAndTime['times'][0][1];
        $result['returning_estimated_time'] = $matrixDistanceAndTime['times'][1][0];

        return $result;
    }
}
