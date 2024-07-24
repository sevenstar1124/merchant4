<?php

namespace App\Models;

use CodeIgniter\Model;

class ConstantModel extends Model
{
    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }
    
    public function getDataAll($table, $order_column, $order_type)
    {
        return $this->db->table($table)
                        ->orderBy($order_column, $order_type)
                        ->get()
                        ->getResult();
    }
    
    // Query Data from Table by One Column;
    public function getDataOneColumn($table, $col1_name, $col1_value)
    {
        return $this->db->table($table)
                        ->where($col1_name, $col1_value)
                        ->get()
                        ->getResult();
    }
    
    // Query Data from Table By Two Columns;
    public function getDataTwoColumn($table, $col1_name, $col1_value, $col2_name, $col2_value)
    {
        return $this->db->table($table)
                        ->where($col1_name, $col1_value)
                        ->where($col2_name, $col2_value)
                        ->get()
                        ->getResult();
    }
    
    // Query Data from Table by One Column and Sort;
    public function getDataOneColumnSortColumn($table, $col1_name, $col1_value, $sort_column, $sort_type)
    {
        return $this->db->table($table)
                        ->where($col1_name, $col1_value)
                        ->orderBy($sort_column, $sort_type)
                        ->get()
                        ->getResult();
    }
    
    // Query Data from Table by Two Columns and Sort;
    public function getDataTwoColumnSortColumn($table, $col1_name, $col1_value, $col2_name, $col2_value, $sort_column, $sort_type)
    {
        return $this->db->table($table)
                        ->where($col1_name, $col1_value)
                        ->where($col2_name, $col2_value)
                        ->orderBy($sort_column, $sort_type)
                        ->get()
                        ->getResult();
    }
    
    // Not Equal To;
    public function twoColumnNotEqual($table, $col1_name, $col1_value, $col2_name, $col2_value)
    {
        return $this->db->table($table)
                        ->where($col1_name, $col1_value)
                        ->where("$col2_name !=", $col2_value)
                        ->get()
                        ->getResult();
    }
    
    // Insert Data to Any Table;
    public function insertData($table, $data)
    {
        return $this->db->table($table)->insert($data);
    }
    
    // Insert Data to Any Table and get the last id;
    public function insertDataReturnLastId($table, $data)
    {
        $this->db->table($table)->insert($data);
        return $this->db->insertID();
    }

    // Update Data to Any Table;
    public function updateData($table, $data, $id)
    {
        return $this->db->table($table)
                        ->where('id', $id)
                        ->update($data);
    }
    
    // Delete Data from Any Table;
    public function deleteData($table, $id)
    {
        return $this->db->table($table)
                        ->where('id', $id)
                        ->delete();
    }
    
    // Delete Data from Any Table by Column;
    public function deleteByColumn($table, $col_name, $col_value)
    {
        return $this->db->table($table)
                        ->where($col_name, $col_value)
                        ->delete();
    }
}
