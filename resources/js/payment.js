document.addEventListener('DOMContentLoaded', function () {
    axios.get('http://127.0.0.1:8000/api/payment/token')
        .then(response => {
            const token = response.data.token;
            braintree.dropin.create({
                authorization: token,
                container: '#dropin-container',
                locale: 'it_IT',
            }, function (createErr, instance) {
                if (createErr) {
                    console.error('Error creating Drop-in UI:', createErr);
                    return;
                }

                document.getElementById('pay').addEventListener('click', function () {
                    const amount = document.getElementById('sponsorship').value;
                    const flatId = document.getElementById('flatId').value;
                    const planId = document.getElementById('sponsorship').value;

                    instance.requestPaymentMethod(function (err, payload) {
                        if (err) {
                            console.error('Error requesting payment method:', err);
                            return;
                        }

                        console.log('dati della tranzazione', payload);
                        axios.post('http://127.0.0.1:8000/api/payment/checkout', {
                            payment_method_nonce: payload.nonce,
                            amount: amount,
                            flatId: flatId,
                            planId: planId,
                        })
                            .then(response => {
                                localStorage.removeItem('payment_success');
                                const data = response.data;
                                console.log(data);
                                // console.log(data.redirect_url);
                                console.log(data.succes_message);
                                if (data.success) {
                                    localStorage.setItem('payment_success', true);
                                    window.location.href = data.redirect_url;
                                } else {
                                    localStorage.setItem('payment_success', false);
                                    window.location.href = data.redirect_url;
                                }
                            })
                            .catch(error => {
                                console.error('Errore nella richiesta di pagamento:', error);
                            });
                    });
                });
            });
        })
        .catch(error => {
            console.error('Errore nel recupero del token Braintree:', error);
        });
});

