<?php

namespace App\Services;

use App\Services\Interfaces\GraphhopperServiceInterface;
use Illuminate\Support\Facades\Http;

/**
 * Class GraphhopperService
 * @package App\Services
 */
class GraphhopperService implements GraphhopperServiceInterface
{
    protected $url;
    protected $apiKey;

    public function __construct()
    {
        $this->url = 'https://graphhopper.com/api';
        $this->apiKey = $_ENV['GRAPHHOPPER_API_KEY'];
    }

    public function matrixDistanceAndTime($point1, $ponit2)
    {
        $link = '/1/matrix';
        $params = '?point='.$point1.
                    '&point='.$ponit2.
                    '&type=json'.
                    '&profile=car&out_array=weights'.
                    '&out_array=times'.
                    '&out_array=distances'.
                    '&key=62e1eba4-0bb2-47be-91df-07f72846a117';

        $response = Http::get($this->url . $link . $params);
        return $response->json();
    }
}