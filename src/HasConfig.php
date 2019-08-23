<?php

namespace JohnnyFreeman\LaravelModelConfig;

use Illuminate\Config\Repository;

trait HasConfig
{
    /**
     * Get the config attribute.
     *
     * @param json $config
     * @return mixed
     */
    public function getConfigAttribute($config)
    {
        return new Repository(json_decode($config, true));
    }

    /**
     * Set the config attribute.
     *
     * @param  $config
     * @return void
     */
    public function setConfigAttribute(Repository $config)
    {
        $this->attributes['config'] = json_encode($config->all());
    }

    /**
     * The model's config.
     *
     * @param string|null $key
     * @param mixed|null  $default
     * @return Settings
     */
    public function config($key = null, $default = null)
    {
        if (is_null($key)) {
            return $this->config;
        }

        if (is_array($key)) {
            $config = $this->config;
            $config->set($key);
            $this->config = $config;
            return;
        }

        return $this->config->get($key, $default);
    }
}
