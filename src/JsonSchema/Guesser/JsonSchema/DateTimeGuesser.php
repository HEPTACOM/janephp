<?php

namespace Jane\JsonSchema\Guesser\JsonSchema;

use Jane\JsonSchema\Guesser\Guess\DateTimeType;
use Jane\JsonSchema\Guesser\Guess\Type;
use Jane\JsonSchema\Guesser\GuesserInterface;
use Jane\JsonSchema\Guesser\TypeGuesserInterface;
use Jane\JsonSchema\Model\JsonSchema;
use Jane\JsonSchema\Registry;

class DateTimeGuesser implements GuesserInterface, TypeGuesserInterface
{
    /** @var string Format of date to use when normalized */
    private $outputDateFormat;

    /** @var string Format of date to use when denormalized */
    private $inputDateFormat;

    public function __construct(string $outputDateFormat = \DateTime::RFC3339, ?string $inputDateFormat = null)
    {
        $this->outputDateFormat = $outputDateFormat;
        $this->inputDateFormat = $inputDateFormat;
    }

    /**
     * {@inheritdoc}
     */
    public function supportObject($object): bool
    {
        $class = $this->getSchemaClass();

        return ($object instanceof $class) && 'string' === $object->getType() && 'date-time' === $object->getFormat();
    }

    /**
     * {@inheritdoc}
     */
    public function guessType($object, string $name, string $reference, Registry $registry): Type
    {
        return new DateTimeType($object, $this->outputDateFormat, $this->inputDateFormat);
    }

    protected function getSchemaClass(): string
    {
        return JsonSchema::class;
    }
}
