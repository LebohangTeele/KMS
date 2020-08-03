<?php
    class Auth_model extends CI_Model
    {
        function __construct()
        {
            //set the table name
            $this->table='tbl_users';
        }

        function getRows($params=array())
        {
            $this->db->select('*');
            $this->db->from($this->table);
            
            if(array_key_exists("conditions",$params)):
                foreach($params['conditions'] as $key=>$val):
                    $this->db->where($key,$val);
                endforeach;
            endif;
    
            if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'):
                $result = $this->db->count_all_results();
            else:
                if(array_key_exists("id",$params)|| $params['returnType'] =='single'):
                    if(!empty($params['id'])):
                        $this->db->where('id',$params['id']);
                    endif;
                    $query = $this->db->get();
                    $result=$query->row_array();
                else:
                    $this->db->order_by('id','desc');
                    if(array_key_exists("start",$params)&&array_key_exists("limit",$params)):
                        $this->db->limit($params['limit'],$params['start']);
                    elseif(!array_key_exists("start",$params)&&array_key_exists("limit",$params)):
                        $this->db->limit($params['limit']);
                    endif;
                    $query = $this->db->get();
                    $result =($query->num_rows>0) ? $query->result_array():false;
                endif;
    
            endif;
    
            return $result;
        }

        function get_branch_id($branch_name)
        {
            $this->db->select('branch_id')
                    ->from('tbl_branches')
                    ->where('branch_sudo_name',$branch_name);
            return $this->db->get()->row_array();

        }


    }