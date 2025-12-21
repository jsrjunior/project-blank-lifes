<?php

namespace App\Models\Concerns;

trait WithIdBlankAdminColumn
{
    /**
     * Get id admin column
     *
     * @param bool $export
     * @return mixed|string
     */
    public function getIdBlankAdminColumn($export = false)
    {
        if($export) {
            return $this->getKey();
        }

        $user = user();

        if($user && $user->can('view', $this)) {
            $link = $this->route('show');
        } elseif($user && $user->can('update', $this)) {
            $link = $this->route('edit');
        }

        if(isset($link)) {
            return html()->a($link, '#'.$this->getKey())->target('_blank')->class('text-blue');
        }

        return '#'.$this->getKey();
    }
}
