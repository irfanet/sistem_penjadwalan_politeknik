<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function index()
	{
		 //validasi jika user belum login
		if($this->session->userdata('nip') == TRUE){
			redirect('dashboard');
		}else{
			if($this->session->userdata('jabatan') == "Mahasiswa"){
				redirect('dashboard');
			}
		}
		
		$data['title'] = 'Login Page';

		$this->form_validation->set_rules('email','Email','trim|required');
		$this->form_validation->set_rules('password','Password','trim|required');

		if($this->form_validation->run()==FALSE){
			$this->load->view('auth/index');
		}else{
			// validasinya success
			$this->_login();
		}
	}

	public function _login(){
		// $nip = $this->input->post('nip');
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$user = $this->db->get_where('pegawai', ['email' => $email])->row_array();
		$mhs = $this->db->get_where('mahasiswa', ['nim' => $email])->row_array();

		
		// jika usernya ada
		if($user || $mhs){
			//jika usernya aktif
			if($user['is_active']==1 || $mhs['is_active']==1){
				// cek password
				if(password_verify($password, $user['password'])){
					$data= [
						'nip' => $user['nip'],
						'id' => $user['id'],
						'id_prodi' => $user['id_prodi'],
						'jabatan' => $user['jabatan'],
						'golongan' => $user['golongan'],
						'nama' => $user['nama_singkat'],
						'nama_lengkap' => $user['nama_lengkap'],
						'email' => $user['email']
					];

					$this->session->set_userdata($data);
					if($user['jabatan']=='Kajur'){
						redirect('dashboard');
					}
					else if($user['jabatan']=='Kaprodi'){
						redirect('dashboard');
					}
					else if($user['jabatan']=='Dosen'){
						redirect('dashboard');
					}
					else if($user['jabatan']=='Panitia'){
						redirect('absensi');
					}
					else if($user['jabatan']=='Petugas'){
						redirect('penggandaan');
					}
				}	
				else if(password_verify($password,$mhs['password'])){
					$data= [
						'nim' => $mhs['nim'],
						'id' => $mhs['id'],
						'id_prodi' => $mhs['prodi'],
						'kelas' => $mhs['kelas'],
						'nama' => $mhs['nama'],
						'jabatan' => 'Mahasiswa'
					];
					$this->session->set_userdata($data);
					redirect('dashboard');
					
				}
				else{
					$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
					Login failed! Wrong password.</div>');
					redirect('auth');
				}
			}
			else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
			This Account has not been activited</div>');
				redirect('auth');
			}
		}
		else{
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
			Account is not registered</div>');
			redirect('auth');
		}
	}

	public function forgotPassword(){
        $data['title'] = 'Forgot Password';

		$this->form_validation->set_rules('email','Email','required|trim|valid_email');
		if($this->form_validation->run()==FALSE){
			$this->load->view('auth/forgot-password');
		}
		else{
			$email = $this->input->post('email');
			$user = $this->db->get_where('pegawai',['email' => $email, 'is_active' => 1])->row_array();

			if($user){
				$token = base64_encode(random_bytes(32));
				$user_token = [
					'email' => $email,
					'token' => $token,
					'date_created' => time()
				];

				$this->db->insert('user_token',$user_token);
				$this->_sendEmail($token,'forgot');

				$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
				Pleace check your email to reset your password!</div>');
				redirect('auth/forgotPassword');

			}
			else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
				Email is not registered or activated!</div>');
				redirect('auth/forgotPassword');
			}

		}
	}

	private function _sendEmail($token,$type){
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'satpolpp.provjateng@gmail.com',
            'smtp_pass' => 'satpolpp@30',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        ];


        $this->load->library('email',$config);  
        $this->email->initialize($config); 

        $this->email->from('satpolpp.provjateng@gmail.com','Satpol PP Prov. Jateng');
        $this->email->to($this->input->post('email'));

        if($type == 'forgot'){
            $this->email->subject('Reset Password');
            $this->email->message('Click this link to reset your password : <a href="'. base_url() . 'auth/resetpassword?email=' .$this->input->post('email') . '&token=' .urlencode($token). '">Reset Password</a>');
        }

        if($this->email->send()){
            return true;
        }
        else{
            echo $this->email->print_debugger();
            die;
        }
	}

	public function resetPassword(){
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user = $this->db->get_where('pegawai',['email' => $email])->row_array();

		if($user){
			$user_token = $this->db->get_where('user_token',['token' => $token])->row_array();
		
			if($user_token){
				$this->session->set_userdata('reset_email', $email);
				$this->changePassword();
			}
			else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
				Reset password failed! Wrong token.</div>');
				redirect('auth');
			}
		}
		else{
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
				Reset password failed! Wrong email.</div>');
				redirect('auth');
		}
	}

	public function changePassword(){

		if(!$this->session->userdata('reset_email')){
			redirect('auth');
		}

		$this->form_validation->set_rules('password1','Password','trim|required|min_length[5]|matches[password2]');
		$this->form_validation->set_rules('password2','Password','trim|required|min_length[5]|matches[password1]');

		if($this->form_validation->run()==FALSE){
			$data['title'] = 'Change Password!';
			$this->load->view('auth/change-password');
		}
		else{
			$password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
			$email = $this->session->userdata('reset_email');

			$this->db->set('password',$password);
			$this->db->where('email',$email);
			$this->db->update('pegawai');

			$this->session->unset_userdata('reset_email');
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
				Password has been changed! Please login.</div>');
				redirect('auth');

		}
			
	}

	public function logout(){

		$this->session->unset_userdata('nip');
		$this->session->unset_userdata('jabatan');
		$this->session->unset_userdata('nama');

		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">
			  You have been logout</div>');
			redirect('auth');
	}
}
