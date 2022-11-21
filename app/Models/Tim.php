<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
  
class Tim extends Model
{
    use HasFactory, SoftDeletes;
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama', 'logo', 'tahun','alamat','kota'
    ];
    
    public function pemains()
    {
        return $this->hasMany(Pemain::class);
    }
    
    public function jadwals()
    {
        return $this->hasMany(JadwalPertandingan::class);
    }
}