<?php defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    private $_table = "admin";

    public $id;
    public $nama;
    public $email;
    public $password;
    public $image;
    public $created_at;

    public function doLoginAdmin()
    {
        $post = $this->input->post();

        // cari user berdasarkan email
        $this->db->where('email', $post["email"]);
        $admin = $this->db->get($this->_table)->row();

        // jika admin terdaftar
        if ($admin) {
            // periksa password-nya
            $isPasswordTrue = $post["password"] == $admin->password;
            // jika password benar dan dia admin
            if ($isPasswordTrue) {
                // login sukses yay!
                $this->session->set_userdata(['user_logged' => $admin]);
                $this->session->set_userdata(['role' => 'Admin']);
                $this->session->set_userdata(['nama' => $admin->nama]);
                $this->session->set_userdata(['image' => $admin->image]);
                $this->session->set_userdata(['id_login' => $admin->id]);
                return true;
            }
        }

        // login gagal
        return false;
    }

    public function registration()
    {
        $email = $this->input->post('email', true);
        $data = [
            'nama' => htmlspecialchars($this->input->post('nama', true)),
            'email' => htmlspecialchars($email),
            'image' => 'default.jpg',
            'password' => htmlspecialchars($this->input->post('password1')),
        ];
        $this->db->insert($this->_table, $data);
        return true;
    }

    public function isNotLogin()
    {
        return $this->session->userdata('user_logged') === null;
    }

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }

    public function terbaru5()
    {
        $this->db->select('*');
        $this->db->order_by('created_at', 'DESC');
        $this->db->limit(5);
        return $this->db->get($this->_table)->result();
    }

    public function getByIdresult($nra)
    {
        return $this->db->get_where($this->_table, ["nra" => $nra])->result();
    }

    public function getById($nra)
    {
        return $this->db->get_where($this->_table, ["nra" => $nra])->row();
    }

    public function save()
    {
        $post = $this->input->post();
        $this->nra = $post["nra"];
        $this->brevet = $post["brevet"];
        $this->nama = $post["nama"];
        $this->sk = $post["sk"];
        $this->kip = $post["kip"];
        $this->alamat = $post["alamat"];
        $this->email = $post["email"];
        $this->password = $post["password"];
        $this->notelp = $post["notelp"];
        $this->profile = $this->do_upload();
        $this->created_at = date('Y-m-d H:i:s');
        $this->updated_at = '';
        return $this->db->insert($this->_table, $this);
    }

    public function update()
    {
        $post = $this->input->post();

        $this->nama = $post["nama"];
        $this->brevet = $post["brevet"];
        $this->sk = $post["sk"];
        $this->kip = $post["kip"];
        $this->alamat = $post["alamat"];
        $this->email = $post["email"];
        $this->password = $post["password"];
        $this->notelp = $post["notelp"];
        if (!empty($_FILES["profile"]["name"])) {
            $this->profile = $this->do_upload();
            unlink(FCPATH . './anggota/' . $post["old_profile"]);
        } else {
            $this->profile = $post["old_profile"];
        }
        $this->updated_at = date('Y-m-d H:i:s');


        return $this->db->update($this->_table, $this, array('nra' => $post['nra']));
    }

    public function delete($nra)
    {
        return $this->db->delete($this->_table, array("nra" => $nra));
    }

    private function do_upload()
    {
        $config['upload_path']          = './anggota/';
        $config['allowed_types']        = 'jpg|png|jpeg';
        $config['max_size']                = 2048;
        $config['file_name']            = date('d-m-Y_H-i-s');
        $config['overwrite']            = true;
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('profile')) {
            return $this->upload->data("file_name");
        }
        $error = array('error' => $this->upload->display_errors());
        print_r($error);
        exit;
    }

    public function logout()
    {
        $this->session->unset_userdata('variable');
        $this->session->sess_destroy();
    }
}
