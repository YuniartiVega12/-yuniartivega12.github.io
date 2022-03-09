<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\MenuModel;
use CodeIgniter\HTTP\Request;

class MenuController extends Controller
{
    /** 
     * Instance of the main Request object.
     * 
     * @var HTTP\IncromingRequest
     */
    protected $request;
    function __construct()
    {
        $this->menus = new MenuModel();
    }
    public function tampil()
    {
        $data['data'] = $this->menus->findAll();
        return view('menu', $data);
    }
    public function create()
    {
        $data = array(
            'nama' => $this->request->getPost('nama'),
            'jumlah' => $this->request->getPost('jumlah'),
            'keterangan' =>$this->request->getPost('keterangan'),
            'jenis' => $this->request->getPost('jenis'),
            'harga' => $this->request->getPost('harga'),
        );
        $this->menus->insert($data);
        return redirect('menu')->with('success', 'data berhasil disimpan');
    }
    public function edit($id)
    {
        # code...
        $data = array(
            'nama' => $this->request->getPost('nama'),
            'jumlah' => $this->request->getPost('jumlah'),
            'keterangan' =>$this->request->getPost('keterangan'),
            'jenis' => $this->request->getPost('jenis'),
            'harga' => $this->request->getPost('harga'),
        );
        $this->menus->update($id, $data);
        return redirect('menu')->with('success', 'data berhasil disimpan');
    }
    public function show($id)
    {
        # code...
    }
    public function delete($id)
    {
        # code...
        $this->menus->delete($id);
        return redirect('menu')->with('success', 'Data berhasil dihapus');
    }
}
