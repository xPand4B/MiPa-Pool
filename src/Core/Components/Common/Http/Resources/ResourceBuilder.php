<?php

namespace MiPaPo\Core\Components\Common\Http\Resources;

use Illuminate\Http\JsonResponse;
use MiPaPo\Core\CoreBundle;

/**
 * @see https://jsonapi.org/format/
 */
class ResourceBuilder
{
    /**
     * @var int
     */
    private const DEFAULT_STATUS_CODE = 200;

    /**
     * @var int
     */
    private $statusCode;

    /**
     * @var array
     */
    private $responseData;

    /**
     * @var array
     */
    private $data;

    /**
     * @var array
     */
    private $meta;

    /**
     * Set data type and attributes information.
     *
     * @param $type
     * @param array $attributes
     * @return $this
     */
    public function setData($type, array $attributes): self
    {
        if ($type) {
            $this->data['type'] = $type;
        }

        if (! empty($attributes)) {
            $this->data['attributes'] = $attributes;
        }

        return $this;
    }

    /**
     * Set response meta information.
     *
     * @param array $data
     * @return $this
     */
    public function setMeta(array $data): self
    {
        if (! empty($data)) {
            $this->meta = $data;
        }

        return $this;
    }

    /**
     * Set status code.
     *
     * @param int $statusCode
     * @return $this
     */
    public function setStatusCode(int $statusCode): self
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * Get the response.
     *
     * @return JsonResponse
     */
    public function getResponse(): JsonResponse
    {
        $this->build();

        return response()->json(
            $this->responseData, $this->statusCode
        );
    }

    /**
     * Build the response.
     *
     * @return $this
     */
    private function build(): self
    {
        if ($this->data) {
            $this->responseData['data'] = $this->data;
        }

        if ($this->meta) {
            $this->responseData['meta'] = $this->meta;
        }

        if (! $this->statusCode) {
            $this->statusCode = self::DEFAULT_STATUS_CODE;
        }

        $this->responseData['jsonapi'] = [
            'version' => CoreBundle::API_VERSION
        ];

        return $this;
    }
}