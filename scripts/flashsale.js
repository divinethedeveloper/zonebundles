function triggerFlashSale() {
    Swal.fire({
        title: 'Flash Sale: 20GB MTN',
        text: 'Enter the MTN number to receive the data:',
        input: 'tel',
        inputPlaceholder: '054XXXXXXX',
        showCancelButton: true,
        confirmButtonText: 'Pay GHS 87',
        confirmButtonColor: '#2563eb',
        preConfirm: (number) => {
            // Basic Ghana Number Validation
            const phoneRegex = /^[0-9]{10}$/;
            if (!phoneRegex.test(number)) {
                Swal.showValidationMessage('Please enter a valid 10-digit number');
            }
            return number;
        }
    }).then((result) => {
        if (result.isConfirmed) {
            // Trigger your Paystack function
            // Note: We hardcode 87 GHS (8700 pesewas) and "MTN" for this sale
            payWithPaystack(87, "mtn", "20GB Flash Sale", result.value);
        }
    });
}