## Install for Lumen

**1.** Open file `bootstrap/app.php` and add new service provider
```
$app->register(Gavoronok30\LaravelGeneratorConfigurable\Providers\GeneratorServiceProvider::class);
```
**2.** Run commands

For creating config file
```
php artisan generator:publish --tag=config
```
For generate default blade templates
```
php artisan generator:publish --tag=resources
```
**3.** Add folder `storage/generator` to .gitignore at the root of the project

**4.** Edit templates `resources/views/vendor/laravel-generator-configurable/templates`
and config file `config/generator.php`

## ENV variables

File .env

Enable generator (1 - enable (only development), empty - disable)
```
GENERATOR_ENABLE=1
```
Enable test mode for generator (1 - test mode for debug, empty - live mode)
```
GENERATOR_TEST_MODE=1
```
## Run generator
Open url in browser ({{YOUR_URL}} - replace to your domain)
```
http://{{YOUR_URL}}/generator
```
## Documentation
The documentation is located (inside the component folder) in the folder `/vendor/gavoronok30/laravel-generator-configurable/docs`
