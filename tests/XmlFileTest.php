<?php

namespace Tests;

use App\File\XmlFile;
use App\Parser;
use PHPUnit\Framework\TestCase;

class XmlFileTest extends TestCase
{

    public function testPositiveGetDataAsString()
    {
        $parser = new Parser(City::NAME);

        $xmlFile = new XmlFile();
        $data    = $xmlFile->getDataAsString($parser);

        $xml = new \SimpleXMLElement($data);
        $this->assertEquals(City::NAME, $xml->city);
        $this->assertEquals(City::ID, (int)$xml->city_id);
    }

    public function testNegativeGetDataAsString()
    {
        $parser = new Parser(City::INCORRECT_NAME);

        $xmlFile = new XmlFile();
        $data    = $xmlFile->getDataAsString($parser);
        $xml     = new \SimpleXMLElement($data);

        $this->assertEquals('Choose correct city', $xml->error);
    }

    /**
     * Проверка порядка свойст
     * Для XML:
     * Дата
     * Скорость ветра
     * Температура
     */
    public function testPropertyOrder()
    {
        $parser = new Parser(City::NAME);

        $xmlFile = new XmlFile();
        $data    = $xmlFile->getDataAsString($parser);
        $xml     = new \SimpleXMLElement($data);

        $correctPropertyOrder = ['date', 'wind_speed', 'temp'];
        $index                = 0;
        foreach ($xml as $property => $value) {
            $this->assertEquals($correctPropertyOrder[$index], $property);
            $index++;

            if ($index >= 3) {
                break;
            }
        }
    }
}
