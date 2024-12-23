<!DOCTYPE html>
<html>
<head>
    <title>Payment Confirmation</title>
</head>
<body>
    <h1>{{ $group->name }}</h1>
    <p>Payment confirmation for {{ $user->name }}.</p>
    <p>Expenses:</p>
    <ul>
        @foreach ($expenses as $expense)
            <li>{{ $expense->name }} - {{ $expense->getTotalPrice()}}$ / your share - {{  round($expenses[$expense],2) }}$ </li>
        @endforeach
    </ul>
    <p>Your total payment: {{ $user->calculateUserPaymentForGroup($group) }}</p>
</body>
</html>