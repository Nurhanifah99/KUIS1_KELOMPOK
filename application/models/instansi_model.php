<?php
defined('BASEPATH') or exit('No direct script access allowed');

class instansi_model extends CI_Model
{

    public function getAllinstansi()
    {
        //https://www.codeigniter.com/user_guide/database/query_builder.html#selecting-data
        //$query untuk menampung isi dari tabel mahasiswa
        //$query=$this->db->get('mahasiswa');

        //https://www.codeigniter.com/user_guide/database/results.html
        //untuk menampilkan isi query
        //return $query->result_array();

        return $this->db->get('instansi')->result_array();
    }
    public function tambahdatains()
    {
        $data = [
            "nomor_instansi" => $this->input->post('nomor_instansi', true),
            "nama_instansi" => $this->input->post('nama_instansi', true),
            "alamat" => $this->input->post('alamat', true)
        ];

        $this->db->insert('instansi', $data);
    }

    public function hapusdatains($nomor_instansi)
    {
        $this->db->where('nomor_instansi', $nomor_instansi);
        $this->db->delete('instansi');
    }

    public function getinstansiByID($nomor_instansi)
    {
        return $this->db->get_where('instansi', ['nomor_instansi' => $nomor_instansi])->row();
    }

    public function ubahdatains()
    {
        $data = [
            "nomor_instansi" => $this->input->post('nomor_instansi', true),
            "nama_instansi" => $this->input->post('nama_instansi', true),
            "alamat" => $this->input->post('alamat', true)
        ];
        $this->db->where('nomor_instansi', $this->input->post('nomor_instansi'));
        $this->db->update('instansi', $data);
    }

    public function cariDataInstansi()
    {
        $keyword = $this->input->post('keyword');
        $this->db->like('nomor_instansi', $keyword);
        $this->db->or_like('nama_instansi', $keyword);
        return $this->db->get('instansi')->result_array();
    }
}
