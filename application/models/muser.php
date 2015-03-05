<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
  /**
     * Programmer Ika Nur Fajri
     * fajrie.xp@gmail.com
     */

class Muser extends CI_Model {

    function Muser() {
        parent::__construct();

    }

    // cek keberadaan user di database
    function check_user_account($username, $password) {
        $this -> db -> select('*');
        $this -> db -> from('users');
        $this -> db -> where('user_email', $username);
        $this -> db -> where('user_pass', $password);
        return $this -> db -> get();
    }

}
