<?php

namespace spec\Spatie\GoogleSearch;

use PhpSpec\ObjectBehavior;

class GoogleSearchSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('search-engine-id');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Spatie\GoogleSearch\GoogleSearch');
    }

    public function it_should_throw_an_exception_when_called_with_an_empty_string()
    {
        $this->getResults('')->shouldHaveCount(0);
    }

    public function it_should_throw_an_exception_when_no_valid_engine_id_is_set()
    {
        $this->shouldThrow('\Exception')->during('getResults', array('test-query'));
    }
}
