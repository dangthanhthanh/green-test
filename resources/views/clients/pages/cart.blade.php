@extends('clients.layout.master')

@section('title')
    Cart
@endsection

@section('content')
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cart as $id => $item)
                                    <tr id="product{{ $id }}">
                                        <td class="shoping__cart__item">
                                            <img src="{{ asset('images') . '/' . $item['image'] }}" alt="">
                                            <h5>{{ $item['name'] }}</h5>
                                        </td>
                                        <td class="shoping__cart__price">
                                            ${{ number_format($item['price'], 2) }}
                                        </td>
                                        <td class="shoping__cart__quantity">
                                            <div class="quantity">
                                                <div class="pro-qty">
                                                    <input
                                                        data-url="{{ route('cart.update-product-in-cart', ['id' => $id]) }}"
                                                        data-id="{{ $id }}" type="text"
                                                        value="{{ $item['qty'] }}">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="shoping__cart__total">
                                            <div class="child_shoping__cart__total">
                                                ${{ number_format($item['qty'] * $item['price'], 2) }}
                                            </div>
                                        </td>
                                        <td class="shoping__cart__item__close">
                                            <span data-id="{{ $id }}"
                                                data-url="{{ route('cart.delete-product-in-cart', ['id' => $id]) }}"
                                                class="icon_close"></span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="#" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                        <a href="{{ route('cart.delete-all') }}"
                            class="primary-btn cart-btn cart-btn-right cart-btn-delete-all"><span class="icon_close"></span>
                            Delete Cart</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Discount Codes</h5>
                            <form action="#">
                                <input type="text" placeholder="Enter your coupon code">
                                <button type="submit" class="site-btn">APPLY COUPON</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
                            @php
                                $total = 0;
                                foreach ($cart as $item) {
                                    $total += $item['price'] * $item['qty'];
                                }
                            @endphp
                            <li class="total1">
                                <div class="total2">Total <span id="total_cart">${{ number_format($total, 2) }}</span>
                                </div>
                            </li>
                        </ul>
                        <a href="{{ route('checkout') }}" class="primary-btn">PROCEED TO CHECKOUT</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('js-custom')
    <script type="text/javascript">
        $(document).ready(function() {
            $('span.icon_close').on('click', function() {
                var id = $(this).data('id');
                var url = $(this).data('url');
                var selectorTr = '#product' + id;
                var urlCart = "{{ route('cart.cart') }}" + ' .total2';

                $.ajax({
                    type: 'GET',
                    url: url,
                    success: function(res) {
                        // swal("Xoa san pham thang thanh cong ^^!", "", "success");
                        $(selectorTr).empty();
                        // $(".total1").load(urlCart);
                        $('#total_cart').html(res.total_cart);
                        console.log(res);
                    }
                });
            });


            $('span.qtybtn').on('click', function(event) {
                var $button = $(this);
                var oldValue = $button.parent().find('input').val();
                if ($button.hasClass('inc')) {
                    var newVal = parseFloat(oldValue) + 1;
                } else {
                    if (oldValue > 0) {
                        var newVal = parseFloat(oldValue) - 1;
                    } else {
                        newVal = 0;
                    }
                }


                var url = $button.parent().find('input').data('url') + '/' + newVal;
                var id = $button.parent().find('input').data('id');

                var urlCart = "{{ route('cart.cart') }}" + ' ' + '#product' + id +
                    ' .shoping__cart__total .child_shoping__cart__total';

                var selector = "#product" + id + ' .shoping__cart__total';

                var urlCartTotal = "{{ route('cart.cart') }}" + ' .total2';

                console.log(url);

                $.ajax({
                    type: 'GET',
                    url: url,
                    success: function(res) {
                        if (res.id && newVal == 0) {
                            $("#product" + id).empty();
                        }
                        $(selector).load(urlCart);
                        $(".total1").load(urlCartTotal);
                    }
                });
            });
        });
    </script>
@endsection
