<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Produk_model", "produk");
        $this->load->model("Pelanggan_model", "pelanggan");
        $this->load->model("Cart_model", "cart");
        $this->load->model("Transaksi_model", "transaksi");
    }

    public function index()
    {
        is_logged_in();
        $data['title'] = 'Transaksi';
        $data['menu'] = 'Transaksi';
        $data['transaksi'] = $this->transaksi->getAll();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('transaksi/index', $data);
        $this->load->view('templates/footer');
    }

    public function detail($kode_transaksi, $id_pelanggan)
    {
        is_logged_in();
        $data['title'] = 'Detail Transaksi';
        $data['menu'] = 'Transaksi';
        $data['transaksi'] = $this->transaksi->getByKodeTransaksi($kode_transaksi);
        $data['pelanggan'] = $this->pelanggan->getById($id_pelanggan);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('transaksi/detail', $data);
        $this->load->view('templates/footer');
    }

    public function update($kode_transaksi)
    {
        is_logged_in();
        $data['title'] = 'Detail Transaksi';
        $data['menu'] = 'Transaksi';
        $this->transaksi->update($kode_transaksi);
        redirect('transaksi/index');
    }

    public function laporan()
    {
        $post = $this->input->post();
        $start_date = $post['start_date'];
        $stop_date = $post['stop_date'];

        $data['transaksi'] = $this->transaksi->getAllTanggal();
        $data['start_date'] = $start_date;
        $data['stop_date'] = $stop_date;

        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "laporan tanggal " . $start_date . " - " . $stop_date . ".pdf";
        $this->pdf->load_view('transaksi/laporan', $data);
    }
}
