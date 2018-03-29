To run tests use the following: vendor/bin/phpunit -c tests/phpunit.xml tests

I haven't really tried a TDD approach before but found it gave reassurance when making changes.
Although there was some experimentation going on which slowed me down a bit.

I have assumed we are using a sanitized order ID. A custom Exception would probably be better than
standard Exception for invalid user id.

I got a bit bogged down in detail at the beginning rather than focussing on the most important
aspects.

Some additional attributes for order might be references to customer and shipping data.

Maybe some reference to stock level in order line.

Refactoring:

Exception handling for data retrieval.

Explore the coupling between order and orderLine to see if this can be loosened.

The tests need to be expanded and made more rigorous.

Settle on a style for class attribute declaration. 


