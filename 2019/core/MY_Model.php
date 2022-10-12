<?php defined('BASEPATH') OR exit('No direct script access allowed');


class MY_Model extends CI_Model {
   
    public $table;
    public $key = [];
    public $field = [];

    public function __construct()
    {
        parent::__construct();
        
    }

    public function setConfig($config)
    {
        if (isset($config['table']))
        {
            $this->table = $config['table'];
        }

        if (isset($config['key']))
        {
            $this->key = $config['key'];
        }

        if (isset($config['field']))
        {
            $this->field = $config['field'];
        }
    }

    public function getAll()
    {
        return $this->db
                    ->get($this->table)
                    ->result_array();
    }

    public function getFilter($where)
    {
        $this->prepareFilter($where);

        return $this->db
                    ->get($this->table)
                    ->result_array();
    }

    public function get($where)
    {
        if (! $this->checkGetSingle($where)) {
            return [];
        }

        $this->prepareFilter($where);

        return $this->db
                    ->get($this->table)
                    ->row_array();
    }

    public function add($data)
    {
        $where = $this->filterKey($data);
        $update = $this->filterField($data);
        $insert = array_merge($where,$update);

        if (count($this->get($where))==0) {
            return $this->db->insert($this->table, $insert);
        }

        return false;
    }

    public function update($data)
    {
        $where = $this->filterKey($data);
        $update = $this->filterField($data);

        if (! $this->checkGetSingle($where)) {
            return false;
        }

        $this->prepareFilter($where);

        return $this->db
                    ->update($this->table, $update);
    }

    public function delete($data)
    {
        $where = $this->filterKey($data);

        if (! $this->checkGetSingle($where)) {
            return false;
        }

        $this->prepareFilter($where);

        return $this->db
                    ->delete($this->table);
    }

    protected function prepareFilter($where)
    {
        foreach ($where as $key => $value) {
            if ($this->checkWhere($key))
                $this->buildWhere($key,$value);
        }
    }

    protected function checkGetSingle($where)
    {
        return count($where) === count($this->key);
    }

    protected function checkWhere($key)
    {
        return in_array($key, $this->key);
    }

    protected function buildWhere($key,$value)
    {
        $this->db->where($key, $value);
    }



    public function filterKey($value)
    {
        $key = $this->key;
        return array_filter($value, function($k) use ($key) {
            return in_array($k, $key);
        }, ARRAY_FILTER_USE_KEY);
    }

    protected function filterField($value)
    {
        $field = $this->field;
        return array_filter($value, function($k) use ($field) {
            return in_array($k, $field);
        }, ARRAY_FILTER_USE_KEY);
    }




}
