<?php defined('BASEPATH') or exit('No direct script access allowed');

class Produk_model extends CI_Model
{
    private $_table = "produk";

    public $id;
    public $nama;
    public $keterangan;
    public $harga;
    public $jumlah;
    public $image;
    public $status;
    public $created_at;
    public $updated_at;

    public function getAll()
    {
        // return $this->db->get($this->_table)->result_array();
        return $this->db->get_where($this->_table, ["jumlah >" => 0])->result_array();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["id" => $id])->row_array();
    }

    public function save()
    {

        $post = $this->input->post();
        $this->nama = $post["nama"];
        $this->keterangan = $post["keterangan"];
        $this->harga = $post["harga"];
        $this->jumlah = $post["jumlah"];
        $this->status = "Aktif";;
        $this->image = $this->do_upload();
        $this->updated_at = date('Y-m-d H:i:s');
        return $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();

        $this->id = $post["id"];
        $this->nama = $post["nama"];
        $this->keterangan = $post["keterangan"];
        $this->harga = $post["harga"];
        $this->jumlah = $post["jumlah"];
        $this->status = $post["status"];

        if (!empty($_FILES["image"]["name"])) {
            $this->image = $this->do_upload();
            unlink(FCPATH . './produk/' . $post["old_image"]);
        } else {
            $this->image = $post["old_image"];
        }

        $this->updated_at = date('Y-m-d H:i:s');


        return $this->db->update($this->_table, $this, array('id' => $post['id']));
    }

    private function do_upload()
    {
        $config['upload_path']          = './produk/';
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
