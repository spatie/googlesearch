<?php

namespace spec\Spatie\GoogleSearch;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GoogleSearchSpec extends ObjectBehavior
{
    function let() {
        $this->beConstructedWith('search-engine-id');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Spatie\GoogleSearch\GoogleSearch');
    }

    function it_should_throw_an_exception_when_called_with_an_empty_string()
    {
        $this->getResults('')->shouldHaveCount(0);
    }

    /*
    function it_should_return_an_array_when_called_with_a_valid_query()
    {
        $result = $this->getResults('test');
        $result->shouldHaveKey('url');

    }
    */
}
