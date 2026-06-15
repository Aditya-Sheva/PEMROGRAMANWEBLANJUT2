<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $fillable = ['name','file_path','file_type','uploaded_by'];
    public function uploader() { return $this->belongsTo(User::class, 'uploaded_by'); }
}