<?php

namespace App\Libraries\Database\Eloquent\Concerns;


trait AdminLines
{
    /**
    * List of headers for the admin listing table.
    *
    * @return array
    */
    public function getAdminLines($resources)
    {
       $array = array();
       $i = 0;
       foreach($resources as $resource)
       {
           foreach($resource->getAdminColumns() as $column)
           {
               $array[$i][$column] = ''; // Initialize as an array
               $array[$i]['attribute'] = ''; // Initialize as an array
               ob_start();
               echo $resource->getAdminColumn($column);
               $capturedOutput = ob_get_clean();
               $array[$i][$column] = $capturedOutput;
               $array[$i]['attribute'] = $resource->getAdminColumnAttributes($i, $column) ?? "";
           }
           $i++;
       }
       return $array;
    }

    public function getAdminLine($resource)
    {
        $array = array();

        foreach($resource->getAdminColumns() as $column)
        {
            $array[$column] = ''; // Initialize as an array
            $array['attribute'] = ''; // Initialize as an array
            ob_start();
            echo $resource->getAdminColumn($column);
            $capturedOutput = ob_get_clean();
            $array[$column] = $capturedOutput;

        }

        return $array;
    }

    public function getAdminLinesExpandAll($resources)
    {
        $array = array();
        $i = 0;
        foreach ($resources as $resource) {
            foreach ($resource->getAdminColumnExpandAll() as $column) {
                $array[$i][$column] = ''; 
                $array[$i]['attribute'] = ''; 

                ob_start();
                echo $resource->getAdminColumn($column);
                $capturedOutput = ob_get_clean();
                $array[$i][$column] = strip_tags($capturedOutput); 
                $array[$i]['attribute'] = strip_tags($resource->getAdminColumnAttributes($i, $column)) ?? "";
            }
            $i++;
        }
        return $array;
    }
}
