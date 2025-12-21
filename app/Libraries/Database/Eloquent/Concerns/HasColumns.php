<?php

namespace App\Libraries\Database\Eloquent\Concerns;

use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Spatie\Html\Attributes;

trait HasColumns
{
    /**
     * List of headers for the admin listing table.
     *
     * @return array
     */
    public function getAdminColumns()
    {
        return [$this->getKey()];
    }

    /**
     * List of export columns.
     *
     * @return array
     */
    public function getExportColumns()
    {
        return $this->getAdminColumns();
    }

    /**
     * Convert date to localized format.
     *
     * @param string $attribute
     * @param bool $export
     * @return string
     */
    public function getDateAdminColumn($attribute, $export = false)
    {
        $value = $this->{$attribute};

        if (is_null($value)) {
            return $this?->date;
        }

        // NOTE: Checa se $value é d/m/Y
        if (preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $value)) {
            return Carbon::createFromFormat('d/m/Y', $value)->format('d/m/Y');
        }

        if (is_string($value)) {
            $value = $this->asDateTime($value);
        }

        return $value->format(config('admin.date_format'));
    }

    /**
     * Value for an admin column.
     *
     * @param string $attribute
     * @param bool $export
     * @return string
     */
    public function getAdminColumn($attribute, $export = false)
    {
        $attribute = str_replace('.', '-', $attribute);

        if(substr($attribute, -2) === '__') {
            $attribute = substr($attribute, 0, -2);
        }

        $method = Str::camel('get-'.$attribute.'-admin-column');
        if (method_exists($this, $method)) {
            return $this->{$method}($export);
        }

        if ($this->hasAdminColumnView($attribute)) {
            return $this->getAdminColumnView($attribute)
                ->with('instance', $this);
        }

        if ($this->isDateAttribute($attribute)) {
            return $this->getDateAdminColumn($attribute, $export);
        }

        return $this->$attribute;
    }

    public function getVariableColumn($attribute)
    {
        $attribute = str_replace('.', '-', $attribute);

        if(substr($attribute, -2) === '__') {
            $attribute = substr($attribute, 0, -2);
        }

        $method = Str::camel('get-'.$attribute.'-variable-column');
        if (method_exists($this, $method)) {
            return $this->{$method}(false);
        }

        $method = Str::camel('get-'.$attribute.'-admin-column');
        if (method_exists($this, $method)) {
            return $this->{$method}(false, true);
        }

        $parts = explode('--', $attribute);
        $column = end($parts);

        $currentObject = $this;

        if (count($parts) > 1) {
            $slices = [];

            foreach($parts as $index => $part) {
                if ($part != end($parts)) {
                    $camelPart = Str::camel($part);

                    if (method_exists($currentObject, $camelPart)) {
                        $currentObject = $currentObject->$camelPart;
                    } elseif(method_exists($currentObject, $part)) {
                        $currentObject = $currentObject->$part;
                    }

                    if (!$currentObject) {
                        return $this->$attribute;
                    }

                    if (get_class($currentObject) == 'Illuminate\Database\Eloquent\Collection') {
                        $slices = array_slice($parts, $index+1);
                        array_pop($slices);
                        $values = [];

                        $values = array_merge($values, multipleModelValues($currentObject, $slices, $column));

                        return implode(', ', $values);
                    }
                }
            }
        }

        return $currentObject->$column;
    }

    public function getAdminColumnView($column)
    {
        return view($this->getAdminColumnViewPath($column));
    }

    public function hasAdminColumnView($column)
    {
        return View::exists($this->getAdminColumnViewPath($column));
    }

    public function getAdminColumnViewPath($column)
    {
        $className = class_basename($this);
        $module = strtolower(Str::plural(Str::snake($className)));
        return "admin.{$module}.partials.columns.{$column}";
    }

    /**
     * Get admin row class.
     *
     * @param $index
     * @return string
     */
    public function getAdminRowClass($index)
    {
        return '';
    }

    public function getAdminRowAttributes($index, $resource = null)
    {
        $attributes = new Attributes();
        $attributes->addClass($this->getAdminRowClass($index));
        return $attributes->render();
    }

    /**
     * Get admin column class.
     *
     * @param $index
     * @param $attribute
     * @return string
     */
    public function getAdminColumnClass($index, $attribute)
    {
        $classes = collect([]);

        if (!$this->getAdminColumnExpand($index, $attribute)) {
            $classes->push('shrink');
        }

        $method = Str::camel('get-'.$attribute.'-admin-column-class');

        if (method_exists($this, $method)) {
            $classes->push($this->{$method}());
        }

        return $classes->implode(' ');
    }

    public function getAdminColumnAttributes($index, $attribute)
    {
        $attributes = new Attributes();

        $method = Str::camel('get-'.$attribute.'-admin-column-attributes');
        if (method_exists($this, $method)) {
            $attributes->setAttributes($this->{$method}());
        }

        $attributes->addClass($this->getAdminColumnClass($index, $attribute));

        return $attributes->render();
    }

    /**
     * If this column should expand.
     *
     * @param int $index
     * @param string $attribute
     * @return bool
     */
    public function getAdminColumnExpand($index, $attribute)
    {
        return $index === (count($this->getAdminColumns()) - 1);
    }

    /**
     * Get admin actions.
     *
     * @return string
     */
    public function getAdminActions()
    {
        if ($this->hasAdminColumnView('actions')) {
            return $this->getAdminColumnView('actions')
                ->with('instance', $this);
        }
    }

    /**
     * Get admin dropdown actions.
     *
     * @return string
     */
    public function getAdminDropdownActions()
    {
    }
}
