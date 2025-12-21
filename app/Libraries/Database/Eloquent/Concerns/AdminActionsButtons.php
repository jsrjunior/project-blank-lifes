<?php

namespace App\Libraries\Database\Eloquent\Concerns;


trait AdminActionsButtons
{
     /**
     * List of headers for the admin listing table.
     *
     * @return array
     */
    public function  getAdminActionsButtons($resources,$type)
    {
        $array = array();
        $i = 0;
        foreach($resources as $resource)
        {dd($resource->route('edit'));
            $actions = '';

            ob_start();
            echo $resource->getAdminActions();
            $actions .= ob_get_clean();
            if (isset(user()->id) && user()->can('view', $this))
            {
                $actions .= html()->a()
                ->href($resource->route('show'))
                ->attribute('data-pjax')
                ->attribute('data-toggle', 'tooltip')
                ->attribute('title', 'Visualizar')
                ->style('margin-right: 7px;')
                ->class('btn btn-primary-green btn-sm')
                ->child(html()->i()->class('fas fa-eye'));

            }
            if (isset(user()->id) && user()->can('update', $this))
            {
                $actions .= html()->a()
                ->href($resource->route('edit'))
                ->attribute('data-pjax')
                ->attribute('data-toggle', 'tooltip')
                ->attribute('title', 'Editar')
                ->style('margin-right: 7px;')
                ->class('btn btn-previous btn-sm')
                ->child(html()->i()->class('fas fa-pen'));
            }

            if (isset(user()->id) && user()->can('delete', $this))
            {
                $actions .= html()->a()
                ->href($resource->route('delete'))
                ->attribute('data-toggle', 'tooltip')
                ->attribute('title', 'Excluir')
                ->attribute('data-method', 'DELETE')
                ->attribute('data-method-pjax', 'true')
                ->attribute('data-confirm', modelAction($type, 'confirmation.delete'))
                ->style('margin-right: 7px;')
                ->class('btn btn-danger btn-sm')
                ->child(html()->i()->class('fas fa-trash-alt'));
            }

            $array[$i] = $actions;

            $i++;
        }
        return $array;

    }
}
