<?php

namespace App\Libraries\Database\Eloquent\Concerns;

use ErrorException;
use Illuminate\Database\Eloquent\Relations\Relation;
use ReflectionClass;
use ReflectionMethod;

trait HasRelationships {

    /**
     * Get users name admin column
     *
     * @return string
     */
    public function relationships()
    {
        $model = new static;
        $relationships = [];

        $methods = (new ReflectionClass($model))->getMethods(ReflectionMethod::IS_PUBLIC);

        if (!$methods) {
            return $relationships;
        }

        foreach($methods as $method)
        {
            if ($method->class != get_class($model) ||
                !empty($method->getParameters()) ||
                $method->getName() == __FUNCTION__) {
                continue;
            }

            try {
                $return = $method->invoke($model);

                if ($return instanceof Relation) {
                    $relationships[$method->getName()] = [
                        'type' => (new ReflectionClass($return))->getShortName(),
                        'model' => (new ReflectionClass($return->getRelated()))->getName()
                    ];
                }
            } catch(\Throwable $e) {
                continue;
            }
        }

        return $relationships;
    }
}
