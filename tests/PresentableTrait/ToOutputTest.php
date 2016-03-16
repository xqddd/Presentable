<?php
namespace Tests\Alert;

class ToOutputTest extends \PHPUnit_Framework_TestCase
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
     * When called with string parameter will output string
     */
    public function testWhenCalledWithStringParameterWillOutputString()
    {
        $this->mock->expects($this->any())
            ->method('toString')
            ->will(
                $this->returnValue('outputString')
            );

        $output = $this->mock->toOutput('string');

        $this->assertInternalType(
            'string',
            $output
        );
    }

    /**
     * When called with array parameter will output array
     */
    public function testWhenCalledWithArrayParameterWillOutputArray()
    {
        $this->mock->expects($this->any())
            ->method('toArray')
            ->will(
                $this->returnValue([])
            );

        $output = $this->mock->toOutput('array');

        $this->assertInternalType(
            'array',
            $output
        );
    }

    /**
     * When called with array parameter and true will output associative array
     */
    public function testWhenCalledWithArrayParameterAndTrueWillOutputAssociativeArray()
    {
        $this->mock->expects($this->any())
            ->method('toArray')
            ->with(true)
            ->will(
                $this->returnValue(
                    [
                        'key1' => 'value1',
                        'key2' => 'value2',
                        'key3' => 'value3'
                    ]
                )
            );

        $output = $this->mock->toOutput('array', true);

        $this->assertInternalType(
            'array',
            $output
        );

        foreach ($output as $key => $value) {
            $this->assertNotInternalType(
                'int',
                $key
            );
        }
    }

    /**
     * When called with array parameter and false will output non-associative array
     */
    public function testWhenCalledWithArrayParameterAndFalseWillOutputNonAssociativeArray()
    {
        $this->mock->expects($this->any())
            ->method('toArray')
            ->with(false)
            ->will(
                $this->returnValue(
                    [
                        'value1',
                        'value2',
                        'value3'
                    ]
                )
            );

        $output = $this->mock->toOutput('array', false);

        $this->assertInternalType(
            'array',
            $output
        );

        $i = 0;
        foreach ($output as $key => $value) {
            $this->assertInternalType(
                'int',
                $key
            );
            $this->assertEquals(
                $i++,
                $key
            );
        }
    }

}
