<?php

namespace App\Cars;

use App\Car;
use Illuminate\Database\Eloquent\Collection;

class EloquentRepository implements CarsRepository
{
    public function search(string $query = ''): Collection
    {
        return Car::query()
            ->where('make', 'like', "%{$query}%")
            ->orWhere('model', 'like', "%{$query}%")
            ->orWhere('year', 'like', "%{$query}%")
            ->orWhere('registration', 'like', "%{$query}%")
            ->orWhere('engine', 'like', "%{$query}%")
        ->get();
    }
}
