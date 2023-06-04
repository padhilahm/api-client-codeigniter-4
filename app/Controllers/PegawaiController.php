<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;

class PegawaiController extends BaseController
{
    use ResponseTrait;
    protected $url;

    public function __construct()
    {
        $this->url = 'http://localhost:8080/api/pegawai';
        helper('restclient');
    }

    public function index()
    {
        $response = akses_restapi('GET', $this->url, []);

        if ($response->getStatusCode() == 401) {
            return redirect()->to(site_url('login'))->with('error', 'Silahkan login terlebih dahulu');
        }

        $data = [
            'pegawai' => json_decode($response->getBody(), true)
        ];
        return view('pegawai/index_view', $data);
    }

    public function new()
    {
        return view('pegawai/new_view');
    }

    public function show($id)
    {
        $response = akses_restapi('GET', $this->url . '/' . $id, []);
        echo "<pre>";
        print_r($response->getBody());
        echo "</pre>";
    }

    public function create()
    {
        $data = [
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email')
        ];
        $response = akses_restapi('POST', $this->url, $data);

        if ($response->getStatusCode() == 201) {
            return redirect()->to(site_url('pegawai'))->with('success', 'Data berhasil ditambahkan');
        }

        $response = json_decode($response->getBody(), true);

        isset($response['error']['email']) ? $data['email'] = $response['error']['email'] : $data['email'] = '';
        isset($response['error']['nama']) ? $data['nama'] = $response['error']['nama'] : $data['nama'] = '';

        return redirect()->back()
            ->with('errorInput', $data)
            ->withInput();
    }

    public function update($id)
    {
        $data = [
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email')
        ];

        $response = akses_restapi('PUT', $this->url . '/' . $id, $data);
        if ($response->getStatusCode() == 200) {
            return redirect()->back()->with('success', 'Data berhasil diupdate');
        }

        $response = json_decode($response->getBody(), true);

        isset($response['error']['email']) ? $data['email'] = $response['error']['email'] : $data['email'] = '';
        isset($response['error']['nama']) ? $data['nama'] = $response['error']['nama'] : $data['nama'] = '';

        return redirect()->back()
            ->with('errorInput', $data)
            ->withInput();
    }

    public function delete($id)
    {
        $response = akses_restapi('DELETE', $this->url . '/' . $id, []);
        if ($response->getStatusCode() == 200) {
            return redirect()->to(site_url('pegawai'))->with('success', 'Data berhasil dihapus');
        }

        return redirect()->to(site_url('pegawai'))->with('error', 'Data gagal dihapus');
    }

    public function edit($id)
    {
        $response = akses_restapi('GET', $this->url . '/' . $id, []);

        if ($response->getStatusCode() == 200) {
            $data = [
                'pegawai' => json_decode($response->getBody(), true)
            ];
            return view('pegawai/edit_view', $data);
        }

        return redirect()->to(site_url('pegawai'))->with('error', 'Data tidak ditemukan');
    }
}
