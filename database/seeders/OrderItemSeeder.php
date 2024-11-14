<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Nette\Utils\Random;
use Symfony\Component\VarDumper\VarDumper;

class OrderItemSeeder extends Seeder
{

    public function run(): void
    {
        $this->addOrderItemWithOutOrm();
    }

    private function addOrderItemWithOutOrm()
    {
        $data = $this->getProductAndOrderList();
        $productIds = $data['productIdList']->toArray();
        $orderIds = $data['orderIdList'];
        foreach ($orderIds as $orderId) {
            $orderItemQty = random_int(2, 7);
            foreach (range(1, $orderItemQty) as $number) {
                $randomProductIndex = random_int(0, count($productIds) - 1);
                $randomProductId = $productIds[$randomProductIndex]->id;
                DB::table('order_items')->insert([
                    'order_id' => $orderId->id,
                    'product_id' => $randomProductId,
                    'quantity' => 1
                ]);
            }
        }
    }

    private function addOrderItemWithOrm() {}

    private function getProductAndOrderList()
    {
        $prodcutIdList = DB::table('products')->select('id')->get();
        $orderIdList = DB::table('orders')->select('id')->get();
        return array(
            'productIdList' => $prodcutIdList,
            'orderIdList' => $orderIdList
        );
    }
}
