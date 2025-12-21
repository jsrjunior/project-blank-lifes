<?php

namespace App\Libraries\Database\Eloquent\Concerns;


trait TranslateAdminColumns
{
    /**
     * List of headers for the admin listing table.
     * @param Model
     *
     * @return array
     */
    public function getTranslateAdminColumns($type)
    {
        $array = array();
        $i = 0;

        foreach($this->getAdminColumns() as $column)
        {
            $array[$i]['column'] = ''; // Initialize as an array
            $array[$i]['attribute'] = ''; // Initialize as an array
            $array[$i]['key'] = '';

            $array[$i]['column'] = modelAttribute($type, $column) ?? $column;
            $array[$i]['attribute'] = $this->getAdminColumnAttributes($i, $column) ?? "";
            $array[$i]['key'] = $column ?? "";
            $i++;
        }

        return $array;
    }

    public function getTranslateAdminColumnExpandAll($type)
    {
        if($this->getAdminColumnExpandAll()){
            $array = array();
            $i = 0;

            foreach($this->getAdminColumnExpandAll() as $column)
            {
                $array[$i]['column'] = ''; // Initialize as an array
                $array[$i]['attribute'] = ''; // Initialize as an array
                $array[$i]['key'] = '';

                $array[$i]['column'] = modelAttribute($type, $column) ?? $column;
                $array[$i]['attribute'] = $this->getAdminColumnAttributes($i, $column) ?? "";
                $array[$i]['key'] = $column ?? "";
                $i++;
            }
        } else {
            $array = $this->getTranslateAdminColumns($type);
        }

        return $array;
    }
}
