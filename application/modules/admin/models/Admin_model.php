<?php
class Admin_model extends CI_Model
{
    function get_all_golongan(){
        $sql = "SELECT * FROM golongan";

        $query = $this->db->query($sql);
        return $query;
    }

    function get_all_rekening(){
        $sql = "SELECT * FROM rekening a
                INNER JOIN golongan b ON a.id_golongan = b.id_golongan";

        $query = $this->db->query($sql);
        return $query;
    }

    function get_all_arus_kas(){
        $sql = "SELECT * FROM arus_kas";

        $query = $this->db->query($sql);
        return $query;
    }

    function get_all_transaksi(){
        $sql = "SELECT a.*, d.*,
                b.id_rekening AS id_rekening_debet, b.nama_rekening AS nama_rekening_debet, b.no_rekening AS no_rekening_debet,
                c.id_rekening AS id_rekening_kredit, c.nama_rekening AS nama_rekening_kredit, c.no_rekening AS no_rekening_kredit
                FROM transaksi a
                INNER JOIN rekening b ON a.rekening_debet_transaksi = b.id_rekening
                INNER JOIN rekening c ON a.rekening_kredit_transaksi = c.id_rekening
                INNER JOIN arus_kas d ON a.arus_kas_transaksi = d.id_arus_kas";

        $query = $this->db->query($sql);
        return $query;
    }

    function get_subtotal($start_date, $end_date){
        $sql = "SELECT SUM(nominal_transaksi) AS subtotal
                FROM transaksi
                WHERE (tgl_transaksi BETWEEN '$start_date' AND '$end_date')";

        $query = $this->db->query($sql);
        return $query;
    }

    function get_golongan_by_id($id){
        $sql = "SELECT * FROM golongan WHERE id_golongan = '".$id."'";
        $query = $this->db->query($sql);
        return $query;
    }

    function get_rekening_by_id($id){
        $sql = "SELECT * FROM rekening a
                INNER JOIN golongan b ON a.id_golongan = b.id_golongan
                WHERE a.id_rekening = '".$id."'";

        $query = $this->db->query($sql);
        return $query;
    }

    function get_arus_kas_by_id($id){
        $sql = "SELECT * FROM arus_kas WHERE id_arus_kas = '".$id."'";
        $query = $this->db->query($sql);
        return $query;
    }

    function get_transaksi_by_id($id){
        $sql = "SELECT a.*, d.*,
                DATE_FORMAT(a.tgl_transaksi, '%Y-%m-%d') AS custom_tgl_transaksi,
                b.id_rekening AS id_rekening_debet, b.nama_rekening AS nama_rekening_debet, b.no_rekening AS no_rekening_debet,
                c.id_rekening AS id_rekening_kredit, c.nama_rekening AS nama_rekening_kredit, c.no_rekening AS no_rekening_kredit
                FROM transaksi a
                INNER JOIN rekening b ON a.rekening_debet_transaksi = b.id_rekening
                INNER JOIN rekening c ON a.rekening_kredit_transaksi = c.id_rekening
                INNER JOIN arus_kas d ON a.arus_kas_transaksi = d.id_arus_kas
                WHERE a.id_transaksi = '".$id."'";

        $query = $this->db->query($sql);
        return $query;
    }

    function get_bukubesar($no_rek, $s_n){
//        $sql = "SELECT a.*, (@mutasi := @mutasi + IF(a.DEBET <> 0, a.DEBET, (-1 * a.KREDIT))) AS MUTASI
//                FROM
//                (
//                    SELECT a.tgl_transaksi, a.keterangan_transaksi, IF(b.no_rekening = '$no_rek', a.nominal_transaksi, 0) AS DEBET,  IF(c.no_rekening = '$no_rek', a.nominal_transaksi, 0) AS KREDIT
//                    FROM transaksi a
//                    INNER JOIN rekening c ON c.id_rekening = a.rekening_kredit_transaksi
//                    INNER JOIN rekening b ON b.id_rekening = a.rekening_debet_transaksi
//                    WHERE b.no_rekening = '$no_rek' OR c.no_rekening = '$no_rek'
//                    ORDER BY tgl_transaksi
//                ) a
//                CROSS JOIN (select @mutasi := 0) params";

        $sql = "SELECT a.*, IF('$s_n' = 'Debet', (@mutasi := @mutasi + IF(a.DEBET <> 0, a.DEBET, (-1 * a.KREDIT))), (@mutasi := @mutasi + IF(a.KREDIT <> 0, a.KREDIT, (-1 * a.DEBET)))) AS MUTASI
                FROM
                (
                    SELECT a.tgl_transaksi, a.keterangan_transaksi, IF(b.no_rekening = '$no_rek', a.nominal_transaksi, 0) AS DEBET,  IF(c.no_rekening = '$no_rek', a.nominal_transaksi, 0) AS KREDIT
                    FROM transaksi a
                    INNER JOIN rekening c ON c.id_rekening = a.rekening_kredit_transaksi
                    INNER JOIN rekening b ON b.id_rekening = a.rekening_debet_transaksi
                    WHERE b.no_rekening = '$no_rek' OR c.no_rekening = '$no_rek'
                    ORDER BY tgl_transaksi
                ) a
                CROSS JOIN (select @mutasi := 0) params";

        $query = $this->db->query($sql);
        return $query;
    }

    function get_saldo_summary($no_rek){
        $sql = "SELECT * 
                FROM (
                    SELECT a.*,
                           (@debet := @debet + IF(b.no_rekening = '$no_rek', a.nominal_transaksi, 0)) AS TOTAL_DEBET,
                           (@kredit := @kredit + IF(c.no_rekening = '$no_rek', a.nominal_transaksi, 0)) AS TOTAL_KREDIT
                    FROM transaksi a
                    CROSS JOIN (select @debet := 0, @kredit := 0) params
                    INNER JOIN rekening b ON b.id_rekening = a.rekening_debet_transaksi
                    INNER JOIN rekening c ON c.id_rekening = a.rekening_kredit_transaksi
                    WHERE b.no_rekening = '$no_rek' OR c.no_rekening = '$no_rek'
                ) a
                ORDER BY a.id_transaksi DESC LIMIT 1";

        $query = $this->db->query($sql);
        return $query;
    }

    function add_golongan($data){
        $input_data = array(
            'no_golongan' => $data['no_golongan'],
            'nama_golongan' => $data['nama_golongan'],
            's_n_golongan' => $data['s_n_golongan'],
            'neraca' => $data['neraca']
        );

        $this->db->insert('golongan',$input_data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function add_rekening($data){
        $input_data = array(
            'no_rekening' => $data['no_rekening'],
            'nama_rekening' => $data['nama_rekening'],
            'id_golongan' => $data['id_golongan']
        );

        $this->db->insert('rekening',$input_data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function add_arus_kas($data){
        $input_data = array(
            'nama_arus_kas' => $data['nama_arus_kas']
        );

        $this->db->insert('arus_kas',$input_data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function add_transaksi($data){
        $input_data = array(
            'tgl_transaksi' => $data['tgl_transaksi'],
            'keterangan_transaksi' => $data['keterangan_transaksi'],
            'rekening_debet_transaksi' => $data['rekening_debet_transaksi'],
            'rekening_kredit_transaksi' => $data['rekening_kredit_transaksi'],
            'nominal_transaksi' => $data['nominal_transaksi'],
            'arus_kas_transaksi' => $data['arus_kas_transaksi']
        );

        $this->db->insert('transaksi',$input_data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function update_golongan($updated_data, $id_golongan){
        $this->db->where('id_golongan', $id_golongan);
        return $this->db->update('golongan',$updated_data);
    }

    function update_rekening($updated_data, $id_rekening){
        $this->db->where('id_rekening', $id_rekening);
        return $this->db->update('rekening',$updated_data);
    }

    function update_arus_kas($updated_data, $id_arus_kas){
        $this->db->where('id_arus_kas', $id_arus_kas);
        return $this->db->update('arus_kas',$updated_data);
    }

    function update_transaksi($updated_data, $id_transkasi){
        $this->db->where('id_transaksi', $id_transkasi);
        return $this->db->update('transaksi',$updated_data);
    }

    function get_record_year(){
        $sql = "SELECT YEAR(tgl_transaksi)
                FROM transaksi
                GROUP BY YEAR(tgl_transaksi)";

        $query = $this->db->query($sql);
        return $query;
    }

}
?>