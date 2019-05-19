<?php
Class Kontak extends CI_Controller{

    var $API ="";

    function __construct() {
        parent::__construct();
        // $this->API="http://localhost/rest_ci/index.php";
        $this->API="http://test.sdcilsy-charlie.web.id:8080";
        // http://test.sdcilsy-charlie.web.id:8080/api/kontak/users        
        $this->load->library('session');
        $this->load->library('Curl');
        $this->load->helper('form');
        $this->load->helper('url');
    }

    // menampilkan data kontak
    function index(){
        // print_r('xxxxxxxxxxxxxxxxxxxxxxx');die();

        $data['datakontak'] = json_decode($this->curl->simple_get($this->API.'/kontak/index'));
        // print_r($data);die();
        $this->load->view('kontak/list',$data);
    }

    // insert data kontak
    function create(){
        // print_r($_POST);die();
        // if(isset($_POST['submit'])){
            $data = array(
                'id'       =>  $this->input->post('id'),
                'nama'      =>  $this->input->post('nama'),
                'nomor'=>  $this->input->post('nomor'),
                'email'      =>  $this->input->post('email'),
                'pesan'      =>  $this->input->post('pesan')
            );
            $insert =  $this->curl->simple_post($this->API.'/kontak', $data, array(CURLOPT_BUFFERSIZE => 10)); 
            if($insert)
            {
                $this->session->set_flashdata('hasil','Insert Data Berhasil');
            }else
            {
               $this->session->set_flashdata('hasil','Insert Data Gagal');
            }
            redirect('');
        // }else{
        //     $this->load->view('kontak/create');
        // }
    }

    // edit data kontak
    function edit(){
        if(isset($_POST['submit'])){
            $data = array(
                'id'       =>  $this->input->post('id'),
                'nama'      =>  $this->input->post('nama'),
                'nomor'=>  $this->input->post('nomor'));
            $update =  $this->curl->simple_put($this->API.'/kontak', $data, array(CURLOPT_BUFFERSIZE => 10)); 
            if($update)
            {
                $this->session->set_flashdata('hasil','Update Data Berhasil');
            }else
            {
               $this->session->set_flashdata('hasil','Update Data Gagal');
            }
            redirect('kontak');
        }else{
            $params = array('id'=>  $this->uri->segment(3));
            $data['datakontak'] = json_decode($this->curl->simple_get($this->API.'/kontak',$params));
            $this->load->view('kontak/edit',$data);
        }
    }

    // delete data kontak
    function delete($id){
        if(empty($id)){
            redirect('kontak');
        }else{
            $delete =  $this->curl->simple_delete($this->API.'/kontak', array('id'=>$id), array(CURLOPT_BUFFERSIZE => 10)); 
            if($delete)
            {
                $this->session->set_flashdata('hasil','Delete Data Berhasil');
            }else
            {
               $this->session->set_flashdata('hasil','Delete Data Gagal');
            }
            redirect('kontak');
        }
    }
}