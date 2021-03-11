<?php

return [
    'enable' => env('GENERATOR_ENABLE', false),
    'templates' => resource_path('views/vendor/laravel-generator-configurable/templates/'),
    'testMode' => env('GENERATOR_TEST_MODE', true),
    'testFolder' => storage_path('generator/'),
    'customFiles' => [
        'entity' => [
            [
                'template' => 'entity.blade.php',
                'outputFile' => 'app/Domain/%/%.php',
            ],
            [
                'template' => 'entity_filter.blade.php',
                'outputFile' => 'app/Domain/%/%Filter.php',
            ],
            [
                'template' => 'entity_repository_interface.blade.php',
                'outputFile' => 'app/Domain/%/%RepositoryInterface.php',
            ],
            [
                'template' => 'entity_repository.blade.php',
                'outputFile' => 'app/Infrastructure/PostgresRepository/Eloquent%Repository.php',
            ],
            [
                'template' => 'repository_service_provider.blade.php',
                'outputFile' => 'app/Providers/RepositoryServiceProvider.php',
                'mode' => 'system',
                'format' => 'text',
            ],
        ],
        'migration' => [
            [
                'template' => 'migration.blade.php',
                'outputFile' => 'database/migrations/%migrationDate%_create_%.php',
            ],
            [
                'template' => 'migration_relationship.blade.php',
                'outputFile' => 'database/migrations/%migrationDate%_create_%.php',
            ],
        ],
        'seeder' => [
            [
                'template' => 'seeder.blade.php',
                'outputFile' => 'database/seeders/%TableSeeder.php',
            ],
            [
                'template' => 'seeder_database.blade.php',
                'outputFile' => 'database/seeders/DatabaseSeeder.php',
                'mode' => 'system',
                'format' => 'text',
            ],
        ],
        'response' => [
            [
                'template' => 'response_resource.blade.php',
                'outputFile' => 'app/Http/Resources/%/%Resource.php',
            ],
            [
                'template' => 'response_resource_collection.blade.php',
                'outputFile' => 'app/Http/Resources/%/%ResourceCollection.php',
            ],
        ],
        'controller' => [
            [
                'template' => 'controller.blade.php',
                'outputFile' => 'app/Http/Controllers/%contextPath%%Controller.php',
            ],
        ],
        'controllerList' => [
            [
                'template' => 'controller_list_command.blade.php',
                'outputFile' => 'app/Application/%/Get%List.php',
            ],
            [
                'template' => 'controller_list_command_handler.blade.php',
                'outputFile' => 'app/Application/%/Get%ListHandler.php',
            ],
        ],
        'controllerById' => [
            [
                'template' => 'controller_by_id_command.blade.php',
                'outputFile' => 'app/Application/%/Get%ById.php',
            ],
            [
                'template' => 'controller_by_id_command_handler.blade.php',
                'outputFile' => 'app/Application/%/Get%ByIdHandler.php',
            ],
        ],
        'controllerCreate' => [
            [
                'template' => 'controller_create_command.blade.php',
                'outputFile' => 'app/Application/%/Register%.php',
            ],
            [
                'template' => 'controller_create_command_handler.blade.php',
                'outputFile' => 'app/Application/%/Register%Handler.php',
            ],
        ],
        'controllerUpdate' => [
            [
                'template' => 'controller_update_command.blade.php',
                'outputFile' => 'app/Application/%/Update%.php',
            ],
            [
                'template' => 'controller_update_command_handler.blade.php',
                'outputFile' => 'app/Application/%/Update%Handler.php',
            ],
        ],
        'controllerDelete' => [
            [
                'template' => 'controller_delete_command.blade.php',
                'outputFile' => 'app/Application/%/Delete%.php',
            ],
            [
                'template' => 'controller_delete_command_handler.blade.php',
                'outputFile' => 'app/Application/%/Delete%Handler.php',
            ],
        ],
        'route' => [
            [
                'template' => 'route.blade.php',
                'outputFile' => 'routes/%context%.php',
                'mode' => 'system',
                'format' => 'text',
            ],
        ],
        'test' => [
            [
                'template' => 'test.blade.php',
                'outputFile' => 'tests/%contextPath%%context%%Test.php',
            ],
        ],
        'apiDoc' => [
            [
                'template' => 'api_doc.blade.php',
                'outputFile' => 'api-doc/%contextPath%%.js',
                'format' => 'text',
            ],
        ],
    ],
    'fieldTypeAliases' => [
        'integer' => 'int',
        'boolean' => 'bool',
    ],
    'fieldTextFormatAliases' => [
        'Carbon' => 'string',
    ]
];
