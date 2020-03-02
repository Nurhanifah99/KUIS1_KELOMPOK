<?php
defined('BASEPATH') or exit('No direct script access allowed');

class surat_masuk extends CI_Controller
{

        public function __construct()
        {
                parent::__construct();
                $this->load->model('suratmasuk_model');
        }

        public function index()
        {
                //$this->load->database();
                //$this->load->model('mahasiswa_model');
                $data['title'] = 'List Surat';
                $data['surat_masuk'] = $this->suratmasuk_model->getAllsurat_masuk();
                if ($this->input->post('keyword')) {
                        # code...
                        $data['surat_masuk'] = $this->suratmasuk_model->cariDataSurat();
                }
                $this->load->view('template/header', $data);
                $this->load->view('surat_masuk/index', $data);
                $this->load->view('template/footer');
        }

        public function tambah()
        {
                $this->load->model('suratmasuk_model');
                $data['title'] = 'Form Menambahkan Data Surat';
                $this->load->model('instansi_model');
                $data['instansi'] = $this->instansi_model->getAllinstansi();

                $this->load->helper(array('form', 'url'));
                $this->load->library('form_validation');
                $this->form_validation->set_rules('no_agenda', 'No_agenda', 'required|numeric');
                $this->form_validation->set_rules('isi_ringkasan', 'Isi_ringkasan', 'required');
                $this->form_validation->set_rules('no_surat', 'No_surat', 'required');
                $this->form_validation->set_rules('tgl_surat', 'Tgl_surat', 'required|date');
                $this->form_validation->set_rules('tgl_diterima', 'Tgl_diterima', 'required|date');
                $this->form_validation->set_rules('penerima', 'Penerima', 'required');
                $this->form_validation->set_rules('nomor_instansi', 'Nomor_instansi', 'required|numeric');
                if ($this->form_validation->run() == FALSE) {
                        $this->load->view('template/header', $data);
                        $this->load->view('surat_masuk/tambah', $data);
                        $this->load->view('template/footer');
                } else {
                        $this->suratmasuk_model->tambahdatasrtmk();
                        $this->session->set_flashdata('flash-data', 'ditambahkan');

                        redirect('surat_masuk', 'refresh');
                }
        }

        public function hapus($kode_surat)
        {
                $this->suratmasuk_model->hapusdatasrtmk($kode_surat);
                $this->session->set_flashdata('flash-data', 'dihapus');

                redirect('surat_masuk', 'refresh');
        }

        public function detail($kode_surat)
        {
                $data['title'] = 'Detail Surat';
                $data['surat_masuk'] = $this->suratmasuk_model->getsuratByID($kode_surat);
                $this->load->view('template/header', $data);
                $this->load->view('surat_masuk/detail', $data);
                $this->load->view('template/footer');
        }

        public function edit($kode_surat)
        {
                $data['title'] = 'Form Edit Data Surat';
                $this->load->model('instansi_model');
                $this->load->model('suratmasuk_model');

                $data['instansi'] = $this->instansi_model->getAllinstansi();
                $data['surat_masuk'] = $this->suratmasuk_model->getsuratByID($kode_surat);
                // $data['jurusan']=['Teknik Informatika','Teknik Kimia','Teknik Industri','Teknik Mesin'];
                $this->load->helper(array('form', 'url'));
                $this->load->library('form_validation');
                $this->form_validation->set_rules('no_agenda', 'No_agenda', 'required|numeric');
                $this->form_validation->set_rules('isi_ringkasan', 'Isi_ringkasan', 'required');
                $this->form_validation->set_rules('no_surat', 'No_surat', 'required');
                $this->form_validation->set_rules('tgl_surat', 'Tgl_surat', 'required|date');
                $this->form_validation->set_rules('tgl_diterima', 'Tgl_diterima', 'required|date');
                $this->form_validation->set_rules('penerima', 'Penerima', 'required');
                $this->form_validation->set_rules('nomor_instansi', 'Nomor_instansi', 'required');

                if ($this->form_validation->run() == FALSE) {
                        $this->load->view('template/header', $data);
                        $this->load->view('surat_masuk/edit', $data);
                        $this->load->view('template/footer');
                } else {
                        $this->suratmasuk_model->ubahdatasrtmk();
                        $this->session->set_flashdata('flash-data', 'diedit');

                        redirect('surat_masuk', 'refresh');
                }
        }
}
