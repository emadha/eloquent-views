<?php


namespace EmadHa\EloquentViews;


/**
 * Class EloquentViews
 *
 * @package EmadHa\EloquentViews
 */
class EloquentViews
{

    /**
     * @var
     */
    protected $model;

    /**
     * EloquentViews constructor.
     *
     * @param $model
     */
    public function __construct($model)
    {
        $this->model = $model;
    }

    /**
     * @param       $view
     * @param array $data
     *
     * @return mixed
     * @throws \ReflectionException
     */
    public function buildView($view, $data = [])
    {
        # Get the layout view base directory
        $layout_base = config('eloquent-views.path') ?: 'eloquent';

        # Create reflection class from model
        $model_reflection = (new \ReflectionClass($this->model));

        # Get the model short name
        $model_shortname = $model_reflection->getShortName();

        # Get the model view base directory
        $model_base = strtolower($model_shortname);

        # Build view path
        # Path will be like this resources/views/{eloquent}/{model}/{view}
        $view = $layout_base . '.' . $model_base . '.' . $view;

        # Merge the data array with the model
        $data = array_merge($data, ['model' => $this->model]);

        # Check if View exists
        if (view()->exists($view)) {
            return view($view, $data);
        }

        # Throw an exception if view is not found.
        throw new \InvalidArgumentException("View [$view] not found.");
    }

    /**
     * @param       $view
     * @param array $data
     *
     * @return mixed
     * @throws \ReflectionException
     */
    public function render($view, $data = [])
    {

        # Get the view
        $layout = $this->buildView($view, $data);

        # Return view and render
        return $layout->render();
    }
}