<?php

namespace Gavoronok30\LaravelGeneratorConfigurable;

use Gavoronok30\LaravelGeneratorConfigurable\Data\GeneratorServiceData;
use Gavoronok30\LaravelGeneratorConfigurable\Data\GeneratorServiceDataFileRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

/**
 * Class GeneratorServiceRenderTest
 * @package Gavoronok30\LaravelGeneratorConfigurable
 */
class GeneratorServiceRenderTest extends GeneratorServiceRenderAbstract
{
    /**
     * @inheritDoc
     */
    protected string $context = GeneratorServiceInterface::CUSTOM_FILE_CONTEXT_TEST;

    /**
     * @param GeneratorServiceData $data
     * @param GeneratorServiceDataFileRequest[]|Collection $files
     */
    public function renderFiles(GeneratorServiceData $data, Collection $files): void
    {
        $data = [
            'data' => $data,
            'entityName' => $data->getEntity()->getName(),
            'entityFields' => $this->getFieldDataFromEntity($data),
            'entityNameRouteAlias' => Str::of(Str::snake($data->getEntity()->getName()))->replace('_', '.'),
            'context' => $data->getConfig()->getContextTest(),
            'contextLower' => Str::camel($data->getConfig()->getContextTest()),
            'relationFields' => $this->getRelationFieldsFromEntity($data->getEntity()),
            'controllerCreateFields' => $this->getFieldsForControllerCreate($data),
            'controllerUpdateFields' => $this->getFieldsForControllerUpdate($data),
            'responseFields' => $this->getFieldsForResponse($data),
        ];

        $this->addExtraVariables($data);

        $files->map(
            function (GeneratorServiceDataFileRequest $file) use ($data) {
                $file->setContent($this->getContent($data, $file));
            }
        );
    }
}
