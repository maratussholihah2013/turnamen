<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
  
class HasilPertandingan extends Model
{
    use HasFactory, SoftDeletes;
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pemain_id', 'waktu_gol', 'jadwal_id',
    ];
        
    public function jadwal()
    {
    	return $this->belongsTo(JadwalPertandingan::class);
    }
        
    public function pemain()
    {
    	return $this->belongsTo(Pemain::class);
    }
}