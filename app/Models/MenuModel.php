<?php 
namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model{
    protected $table      = 'Menu';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'jumlah', 'keterangan', 'jenis', 'harga'];
}