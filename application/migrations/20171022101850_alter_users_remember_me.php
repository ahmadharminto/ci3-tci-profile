<?php
 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Migration_Alter_users_remember_me extends CI_Migration {

    public function __construct()
    {
        parent::__construct();
        $this->load->dbforge();
    }

    public function up()
    {
        $fields=array(
            'remember_me_token' => array(
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => TRUE,
                'after' => 'verification_token'
            )
        );
        $this->dbforge->add_column('users', $fields);
    }
 
    public function down()
    {
        $this->dbforge->drop_column('users', 'remember_me_token');
    }

}