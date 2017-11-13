<?php
 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Migration_Create_home_section_table extends CI_Migration {

    public function __construct()
    {
        parent::__construct();
        $this->load->dbforge();
    }

    public function up()
    {
        $fields = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'is_default' => array(
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0
            ),
            'title' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE
            ),
            'company_name' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE
            ),
            'company_logo' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE
            ),
            'company_address_json' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'home_slider_json' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'about_us_image' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE
            ),
            'about_us_text' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'visitor_count_visibility' => array(
                'type' => 'INT',
                'constraint' => 11,
                'default' => 1
            ),
            'services_json' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'twitter_visibility'  => array(
                'type' => 'INT',
                'constraint' => 11,
                'default' => 1
            ),
            'working_areas_json' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'socmed_link_json' => array(
                'type' => 'TEXT',
                'null' => TRUE
            ),
            'parallax_bground_img' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE
            ),
            'created_at' => array(
                'type' => 'DATETIME'
            ),
            'updated_at' => array(
                'type' => 'DATETIME',
                'null' => TRUE
            ),
            'deleted_at' => array(
                'type' => 'DATETIME',
                'null' => TRUE
            )
        );

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('home_section', TRUE); 

        $now = date('Y-m-d H:i:s');
        $data = array(
            [
                'id' => 1,
                'username' => 'ahmadharminto',
                'email' => 'ahmad.harminto@sociolabs.io',
                'password' => '$2y$10$10uDZgQBdoQs7/swZ4LACOWLEOlSM1Mv9CzSSnJ8Tdxe.Yjaezl1S',
                'verified' => 1,
                'is_active' => 1,
                'user_type_id' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'id' => 2,
                'username' => 'superadmin',
                'email' => 'superadmin@trustcertified.co.id',
                'password' => '$2y$10$1I81fuK2.u9.BoQTe.yjJe2cT.cAugOCD13Fu.gV4LHkL32yCveHC',
                'verified' => 1,
                'is_active' => 1,
                'user_type_id' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ]
        );
        $this->db->where_in('users.id', [1,2]);
        $this->db->delete('users');
        $this->db->insert_batch('users', $data);
    }
 
    public function down()
    {
        $this->dbforge->drop_table('home_section', TRUE);
    }

}