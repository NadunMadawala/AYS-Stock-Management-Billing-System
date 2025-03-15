
<div class="modal fade" id="checkout-modal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Checkout</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="payment-methods mb-4">
                            <h6>Payment Method</h6>
                            <div class="d-flex gap-2 flex-wrap">
                                <button class="btn btn-outline-primary payment-btn" data-method="cash">
                                    <i class="fas fa-money-bill"></i> Cash
                                </button>
                                <button class="btn btn-outline-primary payment-btn" data-method="card">
                                    <i class="fas fa-credit-card"></i> Card
                                </button>
                                <button class="btn btn-outline-primary payment-btn" data-method="upi">
                                    <i class="fas fa-mobile-alt"></i> UPI
                                </button>
                            </div>
                        </div>
                        <div class="payment-details">
                            <div class="mb-3">
                                <label class="form-label">Amount Received</label>
                                <input type="number" class="form-control form-control-lg" id="amount-received">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Change</label>
                                <input type="text" class="form-control form-control-lg" id="change" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="order-summary">
                            <h6>Order Summary</h6>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal</span>
                                <span id="modal-subtotal">$0.00</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Tax (10%)</span>
                                <span id="modal-tax">$0.00</span>
                            </div>
                            <div class="d-flex justify-content-between total-line">
                                <span class="h5">Total</span>
                                <span class="h5" id="modal-total">$0.00</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" id="complete-payment">
                    Complete Payment
                </button>
            </div>
        </div>
    </div>
</div><?php /**PATH D:\Cotton Street Stock Management\cotton-street-stock-management\resources\views/dashboard/cs-item-selling/modals/checkout.blade.php ENDPATH**/ ?>