<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Programmer Ika Nur Fajri
 * fajrie.xp@gmail.com
 */

class Login extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this -> load -> model('Muser');
        $this -> load -> library('SimpleLoginSecure');
        $this -> load -> library('form_validation');
    }
    
 
    public function index() {
        $this -> load -> view('login');
    }

    public function validasi() {
        //untuk validasi form kosong
        $this -> form_validation -> set_rules('useremail', 'username', 'trim|required|xss_clean');
        $this -> form_validation -> set_rules('password', 'password', 'trim|required|xss_clean');
        return $this -> form_validation -> run();
    }

    public function ceklogin() {
        //jika validasi benar maka akan dilanjutkan proses selanjutnya
        if ($this -> validasi()) {
            $username = $this -> input -> post('useremail');
            $pass = $this -> input -> post('password');
            ///proses setelah validasi benar, maka dilanjutkan dengan pengecekan username dan password oleh library
            if ($this -> simpleloginsecure -> login($username, $pass)) {
                // jika username dan password benar akan dialihkan kehalaman main
                redirect('login/main/');
            } else {
                ///jika username atau password salah maka akan kembali ke halaman login 
                $this -> session -> set_flashdata('gagal_save', '<b>GAGAL!</b> Username atau Password Salah');
                redirect('login/');
            }
        } else {
            //jika kosong akan dikembalikan ke halaman login
            $this -> session -> set_flashdata('gagal_save', '<b>GAGAL!</b> Username atau Password Tidak Boleh Kosong');
            redirect('login/');

        }

    }

    public function logout() {
        ///digunakan untuk logout
        $this -> simpleloginsecure -> logout();
        redirect('login');
    }

    //

    public function main() {
        ////pengecekan apakah sudah dalam keadaan login
        if ($this -> session -> userdata('logged_in')) {
     
            $this -> load -> view('main');
        } else {
            ///jika tidak dalam keadaan login akan dikembalikan ke halaman login
            redirect('login');
        }
    }

}
