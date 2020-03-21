<?php


namespace EmadHa\EloquentViews;


/**
 * Trait HasEloquentViews
 *
 * @package EmadHa\EloquentViews
 */
trait HasEloquentViews
{

    /**
     * @param array $models
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function newCollection(array $models = [])
    {
        return (new EloquentViewsCollection(parent::newCollection($models)));
    }

    /**
     * @param       $view
     * @param array $data
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function render($view, $data = [])
    {
        return (new EloquentViews($this))->render($view, $data);
    }
}