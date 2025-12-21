<?php

namespace App\Http\Controllers\Admin\Concerns;

use App\Jobs\Import\CsvImport;
use App\Models\Import;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

trait ImportData
{
    /**
     * Creates Import job.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function Import(Request $request)
    {
        $this->authorize('Import', $this->resourceType);

        $Import = new Import();
        $Import->user_id = user()->getKey();
        $Import->model = get_class($this->getRepository()->getInstance());
        $Import->repository = get_class($this->getRepository());
        $Import->parameters = $request->all();
        $Import->save();

        $job = new CsvImport($Import);

        dispatch($job);

        return redirect()->back()
            ->with('success', __('Importação solicitada com sucesso!'));
    }
}
