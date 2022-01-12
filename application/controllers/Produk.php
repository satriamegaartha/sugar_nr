<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Produk_model", "produk");
    }

    public function index()
    {
        is_logged_in();
        $data['title'] = 'Produk';
        $data['menu'] = 'Produk';
        $data['produk'] = $this->produk->getAll();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('produk/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Produk';
        $data['menu'] = 'Produk';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('produk/tambah', $data);
        $this->load->view('templates/footer');
    }

    public function save()
    {
        if ($this->produk->save()) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Produk berhasil ditambahkan!</div>');
            redirect('produk/index');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menambahkan produk!</div>');
            redirect('produk/tambah');
        }
    }

    public function edit($id)
    {
        $data['title'] = 'Tambah Produk';
        $data['menu'] = 'Produk';

        $data["produk"] = $this->produk->getById($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('produk/edit', $data);
        $this->load->view('templates/footer');
    }

    public function update()
    {
        if ($this->produk->update()) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Produk berhasil dirubah!</div>');
            redirect('produk/index');
        }
    }
}
