<?php

namespace App\Http\Controllers\API\V1\Order;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Services\OrderService;
use App\Http\Resources\OrderResource;
use App\Http\Requests\API\V1\Order\StoreOrderRequest;
use App\Http\Requests\API\V1\Order\UpdateOrderRequest;


class OrderController extends Controller
{
    public function __construct(private OrderService $orderService) {}

    public function index()
    {
        $orders = $this->orderService->getAllOrders();
        return OrderResource::collection($orders);
    }

    public function show($id)
    {
        $order = $this->orderService->getOrderById($id);
        return new OrderResource($order);
    }

    public function store(StoreOrderRequest $request)
    {
        $data = $request->validated();

        $data['user_id'] = auth()->id();

        $data['status'] = 'pending';

        $order = $this->orderService->createOrder($data);

        return new OrderResource($order);
    }

    public function update(UpdateOrderRequest $request, $id)
    {
        $order = $this->orderService->updateOrder($id, $request->validated());
        return new OrderResource($order);
    }

    public function destroy($id)
    {
        $this->orderService->deleteOrder($id);
        return response()->json(['message' => 'Order deleted successfully']);
    }
}
