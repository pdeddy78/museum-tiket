<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Laporan_model extends CI_Model {

    public function getLoket()
    {
        $this->db->select("id_loket, nama_loket");
        return $this->db->get("TMLoket")->result();
    }

    public function cari($tgl_transaksi1, $tgl_transaksi2, $id_loket)
    {
        $where = "TTTiket.tgl_transaksi BETWEEN '".$tgl_transaksi1." 00:00:00' AND '".$tgl_transaksi2." 00:00:00'";
        return $this->db->where($where)
                        ->where('TTTiket.id_loket =',$id_loket)
                        ->join('TMTiket', 'TTTiket.id_tiket = TMTiket.id_tiket')
                        ->join('TMDiskon', 'TTTiket.id_diskon = TMDiskon.id_diskon', 'left')
                        ->join('TMStaf', 'TTTiket.id_guide = TMStaf.id_staf', 'left')
                        ->get('TTTiket');
    }

    public function cariWilayah($tgl_transaksi1, $tgl_transaksi2, $id_loket)
    {
        $where = "TTTiket.tgl_transaksi BETWEEN '".$tgl_transaksi1." 00:00:00' AND '".$tgl_transaksi2." 00:00:00'";
        return $this->db->select('TMWilayah.asal_wilayah, COUNT(id_transaksi) AS Jumlah' )
                        ->where($where)
                        ->where('TTTiket.id_loket =',$id_loket)
                        ->group_by('TTTiket.id_wilayah')
                        ->join('TMWilayah', 'TTTiket.id_wilayah = TMWilayah.id_wilayah', 'left')
                        ->get('TTTiket');
    }

}