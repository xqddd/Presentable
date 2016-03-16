<?php
namespace Tests\Alert;

class ToJsonTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $mock;

    public function setUp()
    {
        $this->mock = $this->getMockForTrait('\Xqddd\Presentable\PresentableTrait');
    }

    /**
     * When called will output a json string
     */
    public function testWhenCalledWillOutputAJsonString()
    {
        $this->mock->expects($this->any())
            ->method('toString')
            ->will(
                $this->returnValue('outputString')
            );

        $this->mock->expects($this->any())
            ->method('toArray')
            ->will(
                $this->returnValue([])
            );

        $jsonFromString = $this->mock->toJson(0, 'string');
        $jsonFromArray = $this->mock->toJson(0, 'array');

        $decodedJsonFromString = json_decode($jsonFromString);
        $decodedJsonFromArray = json_decode($jsonFromArray);

        $this->assertInternalType(
            'string',
            $jsonFromString
        );
        $this->assertInternalType(
            'string',
            $jsonFromArray
        );
        $this->assertInternalType(
            'string',
            $decodedJsonFromString
        );
        $this->assertInternalType(
            'array',
            $decodedJsonFromArray
        );

    }

}
