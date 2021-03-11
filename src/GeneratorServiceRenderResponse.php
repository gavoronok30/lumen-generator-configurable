<?php

namespace Gavoronok30\LaravelGeneratorConfigurable;

use Gavoronok30\LaravelGeneratorConfigurable\Data\GeneratorServiceData;
use Gavoronok30\LaravelGeneratorConfigurable\Data\GeneratorServiceDataFileRequest;
use Illuminate\Support\Collection;

/**
 * Class GeneratorServiceRenderResponse
 * @package Gavoronok30\LaravelGeneratorConfigurable
 */
class GeneratorServiceRenderResponse extends GeneratorServiceRenderAbstract
{
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
            'responseFields' => $this->getFieldsForResponse($data),
            'relationFields' => $this->getRelationFieldsFromEntity($data->getEntity()),
        ];

        $files->map(
            function (GeneratorServiceDataFileRequest $file) use ($data) {
                $file->setContent($this->getContent($data, $file));
            }
        );
    }
}
