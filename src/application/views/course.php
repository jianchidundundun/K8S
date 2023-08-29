



<div style="text-align:center"> 
  <h1><?php echo $coursename?></h1>
    <h1><?php echo $des?> </h1>
  
  <br>
  <br>



  <br>

  




      
  <h3>If you feel that this review has really helped you, and you want to motivate the author with money, you can pay $10 for the author in the following ways, but this behavior is completely voluntary, not mandatory.</h3>


  <div id="paypal-button-container"></div>
    <!-- reference from https://developer.paypal.com/demo/checkout/#/pattern/client -->
    
    <script src="https://www.paypal.com/sdk/js?client-id=test&currency=USD"></script>

    <script>
        // Render the PayPal button into #paypal-button-container
        paypal.Buttons({

            // Set up the transaction
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            //要支付的金额
                            value: '10.00'
                        }
                    }]
                });
            },

            // Finalize the transaction
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(orderData) {
                    // Successful capture! For demo purposes:
                    console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                    var transaction = orderData.purchase_units[0].payments.captures[0];
                    alert('Transaction '+ transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');

                    // Replace the above to show a success message within this page, e.g.
                    // const element = document.getElementById('paypal-button-container');
                    // element.innerHTML = '';
                    // element.innerHTML = '<h3>Thank you for your payment!</h3>';
                    // Or go to another URL:  actions.redirect('thank_you.html');
                });
            }


        }).render('#paypal-button-container');
    </script>
</div> 
<br>
<br>
<br>
<br>
<br>
<!-- payapl api -->



<!-- 视频播放 -->
