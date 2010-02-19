<?php
// system/application/plugins/doctrine_pi.php
define('DS', DIRECTORY_SEPARATOR);
// load Doctrine library
require_once APPPATH . 'plugins' . DS . 'doctrine' . DS . 'lib' . DS . 'Doctrine.php';

// load database configuration from CodeIgniter
require_once APPPATH . 'config' . DS . 'database.php';

define('MODELS_DIRECTORY', APPPATH . 'models' . DS);
define('FIXTURES_DIRECTORY', APPPATH . 'data' . DS . 'fixtures' . DS);
define('SCHEMA_DIRECTORY', APPPATH . 'data' . DS . 'schema' . DS);

// this will allow Doctrine to load Model classes automatically
spl_autoload_register(array('Doctrine', 'autoload'));

// we load our database connections into Doctrine_Manager
// this loop allows us to use multiple connections later on
foreach ($db as $connection_name => $db_values)
{

	// first we must convert to dsn format
	$dsn = $db[$connection_name]['dbdriver'] .
		'://' . $db[$connection_name]['username'] .
		':' . $db[$connection_name]['password'].
		'@' . $db[$connection_name]['hostname'] .
		'/' . $db[$connection_name]['database'];

	Doctrine_Manager::connection($dsn,$connection_name);
}

// CodeIgniter's Model class needs to be loaded
require_once BASEPATH . DS . 'libraries' . DS . 'Model.php';

// telling Doctrine where our models are located
function doctrine_load_models()
{
	if(file_exists(MODELS_DIRECTORY . DS . 'generated'))
    {
		Doctrine::loadModels(MODELS_DIRECTORY . DS . 'generated');
		Doctrine::loadModels(MODELS_DIRECTORY);
	}
}

doctrine_load_models();

function doctrine_install()
{
	doctrine_create_database();
	doctrine_populate_database();
	doctrine_load_models();
}

function doctrine_uninstall()
{
	doctrine_destroy_database();
	doctrine_destroy_models();
}

function doctrine_reinstall()
{
	doctrine_uninstall();
	doctrine_install();
}

/**
 * Create Database Tables from Models
 */
function doctrine_create_database()
{
	if(count(scandir(MODELS_DIRECTORY)) == 2)
    {
		doctrine_create_models();
	}

	Doctrine::createTablesFromModels(MODELS_DIRECTORY);
}

/**
 * Populate database with YAML fixtures
 * @param string $name
 */
function doctrine_populate_database($name = NULL)
{
    if($name === NULL)
        $location = FIXTURES_DIRECTORY;
    else
        $location = FIXTURES_DIRECTORY . $name . '.yml';

	Doctrine_Core::loadData($location);
}

/**
 * Populate database with YAML fixtures
 * @param string $name
 */
function doctrine_extract_database_data($name = NULL, $individual = FALSE)
{
    if($individual === TRUE)
        $location = FIXTURES_DIRECTORY;
    else
        $location = FIXTURES_DIRECTORY . $name . '.yml';

    Doctrine_Core::dumpData($location, $individual);
}

/**
 * Drops all tables from database
 */
function doctrine_destroy_database()
{
	$conn = Doctrine_Manager::getInstance()->getCurrentConnection();

	$models = Doctrine::getLoadedModels();

	foreach($models as $model) {
		$conn->export->dropTable(Doctrine::getTable($model)->getTableName());
	}
}

/**
 * Generate YAML Schema file from Models
 * @param string $name
 */
function doctrine_create_yaml($name)
{
    Doctrine_Core::generateYamlFromModels(SCHEMA_DIRECTORY . $name . '.yml', MODELS_DIRECTORY);
}

/**
 * Generates Models from YAML Schema file
 * @param string $name
 */
function doctrine_create_models($name = NULL)
{
    if($name === NULL)
        $location = SCHEMA_DIRECTORY;
    else
        $location = SCHEMA_DIRECTORY . $name;

    Doctrine::generateModelsFromYaml($location, MODELS_DIRECTORY);
}

/**
 * Generate Models from Database Tables
 */
function doctrine_create_models_db()
{
     Doctrine::generateModelsFromDb(MODELS_DIRECTORY);
}

/**
 * Delete all Models from the Model directory
 */
function doctrine_destroy_models()
{
	foreach(scandir(MODELS_DIRECTORY) as $file)
    {
		if($file == '.' || $file == '..')
        {
			continue;
		}

		$file = MODELS_DIRECTORY . $file;
		if(is_dir($file))
        {
			foreach(scandir($file) as $subfile)
            {
				if($subfile != '.' && $subfile != '..')
                {
					unlink($file . DS . $subfile);
				}
			}

			rmdir($file);
		}
        else
        {
			unlink($file);
		}
	}
}

// (OPTIONAL) CONFIGURATION BELOW

// this will allow us to use "mutators"
Doctrine_Manager::getInstance()->setAttribute(
	Doctrine::ATTR_AUTO_ACCESSOR_OVERRIDE, true);

// this sets all table columns to notnull and unsigned (for ints) by default
Doctrine_Manager::getInstance()->setAttribute(
	Doctrine::ATTR_DEFAULT_COLUMN_OPTIONS,
	array('notnull' => true, 'unsigned' => true));

// set the default primary key to be named 'id', integer, 4 bytes
Doctrine_Manager::getInstance()->setAttribute(
	Doctrine::ATTR_DEFAULT_IDENTIFIER_OPTIONS,
	array('name' => 'id', 'type' => 'integer', 'length' => 4));

/* End of file doctrine_pi.php */
/* Location: ./application/plugins/doctrine_pi.php */