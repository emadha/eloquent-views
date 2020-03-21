<?php


namespace EmadHa\EloquentViews;


use Illuminate\Database\Eloquent\Collection;

/**
 * Class EloquentViewsCollection
 *
 * @package EmadHa\EloquentViews
 */
class EloquentViewsCollection extends Collection
{

    /**
     * @param       $view
     * @param array $data
     *
     * @return mixed
     */
    public function render($view, $data = [])
    {
        $collection = collect([]);

        foreach ($this as $_item) {
            $collection->add($_item->render($view, $data));
        }

        return $collection;

    }
}