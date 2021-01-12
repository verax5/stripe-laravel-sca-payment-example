<!doctype HTML>

<html>
    <head>
        <script src="https://js.stripe.com/v3/"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    </head>

    <body>
        <div class="container">
            <div class="row mt-5">
                <div class="col-md-6">
                    <h5> Checkout: </h5>

                    <table class="table">
                        <thead>
                            <tr>
                                <th> Title </th>
                                <th> Cost </th>
                            </tr>
                        </thead>

                        @foreach($items as $item)
                        <tr>
                            <td> {{$item['title']}} </td>
                            <td> {{$item['cost']}} </td>
                        </tr>
                        @endforeach

                        <tr>
                            <td><b> Total:</b> </td>
                            <td> <b>{{$total}} </b></td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-md-6">
                    <form action="/confirm-purchase" method="post" id="payment-form">
                        <div class="form-row">
                            <label for="card-element">
                                Credit or debit card
                            </label>
                            <div id="card-element" class="form-control">
                                <!-- A Stripe Element will be inserted here. -->
                            </div>

                            <!-- Used to display form errors. -->
                            <div id="card-errors" role="alert"></div>
                        </div>

                        {{ csrf_field()}}

                        <input type="hidden" name="paymentIntentId" value="{{$paymentIntentId}}">

                        <button class="btn btn-primary mt-2">Submit Payment</button>
                    </form>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {

                var stripe = Stripe('pk_test_KrOBeLEWljcCESyMr9czj4T2');
                var elements = stripe.elements();
                var cardMount = elements.create('card', {
                    hidePostalCode: true
                });
                cardMount.mount('#card-element');

                var paymentForm = document.getElementById('payment-form');
                paymentForm.addEventListener('submit', function(event) {
                    event.preventDefault();

                    stripe.confirmCardPayment('{{$clientSecret}}', {
                            payment_method: {card: cardMount}
                        })
                        .then(function(result) {
                            if (result.error) {
                                var errorSection = document.getElementById('card-errors');
                                errorSection.textContent = result.error.message;
                            } else {
                                // POST to backend to confirm the purchase.
                                $csrfToken = $("[name=_token]").val();
                                paymentForm.submit();
                            }
                        });

                });
            });

        </script>
    </body>
</html>