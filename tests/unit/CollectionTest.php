<?php

/**
 * Created by PhpStorm.
 * User: stavan.shah
 * Date: 11/18/2017
 * Time: 4:55 PM
 */
use App\Support\Collection;

class CollectionTest extends \PHPUnit_Framework_TestCase {

    /** @test */
    public function emptyInstantiatedCollectionReturnsNoItems(){
        $collection = new Collection();
        $this->assertEmpty($collection->get());
    }

    /** @test */
    public function verifyItemCount(){
        $collection = new Collection([
            'one', 'two', 'three'
        ]);
        $this->assertEquals($collection->count(), 3);
    }
}
