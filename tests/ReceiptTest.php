<?php

/**
 * Created by PhpStorm.
 * User: stavan.shah
 * Date: 11/19/2017
 * Time: 5:28 PM
 */
use App\Receipt;
class ReceiptTest extends PHPUnit_Framework_TestCase {

    /** @var \App\Receipt receipt */
    protected $receipt;

    public function setUp()
    {

        $this->receipt = new Receipt();
    }

    public function tearDown()
    {
        unset($this->receipt);
    }

    public function provideTotalData() {
        return [
            'indexdataset#1'=> [[1,2,5,8],16],
            'indexdataset#2'=> [[1,2,0,8],11]
        ];
    }

    /** @test
     * @dataProvider provideTotalData
     */
    public function testTotal($input, $expected) {
        $coupon = null;
        $output = $this->receipt->total($input, $coupon);
        $this->assertEquals($expected, $output, "When sunmming total to be {$expected}");
    }

    /** @test */
    public function testTax() {
        $inputAmout = 10.00;
        $tax = 0.10;
        $output = $this->receipt->tax($inputAmout, $tax);
        $this->assertEquals(1, $output, 'Tax calulated to be 1.0');
    }

    /** @test */
    public function testTotalCoupon() {
        $input = [2,8,5];
        $coupon = 0.20;
        $output = $this->receipt->total($input, $coupon);
        $this->assertEquals(12, $output, 'When sunmming total to be 12 with coupon');
    }

    /** @test */
    public function testTotalCouponException() {
        $input = [2,8,5];
        $coupon = 1.20;
        $this->expectException('\App\Exception\BadMethodException');
        $this->receipt->total($input, $coupon);
    }

    /** @test */ //<--- example of a stub
    public function testPostTaxTotal() {
        $Receipt = $this->getMockBuilder('App\Receipt')
            ->setMethods(['tax', 'total'])
            ->getMock();
        $Receipt->method('total')->will($this->returnValue(10.00));
        $Receipt->method('tax')->will($this->returnValue(1.0));
        $result = $Receipt->postTaxTotal([1, 2, 5, 8], 0.20, null);
        $this->assertEquals(11.00, $result);
    }

    /** @test */ //<---- example of a mock
    //Mock has expectations as to which stub methods are called and the inputs to the stub methods
    public function testPostTaxTotalMock() {
        $items = [1,2,5,8];
        $coupon = null;
        $tax = 0.20;
        $Receipt = $this->getMockBuilder('App\Receipt')
            ->setMethods(['tax', 'total'])
            ->getMock();
        $Receipt->expects($this->once())
            ->method('total')
            ->with($items, $coupon)
            ->will($this->returnValue(10.00));
        $Receipt
            ->expects($this->once())
            ->method('tax')
            ->with(10.0, $tax)
            ->will($this->returnValue(1.0));
        $result = $Receipt->postTaxTotal([1, 2, 5, 8], 0.20, null);
        $this->assertEquals(11.00, $result);
    }

}