<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Decision extends Model
{
    protected $fillable = [
        'proposal_id','secretary_id','chief_id','decision','notes','decided_at',
        'certificate_number','signature_path','signed_at','published_at'
    ];
    public function proposal()  { return $this->belongsTo(Proposal::class); }
    public function secretary() { return $this->belongsTo(User::class, 'secretary_id'); }
    public function chief()     { return $this->belongsTo(User::class, 'chief_id'); }
}