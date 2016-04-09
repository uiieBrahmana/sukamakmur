<?php

class BaseModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    function FetchAll($sql, $arrdata = null)
    {
        $query = $this->db->query($sql, $arrdata);
        return $query->result_array();
    }

    function Save($sql, $arrdata)
    {
        $this->db->query($sql, $arrdata);
        return $this->db->insert_id();
    }

}