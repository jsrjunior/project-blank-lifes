<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Libraries\Database\Eloquent\Concerns\AdminLines;
use App\Libraries\Database\Eloquent\Concerns\AdminOrderable;
use App\Libraries\Database\Eloquent\Concerns\AdminSearchable;
use App\Libraries\Database\Eloquent\Concerns\Fillable;
use App\Libraries\Database\Eloquent\Concerns\Filterable;
use App\Libraries\Database\Eloquent\Concerns\HasColumns;
use App\Libraries\Database\Eloquent\Concerns\HasRoutes;
use App\Models\Concerns\WithIdAdminColumn;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Html\Attributes;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasRoles;
    use HasRoutes;
    //use SoftDeletes;
    use AdminOrderable;
    use AdminSearchable;
    use WithIdAdminColumn;
    //use WithIsActiveAdminColumn;
    use HasColumns;
    use Fillable;
    use Filterable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getAdminRowAttributes($index, $resource)
    {
        $attributes = new Attributes();
        // $attributes->setAttributes(['onclick' => "window.location='" . route('web.admin.users.edit', ['id' => $resource->id]) . "'"]);
        $attributes->setAttributes(['style' => 'cursor: pointer;']);
        return $attributes->render();
    }

    public static function getTypes(): Collection
    {
        return collect(modelAttribute(self::class, 'options.type'));
    }

    /**
     * List of headers for the admin listing table.
     *
     * @return array
     */
    public function getAdminColumns()
    {
        return ['id', 'name', 'email',  'created_at'];
    }

    public function getAdminColumnExpandAll()
    {
        return ['id', 'name', 'email','created_at'];
    }

    /**
     * Get roles admin column
     *
     * @param bool $export
     * @return string
     */
    public function getRolesAdminColumn($export = false)
    {
        return $this->roles->pluck('name')->join(', ');
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
        return in_array($attribute, $this->getAdminColumnExpandAll());
    }

    /**
     * Get admin order columns.
     *
     * @return array
     */
    public function getOrderColumns()
    {
        return ['id', 'name', 'email','created_at'];
    }

    /**
     * Get default order key.
     *
     * @return string|string[]
     */
    public function getOrderKey()
    {
        return [ 'name'];
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

}
