<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
  
class JadwalPertandingan extends Model
{
    use HasFactory;
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tanggal', 'waktu', 'tim_home','tim_away','total_skor_home','total_skor_away'
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