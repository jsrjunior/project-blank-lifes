<?php
namespace App\Models;

use App\Libraries\Database\Eloquent\Model;
use App\Models\DocumentType;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'document_type_id',
        'number',
    ];

    public function documentable()
    {
        return $this->morphTo();
    }

    public function type()
    {
        return $this->belongsTo(DocumentType::class, 'document_type_id');
    }
}
