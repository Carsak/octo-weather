<?php

namespace App;

use App\Exception\CityNotFoundException;

class Presenter
{
    /**
     * @var \App\Parser
     */
    private $parser;

    private $isCityCorrect = true;

    public $temp;
    public $city;
    public $cityId;
    public $description;
    public $icon;
    public $tempMin;
    public $tempMax;
    public $windSpeed;
    public $windDirection;
    public $humidity;

    public function __construct(Parser $parser)
    {
        $this->parser = $parser;

        try {
            $data = $parser->parse();
        } catch (CityNotFoundException $e) {
            $this->isCityCorrect = false;

            return;
        }

        $this->city          = $data['name'];
        $this->cityId        = $data['id'];
        $this->temp          = $data['main']['temp'];
        $this->tempMin       = $data['main']['temp_min'];
        $this->tempMax       = $data['main']['temp_max'];
        $this->description   = $data['weather'][0]['main'];
        $this->icon          = $data['weather'][0]['icon'];
        $this->humidity      = $data['main']['humidity'];
        $this->windSpeed     = $data['wind']['speed'];
        $this->windDirection = $data['wind']['deg'];
    }

    public function isCityCorrect()
    {
        return $this->isCityCorrect;
    }
}
