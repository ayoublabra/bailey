<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>

    $(document).ready(function() {
       
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1]
            item(page)
        });
        function item(page) {
            $.ajax({
                url: "/pagination/paginate-data?page=" + page,
                success: function(res) {
                    $('.ajax').html(res)
                }
            });
        }
     // Validation du nom
     $('#last_name').on('blur', function() {
                // Ajoutez ici la validation pour le nom (required|string|max:255)
                var lastName = $(this).val();
                if (lastName === '') {
                    showErrorLastName('Nom est requis.');
                } else if (lastName.length > 255) {
                    showErrorLastName('Nom ne peut pas dépasser 255 caractères.');
                } else {
                    $('#error-last_name').text('');
                }
            });

            // Validation du prénom
            $('#first_name').on('blur', function() {
                // Ajoutez ici la validation pour le prénom (required|string|max:255)
                var firstName = $(this).val();
                if (firstName === '') {
                    showErrorFirstName('Prénom est requis.');
                } else if (firstName.length > 255) {
                    showErrorFirstName('Prénom ne peut pas dépasser 255 caractères.');
                } else {
                    $('#error-first_name').text('');
                }
            });
            $('.insurance').on('change', function() {
            var checked = $('.insurance:checked').length;
            if (checked <= 0) {
                $('#error-insurance').css('display','block');
                showErrorInsurance('Au moins une assurance doit être sélectionnée.');
            } else {
                $('#error-insurance').css('display','none');

            }
              });
          
               // Validation du nom du client
               $('#last_name_client').on('blur', function() {
                // Ajoutez ici la validation pour le nom du client (required|string|max:255)
                var lastNameClient = $(this).val();
                if (lastNameClient === '') {
                    showErrorLastNameClient('Nom du client est requis.');
                } else if (lastNameClient.length > 255) {
                    showErrorLastNameClient('Nom du client ne peut pas dépasser 255 caractères.');
                } else {
                    $('#error-last_name_client').text('');
                }
            });
                   // Validation du prénom du client
                   $('#first_name_client').on('blur', function() {
                // Ajoutez ici la validation pour le prénom du client (required|string|max:255)
                var firstNameClient = $(this).val();
                if (firstNameClient === '') {
                    showErrorFirstNameClient('Prénom du client est requis.');
                } else if (lastNameClient.length > 255) {
                    showErrorFirstNameClient('Prénom du client ne peut pas dépasser 255 caractères.');
                } else {
                    $('#error-first_name_client').text('');
                }
            });
                 // Validation de l'adresse du client
                 $('#address_client').on('blur', function() {
                // Ajoutez ici la validation pour l'adresse du client (required|string|max:255)
                var addressClient = $(this).val();
                if (addressClient === '') {
                    showErrorAddressClient('Adresse du client est requis.');
                } else if (addressClient.length > 255) {
                    showErrorAddressClient('Adresse du client ne peut pas dépasser 255 caractères.');
                } else {
                    $('#error-address_client').text('');
                }
            });
               // Validation du code postal du client
               $('#postal_code_client').on('blur', function() {
                // Ajoutez ici la validation pour l'adresse du client (required)
                var postalCodeClient = $(this).val();
                if (postalCodeClient === '') {
                    showErrorPostalCodeClient('Postal Code du Client est requis.');
                } else {
                    $('#error-address_client').text('');
                }
            });
               // Validation de ville du client
               $('#city_client').on('blur', function() {
                // Ajoutez ici la validation pour ville du client (required)
                var cityClient = $(this).val();
                if (cityClient === '') {
                    showErrorCityClient('Ville du client est requis.');
                } else if (cityClient.length > 255) {
                    showErrorCityClient('Ville du client ne peut pas dépasser 255 caractères.');
                } else {
                    $('#error-city_client').text('');
                }
            });
               // Validation de l'email du client
               $('#email_client').on('blur', function() {
                // Ajoutez ici la validation pour l'email du client (required|string|max:255)
                var emailClient = $(this).val();
                if (emailClient === '') {
                    showErrorEmailClient('Email du client est requis.');
                } else if (emailClient.length > 255) {
                    showErrorEmailClient('Email du client ne peut pas dépasser 255 caractères.');
                } else {
                    $('#error-email_client').text('');
                }
            });

            // Validation de Téléphone mobile du client
            $('#mobile_phone_client').on('blur', function() {
                // Ajoutez ici la validation pour Téléphone mobile du client (required|string|max:255)
                var mobilePhoneClient = $(this).val();
                if (mobilePhoneClient === '') {
                    showErrorMobilePhoneClient('Téléphone mobile du client est requis.');
                } else if (mobilePhoneClient.length > 20) {
                    showErrorMobilePhoneClient('Téléphone mobile ne peut pas dépasser 20 caractères.');
                } else {
                    $('#error-mobile_phone_client').text('');
                }
            });
            
                // Validation de Iban du client
                $('#iban_client').on('blur', function() {
                // Ajoutez ici la validation pour Téléphone mobile du client (required|string|max:255)
                var ibanClient = $(this).val();
                if (ibanClient === '') {
                    showErrorIban('Iban du client est requis.');
                } else if (mobilePhoneClient.length > 37) {
                    showErrorIban('iban ne peut pas dépasser 37 caractères.');
                } else {
                    $('#error-iban_client').text('');
                }
            });
            


             // Validation de Date création
             $('#date_creation').on('blur', function() {
                // Ajoutez ici la validation pour Date création(required)
                var dateCreation = $(this).val();
                if (dateCreation === '') {
                    showErrorDateCreation('Date création est requis.');
                } else {
                    $('#error-date_creation').text('');
                }
            });
             // Validation de Date signature
             $('#date_signature').on('blur', function() {
                // Ajoutez ici la validation pour Date signature (required)
                var dateSignature = $(this).val();
                if (dateSignature === '') {
                    showErrorDateSignature('Date signature est requis.');
                } else {
                    $('#error-date_signature').text('');
                }
            });
             // Validation de Date validation
             $('#date_validation').on('blur', function() {
                // Ajoutez ici la validation pour Date validation(required)
                var dateValidation = $(this).val();
                if (dateValidation === '') {
                    showErrorDateValidation('Date validation du client est requis.');
                } else {
                    $('#error-date_validation').text('');
                }
            });

 



            function showErrorLastName(message) {
            $('#error-last_name').text(message);
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: message
            });}
            function showErrorFirstName(message) {
            $('#error-first_name').text(message);
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: message
            });}
            function showErrorInsurance(message) {
            $('#error-insurance').text(message);
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: message
            });}

            function showErrorLastNameClient(message) {
            $('#error-last_name_client').text(message);
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: message
            });}
            function showErrorFirstNameClient(message) {
            $('#error-first_name_client').text(message);
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: message
            });}
            function showErrorAddressClient(message) {
            $('#error-address_client').text(message);
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: message
            });}

            function showErrorPostalCodeClient(message) {
            $('#error-postal_code_client').text(message);
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: message
            });}

            function showErrorCityClient(message) {
            $('#error-city_client').text(message);
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: message
            });}

            function showErrorEmailClient(message) {
            $('#error-email_client').text(message);
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: message
            });}

            function showErrorMobilePhoneClient(message) {
            $('#error-mobile_phone_client').text(message);
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: message
            });}
            
            function showErrorBicSwiftClient(message) {
            $('#error-bic_swift_client').text(message);
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: message
            });}
            function showErrorIban(message) {
            $('#error-iban_client').text(message);
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: message
            });}
            function showErrorDateCreation(message) {
            $('#error-date_creation').text(message);
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: message
            });}
            
            function showErrorDateSignature(message) {
            $('#error-date_signature').text(message);
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: message
            });}
 
            function showErrorDateValidation(message) {
            $('#error-date_validation').text(message);
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: message
            });}




        $('#ajaxForm input[type="checkbox"]').on('change', function() {

            var pdlElecChecked = $('input[name="insurance[]"][value="101"]').is(":checked");
            var pdlGazChecked = $('input[name="insurance[]"][value="102"]').is(":checked");
            var startEcoChecked = $('input[name="insurance[]"][value="103"]').is(":checked");
            var pgeChecked = $('input[name="insurance[]"][value="104"]').is(":checked");
            var montantChecked = $('input[name="insurance[]"][value="105"]').is(":checked");

            if (pdlElecChecked || pdlGazChecked) {

                $('input[name="insurance[]"][value="104"]').prop('disabled', true);
                $('input[name="insurance[]"][value="105"]').prop('disabled', true);
            } else {
                $('input[name="insurance[]"][value="105"]').prop('disabled', false);
                if (startEcoChecked) {

                    $('input[name="insurance[]"][value="101"]').prop('disabled', true);
                    $('input[name="insurance[]"][value="102"]').prop('disabled', true);
                    $('input[name="insurance[]"][value="105"]').prop('disabled', true);
                } else {


                    if (pgeChecked) {

                        $('input[name="insurance[]"][value="101"]').prop('disabled', true);
                        $('input[name="insurance[]"][value="102"]').prop('disabled', true);
                        $('input[name="insurance[]"][value="105"]').prop('disabled', true);
                    } else {



                        if (montantChecked) {

                            $('input[name="insurance[]"][value="101"]').prop('disabled', true);
                            $('input[name="insurance[]"][value="102"]').prop('disabled', true);
                            $('input[name="insurance[]"][value="104"]').prop('disabled', true);
                        } else {
                            $('input[name="insurance[]"][value="101"]').prop('disabled', false);
                            $('input[name="insurance[]"][value="102"]').prop('disabled', false);
                            $('input[name="insurance[]"][value="104"]').prop('disabled', false);
                        }
                    }
                }
            }


        });


});

</script>