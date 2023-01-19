<?php

namespace App\Controllers;

use App\Models\KategoriModel;
use App\Models\KendaraanModel;
use App\Models\MemberModel;

class Kasir extends BaseController
{
    protected $kendaraanModel;
    protected $memberModel;
    protected $kategoriModel;
    public function __construct()
    {
        $this->kendaraanModel = new KendaraanModel();
        $this->memberModel = new MemberModel();
        $this->kategoriModel = new KategoriModel();
    }
    public function masuk()
    {
        $data = [
            'validation' => \Config\Services::validation(),
            'kategori' => $this->kategoriModel->findAll()

        ];
        return view('kasir/masuk', $data);
    }
    public function keluar()
    {
        $noPol = strtoupper(str_replace(' ', '', $this->request->getVar('keyword')));

        $kendaraan = $this->kendaraanModel->cariKendaraan($noPol);
        $jam_keluar = date('Y-m-d H:i:s');
        $bayar = '';

        if ($noPol) {
            if (empty($kendaraan)) {
                $kendaraan = false;
                session()->setFlashdata('danger', 'Kendaraan tidak terdaftar.');
            } else {
                if ($kendaraan['status_member'] == 'member') {
                    $bayar = 'free';
                } else {
                    $awal = date_create($kendaraan['jam_masuk']);
                    $akhir = date_create($jam_keluar);
                    $diff = date_diff($akhir, $awal);

                    $menit = intval(ceil(((intval($diff->h) * 60) + intval($diff->i)) / 60));
                    $harga_jam = intval($kendaraan['harga_jam']);
                    $bayar = $harga_jam * $menit;
                }
            }
        }


        $data = [
            'kendaraan' => $kendaraan,
            'jam_keluar' => $jam_keluar,
            'bayar' => $bayar
        ];

        // dd($data);
        return view('kasir/keluar', $data);
    }
    public function tambahMasuk()
    {
        $noPol = strtoupper($this->request->getVar('noPol'));
        $noPol = str_replace(' ', '', $noPol);
        $jam_masuk = date('Y-m-d H:i:s');
        $cekMember = $this->memberModel->where('no_pol', $noPol)->first();
        $where = "no_pol = '$noPol' ORDER BY jam_masuk DESC";
        $kendaraan = $this->kendaraanModel->where($where)->first();
        if ($kendaraan) {
            if ($kendaraan['jam_keluar'] == '') {
                session()->setFlashdata('danger', 'Kendaraan sudah terdaftar dan belum keluar.');
                return redirect()->to('/masuk')->withInput();
            }
        }
        if ($cekMember) {
            $member = 'member';
        } else {
            $member = 'non-member';
        }

        $data = [
            'id_kategori' => $this->request->getVar('kategori'),
            'no_pol' => $noPol,
            'jam_masuk' => $jam_masuk,
            'status_member' => $member,
            'id_user' => session()->get('id_user')
        ];

        $this->kendaraanModel->disableForeignKeyChecks();
        $this->kendaraanModel->save($data);
        $this->kendaraanModel->enableForeignKeyChecks();

        session()->setFlashdata('success', 'Berhasil menambah data.');
        return redirect()->to('/masuk');
    }

    public function bayar()
    {
        $data = [
            'id_kendaraan' => $this->request->getVar('id_kendaraan'),
            'id_kategori' => $this->request->getVar('id_kategori'),
            'no_pol' => $this->request->getVar('no_pol'),
            'jam_masuk' => date('Y-m-d H:i:s', strtotime($this->request->getVar('jam_masuk'))),
            'jam_keluar' => date('Y-m-d H:i:s', strtotime($this->request->getVar('jam_keluar'))),
            'bayar' => $this->request->getVar('bayar'),
            'id_user' => session()->get('id_user'),
            'status_member' => $this->request->getVar('member'),
        ];

        $this->kendaraanModel->disableForeignKeyChecks();
        $this->kendaraanModel->save($data);
        $this->kendaraanModel->enableForeignKeyChecks();
        session()->setFlashdata('success', 'Berhasil bayar.');
        return redirect()->to('/keluar');
    }
}
