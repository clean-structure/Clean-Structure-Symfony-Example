<?php

declare(strict_types=1);

namespace CleanStructure\Core\Infrastructure\Symfony;

use ArrayObject;
use CleanStructure\Core\Domain\NormalizeInterface;
use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AttributeLoader;
use Symfony\Component\Serializer\NameConverter\MetadataAwareNameConverter;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\BackedEnumNormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeZoneNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

final readonly class SerializerDecorator implements NormalizeInterface
{
    /**
     * @param Serializer $serializer
     */
    public function __construct(
        private Serializer $serializer
    ) {
    }

    /**
     * Фабрика для создания Serializer со своими настройками
     */
    public static function create(): self
    {
        $phpDocExtractor = new PhpDocExtractor();
        $reflectionExtractor = new ReflectionExtractor();

        $listExtractors = [$reflectionExtractor];
        $typeExtractors = [$phpDocExtractor, $reflectionExtractor];
        $docExtractors = [$phpDocExtractor];
        $accessExtractors = [$reflectionExtractor];
        $propertyExtractors = [$reflectionExtractor];

        $propertyInfo = new PropertyInfoExtractor(
            $listExtractors,
            $typeExtractors,
            $docExtractors,
            $accessExtractors,
            $propertyExtractors
        );

        $classMetadataFactory = new ClassMetadataFactory(new AttributeLoader());
        $nameConverter = new MetadataAwareNameConverter($classMetadataFactory);

        return new self(
            new Serializer(
                [
                    new DateTimeZoneNormalizer(),
                    new DateTimeNormalizer(),
                    new BackedEnumNormalizer(),
                    new ArrayDenormalizer(),
                    new ObjectNormalizer($classMetadataFactory, $nameConverter, null, $propertyInfo),
                ],
                [new JsonEncoder()]
            )
        );
    }

    /**
     * @inheritdoc
     * @param array<string, mixed> $context
     */
    public function normalize(
        mixed $object,
        ?string $format = null,
        array $context = []
    ): array|string|int|float|bool|ArrayObject|null {
        return $this->serializer->normalize($object, $format, $context);
    }


    /**
     * @inheritdoc
     * @param array<string, mixed> $context
     */
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        return $this->serializer->denormalize(
            $data,
            $type,
            $format,
            $context + [AbstractObjectNormalizer::DISABLE_TYPE_ENFORCEMENT => true]
        );
    }

    /**
     * @inheritdoc
     * @param array<string, mixed> $context
     */
    public function denormalizeArray(mixed $data, string $type, ?string $format = null, array $context = []): array
    {
        return $this->serializer->denormalize(
            $data,
            $type . '[]',
            $format,
            $context + [AbstractObjectNormalizer::DISABLE_TYPE_ENFORCEMENT => true]
        );
    }
}
