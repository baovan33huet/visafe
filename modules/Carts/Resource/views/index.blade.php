@extends('layouts.client')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
    @include('parts.client.page_title')
    <section class="h-100">
        <div class="container h-100 py-5">
            <div class="row d-flex justify-content-center align-items-center h-100" style="background-color: #e8ebed;">

                <div class="col-10 mb-3">

                    @if (session('msg'))
                        <div class="alert alert-success mt-3 text-center">{{session('msg')}}</div>
                    @endif
                    @php
                        $total = 0;
                    @endphp
                    @if($carts->count())
                    @foreach($carts as $cart)
                        <div class="card rounded-3 mb-4 mt-3">
                            <div style="display: none;">{{$total += $cart->price}}</div>
                            <div class="card-body p-4">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="col-md-2 col-lg-2 col-xl-2">
                                    <img
                                        src="{{$cart->course->thumbnail}}"
                                        class="img-fluid rounded-3" alt="Cotton T-shirt">
                                </div>
                                <div class="col-md-3 col-lg-3 col-xl-3">
                                    <p class="lead fw-normal mb-2">{{$cart->course->name}}</p>
                                </div>
                                <div class="col-md-3 col-lg-3 col-xl-2 d-flex">

                                        <input  min="1" data-cart-id="{{$cart->id}}" name="quantity" value="{{$cart->quantity}}" type="number"
                                                class="form-control form-control-sm quantity" />


                                </div>
                                <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                    <h5  class="mb-0 price" data-cart-id="{{$cart->id}}">{{money($cart->price)}}</h5>
                                </div>
                                <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                    <a href="{{route('carts.delete',$cart->id)}}" onclick="alert('Bạn có muốn xoá ?')" class="text-danger"><i class="fas fa-trash fa-lg"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                     @endforeach


                            <div class="card-body btn btn-primary btn-block btn-lg d-flex justify-content-between text-white" style="width: 28%; padding: 5px 10px;margin: 0 auto; font-weight: 700">
                                <span class="font-weight-bold">CHECKOUT
                                <i class="fas fa-long-arrow-alt-right ms-2"></i>
                                </span>
                                <span id="total" class="font-weight-bold">{{money($total)}}</span>

                            </div>
                    @else
                            <div class="card mb-4 text-center mb-5 mt-3">
                                <div class="card-body">
                                    <h2>Không có khoá học nào!</h2>
                                </div>
                     @endif
                </div>
            </div>
            </div>

        </div>
    </section>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            let csrfToken = $('meta[name="csrf-token"]').attr('content');
            let total = $('#total');


            $('.quantity').change(function () {
                let quantity = $(this).val();
                let cartId = $(this).data('cart-id');


                let price = $('.price[data-cart-id="' + cartId + '"]');
                let newPrice = price.text().slice(0, -1);

                let data = {
                    cartId: cartId,
                    quantity: quantity,
                }

                $.ajax({
                    url: "{{route('carts.update', $cart->id ?? 0)}}",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': csrfToken // Thêm token CSRF vào tiêu đề
                    },
                    data: data,
                    dataType: "json",
                    success: function (data) {
                        price.text(data.data.price);

                        let newTotal = $('.price').map(function () {
                            let newPrice = $(this).text().trim().replace(',', '.');
                            return parseFloat(newPrice) || 0;
                        }).get().reduce((acc, curr) => acc + curr, 0);
                        total.text(newTotal + 'đ');

                    },

                    error: function (xhr, status, error) {
                        console.error('AJAX Error:', xhr.responseText);
                    }
                })
            })
        })
    </script>
@endsection
