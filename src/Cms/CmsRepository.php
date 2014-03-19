<?php
namespace src\Cms;

use src\Repository\CommonRepository;

class CmsRepository extends CommonRepository {

    //specific stuff goes here
    public function find($id) {
        $sql = "SELECT * FROM `$this->table` WHERE `id` = '$id' LIMIT 1";
        $cms = $this->db->fetchAssoc($sql);

        $cms['is_visible'] = $cms['is_visible'] ? true : false;

        return $cms;
    }

    //specific stuff goes here
    public function findOneBySlug($slug) {
        $sql = "SELECT * FROM `$this->table` WHERE `slug` = '$slug' LIMIT 1";
        $cms = $this->db->fetchAssoc($sql);

        $cms['is_visible'] = $cms['is_visible'] ? true : false;

        return $cms;
    }

    public function findByHook($hook, $showHidden = false) {
        $visible = "AND `is_visible` = 1";
        if($showHidden){
            $visible = "";
        }
        $sql = "SELECT * FROM `$this->table` WHERE `hook` = $hook ".$visible;
        $cms = $this->db->fetchAll($sql);

        return $cms;
    }
}
