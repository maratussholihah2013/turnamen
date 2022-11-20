<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
  
class Pemain extends Model
{
    use HasFactory;
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama', 'tinggi_badan', 'berat_badan','posisi','nomor_punggung'
    ];
    
    public function hasils()
    {
        return $this->hasMany(HasilPertandingan::class);
    }
    
    public function tim()
    {
    	return $this->belongsTo(Tim::class);
    }
}