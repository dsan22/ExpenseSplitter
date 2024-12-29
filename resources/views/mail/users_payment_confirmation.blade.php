<!DOCTYPE html>
<html>
<head>
    <title>Payment Confirmation</title>
    <wireui:scripts />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="w-full justify-center items-center text-center pt-4">
        <h1 class="text-4xl font-bold">{{ $group->name }}</h1>
        <p class="text-xl pt-1">Payment confirmation for {{ $user->name }}.</p>
    </div>
    <div class="w-full flex justify-center pt-3">
        <table class="w-3/4">
            <thead class="bg-cyan-100">
                <tr>
                    <th class="px-4 py-2">Name</th>
                    <th class="px-4 py-2">Amount</th>
                    <th class="px-4 py-2">Unit Price</th>
                    <th class="px-4 py-2">Total Price</th>
                    <th class="px-4 py-2">Added By</th>
                    <th class="px-4 py-2">Your Payment</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($expenses as $expense)
                    <tr 
                        class="{{ $loop->even ? 'bg-cyan-50' : 'bg-white' }}"
    
                    >
                        <td class="px-3 py-3">{{ $expense->name }}</td>
                        <td class="px-3 py-3">{{ $expense->amount }}</td>
                        <td class="px-3 py-3">{{ $expense->unit_price }}$</td>
                        <td class="px-3 py-3">{{ $expense->getTotalPrice() }}$</td>
                        <td class="px-3 py-3">{{ $expense->added_by->name }}</td>
                        <td class="px-3 py-3">{{round($expenses[$expense],2)}}$</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="text-center pt-5">
        <p class="text-2xl font-bold">Your total payment: {{ $user->calculateUserPaymentForGroup($group) }}$</p>
    </div>
    
</body>
</html>