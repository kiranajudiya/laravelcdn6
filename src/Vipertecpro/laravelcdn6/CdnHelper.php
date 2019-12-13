<?php

namespace Vipertecpro\laravelcdn6;

use Illuminate\Config\Repository;
use Vipertecpro\laravelcdn6\Contracts\CdnHelperInterface;
use Vipertecpro\laravelcdn6\Exceptions\MissingConfigurationException;
use Vipertecpro\laravelcdn6\Exceptions\MissingConfigurationFileException;

/**
 * Class CdnHelper
 * Helper class containing shared functions.
 *
 * @category General Helper
 *
 * @author  Vipul Walia <vipertecpro@gmail.com>
 */
class CdnHelper implements CdnHelperInterface
{
    /**
     * An object of the 'Repository' class that allows reading the laravel config files.
     *
     * @var Repository
     */
    protected $configurations;

    /**
     * @param Repository $configurations
     */
    public function __construct(Repository $configurations)
    {
        $this->configurations = $configurations;
    }

    /**
     * Check if the config file exist and return it or
     * throw an exception.
     *
     * @throws Exceptions\MissingConfigurationFileException
     *
     * @return array
     */
    public function getConfigurations()
    {
        $configurations = $this->configurations->get('cdn');

        if (!$configurations) {
            throw new MissingConfigurationFileException("CDN 'config file' (cdn.php) not found");
        }

        return $configurations;
    }

    /**
     * Checks for any required configuration is missed.
     *
     * @param $configuration
     * @param $required
     *
     * @throws MissingConfigurationException
     */
    public function validate($configuration, $required)
    {
        // search for any null or empty field to throw an exception
        $missing = '';
        foreach ($configuration as $key => $value) {
            if (in_array($key, $required, true) &&
                (empty($value) || $value === null || $value === '')
            ) {
                $missing .= ' '.$key;
            }
        }

        if ($missing) {
            throw new MissingConfigurationException('Missed Configuration:'.$missing);
        }
    }

    /**
     * Take url as string and return it parsed object.
     *
     * @param $url
     *
     * @return mixed
     */
    public function parseUrl($url)
    {
        return parse_url($url);
    }

    /**
     * check if a string starts with a string.
     *
     * @param $with
     * @param $str
     *
     * @return bool
     */
    public function startsWith($with, $str)
    {
        return substr($str, 0, strlen($with)) === $with;
    }

    /**
     * remove any extra slashes '/' from the path.
     *
     * @param $path
     *
     * @return string
     */
    public function cleanPath($path)
    {
        return rtrim(ltrim($path, '/'), '/');
    }
}
