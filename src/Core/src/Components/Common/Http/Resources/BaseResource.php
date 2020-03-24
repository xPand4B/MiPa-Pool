<?php

namespace MiPaPo\Core\Components\Common\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

abstract class BaseResource extends JsonResource
{
    /**
     * @var array
     */
    protected $queryParams = [];

    /**
     * @var string
     */
    protected $table = '';

    /**
     * BaseResource constructor.
     *
     * @param $resource
     * @param null $request
     */
    public function __construct($resource, $request = null)
    {
        parent::__construct($resource);

        if ($request instanceof Request) {
            $this->getQueryParams($request);
        }
    }

    /**
     * Extract query params from url.
     *
     * @param Request $request
     *
     * @return void
     */
    private function getQueryParams(Request $request): void
    {
        $columns = $this->getColumnListing($this->table);

        if (!$columns) {
            return;
        }

        foreach ($columns as $column) {
            if ($request->has(mb_strtolower($column))) {
                array_push($this->queryParams, mb_strtolower($column));
            }
        }
    }

    /**
     * Get all columns for the specified database table.
     *
     * @param string $table
     *
     * @return array|null
     */
    private function getColumnListing(string $table): ?array
    {
        return DB::getSchemaBuilder()
            ->getColumnListing($table);
    }

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     *
     * @return array
     */
    public function toArray($request)
    {
        $attr = $this->getAttributes($request);
        $attr = $this->filterQueryParams($attr);

        $rel = $this->getRelations($request);

        $links = $this->getLinks($request);

        $type = $this->getType();

        $id = $this->getId();

        return [
            'type' => $type,
            'id' => $id,
            'attributes' => $attr,
            'relationships' => $rel,
            'links' => $links
        ];
    }

    /**
     * Filters attribute-fields based on query params.
     *
     * @param array $attributes
     *
     * @return array
     */
    private function filterQueryParams(array $attributes): array
    {
        $filtered = [];

        if ($this->queryParams === []) {
            return $attributes;
        }

        foreach ($this->queryParams as $key) {
            if (array_key_exists($key, $attributes)) {
                $filtered[$key] = $attributes[$key];
            }
        }

        if ($filtered === []) {
            return $attributes;
        }

        return $filtered;
    }

    /**
     * Returns the resource id.
     *
     * @return String
     */
    protected function getId(): String
    {
        return (string)$this->id;
    }

    /**
     * Returns the resource type.
     *
     * @return String
     */
    abstract protected function getType(): String;

    /**
     * Returns the resource attributes.
     *
     * @param $request
     *
     * @return array
     */
    abstract protected function getAttributes($request): array;

    /**
     * Returns the resource relations.
     *
     * @param $request
     *
     * @return array
     */
    abstract protected function getRelations($request): array;

    /**
     * Returns the resource links.
     *
     * @param $request
     *
     * @return array
     */
    protected function getLinks($request): array
    {
        return [
            'self' => null,
            'related' => null,
        ];
    }
}
