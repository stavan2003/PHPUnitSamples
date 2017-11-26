<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Calculator
 *
 * @author stavan.shah
 */
use App\Calculator;
/*use - Allows us to bring the class in the current namespace and we can create new objects using
 new Calculator(). Else we would have to use new App\Calculator() which becomes shabby if the namespace is long
 i.e new App\Lib\Prod\Calculator() <-- looks bad. Hence "use" is used and an alias can be added
 use App\Lib\Prod\Calculator as Calculator;
*/

class CalculatorTest extends \PHPUnit_Framework_TestCase {

    //put your code here
    public function testAddNum() {
        $calc = new Calculator();
        $this->assertEquals(4, $calc->add(2, 2));
        echo "Test Done testAddNum";
    }

}
