<?php
    defined('BASEPATH')OR exit('No direct script access allowed');

    class Sales_model extends CI_Model
    {
        public function __construct()
        {
            parent::__construct();
        }
        function get_branches()
        {
            $this->db->select('branch_sudo_name')
                    ->from('tbl_branches');
            return $this->db->get()->result_array();
        }
        function get_branch_name()
        {
            $this->db->select('branch_full_name')
                    ->from('tbl_branches')
                    ->where('branch_id',$this->session->userdata('active_branch_id'));
            $result = $this->db->get()->row_array();
            return $result['branch_full_name'];
        }
        function get_company_logo()
        {
            $this->db->select('logo_link')
                        ->from('tbl_company_logo p')
                        ->join('tbl_branches q','q.company_id=p.company_id')
                        ->where('q.company_id',$this->session->userdata('active_branch_id'));
            $result = $this->db->get()->row_array(); 
            return $result['logo_link'];
        }

        function get_company_registration()
        {
            $this->db->select('company_registration')
                    ->from('tbl_companies p')
                    ->join('tbl_branches q','q.company_id=p.company_id')
                    ->where('q.branch_id',$this->session->userdata('active_branch_id'));
            $result = $this->db->get()->row_array();
            return $result['company_registration'];
        }

        function get_company_tax_number()
        {
            $this->db->select('p.sars_registration')
                    ->from('tbl_sars p')
                    ->join('tbl_branches q','p.company_id=q.company_id')
                    ->where('q.branch_id',$this->session->userdata('active_branch_id'));
            $result = $this->db->get()->row_array();
            return $result['sars_registration'];
        }
        function get_registered_customers()
        {
            $this->db->select('*')
                    ->from('tbl_customer')
                    ->where('customer_branch',$this->session->userdata('user_branch'));
            return $this->db->get()->row_array();
        }
        function get_payment_modes()
        {
            $this->db->select('*')
                    ->from('tbl_payment_mode');
            return $this->db->get()->result_array();
        }
        function get_company_contact_details()
        {
            $this->db->select('address, phone,if(phone_ext IS NULL,"",phone_ext)as phone_extension,email')
                ->from('tbl_contact_details')
                ->where('branch_id',$this->session->userdata('active_branch_id'))
                ->where('contact_type',5);
            $result = $this->db->get()->row_array();
            return $result;
        }
        function get_quotation_number()
        {
            $this->db->select('q.quote_counter,p.quote_prefix')
                    ->from('tbl_branches_quotes q')
                    ->join('tbl_branch_prefixes p','p.branch_id=q.branch_id')
                    ->where('q.branch_id',$this->session->userdata('active_branch_id'));
            $result=$this->db->get()->row_array();
            return $result['quote_prefix'].$result['quote_counter'];
        }
        function get_refund_prefix()
        {
            $this->db->select('b.refund_prefix,x.refunds_counter')
                    ->from('tbl_branch_prefixes b')
                    ->join('tbl_counter_sales_refunds x','b.branch_id=x.branch_id')
                    ->where('b.branch_id',$this->session->userdata('active_branch_id'));
            $result=$this->db->get()->row_array();
            return $result['refund_prefix'].$result['refunds_counter'];
        }
        function get_invoice_number()
        {
            $this->db->select('i.invoice_prefix,x.invoice_counter')
                    ->from('tbl_branch_prefixes i')
                    ->join('tbl_branches_invoices x','i.branch_id=x.branch_id')
                    ->where('i.branch_id',$this->session->userdata('active_branch_id'));
            $result=$this->db->get()->row_array();
            return $result['invoice_prefix'].$result['invoice_counter'];
        }
        function get_quotation_line_items($quote_name)
        {
            $this->db->select('a.quote_id,q.line_item_id,q.item_id,q.quantity,q.quote_name,x.part_name, x.unit_price')
                     ->from('tbl_line_items q')
                     ->where('q.quote_name',$quote_name)
                     ->join('tbl_parts x','x.part_id=q.item_id')
                     ->join('tbl_quotes a', 'a.quote_name=q.quote_name');
            return $this->db->get()->result_array();
        }
        function get_invoice_line_items($quote_id)
        {
            $this->db->select('a.quote_id,q.line_item_id,q.item_id,q.quantity,q.quote_name,x.part_name,x.part_number,x.unit_price')
                     ->from('tbl_line_items q')
                     ->where('q.quote_id',$quote_id)
                     ->join('tbl_parts x','x.part_id=q.item_id')
                     ->join('tbl_quotes a', 'a.quote_name=q.quote_name');
            return $this->db->get()->result_array();
        }

        /**
         * Processing invoices
         */

         function get_waiting_quotations()
         {
            // the table  has 1. date when quotation was created /2.summary of purchased items/3. total cost on quotation/4.and the state [ticket/quotation]
            $interval = "INTERVAL 7 DAY";
            $this->db->select('q.created,q.quote_number,q.quote_name, q.quote_value, q.quote_status,l.state')
                    ->from('tbl_quotes q')
                    ->join('tbl_quote_states l','l.state_id=q.quote_status')
                    ->where("DATE_FORMAT(created, '%Y-%m-%d') = subdate(curdate(),0)")
                    ->where('q.quote_status',1)
                    ->order_by('q.created','desc');
            return $this->db->get()->result_array();
         }
         function get_waiting_invoices()
         {
            // the table  has 1. date when quotation was created /2.summary of purchased items/3. total cost on quotation/4.and the state [ticket/quotation]
            $this->db->select('d.modified,d.invoice_number,d.invoice_name,d.invoice_value,d.quote_id,x.quote_status,g.state')
                    ->from('tbl_invoices d')
                    ->join('tbl_quotes x','d.quote_id=x.quote_id')
                    ->join('tbl_quote_states g','g.state_id=x.quote_status')
                    ->where('x.quote_status',2)
                    //->where( "DATE_FORMAT(d.modified, '%Y-%m-%d') = subdate(curdate(),2)")
                    ->order_by('d.modified','DESC');
                    
            return $this->db->get()->result_array();
         }
         /**
          * Invoices that have been processed for that day
          */
         function get_processed_invoices()
         {
            $this->db->select('q.created,q.quote_number,q.quote_name, q.quote_value, q.quote_status,l.state')
                    ->from('tbl_quotes q')
                    ->join('tbl_quote_states l','l.state_id=q.quote_status')
                    ->where( "DATE_FORMAT(created, '%Y-%m-%d') = subdate(curdate(),1)")
                    ->where('q.quote_status',2);
            return $this->db->get()->result_array();
         }
         /**
          * Refunds that have been processed today
          */
          function get_processed_refunds()
          {
            $this->db->select('g.*,l.state')
                    ->from('tbl_quotes g')
                    ->where('g.quote_status',3)
                    ->where("DATE_FORMAT(g.modified, '%Y-%m-%d') = subdate(curdate(),0)")
                    ->join('tbl_quote_states l', 'g.quote_status=l.state_id');
            return $this->db->get()->result_array();
          }
        /**
         * Get parts for sales search
         */
        function get_parts($search_string)
        {
            /**
             * p zita remadunhurirwa ra baba
             * q zita remadunhurirwa ra mai
             * 
             */
            if ($search_string!==''):
                $this->db->select('p.*,q.*,c.*,n.*')
                        ->from('tbl_parts p')
                        ->group_start()
                            ->like('p.part_number',$search_string)
                            ->or_like('p.part_name',$search_string)
                        ->group_end()
                        ->join('tbl_part_quantity q','(q.part_id=p.part_id and q.branch_sudo_name="EDEN") or (q.part_id=p.part_id and q.branch_sudo_name="PTA")','right')
                        ->join('bridge_part_model c', 'p.part_id=c.part_id')
                        ->join('tbl_parts_identification_properties n','q.part_id=n.part_id')
                        ->order_by('q.quantity','desc')
                        ->order_by('q.branch_sudo_name','desc')
                        ->order_by('c.part_model_id','asc');
                        //->group_by('q.part_id');
                $result=$this->db->get()->result_array();
                return $result;
            else:
                $this->db->select('p.*,q.*,c.*,n.*')
                        ->from('tbl_parts p')
                        ->group_start()
                            ->like('p.part_number',$search_string)
                            ->or_like('p.part_name',$search_string)
                        ->group_end()
                        ->join('tbl_part_quantity q','(q.part_id=p.part_id and q.branch_sudo_name="EDEN") or (q.part_id=p.part_id and q.branch_sudo_name="PTA")','right')
                        ->join('bridge_part_model c', 'p.part_id=c.part_id')
                        ->join('tbl_parts_identification_properties n','q.part_id=n.part_id')
                        ->order_by('q.branch_sudo_name','desc')
                        ->order_by('c.part_model_id','asc')
                        ->limit(100);
                $result=$this->db->get()->result_array();
                return $result;
            endif;
        }

        public function create_quote_entry($quote_identifier,$quote_total)
        {
            $branch_id = $this->session->userdata('active_branch_id');
            $sales_person_id = $this->session->userdata('user_id');
            $quote_status = 1;

            $insert_array = array(
                                    'branch_id'=>$branch_id,
                                    'sales_person'=>$sales_person_id,
                                    'quote_status'=>$quote_status,
                                    'quote_number'=>$this->get_quotation_number(),
                                    'quote_name'=>$quote_identifier,
                                    'quote_value'=>$quote_total
                                );
            $this->db->insert('tbl_quotes',$insert_array);
            $quote_id=$this->db->insert_id();
            $this->db->where('branch_id',$branch_id)
                    ->set('quote_counter','quote_counter+1',FALSE)
                    ->update('tbl_branches_quotes');
            return $quote_id;
        }
        /**
         * process quotation
         */
        public function process_quotation()
        {
            $cart = $this->cart->contents();
            $quote_total = $this->cart->total();            
            $line_identifier = $this->session->userdata('user_name').'_'.rand(0,1000).date('His');
            $quote_id=$this->create_quote_entry($line_identifier,$quote_total);
            foreach($cart as $x):
                $insert_array=array(
                                        'item_id'=>$x['id'],
                                        'quote_name'=>$line_identifier,
                                        'item_price'=>$x['price'],
                                        'quantity'=>$x['qty'],
                                        'quote_id'=>$quote_id,
                                        'refunded'=>0
                                    );
                $this->db->insert('tbl_line_items',$insert_array);                
            endforeach;
            

            $data['cart']=$this->cart->contents();
            $data['cart']['total']=$this->cart->total();
            $this->cart->destroy();
            return $data['cart'];
        }
        /**
         *
         */
        public function create_invoice_entry()
        {
            $data=array();
            $user_branch = $_SESSION['user_branch'];
            $quote_id = $this->input->post('quote_id');
            $manage_stock = "  UPDATE tbl_part_quantity
                                JOIN tbl_line_items ON tbl_line_items.item_id = tbl_part_quantity.part_id
                                SET tbl_part_quantity.quantity = tbl_part_quantity.quantity-tbl_line_items.quantity
                                WHERE tbl_line_items.quote_id=$quote_id and tbl_part_quantity.branch_sudo_name = '$user_branch'
                            ";
            $this->db->query($manage_stock);
            $this->db->where('branch_id',$this->session->userdata('active_branch_id'))
                    ->set('invoice_counter','invoice_counter+1',FALSE)
                    ->update('tbl_branches_invoices');                            
            if($_POST['paymentValue2']):
                $insert_array = array(
                                        'invoice_number'=>$this->get_invoice_number(),
                                        'invoice_status'=>2,
                                        'invoice_name'=>$this->input->post('invoice_name'),
                                        'invoice_value'=>$_POST['paymentValue1']+$_POST['paymentValue2'],
                                        'payment_mode1'=>$this->input->post('paymentMode1'),
                                        'payment1_value'=>$this->input->post('paymentValue1'),
                                        'second_payment_flag'=>1,
                                        'payment_mode2'=>$this->input->post('paymentMode2'),
                                        'payment2_value'=>$this->input->post('paymentValue2'),
                                        'quote_id'=>$this->input->post('quote_id')
                                    );
            else:
                $insert_array = array(
                                        'invoice_number'=>$this->get_invoice_number(),
                                        'invoice_status'=>2,
                                        'invoice_name'=>$this->input->post('invoice_name'),
                                        'invoice_value'=>$_POST['paymentValue1'],
                                        'payment_mode1'=>$this->input->post('paymentMode1'),
                                        'payment1_value'=>$this->input->post('paymentValue1'),
                                        'second_payment_flag'=>0,
                                        'payment_mode2'=>6,
                                        'payment2_value'=>0,
                                        'quote_id'=>$this->input->post('quote_id')
                                    );
            endif;

            $this->db->insert('tbl_invoices',$insert_array);
            $update_array = array('quote_status'=>2);
            $this->db->where('quote_id',$this->input->post('quote_id'));
            $this->db->update('tbl_quotes',$update_array);
            $this->db->select('u.part_number, r.item_price,r.quantity,(r.quantity*r.item_price) as total_paid_for_item, CONCAT(c.brand,"/",c.model_name,"/",engine_detail) as model,u.part_name')
                    ->from('tbl_line_items r')
                    ->join('bridge_part_model c','r.item_id= c.part_id')
                    ->join('tbl_parts u','u.part_id=r.item_id')
                    ->where('quote_id',$this->input->post('quote_id'))
                    ->group_by('u.part_number');
            $data['invoice_line_items']=$this->db->get()->result_array();
            $data['insert_array']=$insert_array;
            return $data;
        }
        public function process_refund()
        {
            $update_array=array('refunded'=>1);
            $this->db->where('line_item_id',$this->input->post('line_id'));
            $this->db->update('tbl_line_items',$update_array);



            $update_array=array('quote_status'=>3);
            $this->db->where('quote_id',$this->input->post('qid'));
            $this->db->update('tbl_quotes',$update_array);
            $update_array=array('invoice_status'=>2);
            $this->db->where('quote_id',$this->input->post('qid'));
            $this->db->update('tbl_invoices',$update_array);

            $insert_array=array('line_item_id'=>$this->input->post('line_id'),'refunded_quantity'=>$this->input->post('quantity'),'refund_amount'=>$this->input->post('amount'));
            $this->db->insert('tbl_refund_items',$insert_array);

            $adjust_quantity="quantity + ".$this->input->post('quantity');
            $this->db->where('branch_id',$this->session->userdata('active_branch_id'))
                    ->where('part_id',$this->input->post('part_id'))
                    ->set('quantity',$adjust_quantity,FALSE)
                    ->update('tbl_part_quantity');            
            $data = $this->get_processed_refunds();
            $this->manage_refund_counter();
            return $data;
        }
        function refund_all()
        {
            $this->db->select('line_item_id,quantity,item_price')
                    ->from('tbl_line_items')
                    ->where('quote_id',$this->input->post('quotation_id'));
            $temp=$this->db->get()->result_array();
            foreach($temp as $tinsert){
                $insert_array=array('line_item_id'=>$tinsert['line_item_id'],'refunded_quantity'=>$tinsert['quantity'],'refund_amount'=>$tinsert['item_price']);
                $this->db->insert('tbl_refund_items',$insert_array);
            }
            $update_array=array('quote_status'=>3);
            $this->db->where('quote_id',$this->input->post('quotation_id'));
            $this->db->update('tbl_quotes',$update_array);
            $update_array=array('refunded'=>1);
            $this->db->where('quote_id',$this->input->post('quotation_id'));
            $this->db->update('tbl_line_items',$update_array);
            $this->manage_refund_counter();
            $result=$this->get_refund_prefix();            
            return $result;
        }

        function manage_refund_counter()
        {
            $this->db->where('branch_id',$this->session->userdata('active_branch_id'))
                    ->set('refunds_counter','refunds_counter+1',FALSE)
                    ->update('tbl_counter_sales_refunds');
        }

        function test_increase()
        {
            print_r($this->input->post());
            $adjust_quantity="quantity + 3";
            $this->db->where('branch_id',$this->session->userdata('active_branch_id'))
                    ->where('part_id',$this->input->post('part_id'))
                    ->set('quantity',$adjust_quantity,FALSE)
                    ->update('tbl_part_quantity');
        }

    }
