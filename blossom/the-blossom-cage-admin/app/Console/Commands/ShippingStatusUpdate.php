<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Services\Config;

class ShippingStatusUpdate extends Command {

    use \App\Http\Traits\ShippingService;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'OrderStatus:ShippingUpdate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command update shippping status of shippment.';

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

        $configs = new Config();
        $orders = $configs->getOrderModel()->getOrderForShippingUpdate();
        foreach ($orders as $order) {
            $current_status = $this->getShppimentStatus($order);
            if ($current_status !== null) {
                $this->updateShippingStatus($current_status,$order);
            }
        }
        return 'done';
    }

}
