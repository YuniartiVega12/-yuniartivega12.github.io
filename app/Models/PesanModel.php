<?php 
namespace App\Models;

use CodeIgniter\Model;

class PesanModel extends Model{
    protected $table      = 'pesan';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id';
    protected $allowedFields = ['pesanan', 'harga', 'jumlah', 'totalharga','status'];
}