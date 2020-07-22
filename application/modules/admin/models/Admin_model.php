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

    function add_golongan($data){
        $input_data = array(
            'no_golongan' => $data['no_golongan'],
            'nama_golongan' => $data['nama_golongan'],
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
            's_n_rekening' => $data['s_n_rekening'],
            'id_golongan' => $data['id_golongan']
        );

        $this->db->insert('rekening',$input_data);
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
}
?>