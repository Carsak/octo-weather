<?php

namespace App\File;

use App\Parser;
use App\Presenter;

class JsonFile extends File
{
    public function save(Parser $parser)
    {
        $data = $this->getDataAsString($parser);
        $filename = "jsonFile" . date('Y-m-d'). ".json";

        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Length: ". strlen($data));
        header("Content-Disposition: attachment; filename={$filename}.json");
        header("Content-Type: application/octet-stream; ");
        header("Content-Transfer-Encoding: binary");

        echo $data;
    }

    public function getDataAsString(Parser $parser)
    {
        $presenter = new Presenter($parser);

        if (!$presenter->isCityCorrect()) {
            return json_encode(['error' => 'Choose correct city']);
        }

        $data = [
            'date'          => date('Y-m-d'),
            'temp'          => $presenter->temp,
            'windDirection' => $presenter->windDirection,
            'windSpeed'     => $presenter->windSpeed,
            'city'          => $presenter->city,
            'cityId'        => $presenter->cityId,
        ];

        $data = json_encode($data);

        return $data;
    }
}

/**
 * Для JSON первыми по порядку должны быть поля:
Дата
Температура
Направление ветра

 */