<?php

declare(strict_types=1);

/*
 * This file has been auto generated by Jane,
 *
 * Do no edit it directly.
 */

namespace Jane\OpenApi\JsonSchema\Normalizer;

use Jane\JsonSchemaRuntime\Reference;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ResponsesNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;

    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === 'Jane\\OpenApi\\JsonSchema\\Model\\Responses';
    }

    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof \Jane\OpenApi\JsonSchema\Model\Responses;
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        if (!is_object($data)) {
            return null;
        }
        if (isset($data->{'$ref'})) {
            return new Reference($data->{'$ref'}, $context['document-origin']);
        }
        if (isset($data->{'$recursiveRef'})) {
            return new Reference($data->{'$recursiveRef'}, $context['document-origin']);
        }
        $object = new \Jane\OpenApi\JsonSchema\Model\Responses();
        $data = clone $data;
        if (property_exists($data, 'default') && $data->{'default'} !== null) {
            $value = $data->{'default'};
            if (is_object($data->{'default'}) and isset($data->{'default'}->{'$ref'})) {
                $value = $this->denormalizer->denormalize($data->{'default'}, 'Jane\\OpenApi\\JsonSchema\\Model\\Reference', 'json', $context);
            } elseif (is_object($data->{'default'}) and isset($data->{'default'}->{'description'})) {
                $value = $this->denormalizer->denormalize($data->{'default'}, 'Jane\\OpenApi\\JsonSchema\\Model\\Response', 'json', $context);
            }
            $object->setDefault($value);
            unset($data->{'default'});
        }
        foreach ($data as $key => $value_1) {
            if (preg_match('/^[1-5](?:\d{2}|XX)$/', $key)) {
                $value_2 = $value_1;
                if (is_object($value_1) and isset($value_1->{'$ref'})) {
                    $value_2 = $this->denormalizer->denormalize($value_1, 'Jane\\OpenApi\\JsonSchema\\Model\\Reference', 'json', $context);
                } elseif (is_object($value_1) and isset($value_1->{'description'})) {
                    $value_2 = $this->denormalizer->denormalize($value_1, 'Jane\\OpenApi\\JsonSchema\\Model\\Response', 'json', $context);
                }
                $object[$key] = $value_2;
            }
            if (preg_match('/^x-/', $key)) {
                $object[$key] = $value_1;
            }
        }

        return $object;
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $data = new \stdClass();
        if (null !== $object->getDefault()) {
            $value = $object->getDefault();
            if (is_object($object->getDefault())) {
                $value = $this->normalizer->normalize($object->getDefault(), 'json', $context);
            } elseif (is_object($object->getDefault())) {
                $value = $this->normalizer->normalize($object->getDefault(), 'json', $context);
            }
            $data->{'default'} = $value;
        }
        foreach ($object as $key => $value_1) {
            if (preg_match('/^[1-5](?:\d{2}|XX)$/', $key)) {
                $value_2 = $value_1;
                if (is_object($value_1)) {
                    $value_2 = $this->normalizer->normalize($value_1, 'json', $context);
                } elseif (is_object($value_1)) {
                    $value_2 = $this->normalizer->normalize($value_1, 'json', $context);
                }
                $data->{$key} = $value_2;
            }
            if (preg_match('/^x-/', $key)) {
                $data->{$key} = $value_1;
            }
        }

        return $data;
    }
}