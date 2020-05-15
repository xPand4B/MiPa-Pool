<?php

namespace MiPaPo\Core\Components\Common\Contracts;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

interface ApiControllerInterface
{
    /**
     * Get a listing of resources.
     *
     * @param Request $request
     *
     * @return AnonymousResourceCollection
     */
    public function index(Request $request);

    /**
     * Store a newly created resource.
     *
     * @param Request $request
     *
     * @return JsonResource|JsonResponse
     */
    public function store(Request $request);

    /**
     * Return the specified resource.
     *
     * @param Request $request
     * @param string $id
     *
     * @return JsonResource
     */
    public function show(Request $request, string $id): JsonResource;

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param string $id
     *
     * @return bool|JsonResponse|JsonResource
     */
    public function update(Request $request, string $id);

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param string $id
     *
     * @return JsonResource
     */
    public function destroy(Request $request, string $id): JsonResource;
}
