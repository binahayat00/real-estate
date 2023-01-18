<?php

namespace App\Services;

use App\Enums\PostCode;
use App\Repositories\DefineRepository;
use App\Services\Interfaces\PostCodeServiceInterface;
use Illuminate\Support\Facades\Http;

/**
 * Class PostCodeService
 * @package App\Services
 */
class PostCodeService implements PostCodeServiceInterface
{
    protected $url;
    protected $defineRepository;

    public function __construct()
    {
        $this->url = 'api.postcodes.io';
        $this->defineRepository = new DefineRepository();
    }

    public function validatePostCode(string $postCode)
    {
        $link = "/postcodes/$postCode/validate";
        $response = Http::get($this->url . $link);
        return $this->handlePostcodeValidationResponse($response->json());
    }

    public function handlePostcodeValidationResponse($response)
    {
        return ($response['status'] == PostCode::response->default()) ? (
            ($response["result"] == true) ? [
                'message' => 'valid',
                "result" => true
            ] : [
                'message' => 'please enter valid zipcode',
                "result" => false
            ]
        ) : [
                'message' => 'Could not connect to postcode.io',
                "result" => false
            ];
    }

    public function getDetailOfPostCode(string $postCode)
    {
        $link = "/postcodes/$postCode";
        $response = Http::get($this->url . $link);
        return $response->json();
    }

    public function distanceFromRealestate(string $postCode)
    {
        $isValidatePostCode = $this->validatePostCode($postCode);
        if ($isValidatePostCode['result'] == false)
            return $isValidatePostCode['message'];

        $realtorZipcode = $this->defineRepository->getByName('realtor_zipcode');
        $realtorLocation = $this->getDetailOfPostCode($realtorZipcode)['result'];
        $postCodeLocation = $this->getDetailOfPostCode($postCode)['result'];

        return $this->distance($realtorLocation['latitude'], $realtorLocation['longitude'], $postCodeLocation['latitude'], $postCodeLocation['longitude'], PostCode::distanceUnit->default());
    }

    public function distance($lat1, $lon1, $lat2, $lon2, $unit)
    {

        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);
        if ($unit = "meter") {
            return ($miles * 1609.344);
        } else if ($unit == "kilometer") {
            return ($miles * 1.609344);
        } else if ($unit == "Nmile") {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }
    }
}