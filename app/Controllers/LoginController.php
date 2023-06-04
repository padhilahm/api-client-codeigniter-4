<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class LoginController extends BaseController
{
    protected $url;

    public function __construct()
    {
        $this->url = "http://localhost:8080/api/otentikasi";
        helper('restclient');
    }

    public function index()
    {
        if (valid_token()) {
            return redirect()->to('/pegawai');
        }
        return view('login/index_view');
    }

    public function login()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $data = [
            'email' => $email,
            'password' => $password
        ];

        $response = akses_restapi('POST', $this->url, $data);

        $result = json_decode($response->getBody(), true);

        if ($response->getStatusCode() == 200) {
            $session = session();
            $session->set('token', $result['data']['token']);
            return redirect()->to('/pegawai');
        }

        return redirect()->to(site_url('login'))->with('error', "Email atau password salah");
    }
}
