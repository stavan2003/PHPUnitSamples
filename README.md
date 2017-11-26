## PHPUnitSamples

##### Create composer.json
```
{
    "require-dev": {
            "phpunit/phpunit":"^5.7"
    },
    "autoload": {
        "psr-4":{
            "App\\":"app/"
        }
    }
}
```
##### To install the requried packages composer.json  
```
$ composer install
```

autoload.php is generated in the vendor folder [Autoloading allows us to use PHP classes without the need to require() or include() them]

##### PSR-4 is the newest standard of autoloading in PHP, mandates us to use namespaces
  * Put the classes that we want to autoload in a dedicated directory.
  * Give the classes a namespace
  * Point the namespace to the src/ directory in the composer.json file
  * Update the Composer autoloader using
  ``` 
  $ composer dumpautoload -o
  ```
Reference : [Site](http://phpenthusiast.com/blog/how-to-autoload-with-composer)

##### PHPUnit.xml
* The attributes of the <phpunit> element can be used to configure PHPUnit's core functionality
* Bootstrap the autoload.php in phpunit.xml
* The <testsuites> element and its one or more <testsuite> children can be used to compose a test suite out of test suites and test cases. [PHPUnit Manual](https://phpunit.de/manual/current/en/appendixes.configuration.html)
```
<testsuites>
  <testsuite name="My Test Suite">
    <directory>/path/to/*Test.php files</directory>
    <file>/path/to/MyTest.php</file>
    <exclude>/path/to/exclude</exclude>
  </testsuite>
</testsuites>

```
* For Code coverage add below code
```
   <filter>
      <whitelist processUncoveredFilesFromWhitelist="true">
         <directory suffix=".php">./app</directory>
      </whitelist>
   </filter>
   <logging>
      <log type="coverage-html"
      	target="./tmp/coverage/html/" 
      	charset="UTF-8" 
        highlight="true" 
        lowUpperBound="60" 	
        highLowerBound="90" />
      <log type="coverage-clover" target="./tmp/coverage/clover.xml" />
   </logging>
```

#### Running all tests
```
C:/xampp/htdocs/PHPUnitSamples/vendor/phpunit/phpunit/phpunit --configuration C:\xampp\htdocs\PHPUnitSamples\phpunit.xml C:\xampp\htdocs\PHPUnitTestStudy\tests
```

#### Sample Stub [Reference : Lynda - Test-Driven Development in PHP with PHPUnit]
```
    public function testPostTaxTotal() {
        $Receipt = $this->getMockBuilder('App\Receipt')
            ->setMethods(['tax', 'total'])
            ->getMock();
        $Receipt->method('total')->will($this->returnValue(10.00));
        $Receipt->method('tax')->will($this->returnValue(1.0));
        $result = $Receipt->postTaxTotal([1, 2, 5, 8], 0.20, null);
        $this->assertEquals(11.00, $result);
    }
```

#### Sample Mock
```
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
```
