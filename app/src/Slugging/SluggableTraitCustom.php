<?php namespace App\Traits;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait SluggableTraitCustom {


    /**
     * Find by either a URL slug or an ID.
     *
     * @param $arg  string|int      Either a URL slug or an ID.
     *
     * @return static               Instance of the model.
     */
    public static function findBySlugOrId($arg) {
        if (is_numeric($arg)) {
            return static::find($arg);
        } else {
            return static::findBySlug($arg);
        }
    }

    /**
     * Find by either a URL slug or an ID.
     *
     * @param $slug string  Either a URL slug or an ID.
     *
     * @return static       Instance of the model.
     */
    public static function findBySlug($slug) {

        $instance = new static;

        $config = \App::make('config')->get('eloquent-sluggable::config');
        $config = array_merge($config, $instance->sluggable);

        return $instance->where($config['save_to'], $slug)->first();
    }

    /**
     * Find by either a URL slug or an ID, or fail.
     *
     * @param $arg  string|int  Either a URL slug or an ID.
     *
     * @return static           Instance of the model.
     * @throws NotFoundHttpException
     */
    public static function findBySlugOrIdorFail($arg) {
        if (is_numeric($arg)) {
            return static::findOrFail($arg);
        } else {
            return static::findBySlugOrFail($arg);
        }
    }

    /**
     * Find by URL slug, or fail if not found.
     *
     * @param $arg string URL Slug
     *
     * @return static Instance of the model
     * @throws NotFoundHttpException
     */
    public static function findBySlugOrFail($arg) {
        $instance = static::findBySlug($arg);

        if (is_null($instance)) {
            throw new NotFoundHttpException;
        }
        return $instance;
    }
}