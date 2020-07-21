<?php
class Rekomendasi_model extends CI_Model
{

    function get_all_rekomendasi($id_web_user, $limit = null, $offset = null){
        date_default_timezone_set('Asia/Jakarta');

        $sql = "SELECT a.*, b.*, c.*, d.*, f.file_web_image, e.id_web_user_favorite, g.round_rating, g.rating, h.nominal_web_promosi, h.persen_web_promosi
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
                    AND b.active_web_catprod = '1'
                    AND c.active_web_col = '1'
                ";

        if($limit != null && $offset != null){
            $sql .= " LIMIT $limit OFFSET $offset";
        }

        $query = $this->db->query($sql);
        return $query;
    }

    function get_rekomendasi_by_user($id_web_user, $limit = null, $offset = null){
        date_default_timezone_set('Asia/Jakarta');

        $sql = "SELECT h.count, a.*, b.*, c.*, d.*, f.file_web_image, e.id_web_user_favorite, g.round_rating, g.rating, h.nominal_web_promosi, h.persen_web_promosi
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
                LEFT JOIN (
					SELECT a.detail_web_user_activity, SUM(a.count_web_user_activity) as count
					FROM web_user_activity a
					WHERE a.id_web_user = '".$id_web_user."'
					AND a.tipe_web_user_activity = 'CATEGORY'
					GROUP BY a.detail_web_user_activity
                )h ON b.nama_web_catprod = h.detail_web_user_activity
                LEFT JOIN web_promosi h ON h.ucode_web_product = a.ucode_web_product AND ('".date('Y-m-d H:i:s')."' BETWEEN h.start_web_promosi AND h.end_web_promosi)
                WHERE a.active_web_product = '1' 
                    AND b.active_web_catprod = '1'
                    AND c.active_web_col = '1'
				ORDER BY h.count DESC
                ";

        if($limit != null && $offset != null){
            $sql .= " LIMIT $limit OFFSET $offset";
        }

        $query = $this->db->query($sql);
        return $query;
    }

}
?>


















