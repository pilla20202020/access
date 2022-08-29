<?php

namespace App\Modules\Models\DocumentationChecklist;

use App\Modules\Models\CheckedListItem\CheckedListItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentationChecklist extends Model
{
    protected $table = 'tbl_documentation_checklists';

    use HasFactory;

    protected $fillable = [
        'checklist_for',
        'checklist_name',
        'display_order',
        'remarks',
        'status',
        'created_by',
        'created_on',
    ];

    public function checklists()
    {
        return $this->hasMany(CheckedListItem::class,'documentation_id','id');
    }
}
