<?php

namespace Domain\Order\Actions;

use App\Http\Requests\OrderFormRequest;
use Domain\Auth\Contracts\RegisterNewUserContract;
use Domain\Auth\DTOs\NewUserDTO;
use Domain\Order\Models\Order;

class NewOrderAction
{
    public function __invoke(OrderFormRequest $request): Order
    {
        $reqisterAction = app(RegisterNewUserContract::class);

        $customer = $request->get('customer');

        if ($request->boolean('create_account')) {
            $reqisterAction(NewUserDTO::make(
                $customer['first_name'] . ' ' . $customer['last_name'],
                $customer['email'],
                $request->get('password')
            ));
        }

        return Order::query()->create([
            'payment_method_id' => $request->get('payment_method_id'),
            'delivery_type_id' => $request->get('delivery_type_id'),
        ]);
    }
}
