<?php

namespace spec\MattCannon\Collections;

use MattCannon\Collections\Exceptions\InvalidTypeException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;


/**
 * Class TypedCollectionSpec
 * @package spec\MattCannon\Collections
 */
class TypedCollectionSpec extends ObjectBehavior
{
    
    function it_is_initializable()
    {
        $this->shouldHaveType('MattCannon\Collections\TypedCollection');
    }

    function it_is_initializable_without_a_type()
    {
        $this->beConstructedWith([], null);
        $this->shouldHaveType('MattCannon\Collections\TypedCollection');
    }

    function it_can_accept_multiple_types(\stdClass $class)
    {
        $this->beConstructedWith([$class, 'a', 1], null);
        $this->count()->shouldReturn(3);
    }

    function it_can_be_restricted_to_one_type()
    {
        $this->beConstructedWith([], \stdClass::class);
        $this->push(new \stdClass());
        $this->shouldThrow(InvalidTypeException::class)->during('push', [1]);
        $this->count()->shouldReturn(1);
    }

    function it_can_be_restricted_to_a_scalar_type()
    {
        $this->beConstructedWith([], 'integer');
        $this->push(1);
        $this->shouldThrow(InvalidTypeException::class)->during('push', ['test']);
        $this->count()->shouldReturn(1);
    }

    function it_can_be_restricted_to_an_interface()
    {
        $this->beConstructedWith([], TestInterface::class);
        $this->push(new ModelA);
        $this->push(new ModelB);
        $this->shouldThrow(InvalidTypeException::class)->during('push', [new ModelC]);
        $this->count()->shouldReturn(2);
    }

    function it_allows_sub_classes()
    {
        $this->beConstructedWith([], ModelA::class);
        $this->push(new ModelA);
        $this->push(new ModelB);
        $this->shouldThrow(InvalidTypeException::class)->during('push', [new ModelC]);
        $this->count()->shouldReturn(2);
    }

    function it_doesnt_allow_super_classes()
    {
        $this->beConstructedWith([], ModelB::class);
        $this->shouldThrow(InvalidTypeException::class)->during('push', [new ModelA]);
        $this->push(new ModelB);
        $this->count()->shouldReturn(1);
    }
}

/**
 * Class ModelA
 * @package spec\MattCannon\Collections
 */
class ModelA implements TestInterface
{

}

/**
 * Class ModelB
 * @package spec\MattCannon\Collections
 */
class ModelB extends ModelA
{

}

/**
 * Class ModelC
 * @package spec\MattCannon\Collections
 */
class ModelC
{

}

/**
 * Interface TestInterface
 * @package spec\MattCannon\Collections
 */
interface TestInterface
{

}