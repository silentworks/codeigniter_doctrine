<?php

class Dtools extends Controller
{
    /**
     * Generate Models from Database Tables
     */
    public function generate_models_db()
    {
        doctrine_create_models_db();
    }

    public function generate_models_yaml($name = NULL)
    {
        doctrine_create_models($name);
    }

    public function drop_models()
    {
        doctrine_destroy_models();
    }

    public function drop_tables()
    {
        doctrine_destroy_database();
    }

    /**
     * Create Database Tables from Models
     */
    public function generate_tables()
    {
        doctrine_create_database();
    }

    /**
     * Populate database with YAML fixtures
     * @param string $name
     */
    public function populate_tables($name = NULL) {
        doctrine_populate_database($name);
    }

    /**
     * Populate YAML one file fixtures from database
     * @param string $name
     */
    function extract_data_single($name = NULL)
    {
        doctrine_extract_database_data($name, FALSE);
    }

    /**
     * Populate YAML individual file fixtures from database
     * @param string $name
     */
    function extract_data_multiple()
    {
        doctrine_extract_database_data(NULL, TRUE);
    }

    /**
     * Generate YAML Schema file from Models
     * @param string $name
     */
    public function generate_yaml($name)
    {
        if(isset($name))
            doctrine_create_yaml($name);
    }
}
// Dtools Controller