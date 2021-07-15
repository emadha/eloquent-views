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
     * @param bool $asView
     * @return mixed
     */
    public function render($view, $data = [], $asView = false)
    {
        $collection = collect([]);

        if ($asView == true) {
            return $this->render($view, $data);
        }

        foreach ($this as $_item) {
            $collection->add($_item->render($view, $data));
        }

        return $collection;

    }
}