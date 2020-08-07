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
                INNER JOIN arus_kas d ON a.arus_kas_transaksi = d.id_arus_kas
                ORDER BY a.year_transaksi, a.month_transaksi, a.tgl_transaksi";

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

    function get_saldo_golongan($month, $year){
        $sql = "SELECT a.no_golongan, a.nama_golongan, a.neraca, a.s_n_golongan, 
                    IFNULL(monthly_debet.TOTAL_DEBET,0) AS MONTHLY_DEBET, 
                    IFNULL(monthly_kredit.TOTAL_KREDIT,0) AS MONTHLY_KREDIT, 
                    IF(a.s_n_golongan = 'Debet', IFNULL(monthly_debet.TOTAL_DEBET,0) - IFNULL(monthly_kredit.TOTAL_KREDIT, 0), IFNULL(monthly_kredit.TOTAL_KREDIT, 0) -  IFNULL(monthly_debet.TOTAL_DEBET,0)) AS MONTHLY_TOTAL,
                    
                    IFNULL(debet.TOTAL_DEBET,0) AS TOTAL_DEBET, 
                    IFNULL(kredit.TOTAL_KREDIT, 0) AS TOTAL_KREDIT,
                    IF(a.s_n_golongan = 'Debet', IFNULL(debet.TOTAL_DEBET,0) - IFNULL(kredit.TOTAL_KREDIT, 0), IFNULL(kredit.TOTAL_KREDIT, 0) -  IFNULL(debet.TOTAL_DEBET,0)) AS TOTAL,
       
                    a.harta_aset_bersih
                FROM golongan a
                LEFT JOIN
                (
                    SELECT SUM(a.nominal_transaksi) as TOTAL_DEBET, b.id_golongan AS GOLONGAN_DEBET
                    FROM transaksi a
                    INNER JOIN (
                        SELECT a.*, b.no_golongan, b.nama_golongan 
                        FROM rekening a
                        INNER JOIN golongan b ON a.id_golongan = b.id_golongan
                    ) b ON a.rekening_debet_transaksi = b.id_rekening
                    WHERE a.month_transaksi <= '$month' AND a.year_transaksi = '$year'
                    GROUP BY b.id_golongan
                ) monthly_debet ON a.id_golongan = monthly_debet.GOLONGAN_DEBET
                LEFT JOIN (
                    SELECT SUM(a.nominal_transaksi) as TOTAL_KREDIT, c.id_golongan AS GOLONGAN_KREDIT
                    FROM transaksi a
                    INNER JOIN (
                        SELECT a.*, b.no_golongan, b.nama_golongan 
                        FROM rekening a
                        INNER JOIN golongan b ON a.id_golongan = b.id_golongan
                    ) c ON a.rekening_kredit_transaksi = c.id_rekening
                    WHERE a.month_transaksi <= '$month' AND a.year_transaksi = '$year'
                    GROUP BY c.id_golongan
                ) monthly_kredit on a.id_golongan = monthly_kredit.GOLONGAN_KREDIT
                
                
                LEFT JOIN
                (
                    SELECT SUM(a.nominal_transaksi) as TOTAL_DEBET, b.id_golongan AS GOLONGAN_DEBET
                    FROM transaksi a
                    INNER JOIN (
                        SELECT a.*, b.no_golongan, b.nama_golongan 
                        FROM rekening a
                        INNER JOIN golongan b ON a.id_golongan = b.id_golongan
                    ) b ON a.rekening_debet_transaksi = b.id_rekening
                    GROUP BY b.id_golongan
                ) debet ON a.id_golongan = debet.GOLONGAN_DEBET
                LEFT JOIN (
                    SELECT SUM(a.nominal_transaksi) as TOTAL_KREDIT, c.id_golongan AS GOLONGAN_KREDIT
                    FROM transaksi a
                    INNER JOIN (
                        SELECT a.*, b.no_golongan, b.nama_golongan 
                        FROM rekening a
                        INNER JOIN golongan b ON a.id_golongan = b.id_golongan
                    ) c ON a.rekening_kredit_transaksi = c.id_rekening
                    GROUP BY c.id_golongan
                ) kredit on a.id_golongan = kredit.GOLONGAN_KREDIT
                ORDER BY no_golongan
                ";

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
                    SELECT a.tgl_transaksi, a.month_transaksi, a.year_transaksi, a.keterangan_transaksi, IF(b.no_rekening = '$no_rek', a.nominal_transaksi, 0) AS DEBET,  IF(c.no_rekening = '$no_rek', a.nominal_transaksi, 0) AS KREDIT
                    FROM transaksi a
                    INNER JOIN rekening c ON c.id_rekening = a.rekening_kredit_transaksi
                    INNER JOIN rekening b ON b.id_rekening = a.rekening_debet_transaksi
                    WHERE b.no_rekening = '$no_rek' OR c.no_rekening = '$no_rek'
                    ORDER BY a.year_transaksi, a.month_transaksi, a.tgl_transaksi
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
                ORDER BY a.year_transaksi DESC, a.month_transaksi DESC, a.tgl_transaksi DESC LIMIT 1";

        $query = $this->db->query($sql);
        return $query;
    }

    function get_mutasi($no_rek, $s_n, $year){
        $sql = "SELECT a.*, IF(a.mutasi <> 0,(@saldo := @saldo + a.MUTASI), 0) AS SALDO
                FROM (
                SELECT m. months, IFNULL(SUM(debet.TOTAL_DEBET),0) AS DEBET, IFNULL(SUM(kredit.TOTAL_KREDIT), 0) AS KREDIT,
                    IF('$s_n' = 'Debet', IFNULL(SUM(debet.TOTAL_DEBET),0) - IFNULL(SUM(kredit.TOTAL_KREDIT), 0), IFNULL(SUM(kredit.TOTAL_KREDIT), 0) -  IFNULL(SUM(debet.TOTAL_DEBET),0)) AS MUTASI
                FROM months m
                LEFT JOIN (
                    SELECT a.month_transaksi as MONTH_DEBET, SUM(a.nominal_transaksi) as TOTAL_DEBET 
                    FROM transaksi a
                    INNER JOIN rekening b ON b.id_rekening = a.rekening_debet_transaksi
                    WHERE b.no_rekening = '$no_rek' AND a.year_transaksi = '$year'
                    GROUP BY a.month_transaksi
                ) debet ON debet.MONTH_DEBET = m.idmonths
                LEFT JOIN (
                    SELECT a.month_transaksi as MONTH_KREDIT, SUM(a.nominal_transaksi) as TOTAL_KREDIT
                    FROM transaksi a
                    INNER JOIN rekening b ON b.id_rekening = a.rekening_kredit_transaksi
                    WHERE b.no_rekening = '$no_rek' AND a.year_transaksi = '$year'
                    GROUP BY a.month_transaksi
                ) kredit on kredit.MONTH_KREDIT = m.idmonths
                GROUP BY m.idmonths
            ) a
            CROSS JOIN (select @saldo := 0) params";

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
            'arus_kas_transaksi' => $data['arus_kas_transaksi'],
            'month_transaksi' => $data['month_transaksi'],
            'year_transaksi' => $data['year_transaksi']
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
        $sql = "SELECT year_transaksi AS year
                FROM transaksi
                GROUP BY year_transaksi
                ORDER BY year_transaksi DESC";

        $query = $this->db->query($sql);
        return $query;
    }

}
?>