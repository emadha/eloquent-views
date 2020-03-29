<?php

namespace EmadHa\EloquentViews\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;

class CreateView extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'view:create-eloquent {view : the view filename} {--model= : *REQUIRED* the eloquent model which the view will be assigned to.}';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create an Eloquent View file';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     * @throws \ReflectionException
     */
    public function handle()
    {

        # Model option is mandatory
        if (!$this->option('model')) {
            return $this->error('Must define --model value');
        }

        if (!class_exists($this->option('model'))) {
            return $this->error('Class ' . $this->option('model') . ' does not exist.');
        }

        # Validate the Model option
        # Class must exist, and is instance of Model
        $ReflectionClass = (new \ReflectionClass($this->option('model')));
        if (!$ReflectionClass->newInstance() instanceof Model) {
            return $this->error('The model is not an Eloquent Model Instance');
        }

        # Build path variable
        $path = resource_path(sprintf("views"
                . DIRECTORY_SEPARATOR . "%s"
                . DIRECTORY_SEPARATOR . "%s",
                config('eloquent-views.path'), strtolower($ReflectionClass->getShortName()))
        );

        # Create the directory if it doesn't exist
        if (!file_exists($path)) {
            mkdir($path, '777', true);
        }

        # Create the view file
        if (fopen($path . DIRECTORY_SEPARATOR . $this->argument('view') . '.blade.php', 'w')) {
            return $this->info("View '{$this->argument('view')}' for the model {$this->option('model')} was created successfully in {$path} ");
        } else {
            return $this->error('could not create this view');
        }

    }
}
