<?php

use App\Presenter;

class PresenterTest extends \PHPUnit\Framework\TestCase
{
    public function testPositiveCityWasFound()
    {
        $parser = new \App\Parser(\Tests\City::NAME);

        $presenter = new Presenter($parser);

        $this->assertEquals(\Tests\City::ID, $presenter->cityId);
        $this->assertEquals(\Tests\City::NAME, $presenter->city);
        $this->assertTrue($presenter->isCityCorrect());
    }

    public function testNegativeCityNotFound()
    {
        $parser = new \App\Parser('ERT');

        $presenter = new Presenter($parser);

        $this->assertFalse($presenter->isCityCorrect());
        $this->assertNull($presenter->cityId);
        $this->assertNull($presenter->city);
    }
}
