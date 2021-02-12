<?php


namespace App\Service;


use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class JsonCircularSerializer
{
    private $serializer;

    public function __construct()
    {
        $encoders = [new XmlEncoder(), new JsonEncoder()];

        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return $object->getNom();
            },
        ];
        $normalizer = [new ObjectNormalizer(null, null, null, null, null, null, $defaultContext)];

        $this->serializer = new Serializer($normalizer, $encoders);
    }

    public function serialize($inputData, $outputData): string
    {
        
        $jsonContent = $this->serializer->serialize($inputData, $outputData);

        return $jsonContent;
    }
}