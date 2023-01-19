<?php

namespace App\Models;

use CodeIgniter\Model;

class KendaraanModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'data_kendaraan';
    protected $primaryKey       = 'id_kendaraan';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_kategori', 'no_pol', 'jam_masuk', 'jam_keluar', 'bayar', 'id_user', 'status_member'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getKendaraan($tgl_awal = false, $tgl_akhir = false)
    {
        if ($tgl_awal && $tgl_akhir != false) {
            $where = "jam_keluar BETWEEN '$tgl_awal' AND '$tgl_akhir'";
            return $this->join('kategori', 'kategori.id_kategori=data_kendaraan.id_kategori')->join('user', 'user.id_user=data_kendaraan.id_user')->where($where)->get()->getResultArray();
        }
        return $this->join('kategori', 'kategori.id_kategori=data_kendaraan.id_kategori')->join('user', 'user.id_user=data_kendaraan.id_user')->get()->getResultArray();
    }

    public function cariKendaraan($keyword)
    {
        $where = "no_pol = '$keyword' ORDER BY jam_masuk DESC";
        return $this->join('kategori', 'kategori.id_kategori=data_kendaraan.id_kategori')->join('user', 'user.id_user=data_kendaraan.id_user')->where($where)->first();
    }
}
