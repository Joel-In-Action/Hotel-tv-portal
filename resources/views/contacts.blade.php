@extends('layout')

@section('content')
<h1>Contacts</h1>

<div class="hotel">
    <div class="info">
        <p style="
            display: flex;
            align-items: center;
            gap: 16px;
            font-size: 24px;
            font-weight: bold;
        ">
            <img src="{{ asset('/images/phone.png') }}" alt="Phone" style="width:64px;">
            <span>Reception: 709</span>
        </p>

        <p style="
            display: flex;
            align-items: center;
            gap: 16px;
            font-size: 24px;
            font-weight: bold;
        ">
            <img src="{{ asset('/images/phone.png') }}" alt="Phone" style="width:64px;">
            <span>Reception: 710</span>
        </p>

        <p style="
            display: flex;
            align-items: center;
            gap: 16px;
            font-size: 24px;
            font-weight: bold;
        ">
            <img src="{{ asset('/images/phone.png') }}" alt="Phone" style="width:64px;">
            <span>Gold Dhow Bar: 747</span>
        </p>

        <p style="
            display: flex;
            align-items: center;
            gap: 16px;
            font-size: 24px;
            font-weight: bold;
        ">
            <img src="{{ asset('/images/phone.png') }}" alt="Phone" style="width:64px;">
            <span>Sultan Bar: 734</span>
        </p>

        <p style="
            display: flex;
            align-items: center;
            gap: 16px;
            font-size: 24px;
            font-weight: bold;
        ">
            <img src="{{ asset('/images/phone.png') }}" alt="Phone" style="width:64px;">
            <span>Kilimanjaro Restaurant: 730</span>
        </p>
    </div>
</div>


<a href="/" class="tile back">⬅ Back</a>
@endsection
