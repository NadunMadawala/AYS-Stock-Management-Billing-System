<div class="modal fade" id="hold-sales-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Hold Sale</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="hold-reference" class="form-label">Reference Note</label>
                    <input type="text" class="form-control" id="hold-reference" 
                           placeholder="Enter a reference note for this sale">
                </div>
                <div class="mb-3">
                    <label class="form-label">Sale Summary</label>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <tbody id="hold-items-summary">
                                <!-- Items will be listed here -->
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Total Items:</th>
                                    <td id="hold-total-items">0</td>
                                </tr>
                                <tr>
                                    <th>Total Amount:</th>
                                    <td id="hold-total-amount">$0.00</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirm-hold">Hold Sale</button>
            </div>
        </div>
    </div>
</div><?php /**PATH D:\Cotton Street Stock Management\cotton-street-stock-management\resources\views/dashboard/cs-item-selling/modals/hold-sales.blade.php ENDPATH**/ ?>