<?php

namespace App\Controllers;

use App\Models\KategoriModel;
use App\Models\KendaraanModel;
use App\Models\MemberModel;
use App\Models\UserModel;

class Admin extends BaseController
{
    protected $userModel;
    protected $memberModel;
    protected $kendaraanModel;
    protected $kategoriModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->memberModel = new MemberModel();
        $this->kendaraanModel = new KendaraanModel();
        $this->kategoriModel = new KategoriModel();
    }
    public function index()
    {
        // $query = $this->db->query('SELECT * FROM my_table');
        // echo $query->num_rows();
        $kasir = $this->userModel->query("SELECT * FROM user")->getNumRows();
        $kendaraan = $this->userModel->query("SELECT * FROM data_kendaraan WHERE bayar != ''")->getNumRows();
        $member = $this->userModel->query("SELECT * FROM member")->getNumRows();

        $data = [
            'kasir' => $kasir,
            'kendaraan' => $kendaraan,
            'member' => $member,
        ];
        return view('admin/index', $data);
    }
    public function kasir()
    {
        $data = [
            'kasir' => $this->userModel->findAll(),
            'validation' => \Config\Services::validation()
        ];
        return view('admin/kasir', $data);
    }
    public function transaksi()
    {
        $data = [
            'kendaraan' => $this->kendaraanModel->getKendaraan()
        ];

        return view('admin/transaksi', $data);
    }
    public function exportTransaksi()
    {
        $tgl_awal = $this->request->getVar('tgl_awal') . ' 00:00:00';
        $tgl_akhir = $this->request->getVar('tgl_akhir') . ' 23:59:59';

        $data = $this->kendaraanModel->getKendaraan($tgl_awal, $tgl_akhir);

        $mpdf = new \Mpdf\Mpdf();
        $html = '<html lang="en">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Laporan Transaksi</title>
        </head>
        <body>
            <div class="container">
                <div class="row my-2">
                        <div class="col">
                            <h1 style="text-align:center;">Laporan Transaksi</h1>
                            <table  border="1" cellpadding="10" cellspacing="0" style="text-align:center;">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Kategori</th>
                                        <th scope="col">Nomor Polisi</th>
                                        <th scope="col">Jam Masuk</th>
                                        <th scope="col">Jam keluar</th>
                                        <th scope="col">Bayar</th>
                                        <th scope="col">Status Member</th>
                                        <th scope="col">Kasir</th>
                                    </tr>
                                </thead>
                            ';
        $no = 1;
        foreach ($data as $d) {
            $jam_masuk = date('d-m-Y H:i:s', strtotime($d['jam_masuk']));
            $jam_keluar = date('d-m-Y H:i:s', strtotime($d['jam_keluar']));
            if ($d['bayar'] == 'free') {
                $bayar = 'free';
            } else {
                $bayar = number_format(intval($d['bayar']), 0, ',', '.');
            }
            $html .= '
                       <tr>
                            <th scope="row">' . $no++ . '</th>
                            <td>' . $d['nm_kategori'] . '</td>
                            <td>' . $d['no_pol'] . '</td>
                            <td>' . $jam_masuk . '</td>
                            <td>' . $jam_keluar . '</td>
                            <td>' . $bayar  . '</td>
                            <td>' . $d['status_member'] . '</td>
                            <td>' . $d['nm_user'] . '</td>
                        </tr>
            ';
        }
        $html .= '
                            </table>
                        </div>
                    </div>
                </div>
            </body>
        </html>
        ';

        $mpdf->WriteHTML($html);
        $mpdf->Output('Data-Transaksi_' . date('d-m-Y', strtotime($this->request->getVar('tgl_awal'))) . '_s/d_' . date('d-m-Y', strtotime($this->request->getVar('tgl_akhir'))) . '.pdf', 'D');
    }
    public function member()
    {
        $data = [
            'member' => $this->memberModel->findAll(),
            'validation' => \Config\Services::validation()
        ];

        return view('admin/member', $data);
    }
    public function kategori()
    {
        $data = [
            'kategori' => $this->kategoriModel->findAll()
        ];
        return view('admin/kategori', $data);
    }
    public function tambahKategori()
    {
        if (!$this->validate([
            'nm_kategori' => 'is_unique[kategori.nm_kategori]'
        ])) {
            session()->setFlashdata('danger', 'Kategori sudah terdaftar.');
            return redirect()->to('/admin/kategori');
        }
        $data_input = [
            'nm_kategori' => $this->request->getVar('nm_kategori'),
            'harga_jam' => $this->request->getVar('harga_jam')
        ];

        $this->kategoriModel->save($data_input);

        return redirect()->to('/admin/kategori');
    }
    public function hapusKategori($id)
    {
        $this->kategoriModel->delete($id);

        session()->setFlashdata('success', 'Kasir berhasil dihapus.');
        return redirect()->to('/admin/kategori');
    }
    public function updateKategori($id)
    {
        $data = [
            'id_kategori' => $id,
            'nm_kategori' => $this->request->getVar('nm_kategori'),
            'harga_jam'    => $this->request->getVar('harga_jam')
        ];

        $this->kategoriModel->save($data);

        session()->setFlashdata('success', 'Data berhasil diubah.');

        return redirect()->to('/admin/kategori');
    }
    public function tambahKasir()
    {
        if (!$this->validate([
            'username' => 'is_unique[user.username]'
        ])) {
            session()->setFlashdata('danger', 'Username sudah terdaftar.');
            return redirect()->to('/admin/kasir');
        }
        $data_input = [
            'nm_user' => $this->request->getVar('nm_user'),
            'username' => $this->request->getVar('username'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'role' => $this->request->getVar('role')
        ];

        $this->userModel->save($data_input);

        return redirect()->to('/admin/kasir');
    }
    public function hapusKasir($id)
    {
        $this->userModel->delete($id);

        session()->setFlashdata('success', 'Kasir berhasil dihapus.');
        return redirect()->to('/admin/kasir');
    }
    public function editKasir($id)
    {
        $data = [
            'kasir' => $this->userModel->where('id_user', $id)->first()
        ];

        return view('admin/edit/editUser', $data);
    }
    public function ubahStatus()
    {
        $status = $this->request->getVar('status');
        if ($status == 'aktif') {
            $ubahStatus = 'non-aktif';
        } else {
            $ubahStatus = 'aktif';
        }
        $data = [
            'id_user' => $this->request->getVar('id_user'),
            'status' => $ubahStatus,
        ];
        $this->userModel->save($data);
        session()->setFlashdata('success', 'Berhasil merubah status');
        return redirect()->to('/admin/kasir');
    }
    public function updateKasir($id)
    {
        if (!empty($this->request->getVar('passwordBaru'))) {
            $password = password_hash($this->request->getVar('passwordBaru'), PASSWORD_DEFAULT);
        } else {
            $password = $this->request->getVar('passwordLama');
        }
        $data = [
            'id_user' => $id,
            'nm_user' => $this->request->getVar('nm_user'),
            'username' => $this->request->getVar('username'),
            'password' => $password,
            'role' => $this->request->getVar('role')
        ];

        $this->userModel->save($data);

        session()->setFlashdata('success', 'Data berhasil diubah.');

        return redirect()->to('/admin/kasir');
    }
    public function tambahMember()
    {
        if (!$this->validate([
            'no_pol' => 'is_unique[member.no_pol]'
        ])) {
            session()->setFlashdata('danger', 'Nomor Polisi sudah terdaftar.');
            return redirect()->to('/admin/member');
        }
        $data_input = [
            'nm_member' => $this->request->getVar('nm_member'),
            'no_pol' => $this->request->getVar('noPol'),
        ];

        $this->memberModel->save($data_input);

        return redirect()->to('/admin/member');
    }
    public function hapusMember($id)
    {
        $this->memberModel->delete($id);
        session()->setFlashdata('success', 'Member berhasil dihapus.');
        return redirect()->to('/admin/member');
    }
    public function updateMember($id)
    {
        $data = [
            'id_member' => $id,
            'nm_member' => $this->request->getVar('nm_member'),
            'no_pol'    => $this->request->getVar('noPol')
        ];

        $this->memberModel->save($data);

        session()->setFlashdata('success', 'Data berhasil diubah.');

        return redirect()->to('/admin/member');
    }
}
