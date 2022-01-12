<?php defined('BASEPATH') or exit('No direct script access allowed');

class Cart_model extends CI_Model
{
    private $_table = "cart";

    public $id;
    public $id_pelanggan;
    public $id_produk;
    public $jumlah;

    public function getAll()
    {
        return $this->db->get($this->_table)->result_array();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["id" => $id])->row_array();
    }

    public function getByIdPelanggan($id_pelanggan)
    {
        return $this->db->get_where($this->_table, ["id_pelanggan" => $id_pelanggan])->result_array();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->id_pelanggan = $post['id_pelanggan'];
        $this->id_produk = $post['id_produk'];
        $this->jumlah = $post['jumlah'];

        return $this->db->insert($this->_table, $this);
    }

    public function getCartDetailByIdPelanggan($id_pelanggan)
    {
        $query = "SELECT `cart`.*, `produk`.`nama` as `namaproduk`, `produk`.`harga` as `hargaproduk`, `produk`.`image` as `imageproduk`, `produk`.`harga`*`cart`.`jumlah` as `total`
                  FROM `cart` 
                  JOIN `produk`
                  ON `cart`.`id_produk` = `produk`.`id`   
                  WHERE `cart`.`id_pelanggan` = $id_pelanggan
                  ORDER BY `cart`.`id` ASC;                                   
                ";
        return $this->db->query($query)->result_array();
    }
}
