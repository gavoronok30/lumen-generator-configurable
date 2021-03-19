<?php

namespace Gavoronok30\LaravelGeneratorConfigurable;

use Illuminate\Support\Facades\Config;

/**
 * Class GeneratorServiceChunk
 * @package Gavoronok30\LaravelGeneratorConfigurable
 */
class GeneratorServiceChunk
{
    /**
     * @var string
     */
    protected string $folderTemplates;

    /**
     * GeneratorServiceChunk constructor.
     */
    public function __construct()
    {
        $this->folderTemplates = Config::get('generator.templates');
    }

    /**
     * @param string $file
     * @param array $data
     * @return string
     */
    public function get(string $file, array $data = []): string
    {
        $file = sprintf(
            '%schunks/%s.blade.php',
            $this->folderTemplates,
            $file
        );
        return trim(view()->file($file, $data)->render());
    }
}
