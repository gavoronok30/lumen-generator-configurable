<?php

namespace Gavoronok30\LaravelGeneratorConfigurable\Http\Controllers;

use Gavoronok30\LaravelGeneratorConfigurable\GeneratorServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Laravel\Lumen\Routing\Controller as BaseController;

/**
 * Class GeneratorController
 * @package Gavoronok30\LaravelGeneratorConfigurable\Http\Controllers\Generator
 */
class GeneratorController extends BaseController
{
    /**
     * @var GeneratorServiceInterface
     */
    private GeneratorServiceInterface $generatorService;

    /**
     * GeneratorController constructor.
     * @param GeneratorServiceInterface $generatorService
     */
    public function __construct(
        GeneratorServiceInterface $generatorService
    ) {
        $this->generatorService = $generatorService;
    }

    /**
     * @return View
     */
    public function page(): View
    {
        return view('generator::page');
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function check(Request $request): Response
    {
        return new Response(
            ['data' => $this->generatorService->generateFileList($request->all(), true)],
            Response::HTTP_OK
        );
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function generate(Request $request): Response
    {
        $this->generatorService->generateFiles($request->all());

        return new Response(
            [],
            Response::HTTP_NO_CONTENT
        );
    }
}
