<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
/**
 *
 * Cache Library configuration
 *
 * @license 	MIT Licence
 * @category	Config
 * @author  	Andrew Smith
 * @link    	http://www.silentworks.co.uk
 * @copyright	Copyright (c) 2009, Silent Works.
 * @date		09 Jun 2009
 */

// Cache Directory
// If this is not set it will revert to the CI cache directory in config file. $config['cache_path']
$config['cache_dir'] = '';

// Prefix to all cache filenames
$config['cache_postfix'] = '.cache';

// Expiry file prefix
$config['cache_expiry_postfix'] = '.exp';

// Group directory prefix
$config['cache_group_postfix'] = '.group';

// Default time to live = 3600 seconds (One hour).
$config['cache_default_ttl'] = 360;

// Use memcache drivers
// $config['cache_enable_memcache'] = FALSE;

/* End of file cache.php */
/* Location: ./application/config/cache.php */