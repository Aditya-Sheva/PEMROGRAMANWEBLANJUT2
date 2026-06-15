<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = ['proposal_id','document_name','file_path','file_type','document_type'];
    public function proposal() { return $this->belongsTo(Proposal::class); }
}