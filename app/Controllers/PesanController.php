<?php
namespace App\Controllers;

use App\Models\MenuModel;
use App\Models\PesanModel;
use App\Models\detailpesanModel;
use CodeIgniter\Controller;

class PesanController extends Controller
{
    /**
     * instance of the main Request object. 
     * 
     * @var HTTP\IncomingRequest
     */
    protected $request;
    
    function __construct()
    {
        $this->menu = new MenuModel();
        $this->session = session();
        $this->pesan = new PesanModel();
        $this->detailpesan = new detailpesanModel();
    }
    public function index()
    {
        
        // $users =$Usermodel->select('name,email')->find($id);
        # code...
        $data['data'] = $this->menu->select('id,nama')->findAll() ;

        if (session('cart')!=null)
        {
            $data['menu']=array_values(session('cart'));
        }
        else
        {
            $data['menu']=null;
        }
        return view ('pesan', $data);
    }
    public function addCart()
    {
        #code... 
        $id = $this->request->getPost('id_menu');
        $jumlah = $this->request->getPost('jumlah');
        $men = $this->menu->find($id);
        if ($men) {
        }
        // print_r($id);
        $isi = array(
            'id_menu' => $id,
            'nama' =>$men ['nama'],
            'harga' =>$men ['harga'],
            'jumlah' => $jumlah,
        );

        if ($this->session->has('cart')) {
            $index = $this->cek($id);
            $cart = array_values(session('cart'));
            if ($index == -1){
                array_push($cart, $isi);
            } else {
                $cart[$index]['jumlah'] += $jumlah;
            }
            $this->session->set('cart' , $cart);
        } else {
            $this->session->set('cart' , array($isi));
        }
        return redirect('pesan')->with('success', "data berhasil ditambahkan " .$men ['nama']);
    }
    public function cek($id)
    {
        #code... 
        $cart = array_values(session('cart'));
        for ($i = 0; $i < count($cart); $i++) {
            if ($cart[$i]['id_menu'] == $id) {
                return $i;
            }
        }
        return -1;
    }

    public function hapusCart($id)
    {
        #code... 
        $index = $this->cek ($id);
        $cart= array_values(session('cart'));
        unset($cart[$index]);
        $this->session->set('cart',$cart);
        return redirect('pesan')->with('success',"data berhasil dihapus");
    }
    public function simpan()
    {
        if (session('cart')!=null)
        {
            $mpesan=array(
                'user_id'=>'1',
                'tanggal'=>date('Y/m/d'),
                'nama'=>$this->request->getPost('nama'),
                'nomeja'=>$this->request->getPost('nomeja'),
                'status'=>'dibayar',
                'totalharga'=>'0'
            );
            $id= $this->pesan->insert($mpesan);
            $cart = array_values(session('cart'));
            $tHarga=0;
            foreach ($cart as $val) {
                $dpesan=array(
                    'id_pesan'=>$id,
                    'id_menu'=>$val['id_menu'],
                    'jumlah'=>$val['jumlah'],
                    'harga'=>$val['harga']
                );
                $tHarga += $val['jumlah'] * $val['harga'];
                $this ->detailpesan->insert($dpesan);
            }
            $dtHarga= array(
                'totalharga'=>$tHarga,
            );
            $this->pesan->update($id,$dtHarga);
            $this->session->remove ('cart') ;
            return redirect ('pesan') ->with ('success','transaksi berhasil disimpan') ;
        }
    }
}