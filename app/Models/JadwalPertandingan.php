<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
  
class JadwalPertandingan extends Model
{
    use HasFactory, SoftDeletes;
  
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tanggal', 'waktu', 'tim_home','tim_away','total_skor_home','total_skor_away'
    ];

    protected $appends = ['status','skor_akhir'];
    
    public function hasils()
    {
        return $this->hasMany(HasilPertandingan::class,'jadwal_id');
    }
    
    public function timhome()
    {
    	return $this->belongsTo(Tim::class,'tim_home');
    }

    public function timaway()
    {
    	return $this->belongsTo(Tim::class,'tim_away');
    }

    public function getStatusAttribute(){
        if($this->total_skor_home > $this->total_skor_away)
            return "Tim Home Menang";
        elseif ($this->total_skor_home < $this->total_skor_away)
            return "Tim Away Menang";
        else
            return "Draw";
    }

    public function getSkorAkhirAttribute(){
        return $this->total_skor_home.':'.$this->total_skor_away;
    }


}