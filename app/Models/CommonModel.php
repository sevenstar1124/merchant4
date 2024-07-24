<?php

namespace App\Models;

use CodeIgniter\Model;

class CommonModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function createData($table, $insertData = [])
    {
        $this->db->table($table)->insert($insertData);
        $id = $this->db->insertID();
        return $this->db->table($table)->where(['id' => $id])->get()->getRowArray();
    }

    public function readData($table, $where)
    {
        return $this->db->table($table)->where($where)->get()->getRowArray();
    }

    public function readDatas($table, $where = [], $sort = "", $like = [])
    {
        $builder = $this->db->table($table);

        if (!empty($where)) $builder->where($where);
        if (!empty($like)) $builder->like($like);
        if ($sort !== "") $builder->orderBy($sort);

        return $builder->get()->getResultArray();
    }

    public function deleteData($table, $where = [])
    {
        $this->db->table($table)->delete($where);
    }

    public function updateData($table, $update_data = [], $where = [])
    {
        $this->db->table($table)->where($where)->update($update_data);
    }

    public function existsInTable($table, $field, $val)
    {
        $res = $this->db->table($table)->get()->getResultArray();

        foreach ($res as $row) {
            if ($row[$field] == $val) {
                return $row['id'];
            }
        }

        return false;
    }

    public function getRowByDate($table, $field, $date, $where = [])
    {
        $builder = $this->db->table($table);
        $builder->like($field, $date, 'after');

        if (!empty($where)) $builder->where($where);

        return $builder->countAllResults();
    }

    public function flashMessage($type, $message)
    {
        switch ($type) {
            case 'success':
                $data = '<div class="clsShow_Notification"><p class="success"><span>' . $message . '</span></p></div>';
                break;
            case 'error':
                $data = '<div class="clsShow_Notification"><p class="error"><span>' . $message . '</span></p></div>';
                break;
            default:
                $data = '';
                break;
        }
        return $data;
    }
}
