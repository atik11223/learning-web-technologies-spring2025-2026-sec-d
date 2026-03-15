// 1. Static Data
const UNIT_PRICE = 1000;

// 2. Select DOM Elements
const quantityInput = document.getElementById('quantity');
const totalPriceDisplay = document.getElementById('totalPrice');

// State variable to prevent the alert from popping up on every single keystroke once over 1000
let hasReceivedCoupon = false;

// 3. Real-time Calculation & Validation Logic
quantityInput.addEventListener('input', function() {
    
    // Parse the input value to an integer
    let quantity = parseInt(quantityInput.value);

    // Validation: Minimum Threshold
    // If the input is negative or somehow empty (NaN), reset it to 0
    if (quantity < 0 || isNaN(quantity)) {
        quantity = 0;
        quantityInput.value = 0; 
    }

    // Real-time Calculation
    const total = UNIT_PRICE * quantity;
    totalPriceDisplay.value = total;

    // Validation: Gift Coupon Notification
    if (total > 1000 && !hasReceivedCoupon) {
        alert("Congratulations! You are now eligible for a gift coupon!");
        hasReceivedCoupon = true; // Set flag to true so it doesn't spam alerts
    } else if (total <= 1000) {
        // Reset the flag if the user drops the quantity back down, 
        // allowing them to earn it again if they go back up.
        hasReceivedCoupon = false;
    }
});