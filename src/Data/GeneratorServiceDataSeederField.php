<?php

namespace Gavoronok30\LaravelGeneratorConfigurable\Data;

/**
 * Class GeneratorServiceDataSeederField
 * @package Gavoronok30\LaravelGeneratorConfigurable\Data
 */
class GeneratorServiceDataSeederField
{
    /**
     * @var string|null
     */
    private ?string $field;

    /**
     * @param string|null $field
     * @return self
     */
    public static function register(
        ?string $field
    ): self {
        $model = (new self());
        $model->field = $field;

        return $model;
    }

    /**
     * @return string|null
     */
    public function getField(): ?string
    {
        return $this->field;
    }
}
