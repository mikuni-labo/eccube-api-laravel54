<?php

namespace App\Services\Api\Orders;

use App\Models\B2c\Order;
use App\Models\B2c\ShipmentItem;
use App\Models\B2c\Shipping;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ApiOrdersService
{
    private $json = [];

    public function __construct()
    {
    }
    
    public function buildJson(array $parameters)
    {
        $search = $this->makeSearchParameters($parameters);
        
        /** @var \Illuminate\Contracts\Pagination\LengthAwarePaginator $Paginator */
        $Paginator = $this->getPaginator($search);
        
        $this->json['pageInfo'] = $this->setPageInfo($Paginator);
        $this->json['orders']   = $this->setOrders($Paginator);
    }

    private function makeSearchParameters(array $parameters) : array
    {
        return [
            'order_id'          => !empty($parameters['order_id'])          ? $parameters['order_id']          : null,
            'create_date:start' => !empty($parameters['create_date:start']) ? $parameters['create_date:start'] : null,
            'create_date:end'   => !empty($parameters['create_date:end'])   ? $parameters['create_date:end']   : null,
            'update_date:start' => !empty($parameters['update_date:start']) ? $parameters['update_date:start'] : null,
            'update_date:end'   => !empty($parameters['update_date:end'])   ? $parameters['update_date:end']   : null,
            'status'            => !empty($parameters['status'])            ? $parameters['status']            : null,
            'limit'             => !empty($parameters['limit'])             ? $parameters['limit']             : null,
//          'offset'            => !empty($parameters['offset'])            ? $parameters['offset']            : null,
            'page'              => !empty($parameters['page'])              ? $parameters['page']              : null,
            'sort'              => !empty($parameters['sort'])              ? $parameters['sort']              : null,
        ];
    }

    private function getPaginator(array $search) : LengthAwarePaginator
    {
        return Order::search($search);
    }

    private function setPageInfo(LengthAwarePaginator $Paginator) : array
    {
        return [
            'total'       => $Paginator->total(),
            'lastPage'    => $Paginator->lastPage(),
            'currentPage' => $Paginator->currentPage(),
        ];
    }

    private function setOrders(LengthAwarePaginator $Paginator) : array
    {
        $orders = [];
        
        foreach ( $Paginator->items() as $Order )
        {
            $orders[] = $this->setOrder($Order);
        }
        
        return $orders;
    }

    private function setOrder(Order $Order) : Order
    {
        $Order->details   = $this->setOrderDetails($Order);
        $Order->shippings = $this->setShippings($Order);
        
        return $Order;
    }

    private function setOrderDetails(Order $Order) : array
    {
        $details = [];
        
        foreach ( $Order->order_details()->get() as $OrderDetail)
        {
            $details[] = $OrderDetail;
        }
        
        return $details;
    }

    private function setShippings(Order $Order) : array
    {
        $shippings = [];
        
        foreach ( $Order->shippings()->get() as $Shipping)
        {
            $shippings[] = $this->setShipping($Shipping);
        }
        
        return $shippings;
    }

    private function setShipping(Shipping $Shipping) : Shipping
    {
        $Shipping->items = $this->setShipmentItems($Shipping);
        
        return $Shipping;
    }

    private function setShipmentItems(Shipping $Shipping) : array
    {
        $shipmentItems = [];
        
        foreach ( $Shipping->shipment_items()->get() as $ShipmentItem )
        {
            $shipmentItems[] = $ShipmentItem;
        }
        
        return $shipmentItems;
    }

    public function getJson()
    {
        return $this->json;
    }

}
