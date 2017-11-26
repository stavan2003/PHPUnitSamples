<?php

use App\Models\User as User;
/**
 * Created by PhpStorm.
 * User: stavan.shah
 * Date: 11/18/2017
 * Time: 4:55 PM
 */
class UserTest extends \PHPUnit_Framework_TestCase {

    protected $user;

    public function setUp() {
        $this->user = new User();
    }

    /** @test */ //<--- this makes it possible to have test methods not starting with name "test"
    public function testThatWeCanGetTheFirstName(){
        $this->user->setFirstName('Stavan');
        $this->assertEquals($this->user->getFirstName(), 'Stavan');
    }

    /** @test */
    public function testThatWeCanGetTheLastName(){
        $this->user->setLastName('Shah');
        $this->assertEquals($this->user->getLastName(), 'Shah');
    }

    /** @test */
    public function testThatWeCanGetTheFullName(){
        $this->user = new User();
        $this->user->setFirstName('Stavan');
        $this->user->setLastName('Shah');
        $this->assertEquals($this->user->getFullName(), 'Stavan Shah');
    }

    /** @test */
    public function testThatFirstAndLastNameAreTrimmed(){
        $this->user = new User();
        $this->user->setFirstName('   Stavan  ');
        $this->user->setLastName(' Shah ');
        $this->assertEquals($this->user->getFullName(), 'Stavan Shah');
    }

    /** @test */
    public function testThatWeCanSetEmail(){
        $this->user = new User();
        $this->user->setEmail('stavan2003@gmail.com');
        $this->assertEquals($this->user->getEmail(), 'stavan2003@gmail.com');
    }

    /** @test */
    public function testEmailVariablesContainCorrectValues(){
        $emailout['name'] = 'Stavan Shah';
        $emailout['email'] = 'stavan2003@gmail.com';

        $expected_vars = json_encode($emailout);
        $this->user = new User();
        $this->user->setFirstName('Stavan');
        $this->user->setLastName('Shah');
        $this->user->setEmail('stavan2003@gmail.com');

        $this->assertJson($this->user->getEmailVariables(), $emailout);
    }
}
