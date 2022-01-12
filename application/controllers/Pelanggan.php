<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Pelanggan_model", "pelanggan");
    }

    public function index()
    {
        is_logged_in();
        $data['title'] = 'pelanggan';
        $data['menu'] = 'pelanggan';
        $data['pelanggan'] = $this->pelanggan->getAll();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pelanggan/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Pelanggan';
        $data['menu'] = 'pelanggan';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pelanggan/tambah', $data);
        $this->load->view('templates/footer');
    }

    public function save()
    {
        if ($this->pelanggan->save()) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">pelanggan berhasil ditambahkan!</div>');
            redirect('pelanggan/index');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menambahkan pelanggan!</div>');
            redirect('pelanggan/tambah');
        }
    }

    public function edit($id)
    {
        $data['title'] = 'Tambah Pelanggan';
        $data['menu'] = 'Pelanggan';

        $data["pelanggan"] = $this->pelanggan->getById($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('pelanggan/edit', $data);
        $this->load->view('templates/footer');
    }

    public function update()
    {
        if ($this->pelanggan->update()) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Pelanggan berhasil dirubah!</div>');
            redirect('pelanggan/index');
        }
    }
}
