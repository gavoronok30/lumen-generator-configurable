<?php

namespace Gavoronok30\LaravelGeneratorConfigurable;

use Gavoronok30\LaravelGeneratorConfigurable\Data\GeneratorServiceData;
use Gavoronok30\LaravelGeneratorConfigurable\Data\GeneratorServiceDataFileRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

/**
 * Class GeneratorServiceRenderRoute
 * @package Gavoronok30\LaravelGeneratorConfigurable
 */
class GeneratorServiceRenderRoute extends GeneratorServiceRenderAbstract
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
            'entityNameRouteAlias' => Str::of(Str::snake($data->getEntity()->getName()))->replace('_', '.'),
            'prefix' => $data->getRoute()->getPrefix(),
        ];

        $files->map(
            function (GeneratorServiceDataFileRequest $file) use ($data) {
                $file->setContent($this->getContent($data, $file));
            }
        );
    }
}
