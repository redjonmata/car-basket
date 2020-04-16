<?php

namespace App\Cars;

use App\Car;
use App\Cars\CarsRepository;
use Elasticsearch\Client;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Collection;

class ElasticsearchRepository implements CarsRepository
{
    /** @var Client */
    private $elasticsearch;

    public function __construct(Client $elasticsearch)
    {
        $this->elasticsearch = $elasticsearch;
    }

    public function search(string $query = ''): Collection
    {
        $items = $this->searchOnElasticsearch($query);

        return $this->buildCollection($items);
    }

    private function searchOnElasticsearch(string $query = ''): array
    {
        $model = new Car;

        $body = [
            'query' => [
                'bool' => [
                    'should' => [
                        [
                            'multi_match' => [
                                'fields' => ['make', 'model','registration','engine'],
                                'query' => $query
                            ],
                        ]
                    ],
                ],
            ],
        ];
        if (is_numeric($query)) {
            $body['query']['bool']['should'][] = [ 'match' => [ 'year' => $query]];
        }
        if ($query == '' || empty($query)) {
            $items = $this->elasticsearch->search([
                'index' => $model->getSearchIndex(),
                'type' => $model->getSearchType()
            ]);

            return $items;
        }

        $items = $this->elasticsearch->search([
            'index' => $model->getSearchIndex(),
            'type' => $model->getSearchType(),
            'body' => $body
        ]);

        return $items;
    }

    private function buildCollection(array $items): Collection
    {
        $ids = Arr::pluck($items['hits']['hits'], '_id');

        return Car::findMany($ids)->where('visible','1')
            ->sortBy(function ($car) use ($ids) {
                return array_search($car->getKey(), $ids);
            });
    }
}
