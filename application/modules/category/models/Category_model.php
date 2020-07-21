<?php


class Category_model extends CI_Model
{

    function get_category(){
        $sql = "SELECT * FROM web_catprod WHERE active_web_catprod = '1'";
        $query = $this->db->query($sql);
        return $query;
    }

    function get_color(){
        $sql = "SELECT * FROM web_color WHERE active_web_col = '1'";
        $query = $this->db->query($sql);
        return $query;
    }

    function get_all_products($cat, $id_web_user, $filters = null, $group_by = null, $order_by = null, $limit = null, $offset = null){
        date_default_timezone_set('Asia/Jakarta');

        $sql = "SELECT a.*, b.*, c.*, d.*, f.file_web_image, e.id_web_user_favorite, g.round_rating, g.rating, h.nominal_web_promosi, h.persen_web_promosi,
                    IF(h.nominal_web_promosi IS NULL, d.nominal_web_pricelist, h.nominal_web_promosi) as final_price
                FROM web_product a
                INNER JOIN web_catprod b ON a.ucode_catprod = b.id_web_catprod
                INNER JOIN web_color c ON a.ucode_col = c.ucode_web_col
                INNER JOIN web_pricelist d ON a.ucode_web_product = d.ucode_web_product
                LEFT JOIN web_user_favorite e ON e.ucode_web_product = a.ucode_web_product AND e.id_web_user = '".$id_web_user."'
                INNER JOIN web_image f ON a.ucode_web_product = f.ref_web_image AND f.image_order = '1'
                LEFT JOIN (
                    SELECT a.ucode_web_product, round(AVG(a.rating_web_ulasan),0) AS round_rating, round(AVG(rating_web_ulasan),1) AS rating
                    FROM web_ulasan a
                    GROUP BY a.ucode_web_product
                )g ON a.ucode_web_product = g.ucode_web_product
                LEFT JOIN web_promosi h ON h.ucode_web_product = a.ucode_web_product AND ('".date('Y-m-d H:i:s')."' BETWEEN h.start_web_promosi AND h.end_web_promosi)
                WHERE a.active_web_product = '1' 
                    AND b.id_web_catprod ='".$cat."'
                    AND b.active_web_catprod = '1'
                    AND c.active_web_col = '1'
                ";

        if($filters != null){
            foreach($filters as $filter){
                $sql .= " AND $filter ";
            }

        }

        if($group_by != null){
            $sql .= " GROUP BY $group_by ";
        }

        if($order_by != null){
            $sql .= " ORDER BY $order_by ";
        } else {
            $sql .= " ORDER BY 1 ";
        }

        if($limit != null && $offset != null){
            $sql .= " LIMIT $limit OFFSET $offset";
        }

        $query = $this->db->query($sql);
        return $query;
    }

    function get_category_name($id){
        $sql = "SELECT * FROM web_catprod WHERE id_web_catprod = '".$id."' ";
        $query = $this->db->query($sql);
        return $query;
    }
}