<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    public function index(){
        $data['title'] = 'My Profile';
           
        $data['user'] = $this->db->get_where('pegawai', ['nip' =>
        $this->session->userdata('nip')])->row_array();


        $this->load->view('templates/header',$data);
        $this->load->view('templates/topbar',$data);
        $this->load->view('templates/sidebar');
        $this->load->view('profile/index');
        $this->load->view('templates/footer');
    }

    public function edit(){
        $data['title'] = 'Edit Profile';
           
        $data['user'] = $this->db->get_where('pegawai', ['nip' =>
        $this->session->userdata('nip')])->row_array();

        // $this->form_validation->set_rules('nama_lengkap','Full Name','required|trim');
        $this->form_validation->set_rules('email','Email','required|trim|valid_email|is_unique[pegawai.email]',[
            'is_unique' => 'This email has already registered!'
        ]);

        if($this->form_validation->run() == FALSE){
            $this->load->view('templates/header',$data);
            $this->load->view('templates/topbar',$data);
            $this->load->view('templates/sidebar');
            $this->load->view('profile/edit');
            $this->load->view('templates/footer');
        }
        else{
            
            $data = array(
                'email' => $this->input->post('email',TRUE)
            );

            $this->db->where('nip',$nip = $this->input->post('nip',TRUE));
            $this->db->update('pegawai',$data);

            $this->session->set_flashdata('flash','Berhasil Diupdate');
             redirect('profile');
        }
    }

    public function change_password(){
        $data['title'] = 'Change Password';
		$data['user'] = $this->db->get_where('pegawai', ['nip' =>
        $this->session->userdata('nip')])->row_array();


        $this->form_validation->set_rules('current_password','Current Password','required|trim');
        $this->form_validation->set_rules('new_password1',' New Password','required|trim|min_length[5]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2','Confirm New Password','required|trim|min_length[5]|matches[new_password1]');

        if($this->form_validation->run() == FALSE){
            $this->load->view('templates/header',$data);
            $this->load->view('templates/topbar',$data);
            $this->load->view('templates/sidebar');
            $this->load->view('profile/change_password');
            $this->load->view('templates/footer');
        }
        else{
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');

            if(!password_verify($current_password,$data['user']['password'])){
                $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
                Wrong current wassword! </div>');
                redirect('profile/change_password');
            }
            else{
                if($current_password == $new_password){
                    $this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">
                    New password cannot be the same as current password</div>');
                    redirect('profile/change_password');
                }
                else{
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password',$password_hash);
                    $this->db->where('nip',$this->session->userdata('nip'));
                    $this->db->update('pegawai');

                    $this->session->set_flashdata('flash','Berhasil Diupdate');
                redirect('profile');
                }
            }
        }
    }
}