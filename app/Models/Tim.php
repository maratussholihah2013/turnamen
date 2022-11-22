<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
  
class Tim extends Model
{
    use HasFactory, SoftDeletes;
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama', 'logo', 'tahun_berdiri','alamat','kota'
    ];
        
    public function pemains()
    {
        return $this->hasMany(Pemain::class);
    }
    
    public function jadwalhomes()
    {
        return $this->hasMany(JadwalPertandingan::class);
    }

    public function jadwalaways()
    {
        return $this->hasMany(JadwalPertandingan::class);
    }
}