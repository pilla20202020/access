<?php

namespace App\Modules\Models\CheckedListItem;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckedListItem extends Model
{
    protected $table = 'tbl_checked_list_items';

    use HasFactory;

    protected $fillable = [
        'documentation_id',
        'document_name',
        'document_type',
        'document_sample',
        'special_instructions',
        'display_order',
        'remarks',
        'status',
        'created_by',
        'created_on',
    ];
}
