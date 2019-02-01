<?php

namespace Coalition;

class ConfigRepository
{
    /**
     * ConfigRepository Constructor
     */
    public $config_array;

    public function __construct($config_array=[])
    {
       $this->config_array = $config_array;
    }



    /**
     * Determine whether the config array contains the given key
     *
     * @param string $key
     * @return bool
     */
    public function has($key)
    {
        if (array_key_exists($key,$this->config_array))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * Set a value on the config array
     *
     * @param string $key
     * @param mixed  $value
     * @return \Coalition\ConfigRepository
     */
    public function set($key, $value)
    {        
        $this->config_array[]=$key;
        $this->config_array[$key]=$value;
        // return instance of the same class so we can use Set multible times within the same call 
        return $this;  
    }

    /**
     * Get an item from the config array
     *
     * If the key does not exist the default
     * value should be returned
     *
     * @param string     $key
     * @param null|mixed $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
        //$array_config = $this->config_array;
        if($this->has($key))
        {
            return $this->config_array[$key];
        }
        return $default;
    }

    /**
     * Remove an item from the config array
     *
     * @param string $key
     * @return \Coalition\ConfigRepository
     */
    public function remove($key)
    {
        //$array_config = $this->config_array;
        unset($this->config_array[$key]);
         // return instance of the same class so we can use Set multible times within the same call 
         return $this;  
    }

    /**
     * Load config items from a file or an array of files
     *
     * The file name should be the config key and the value
     * should be the return value from the file
     * 
     * @param array|string The full path to the files $files
     * @return void
     */
    public function load($files)
    {   
        if (is_array($files) || is_object($files))
        {
            foreach($files as $file)
            {
                //var_dump($file);
                $loaded_array_from_file = include($file);
                $this->set(pathinfo($file)['filename'],$loaded_array_from_file);
            }
        }
        else
        {
            $loaded_array_from_file = include($files);
            $this->set(pathinfo($files)['filename'],$loaded_array_from_file);
        }
     }
}
