<?php
 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Migration_Create_visitor_table extends CI_Migration {

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
            'no_of_visits' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE
            ),
            'ip_address' => array(
                'type' => 'VARCHAR',
                'constraint' => 20,
            ),
            'requested_url' => array(
                'type' => 'VARCHAR',
                'constraint' => 255
            ),
            'referer_page' => array(
                'type' => 'VARCHAR',
                'constraint' => 255
            ),
            'page_name' => array(
                'type' => 'VARCHAR',
                'constraint' => 255
            ),
            'query_string' => array(
                'type' => 'VARCHAR',
                'constraint' => 255
            ),
            'user_agent' => array(
                'type' => 'VARCHAR',
                'constraint' => 255
            ),
            'is_unique' => array(
                'type' => 'INT',
                'constraint' => 1,
                'default' => 0
            )
        );

        $this->dbforge->add_field($fields);
        $this->dbforge->add_field('access_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP');
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('visitor_log', TRUE); 
    }
 
    public function down()
    {
        $this->dbforge->drop_table('visitor_log', TRUE);
    }

}