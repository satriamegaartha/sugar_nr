<?php defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi_model extends CI_Model
{
    private $_table = "transaksi";

    public $id;
    public $kode_transaksi;
    public $id_pelanggan;
    public $id_produk;
    public $jumlah;
    public $bukti_transfer;
    public $status;
    public $created_at;

    public function getAll()
    {
        $this->db->from($this->_table);
        $this->db->order_by("kode_transaksi", "desc");
        $query = $this->db->get();
        return $query->result_array();
        // return $this->db->get($this->_table)->result_array();
    }

    public function getAllTanggal()
    {
        $post = $this->input->post();
        $start_date = $post['start_date'];
        $stop_date = $post['stop_date'];

        $query = "SELECT `transaksi`.*, `produk`.`nama` as `namaproduk`, `produk`.`harga` as `hargaproduk`, `produk`.`image` as `imageproduk`, `produk`.`harga`*`transaksi`.`jumlah` as `total`, `pelanggan`.`nama` as `namapelanggan`, `pelanggan`.`email` as `emailpelanggan`, `pelanggan`.`alamat` as `alamatpelanggan`, `pelanggan`.`telp` as `telppelanggan`
                  FROM `transaksi` 
                  JOIN `produk`
                  ON `transaksi`.`id_produk` = `produk`.`id`   
                  JOIN `pelanggan`
                  ON `pelanggan`.`id` = `transaksi`.`id_pelanggan`
                  WHERE `transaksi`.`created_at` >= '$start_date'
                  AND `transaksi`.`created_at` <= '$stop_date'   
                  ORDER BY `transaksi`.`id` DESC                               
                ";
        return $this->db->query($query)->result_array();
    }

    public function checkout()
    {
        $id_pelanggan = $this->session->userdata('id_login');
        $cart = $this->cart->getCartDetailByIdPelanggan($id_pelanggan);
        $last_row = $this->db->select('*')->order_by('kode_transaksi', "desc")->limit(1)->get('transaksi')->row_array();
        if (!$last_row) {
            $last_kode_transaksi = 0;
        } else {
            $last_kode_transaksi = $last_row["kode_transaksi"];
            $nomor = (int)substr($last_kode_transaksi, 1, 5);
            $nomor = strval($nomor + 1);
        }
        if (isset($nomor)) {
            $kode_transaksi = 'T' . $nomor;
        } else {
            $kode_transaksi = 'T1';
        }

        foreach ($cart as $c) {
            $this->kode_transaksi = $kode_transaksi;
            $this->id_pelanggan = $c["id_pelanggan"];
            $this->id_produk = $c["id_produk"];
            $this->jumlah = $c["jumlah"];
            $this->bukti_transfer = "";
            $this->status = "Belum Bayar";
            $this->noresi = "";
            $this->created_at = date('Y-m-d H:i:s');
            $this->db->insert($this->_table, $this);


            // kurangi jumlah di produk
            $this->load->model('Produk_model', 'produk');
            $produk_jumlah = $this->produk->getById($c["id_produk"])['jumlah'];
            $newjumlah = $produk_jumlah - $c["jumlah"];

            $this->db->set('jumlah', $newjumlah);
            $this->db->where('id', $c["id_produk"]);
            $this->db->update('produk');

            // delete cart 
            $this->db->delete('cart', ['id_pelanggan' => $c["id_pelanggan"], "id_produk" => $c["id_produk"]]);
        }

        return true;
    }

    public function getTransaksiById($id)
    {
        return $this->db->get_where($this->_table, ["id" => $id])->row_array();
    }

    public function getByIdPelanggan($id_pelanggan)
    {
        $query = "SELECT `transaksi`.*, `produk`.`nama` as `namaproduk`, `produk`.`harga` as `hargaproduk`, `produk`.`image` as `imageproduk`, `produk`.`harga`*`transaksi`.`jumlah` as `total`
                  FROM `transaksi` 
                  JOIN `produk`
                  ON `transaksi`.`id_produk` = `produk`.`id`   
                  WHERE `transaksi`.`id_pelanggan` = $id_pelanggan
                  ORDER BY `transaksi`.`id` DESC;                                   
                ";
        return $this->db->query($query)->result_array();
    }

    public function getByKodeTransaksi($kode_transaksi)
    {
        $query = "SELECT `transaksi`.*, `produk`.`nama` as `namaproduk`, `produk`.`harga` as `hargaproduk`, `produk`.`image` as `imageproduk`, `produk`.`harga`*`transaksi`.`jumlah` as `total`
                  FROM `transaksi` 
                  JOIN `produk`
                  ON `transaksi`.`id_produk` = `produk`.`id`   
                  WHERE `transaksi`.`kode_transaksi` = '$kode_transaksi';                  
                ";
        return $this->db->query($query)->result_array();
    }

    public function getByKodeTransaksiPelanggan($kode_transaksi)
    {
        $query = "SELECT `transaksi`.*, `produk`.`nama` as `namaproduk`, `produk`.`harga` as `hargaproduk`, `produk`.`image` as `imageproduk`, `produk`.`harga`*`transaksi`.`jumlah` as `total`, `pelanggan`.`nama` as `namapelanggan`, `pelanggan`.`email` as `emailpelanggan`, `pelanggan`.`alamat` as `alamatpelanggan`, `pelanggan`.`telp` as `telppelanggan`
                  FROM `transaksi` 
                  JOIN `produk`
                  ON `transaksi`.`id_produk` = `produk`.`id`   
                  JOIN `pelanggan`
                  ON `pelanggan`.`id` = `transaksi`.`id_pelanggan`
                  WHERE `transaksi`.`kode_transaksi` = '$kode_transaksi';                  
                ";
        return $this->db->query($query)->result_array();
    }

    public function uploadbuktitransfer($kode_transaksi)
    {
        $post = $this->input->post();

        $nama_bukti_transfer = $this->do_upload();

        $this->db->set('bukti_transfer', $nama_bukti_transfer);
        $this->db->set('status', 'Menunggu Konfirmasi');
        $this->db->where('kode_transaksi', $kode_transaksi);
        $this->db->update('transaksi');

        return true;
    }

    public function update($kode_transaksi)
    {
        $post = $this->input->post();
        $this->db->set('noresi', $post['noresi']);
        $this->db->set('status', $post['status']);
        $this->db->where('kode_transaksi', $kode_transaksi);
        $this->db->update('transaksi');
    }
    private function do_upload()
    {
        $config['upload_path']          = './bukti_transfer/';
        $config['allowed_types']        = 'jpg|png|jpeg';
        $config['max_size']                = 2048;
        $config['file_name']            = date('d-m-Y_H-i-s');
        $config['overwrite']            = true;
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('image')) {
            return $this->upload->data("file_name");
        }
        $error = array('error' => $this->upload->display_errors());
        print_r($error);
        exit;
    }
}
