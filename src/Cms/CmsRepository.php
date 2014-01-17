<?php
namespace src\Cms;

use src\Repository\CommonRepository;

class CmsRepository extends CommonRepository {

    //specific stuff goes here
    public function findOneBySlug($slug) {
        $sql = "SELECT * FROM `$this->table` WHERE `slug` = '$slug' LIMIT 1";
        $cms = $this->db->fetchAssoc($sql);

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
