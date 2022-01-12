<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Front extends CI_Controller
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
        $data['title'] = 'sugar_nr';
        $data['menu'] = 'Home';

        $this->load->view('front_templates/header', $data);
        $this->load->view('front_templates/navbar', $data);
        $this->load->view('front_templates/topbar', $data);
        $this->load->view('front/index', $data);
        $this->load->view('front_templates/footer');
    }
    public function produk()
    {
        $data['title'] = 'produk';
        $data['menu'] = 'Produk';
        $data['produk'] = $this->produk->getAll();


        $this->load->view('front_templates/header', $data);
        $this->load->view('front_templates/navbar', $data);
        $this->load->view('front_templates/topbar', $data);
        $this->load->view('front/produk', $data);
        $this->load->view('front_templates/footer');
    }
    public function produkdetail($id)
    {
        $data['title'] = 'produk';
        $data['menu'] = 'Produk';
        $data['produk'] = $this->produk->getById($id);

        $this->load->view('front_templates/header', $data);
        $this->load->view('front_templates/navbar', $data);
        $this->load->view('front_templates/topbar', $data);
        $this->load->view('front/produkdetail', $data);
        $this->load->view('front_templates/footer');
    }

    public function login()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login';
            $data['menu'] = 'Login';

            $this->load->view('front_templates/header', $data);
            $this->load->view('front_templates/navbar', $data);
            $this->load->view('front_templates/topbar', $data);
            $this->load->view('front/login', $data);
            $this->load->view('front_templates/footer');
        } else {
            // validasinya success            
            if ($this->pelanggan->doLoginPelanggan()) {
                redirect('front/index');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username atau Password yang anda masukan Salah!!</div>');
                redirect('front/login');
            }
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('variable');
        $this->session->sess_destroy();

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Logout berhasil!</div>');
        redirect('front/index');
    }

    public function registration()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[admin.email]', [
            'is_unique' => 'Email sudah terdaftar!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password tidak cocok!',
            'min_length' => 'Password terlalu pendek!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Registrasi';
            $data['menu'] = 'Registrasi';

            $this->load->view('front_templates/header', $data);
            $this->load->view('front_templates/navbar', $data);
            $this->load->view('front_templates/topbar', $data);
            $this->load->view('front/registration', $data);
            $this->load->view('front_templates/footer');
        } else {
            if ($this->pelanggan->registration()) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Registrasi Account Berhasil</div>');
                redirect('front/login');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username atau Password yang anda masukan Salah!!</div>');
                redirect('front/registration');
            }
        }
    }

    public function addtocart()
    {

        is_logged_in_front();
        $post = $this->input->post();
        $id_pelanggan = $this->session->userdata('id_login');
        $cart = $this->cart->getByIdPelanggan($id_pelanggan);
        if ($cart == NULL) {
            $cart = [];
        }
        foreach ($cart as $c) {
            if ($post['id_produk'] == $c["id_produk"]) {
                $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Produk sudah masuk cart!!</div>');
                redirect('front/cart');
            }
        }
        $this->cart->save();
        redirect('front/cart');
    }

    public function cart()
    {
        $id_pelanggan = $this->session->userdata('id_login');
        $cart = $this->cart->getCartDetailByIdPelanggan($id_pelanggan);

        $gtotal = 0;
        foreach ($cart as $c) {
            $gtotal = $gtotal + $c['total'];
        }

        $data['title'] = 'Cart';
        $data['menu'] = 'Cart';
        $data['cart'] = $cart;
        $data['gtotal'] = $gtotal;
        $this->load->view('front_templates/header', $data);
        $this->load->view('front_templates/navbar', $data);
        $this->load->view('front_templates/topbar', $data);
        $this->load->view('front/cart', $data);
        $this->load->view('front_templates/footer');
    }

    public function editcart($id)
    {
        $cart = $this->cart->getById($id);
        $data['id_produk'] = $cart['id_produk'];
        $data['produk'] = $this->produk->getById($data['id_produk']);
        $data['jumlah'] = $cart['jumlah'];
        $data['id_cart'] = $cart['id'];

        $this->load->view('front_templates/header', $data);
        $this->load->view('front_templates/navbar', $data);
        $this->load->view('front_templates/topbar', $data);
        $this->load->view('front/editcart', $data);
        $this->load->view('front_templates/footer');
    }

    public function updatecart($id)
    {
        $post = $this->input->post();

        $this->db->set('jumlah', $post['jumlah']);
        $this->db->where('id', $id);
        $this->db->update('cart');
        redirect('front/cart');
    }

    public function deletecart($id)
    {
        $this->db->delete('cart', ['id' => $id]);
        redirect('front/cart');
    }

    public function checkout()
    {
        $this->transaksi->checkout();
        redirect('front/viewcheckout');
    }

    public function viewcheckout()
    {
        $id_pelanggan = $this->session->userdata('id_login');
        $data["transaksi"] = $this->transaksi->getByIdPelanggan($id_pelanggan);

        $this->load->view('front_templates/header', $data);
        $this->load->view('front_templates/navbar', $data);
        $this->load->view('front_templates/topbar', $data);
        $this->load->view('front/penjualan', $data);
        $this->load->view('front_templates/footer');
    }

    public function detailpenjualan($kode_transaksi)
    {
        $data["transaksi"] = $this->transaksi->getByKodeTransaksi($kode_transaksi);

        $this->load->view('front_templates/header', $data);
        $this->load->view('front_templates/navbar', $data);
        $this->load->view('front_templates/topbar', $data);
        $this->load->view('front/detailpenjualan', $data);
        $this->load->view('front_templates/footer');
    }

    public function uploadbuktitransfer($kode_transaksi)
    {
        $this->transaksi->uploadbuktitransfer($kode_transaksi);

        redirect('front/viewcheckout');
    }
}
