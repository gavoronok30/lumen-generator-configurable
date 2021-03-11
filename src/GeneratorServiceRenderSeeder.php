<?php

namespace Gavoronok30\LaravelGeneratorConfigurable;

use Gavoronok30\LaravelGeneratorConfigurable\Data\GeneratorServiceData;
use Gavoronok30\LaravelGeneratorConfigurable\Data\GeneratorServiceDataEntityField;
use Gavoronok30\LaravelGeneratorConfigurable\Data\GeneratorServiceDataFileRequest;
use Illuminate\Support\Collection;

/**
 * Class GeneratorServiceRenderSeeder
 * @package Gavoronok30\LaravelGeneratorConfigurable
 */
class GeneratorServiceRenderSeeder extends GeneratorServiceRenderAbstract
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
            'table' => $data->getEntity()->getTable(),
            'entityFields' => $this->getFieldDataFromEntity($data),
            'seederCountRows' => $data->getSeeder()->getCountRows(),
            'seederFields' => $this->getFields($data),
            'relationFields' => $this->getRelationFieldsFromEntity($data->getEntity()),
        ];

        $files->map(
            function (GeneratorServiceDataFileRequest $file) use ($data) {
                $file->setContent($this->getContent($data, $file));
            }
        );
    }

    /**
     * @param GeneratorServiceData $data
     * @return Collection|GeneratorServiceDataEntityField
     */
    private function getFields(GeneratorServiceData $data): Collection
    {
        $fields = collect();

        foreach ($data->getSeeder()->getFields() as $field) {
            if ($field->getField() == 'id') {
                $fields->push(
                    GeneratorServiceDataEntityField::register(
                        'id',
                        'integer',
                        'integer',
                        'int',
                        false,
                        false,
                        false
                    )
                );
                continue;
            } elseif ($field->getField() == GeneratorServiceInterface::FIELD_NAME_DELETED_AT) {
                $fields->push(
                    GeneratorServiceDataEntityField::register(
                        GeneratorServiceInterface::FIELD_NAME_DELETED_AT,
                        GeneratorServiceInterface::FIELD_TYPE_CARBON,
                        GeneratorServiceInterface::FIELD_TYPE_STRING,
                        GeneratorServiceInterface::FIELD_TYPE_CARBON,
                        false,
                        false,
                        false
                    )
                );
                continue;
            } elseif ($field->getField() == GeneratorServiceInterface::FIELD_NAME_CREATED_AT) {
                $fields->push(
                    GeneratorServiceDataEntityField::register(
                        GeneratorServiceInterface::FIELD_NAME_CREATED_AT,
                        GeneratorServiceInterface::FIELD_TYPE_CARBON,
                        GeneratorServiceInterface::FIELD_TYPE_STRING,
                        GeneratorServiceInterface::FIELD_TYPE_CARBON,
                        false,
                        false,
                        false
                    )
                );
                continue;
            } elseif ($field->getField() == GeneratorServiceInterface::FIELD_NAME_UPDATED_AT) {
                $fields->push(
                    GeneratorServiceDataEntityField::register(
                        GeneratorServiceInterface::FIELD_NAME_UPDATED_AT,
                        GeneratorServiceInterface::FIELD_TYPE_CARBON,
                        GeneratorServiceInterface::FIELD_TYPE_STRING,
                        GeneratorServiceInterface::FIELD_TYPE_CARBON,
                        false,
                        false,
                        false
                    )
                );
                continue;
            }

            foreach ($data->getEntity()->getFields() as $entityField) {
                if ($field->getField() == $entityField->getField()) {
                    $fields->push($entityField);
                }
            }
        }

        return $fields;
    }
}
