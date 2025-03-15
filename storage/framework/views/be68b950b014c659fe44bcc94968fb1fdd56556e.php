
<div class="modal fade" id="receipt-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Receipt Preview</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="receipt-content" class="p-3">
                    <div class="text-center mb-4">
                        <h4>Your Company Name</h4>
                        <p class="mb-1">123 Street Name, City</p>
                        <p class="mb-1">Phone: (123) 456-7890</p>
                        <p>Receipt #: <span id="receipt-number"></span></p>
                        <p>Date: <span id="receipt-date"></span></p>
                    </div>
                    
                    <div class="receipt-items mb-4">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody id="receipt-items">
                                <!-- Items will be listed here -->
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3">Subtotal</th>
                                    <td id="receipt-subtotal">$0.00</td>
                                </tr>
                                <tr>
                                    <th colspan="3">Tax (10%)</th>
                                    <td id="receipt-tax">$0.00</td>
                                </tr>
                                <tr>
                                    <th colspan="3">Total</th>
                                    <td id="receipt-total">$0.00</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="text-center">
                        <p>Thank you for your purchase!</p>
                        <p class="small">Please keep this receipt for your records</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="print-receipt">
                    <i class="fas fa-print"></i> Print Receipt
                </button>
            </div>
        </div>
    </div>
</div><?php /**PATH D:\Cotton Street Stock Management\cotton-street-stock-management\resources\views/dashboard/cs-item-selling/modals/receipt.blade.php ENDPATH**/ ?>