<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HasBreadcrumbs;
use App\Http\Controllers\Admin\Concerns\HasForm;
use App\Http\Controllers\Admin\Concerns\HasModel;
use App\Http\Controllers\Admin\Concerns\HasViews;
use App\Http\Controllers\Controller;
use App\Libraries\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\View\View;
use League\Csv\CharsetConverter;
use Symfony\Component\HttpFoundation\StreamedResponse;
use League\Csv\Writer;


abstract class CrudController extends Controller
{
    use HasBreadcrumbs;
    use HasForm;
    use HasModel;
    use HasViews;

    /**
     * Clean instance of the resource.
     *
     * @var Model
     */
    protected $instance;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->instance = $this->getRepository()
            ->getInstance();

        $this->addBreadcrumb($this->instance, 'index');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return View
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request)
    {
        $this->authorize('list', $this->resourceType);

        $resources = $this->getRepository()->index($request->all());

        return $this->view('index')
            ->with('type', $this->resourceType)
            ->with('instance', $this->instance)
            ->with('resources', $resources);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return View
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function list(Request $request)
    {

        $this->authorize('list', $this->resourceType);

        $resources = $this->getRepository()
            ->index($request->all());

        return $this->view('list')
            ->with('type', $this->resourceType)
            ->with('instance', $this->instance)
            ->with('resources', $resources);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param int $id
     *
     * @return View
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Request $request, $id)
    {
        if (!is_numeric($id)) {
            abort(404);
        }

        $instance = $this->getRepository()
            ->find($id, true);

        $this->authorize('view', $instance);

        $this->addBreadcrumb($instance, 'show');

        return $this->view('show')
            ->with('type', $this->resourceType)
            ->with('instance', $instance);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return View
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(Request $request)
    {
        $this->authorize('create', $this->resourceType);

        $this->addBreadcrumb($this->instance, 'create');

        return $this->view('create')
            ->with('type', $this->resourceType)
            ->with('instance', $this->instance)
            ->with('isUpdate', false)
            ->with('request', $request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request)
    {
        $this->authorize('create', $this->resourceType);

        $params = $this->formParams();

        if ($resource = $this->getRepository()
            ->create($params)
        ) {
            if (!(new $this->resourceType)->isApprovalBypassed()) {

                return redirect()->to($resource->route('index'))
                                 ->with('success', 'Aguardando Aprovação do Gestor Para Salvar o Novo: ' . modelAction($this->resourceType, 'success.created'));
            }

            $this->registerLog($this->getFirstMediaParams($resource, $params), $resource->id, 'insert');
            return $this->afterCreate($request, $resource);
        }

        return $this->afterFailed($request, 'created');
    }


    /**
     * Where to redirect after creating the resource.
     *
     * @param Model $resource
     *
     * @return Array
     */
    protected function getFirstMediaParams($resource, $params)
    {
        return $params;
    }

    /**
     * Show the form for edit an existing resource.
     *
     * @param Request $request
     * @param int $id
     *
     * @return View
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Request $request, $id)
    {
        $instance = $this->getRepository()
            ->find($id, true);

        $this->authorize('update', $instance);

        $this->addBreadcrumb($instance, 'edit');

        return $this->view('edit')
            ->with('type', $this->resourceType)
            ->with('instance', $instance)
            ->with('isUpdate', true);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     *
     * @return RedirectResponse
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, $id)
    {
        $instance = $this->getRepository()
            ->find($id, true);

        $this->authorize('update', $instance);
        if ($resource = $this->getRepository()
            ->update($instance, $this->formParams())
        ) {
            $this->registerLog($request, $id, 'update');
            return $this->afterUpdate($resource);
        }

        return $this->afterFailed($request, 'updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param int $id
     *
     * @return RedirectResponse
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function delete(Request $request, $id)
    {
        $instance = $this->getRepository()
            ->find($id, true);

        $this->authorize('delete', $instance);

        if ($success = $this->getRepository()
            ->delete($instance)
        ) {
            $this->registerLog($request, $id, 'delete');
            return $this->afterDelete($instance);
        }

        return $this->afterFailed($request, 'deleted');
    }

    /**
     * Remove the specified resource from storage.     *
     *
     * @param Request $request
     * @param int $id
     *
     * @return RedirectResponse
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function restore(Request $request, $id)
    {
        $instance = $this->getRepository()
            ->find($id, true);

        $this->authorize('restore', $instance);

        if ($success = $this->getRepository()
            ->restore($instance)
        ) {
            $this->registerLog($request, $instance->id, 'restore');

            return $this->afterRestore($instance);
        }

        return $this->afterFailed($request, 'restored');
    }

    /**
     * Validate form request for javascript.
     *
     * @return Request
     */
    public function validation()
    {
        return $this->formRequest()
            ? response()->json(['status' => 'valid'])
            : response()->json(['status' => 'invalid'], 422);
    }

    /**
     * Where to redirect after creating the resource.
     *
     * @param Model $resource
     *
     * @return RedirectResponse
     */
    protected function afterCreate(Request $request, $resource)
    {
        $user = user();
        $route = null;

        if ($user->can('view', $resource)) {
            $route = $resource->route('show');
        } elseif ($user->can('update', $resource)) {
            $route = $resource->route('edit');
        } elseif ($user->can('list', $this->resourceType)) {
            $route = $resource->route('index');
        }

        if(method_exists(new $this->resourceType, 'isApprovalBypassed')){
            if(!(new $this->resourceType)->isApprovalBypassed())
            {
                $route = $resource->route('index');
                return $route->with('success', 'Aguardando Aprovação do Gestor'.modelAction($this->resourceType, 'success.created'));
            }
        }
        
        $route = $route ? redirect()->to($route) : back();

        if ($request->expectsJson()) {
            return response()->json([
                'success' => modelAction($this->resourceType, 'success.created'),
                'model' => $resource,
            ]);
        }

        return $route->with('success', modelAction($this->resourceType, 'success.created'));
    }

    /**
     * Where to redirect after updating resource.
     *
     * @param Model $resource
     *
     * @return RedirectResponse
     */
    protected function afterUpdate($resource)
    {
        if (request()->expectsJson()) {
            return response()->json([
                'success' => modelAction($this->resourceType, 'success.updated')
            ], Response::HTTP_OK);
        }

        return redirect()
            ->to($resource->route('edit'))
            ->with(
                'success',
                modelAction($this->resourceType, 'success.updated')
            );
    }

    /**
     * Where to redirect after deleting resource.
     *
     * @param Model $resource
     *
     * @return RedirectResponse
     */
    protected function afterDelete($resource)
    {
        return redirect()
            ->to($resource->route('index'))
            ->with(
                'success',
                modelAction($this->resourceType, 'success.deleted')
            );
    }

    /**
     * Where to redirect after deleting resource.
     *
     * @param Model $resource
     *
     * @return RedirectResponse
     */
    protected function afterRestore($resource)
    {
        return back()->with(
            'success',
            modelAction($this->resourceType, 'success.restored')
        );
    }

    /**
     * Return with errors and message.
     *
     * @param string $action
     *
     * @return RedirectResponse
     */
    protected function afterFailed(Request $request, $action, $rawAction = false)
    {
        $action = $rawAction ? $action : modelAction($this->resourceType, 'failed.' . $action);

        if ($request->expectsJson()) {
            return response()->json([
                'warning' => $action
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return back()
            ->withInput()
            ->with('warning', $action);
    }

    /**
     * Where to redirect after deleting resource.
     *
     * @param Model $resource
     *
     * @return RedirectResponse
     */
    protected function afterRestoreVersion($resource)
    {
        return redirect()
            ->to($resource->route('edit'))
            ->with(
                'success',
                modelAction($this->resourceType, 'success.restoredVersion')
            );
    }

    /**
     * Display a listing of the resource (API).
     *
     * @param Request $request
     * @return Json
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function all(Request $request)
    {
        // $this->authorize('list', $this->resourceType);

        $resources = $this->getRepository()
            ->index($request->all());

        return response()->json($resources, 200);
    }

    /**
     * Display a listing of the resource (API).
     *
     * @param Request $request
     * @return Json
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function getTranslateAdminColumns(Request $request)
    {
        $this->authorize('list', $this->resourceType);


        return response()->json($this->instance->getTranslateAdminColumns($this->resourceType), 200);
    }

    /**
     * Display a listing of the resource (API).
     *
     * @param Request $request
     * @return Json
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function getAdminLines(Request $request)
    {
        $this->authorize('list', $this->resourceType);

        $resources = $this->getRepository()
            ->index($request->all());

        return response()->json($this->instance->getAdminLines($resources), 200);
    }

    /**
     * Display a listing of the resource (API).
     *
     * @param Request $request
     * @return Json
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function getAdminActions(Request $request)
    {

        $this->authorize('list', $this->resourceType);

        $resources = $this->getRepository()
            ->index($request->all());


        return response()->json($this->instance->getAdminActionsButtons($resources, $this->resourceType), 200);
    }

    /**
     * Display a listing of the resource (API).
     *
     * @param Request $request
     * @return Json
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function getSelectOptions(Request $request)
    {
        $this->authorize('list', $this->resourceType);

        return response()->json((new  $this->repositoryType)->selectOptions(), 200);
    }

    /**
     * Display the specified resource (API).
     *
     * @param Request $request
     * @param int $id
     *
     * @return Json
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function findOne(Request $request, $id)
    {
        $instance = $this->getRepository()
            ->find($id);

        $this->authorize('view', $instance);

        return response()->json($instance, 200);
    }

    public function import(Request $request)
    {
        $this->authorize('import', $this->resourceType);

        return $this->view('import')
            ->with('type', $this->resourceType)
            ->with('instance', $this->instance);
    }

    /**
     * Remove the specified resource from storage (API).
     *
     * @param Request $request
     * @param int $id
     *
     * @return Json
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function deleteById(Request $request, $id)
    {
        $instance = $this->getRepository()
            ->find($id, true);

        $this->authorize('delete', $instance);

        if ($success = $this->getRepository()
            ->delete($instance)
        ) {
            
            $this->registerLog($request, $instance->id, 'deleted');

            return response()->json([
                'deleted' => true
            ]);
        }

        return response()->json([
            'deleted' => false
        ]);
    }



    public function downloadSynchronous(Request $request)
    {
        $this->authorize('download', $this->resourceType);
        $resources = $this->getRepository()->export($request->all());
        $headers_content = $this->instance->getTranslateAdminColumnExpandAll($this->resourceType); // Conteúdo dos cabeçalhos
        $data_content = $this->instance->getAdminLinesExpandAll($resources); // Conteúdo da consulta
        // Monta os cabeçalhos com os itens necessários
        foreach ($headers_content as $key => $value) {
            $headers[] = $value['column'];
        }

        $file_name = $this->instance->getTable() . '_' . date('d-m-Y_H-i-s') . '.csv';

        $response = new StreamedResponse(function () use ($data_content, $headers) {
            $handle = fopen('php://output', 'w');
            $csv = Writer::createFromStream($handle);
            // Configurar a codificação de caracteres
            $csv->setDelimiter(';');
            $csv->insertOne($headers);

            foreach ($data_content as $content) {
                if (isset($content['attribute'])) {
                    unset($content['attribute']);
                }

                isset($content['name']) ? $content['name'] = strip_tags($content['name']) : null;
                $content['id'] = strip_tags($content['id']);
                $content['id'] = str_replace("#", "", $content['id']);

                $csv->insertOne($content);
            }

            fclose($handle);
        });

        // Definir os headers da resposta HTTP
        $file_name = $this->instance->getTable() . '_' . date('d-m-Y_H-i-s') . '.csv';
        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="' . $file_name . '"');

        // Retornar a resposta HTTP com o arquivo CSV
        return $response;
    }

    /**
     * Register Log Activity
     *
     * @param Request $request
     * @param int $subject_id
     * @param string $log_type
     *
     * @return void
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function registerLog($params = [], $subject_id, $log_type)
    {
        $subject = $this->getRepository()->find($subject_id, true);

        $log = activity()
            ->performedOn($subject)
            ->causedBy(user());

        if ($contract = optional($subject)->contract) {
            $log = $log->contract($contract);
        }

        if ($customer = optional($subject)->customer) {
            $log = $log->customer($customer);
        }

        if ($contract && !$customer) {
            $customer = $contract->customer;
            $log = $log->customer($customer);
        }

        if ($params != []) {
            $log = $log->withProperties($this->getRepository()->filterAttributes($params));
        }

        $log = $log->log($log_type);
    }
}
