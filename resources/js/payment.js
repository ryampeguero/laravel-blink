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

                        console.log(payload);
                        axios.post('http://127.0.0.1:8000/api/payment/checkout', {
                            payment_method_nonce: payload.nonce,
                            amount: amount,
                            flatId: flatId,
                            planId: planId,
                        })
                            .then(response => {
                                const data = response.data;
                                console.log(data);
                                console.log(data.redirect_url);
                                const message = document.getElementById('message');
                                if (data.success) {
                                    alert('Pagamento avvenuto con successo!');
                                    window.location.href = data.redirect_url;
                                    // console.log(document.getElementById('message'));
                                    message.classList.remove('d-none');
                                    message.classList.add('alert alert-succes');
                                    message.innerHTML = "messaggio";

                                    setTimeout(function () {
                                        message.classList.add('d-none');
                                    }, 4000);

                                } else {
                                    alert('Errore nel pagamento: ' + data.message);
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

