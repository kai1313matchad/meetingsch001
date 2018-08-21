<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct()
    {
        parent::__construct();

        date_default_timezone_set('Asia/Jakarta');
		# load helper
        // $this->load->helper(array('url', 'form', 'text', 'html', 'security', 'file', 'directory', 'number', 'date', 'download', 'captcha'));

        $this->load->database();

        # load library
        // $this->load->library(array('session', 'form_validation', 'upload', 'user_agent', 'email', 'cart'));
    }    

	public function index()
	{
		$this->load->view('signature');
	}

	function insert() {
		
		$image = $this->input->post('image');
		
		$data = array(
			'image' => $image
		);
		$this->db->insert('test', $data);
	}

	function sendMail() {

		$config = Array(
		    'protocol' => 'smtp',
		    'smtp_host' => 'ssl://smtp.gmail.com',
		    'smtp_port' => 465,
		    'smtp_user' => 'kaishasatrio@match-advertising.com',
		    'smtp_pass' => '3m41lk3rj4?',
		    'mailtype'  => 'html', 
		    'charset'   => 'iso-8859-1'
		);
		// $this->load->library('email', $config);
		$this->email->initialize($config);
		$this->email->set_newline("\r\n");

		// $ci = get_instance();
  //       $ci->load->library('email');
  //       $config['protocol'] = "smtp";
  //       $config['smtp_host'] = "ssl://smtp.gmail.com";
  //       $config['smtp_port'] = "465";
  //       $config['smtp_user'] = "zamroni666@gmail.com";
  //       $config['smtp_pass'] = "balongsari";
  //       $config['charset'] = "utf-8";
  //       $config['mailtype'] = "html";
  //       $config['newline'] = "\r\n";

  //       $ci->email->initialize($config);
        // $ci->email->set_newline("\r\n");
		// $ci->email->set_header('MIME-Version', '1.0; charset= utf-8');
		// $ci->email->set_header('Content-type', 'text/html');
  //       $ci->email->from('zamroni666@gmail.com', 'Your Name');
  //       $list = array('forheron@gmail.com');
  //       $ci->email->to($list);
  //       $ci->email->subject('judul email');

  //       // isi email
  //       $noVer = $this->generate_random_string(4);
		// $message = '<p>hello dunia</p><br>';
		// $message .= '<p>No verifikasi anda : </p>'.$noVer;
		// $message .='<br><p>Terima kasih,</p>';

  //       $ci->email->message($message);
  //       if ($this->email->send()) {
  //           echo 'Email sent.';
  //       } else {
  //           show_error($this->email->print_debugger());
  //       }

		//call the config set mail

		// $config = $this->config->item('email_config', 'set_email');
		// $this->load->library('email', $config);
		// $this->email->set_newline("\r\n");
		// $this->email->set_header('MIME-Version', '1.0; charset= utf-8');
		// $this->email->set_header('Content-type', 'text/html');
		$this->email->from('zamroni666@gmail.com', 'JOKER');
		$this->email->to('kaishasatrio@match-advertising.com');
		$this->email->subject('test mail');
		

		/*
		$message = '<p>Halo '.$this->session->userdata('full_name').'</p><br>';
		$message .= '<p>Terimakasih atas pemesanan yang anda lakukan di <a href="http://sitename.com">Sitename.com</a></p><br>';
		
		$message .= '<h3><strong>No Order :'.$this->session->userdata('kd_trans').'</strong><br></h3><br>';

		$message .= '<h3><strong>Detail Pemesanan :</strong><br></h3><br>';
		$message .='<table style="border:1px solid #000;" border="1" cellpadding=0>';
		$message .='<tr><td>Kode Produk</td><td>Nama Produk</td><td>Berat</td><td>Harga</td><td>Jumlah</td><td>Subtotal</td></tr>';
		foreach($this->cart->contents() as $items)
		{
			$message .= '<tr><td>'.$items["id"].'</td><td>'.$items["name"].'</td><td>'.$items["weight"].'</td><td>Rp.'.rupiah($items["price"]).'</td><td>'.$items["qty"].'</td><td>Rp.'.rupiah($items["subtotal"]).'</td></tr>';
		}
		$message .= '<tr><td>Total Belanja (belum biaya kirim): </td><td colspan=4>Rp.'.rupiah($this->cart->total()).'</td></tr>';
		$message .='</table><br>';
		$message .='<p>Harga di atas belum termasuk biaya kirim. Kami akan mengirimkan total yang harus anda bayar ke email anda dalam jangka waktu 1x24 jam.</p><br>';
		
		$message .= '<h3><strong>Kirim Biaya Pemesanan ke :</strong></h3><br>';
		$message .= '<p>Bank 1 :  Bank Syariah Mandiri(BSM) Nomor Rekening 0117035448 A/n Nurul Huda.</p><br>';
		$message .= '<p>Bank 2 :  Bank Syariah Mandiri(BSM) Nomor Rekening 0117035448 A/n Nurul Huda.</p><br>';
		$message .= '<p>Bank 3 :  Bank Syariah Mandiri(BSM) Nomor Rekening 0117035448 A/n Nurul Huda.</p><br>';
		$message .= '<p>Bank 4 :  Bank Muamalat Nomor Rekening 0130836391 A/n Gatot Satriyo.</p><br>';
		
		$message .= '<p>Kami akan memproses order Anda setelah kami menerima bukti atau info pembayaran(setelah kami cek) yang telah Anda lakukan.</p><br>';
		$message .='<p>Bila dalam waktu 1 minggu dari tanggal pendaftaran kami tidak menerima bukti atau info pembayaran dari Anda, kami menganggap Anda telah membatalkan order Anda. Silahkan untuk kunjungi <a href="http://katalogbatik.com">KatalogBatik.com</a> dan lakukan pemesanan kembali</p><br>';
		$message .='<p>Terima kasih, telah berbelanja</p>';				
		*/
		
		$noVer = $this->generate_random_string(4);
		$message = '<p>hello dunia</p><br>';
		$message .= '<p>No verifikasi anda : </p>'.$noVer;
		$message .='<p>Terima kasih,</p>';
		
		// $body = $this->load->view('email/confirm_order_html.php',$data,TRUE);
    	$this->email->message($message);   

		//$this->email->message(strip_tags($message));
		if($this->email->send() == false){
			show_error($this->email->print_debugger());
		}else{
			
		}

	}

	function generate_random_string($length) {
        $characters = '123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        // $length = 4;
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }	

}
