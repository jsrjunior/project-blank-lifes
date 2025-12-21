<?php

namespace App\Http\Controllers\Admin\Concerns;

use Illuminate\Http\Request;

trait HasReport
{
    public function report(Request $request)
    {
        $query = $request->get('q');
        $query['type'] = 'death';
        $request->merge(['q' => $query]);

        $count = app($this->reportRepositoryType)->indexCount($request->all());

        return view($this->viewPath)
            ->with('resourceCount', $count);
    }
}
