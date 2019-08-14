<?php

namespace Tests;

use App\File\JsonFile;
use App\Parser;
use PHPUnit\Framework\TestCase;

class JsonFileTest extends TestCase
{
    public function testPositiveGetDataAsString()
    {
        $parser = new Parser(City::NAME);

        $jsonFile = new JsonFile();
        $data     = json_decode($jsonFile->getDataAsString($parser), 1);

        $this->assertEquals(City::NAME, $data['city']);
        $this->assertEquals(City::ID, $data['cityId']);
    }

    /**
     * Проверка порядка полей
     * Для JSON первыми по порядку должны быть поля:
     * Дата
     * Температура
     * Направление ветра
     */
    public function testPropertyOrdering()
    {
        $parser = new Parser(City::NAME);

        $jsonFile = new JsonFile();
        $data     = json_decode($jsonFile->getDataAsString($parser), 1);

        $correctPropertyOrder = ['date', 'temp', 'windDirection'];
        $index                = 0;
        foreach ($data as $property => $value) {
            $this->assertEquals($correctPropertyOrder[$index], $property);
            $index++;

            if ($index >= 3) {
                break;
            }
        }
    }

    public function testNegativeGetDataAsString()
    {
        $parser = new Parser(City::INCORRECT_NAME);

        $jsonFile = new JsonFile();
        $data     = $jsonFile->getDataAsString($parser);

        $this->assertEquals('Choose correct city', $data['error']);
    }
}
