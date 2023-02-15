@extends('payments.layouts.payment-client-master')

@push('script')

@endpush

@section('content')
    <center><h1>Please do not refresh this page...</h1></center>

    <form action="{!!route('razor-pay.payment',['payment_id'=>$data->id])!!}" id="form" method="POST">
    @csrf
    <!-- Note that the amount is in paise = 50 INR -->
        <!--amount need to be in paisa-->
        <script src="https://checkout.razorpay.com/v1/checkout.js"
                data-key="{{ config()->get('razor_config.api_key') }}"
                data-amount="{{round($data->payment_amount, 2)*100}}"
                data-buttontext="Pay {{ round($data->payment_amount, 2) . ' ' . $data->currency_code }}"
                data-name="{{$business_name}}"
                data-description="{{$data->payment_amount}}"
                data-image="{{$business_logo}}"
                data-prefill.name="{{$customer->first_name ?? ''}}"
                data-prefill.email="{{$customer->email ?? ''}}"
                data-theme.color="#ff7529">
        </script>
        <button class="btn" id="pay-button" type="submit" style="display:none"></button>
    </form>

    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function () {
            document.getElementById("pay-button").click();
        });
    </script>
@endsection