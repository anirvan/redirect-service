<?php namespace Tests\Unit;

use Performance\Performance;
use Performance\Config;


class T08A_ExportTest extends \PHPUnit_Framework_TestCase
{
    protected function setTestUp()
    {
        Performance::instanceReset();
    }

    public function testConfigQueryLog()
    {
       $this->setTestUp();

        // Run task A
        $this->taskA();

        // Finish all and return export class
        $export = Performance::results();

        // Return all information
        dump($export->get());

        // Return all information in Json
        dump($export->toJson());

        // Return only config
        dump($export->config()->get());

        // Return only points in Json
        dump($export->points()->toJson());

        // Return only points in Json
        dump($export->toFile('tests/Unit/export.txt'));
    }

    public function testCheckJsonForAll()
    {
        $export = Performance::export();
        $this->assertJson($export->toJson());
    }

    public function testCheckJsonForConfig()
    {
        $export = Performance::export();
        $this->assertJson($export->config()->toJson());
    }

    public function testCheckJsonForPoints()
    {
        $export = Performance::results();
        $this->assertJson($export->points()->toJson());
    }

    // Create task

    private function taskA()
    {
        // Set point Task A
        Performance::point(__FUNCTION__);

        //
        // Run code
        usleep(2000);
        //

        Performance::message('This is a message');

        // Finish point Task A
        Performance::finish();
    }
}