<?php

namespace App\Components\Common\Contracts;

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
    function index(Request $request);

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
     * @param $id
     *
     * @return JsonResource
     */
    public function show(Request $request, $id): JsonResource;

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     *
     * @return JsonResource
     */
    public function update(Request $request, $id): JsonResource;

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param $id
     *
     * @return JsonResponse
     */
    public function destroy(Request $request, $id): JsonResponse;
}
