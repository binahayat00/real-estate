<?php

namespace App\Services;

use App\Enums\PostCode;
use App\Services\Interfaces\PostCodeServiceInterface;
use Illuminate\Support\Facades\Http;

/**
 * Class PostCodeService
 * @package App\Services
 */
class PostCodeService implements PostCodeServiceInterface
{
    protected $url;

    public function __construct()
    {
        $this->url = 'api.postcodes.io';
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
}