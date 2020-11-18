<?php

namespace App\Http\Controllers;

use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function resolveModelQueryByRequest(Request $request, $query)
    {
        foreach (array_filter(explode(',', $request->filters)) as $part) {
            $parts = array_filter(explode('.', $part));

            $query = $query->where(...$parts);
        }

        foreach (array_filter(explode(',', $request->relationFilters)) as $part) {
            $parts = array_filter(explode('.', $part));
            $query = $query->whereHas(array_shift($parts), function ($query) use ($parts) {
                $query->where(...$parts);
            });

        }
    
        return $query;
    }
}
