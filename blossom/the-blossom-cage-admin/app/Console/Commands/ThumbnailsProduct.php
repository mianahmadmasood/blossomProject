<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Services\ThumbnailService;

class ThumbnailsProduct extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Thumbnails:Product';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make thumnails of the product images';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        $tn_service = new ThumbnailService();
        return $tn_service->productThumbnailGateway();
    }

}
