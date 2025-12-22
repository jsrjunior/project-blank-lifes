<?php

namespace App\Models;

use App\Events\ResourceCreatedEvent;
use App\Events\ResourceUpdatedEvent;
use App\Libraries\Database\Eloquent\Model;
use App\Models\Concerns\WithIdAdminColumn;
use App\Models\Concerns\WithNameAdminColumn;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Life extends Model
{

    use SoftDeletes;
    use WithIdAdminColumn;
    use WithNameAdminColumn;
    use HasFactory;

    protected $dispatchesEvents = [
        'created' => ResourceCreatedEvent::class,
        'updated' => ResourceUpdatedEvent::class,
        'deleted' => ResourceUpdatedEvent::class,
    ];

    protected $fillable = [
        'name',
        'birth_date',
    ];

     protected $appends = [
        'first_name',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    /**
     * List of headers for the admin listing table.
     *
     * @return array
     */
    public function getAdminColumns()
    {
        return ['id', 'first_name','name', 'birth_date', 'created_at'];
    }

    /**
     * If this column should expand.
     *
     * @param int    $index
     * @param string $attribute
     *
     * @return bool
     */
    public function getAdminColumnExpand($index, $attribute)
    {
        return in_array($attribute, ['first_name']);
    }

    /**
     * Get admin order columns.
     *
     * @return array
     */
    public function getOrderColumns()
    {
        return ['id', 'name', 'created_at'];
    }

    /**
     * Get default order key.
     *
     * @return string
     */
    public function getOrderKey()
    {
        return 'id';
    }

    /**
     * Get default order direction.
     *
     * @return string
     */
    public function getOrderDir()
    {
        return 'desc';
    }

    /**
     * Get export model.
     *
     * @return Model
     */
    public function getModel()
    {
        $modelClass = $this->model;

        return new $modelClass();
    }

    public function phones(){
        return $this->hasMany(Phone::class);
    }

    public function emails(){
        return $this->hasMany(Email::class);
    }

    public function addresses(){
        return $this->hasMany(Address::class);
    }

    /**
     * Retorna apenas o primeiro nome.
     *
     * @return string|null
     */
    public function getFirstNameAttribute(): ?string
    {
        if (empty($this->name)) {
            return null;
        }

        // Remove espaços extras e quebra o nome
        $parts = preg_split('/\s+/', trim($this->name));

        return $parts[0] ?? null;
    }
}