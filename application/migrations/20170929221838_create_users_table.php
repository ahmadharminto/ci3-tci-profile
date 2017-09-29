<?php
 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Migration_Create_users_table extends CI_Migration {

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
            'username' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'unique' => TRUE
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => 150,
                'unique' => TRUE
            ),
            'password' => array(
                'type' => 'VARCHAR',
                'constraint' => 100
            ),
            'verified' => array(
                'type' => 'INT',
                'constraint' => 11,
                'default' => 0
            ),
            'verification_token' => array(
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => TRUE
            ),
            'is_active' => array(
                'type' => 'INT',
                'constraint' => 11,
                'default' => 1
            ),
            'user_type_id' => array(
                'type' => 'INT',
                'constraint' => 11
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
        $this->dbforge->create_table('users', TRUE); 
    }
 
    public function down()
    {
        $this->dbforge->drop_table('users', TRUE);
    }

}