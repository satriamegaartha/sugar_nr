<?php defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggan_model extends CI_Model
{
    private $_table = "pelanggan";

    public $id;
    public $nama;
    public $email;
    public $password;
    public $alamat;
    public $telp;
    public $created_at;
    public $updated_at;

    public function getAll()
    {
        return $this->db->get($this->_table)->result_array();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["id" => $id])->row_array();
    }

    public function save()
    {

        $post = $this->input->post();
        $this->nama = $post["nama"];
        $this->email = $post["email"];
        $this->password = $post["password"];
        $this->alamat = $post["alamat"];
        $this->telp = $post["telp"];
        $this->updated_at = date('Y-m-d H:i:s');
        return $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();

        $this->id = $post["id"];
        $this->nama = $post["nama"];
        $this->email = $post["email"];
        $this->password = $post["password"];
        $this->alamat = $post["alamat"];
        $this->telp = $post["telp"];
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

    public function doLoginPelanggan()
    {
        $post = $this->input->post();

        // cari user berdasarkan email
        $this->db->where('email', $post["email"]);
        $pelanggan = $this->db->get($this->_table)->row();

        // jika pelanggan terdaftar
        if ($pelanggan) {
            // periksa password-nya
            $isPasswordTrue = $post["password"] == $pelanggan->password;
            // jika password benar dan dia pelanggan
            if ($isPasswordTrue) {
                // login sukses yay!
                $this->session->set_userdata(['user_logged' => $pelanggan]);
                $this->session->set_userdata(['role' => 'Pelanggan']);
                $this->session->set_userdata(['nama' => $pelanggan->nama]);
                $this->session->set_userdata(['id_login' => $pelanggan->id]);
                return true;
            }
        }

        // login gagal
        return false;
    }

    public function registration()
    {
        $email = $this->input->post('email', true);
        $alamat = $this->input->post('alamat', true);
        $telp = $this->input->post('telp', true);
        $data = [
            'nama' => htmlspecialchars($this->input->post('nama', true)),
            'email' => htmlspecialchars($email),
            'password' => htmlspecialchars($this->input->post('password1')),
            'alamat' => htmlspecialchars($alamat),
            'telp' => htmlspecialchars($telp),
        ];
        $this->db->insert($this->_table, $data);
        return true;
    }
}
