@extends('dashboard.base')

@section('styles')
<style>

</style>
@endsection

@section('content')
<div class="pos-container">
    <!-- Header Section -->
    <div class="pos-header d-flex justify-content-between align-items-center">
        <h4>Point of Sale</h4>
        <div class="d-flex align-items-center">
            <span class="mr-3">Date: <span id="current-date"></span></span>
            <span>Time: <span id="current-time"></span></span>
        </div>
    </div>

    <!-- Main Content -->
    <div class="pos-content">
        <!-- Cart Section -->
        <div class="pos-cart-section">
            <!-- Search Section -->
            <div class="search-section">
                <div class="form-group">
                    <label><i class="fas fa-barcode"></i> Scan Barcode</label>
                    <input type="text" id="barcode" class="form-control" placeholder="Scan item barcode">
                </div>
                <div class="form-group">
                    <label><i class="fas fa-search"></i> Search Items</label>
                    <input type="text" id="manual-search" class="form-control" placeholder="Search by name">
                </div>
            </div>

            <!-- Cart Table -->
            <div class="table-responsive">
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Discount</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="item-list"></tbody>
                </table>
            </div>

            <!-- Totals Section -->
            <div class="totals-section">
                <div class="total-row">
                    <span>Subtotal:</span>
                    <span id="sub-total">0.00</span>
                </div>
                <div class="total-row">
                    <span>Discount:</span>
                    <span id="total-discount" class="text-danger">0.00</span>
                </div>
                <div class="total-row">
                    <strong>Total:</strong>
                    <strong id="grand-total">0.00</strong>
                </div>
            </div>
        </div>

        <!-- Controls Section -->
        <div class="pos-controls-section">
            <!-- Payment Section -->
            <div class="payment-section">
                <h5 class="">Payment Details</h5>
                <div class="payment-grid">
                    <div class="form-group">
                        <label>Payment Method</label>
                        <select class="form-control" id="payment-method">
                            <option value="cash">Cash</option>
                            <option value="card">Card</option>
                            <option value="upi">UPI</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Amount Received</label>
                        <input type="number" class="form-control" id="amount-received">
                    </div>
                    <div class="form-group">
                        <label>Change</label>
                        <input type="text" class="form-control" id="change" readonly>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control mb-2" id="customer-name" placeholder="Customer Name (Optional)">
                        <input type="tel" class="form-control" id="customer-phone" placeholder="Phone Number (Optional)">
                    </div>
                </div>
            </div>


            <!-- Action Buttons -->
            <div class="action-buttons">
                <button class="btn-action" id="open-calculator">
                    <i class="fas fa-calculator"></i>
                    <span>Calculator</span>
                </button>
                
                <button class="btn-action" id="clear-cart">
                    <i class="fas fa-trash"></i>
                    <span>Clear</span>
                </button>
                
                <button class="btn-action" id="hold-sale">
                    <i class="fas fa-pause"></i>
                    <span>Hold</span>
                </button>
                
                <button class="btn-action" id="print-bill">
                    <i class="fas fa-print"></i>
                    <span>Print</span>
                </button>
                
                <button class="btn-action btn-complete" id="complete-sale">
                    <i class="fas fa-check"></i>
                    <span>Complete Sale</span>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Calculator Modal -->
<div class="modal fade" id="calculator-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Calculator</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-2">
                <div class="calculator">
                    <input type="text" class="calculator-screen" value="0" disabled />
                    <div class="calculator-keys">
                        <button type="button" class="operator btn btn-info" value="%">%</button>
                        <button type="button" class="all-clear btn btn-danger" value="all-clear">AC</button>
                        <button type="button" class="clear-entry btn btn-warning" value="ce">CE</button>
                        <button type="button" class="operator btn btn-info" value="/">&divide;</button>

                        <button type="button" class="btn btn-light" value="7">7</button>
                        <button type="button" class="btn btn-light" value="8">8</button>
                        <button type="button" class="btn btn-light" value="9">9</button>
                        <button type="button" class="operator btn btn-info" value="*">&times;</button>

                        <button type="button" class="btn btn-light" value="4">4</button>
                        <button type="button" class="btn btn-light" value="5">5</button>
                        <button type="button" class="btn btn-light" value="6">6</button>
                        <button type="button" class="operator btn btn-info" value="-">-</button>

                        <button type="button" class="btn btn-light" value="1">1</button>
                        <button type="button" class="btn btn-light" value="2">2</button>
                        <button type="button" class="btn btn-light" value="3">3</button>
                        <button type="button" class="operator btn btn-info" value="+">+</button>

                        <button type="button" class="btn btn-light" value="0">0</button>
                        <button type="button" class="decimal btn btn-light" value=".">.</button>
                        <button type="button" class="btn btn-light" value="00">00</button>
                        <button type="button" class="equal-sign btn btn-success" value="=">=</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Hold Sales Modal -->
<div class="modal fade" id="hold-sales-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hold Sale</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="hold-reference">Reference Note:</label>
                    <input type="text" class="form-control" id="hold-reference" 
                        placeholder="Enter a reference note for this sale">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirm-hold">Hold Sale</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Update date and time
    function updateDateTime() {
        const dateElement = document.getElementById('current-date');
        const timeElement = document.getElementById('current-time');
        
        if (dateElement && timeElement) {
            const now = new Date();
            dateElement.textContent = now.toLocaleDateString();
            timeElement.textContent = now.toLocaleTimeString();
        }
    }
    
    // Only set interval if elements exist
    if (document.getElementById('current-date') && document.getElementById('current-time')) {
        setInterval(updateDateTime, 1000);
        updateDateTime();
    }

    // Handle barcode input
    document.getElementById('barcode').addEventListener('input', function() {
        const barcode = this.value;
        if (barcode.length > 0) {
            // Here you would typically make an API call to fetch item details
            fetchItemDetails(barcode);
            this.value = '';
        }
    });

    // Function to fetch item details (simulate API call)
    function fetchItemDetails(barcode) {
        // Simulate API call - replace with actual API call
        const mockItem = {
            name: `Item ${barcode}`,
            price: (Math.random() * 100).toFixed(2),
            id: Date.now()
        };
        addItemToTable(mockItem);
    }

    // Add item to table
    function addItemToTable(item) {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${item.name}</td>
            <td>${item.price}</td>
            <td>
                <input type="number" class="form-control quantity-input" 
                    value="1" min="1" data-price="${item.price}">
            </td>
            <td>
                <input type="number" class="form-control discount-input" 
                    value="0" min="0" max="100">
            </td>
            <td class="item-total">${item.price}</td>
            <td class="text-center">
                <button type="button" class="btn btn-danger btn-sm remove-item p-1">
                    <i class="fas fa-times fa-sm"></i>
                </button>
            </td>
        `;
        document.getElementById('item-list').appendChild(row);
        updateTotals();
    }

    // Update totals when quantity or discount changes
    document.getElementById('item-list').addEventListener('input', function(e) {
        if (e.target.classList.contains('quantity-input') || 
            e.target.classList.contains('discount-input')) {
            updateTotals();
        }
    });

    // Calculate and update totals
    function updateTotals() {
        let subTotal = 0;
        let totalDiscount = 0;

        document.querySelectorAll('#item-list tr').forEach(row => {
            const price = parseFloat(row.querySelector('.quantity-input').dataset.price);
            const quantity = parseInt(row.querySelector('.quantity-input').value);
            const discount = parseFloat(row.querySelector('.discount-input').value) || 0;
            
            const itemTotal = price * quantity * (1 - discount/100);
            const itemDiscount = price * quantity * (discount/100);
            
            row.querySelector('.item-total').textContent = itemTotal.toFixed(2);
            subTotal += itemTotal;
            totalDiscount += itemDiscount;
        });

        document.getElementById('sub-total').textContent = subTotal.toFixed(2);
        document.getElementById('total-discount').textContent = totalDiscount.toFixed(2);
        document.getElementById('grand-total').textContent = subTotal.toFixed(2);
    }

    // Remove item
    document.getElementById('item-list').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-item') || 
            e.target.parentElement.classList.contains('remove-item')) {
            const row = e.target.closest('tr');
            row.remove();
            updateTotals();
        }
    });

    // Calculate change
    document.getElementById('amount-received').addEventListener('input', function() {
        const amountReceived = parseFloat(this.value) || 0;
        const grandTotal = parseFloat(document.getElementById('grand-total').textContent);
        const change = amountReceived - grandTotal;
        document.getElementById('change').value = change >= 0 ? change.toFixed(2) : '0.00';
    });

    // Clear cart
    document.getElementById('clear-cart').addEventListener('click', function() {
        if (confirm('Are you sure you want to clear the cart?')) {
            document.getElementById('item-list').innerHTML = '';
            updateTotals();
        }
    });

    // Hold sale
    document.getElementById('hold-sale').addEventListener('click', function() {
        $('#hold-sales-modal').modal('show');
    });

    // Calculator functionality
    document.getElementById('open-calculator').addEventListener('click', function() {
        $('#calculator-modal').modal('show');
    });

    const calculator = {
        displayValue: '0',
        firstOperand: null,
        waitingForSecondOperand: false,
        operator: null,
        memory: 0
    };

    function inputDigit(digit) {
        const { displayValue, waitingForSecondOperand } = calculator;

        if (waitingForSecondOperand === true) {
            calculator.displayValue = digit;
            calculator.waitingForSecondOperand = false;
        } else {
            calculator.displayValue = displayValue === '0' ? digit : displayValue + digit;
        }
    }

    function inputDecimal(dot) {
        if (calculator.waitingForSecondOperand === true) {
            calculator.displayValue = "0.";
            calculator.waitingForSecondOperand = false;
            return;
        }

        if (!calculator.displayValue.includes(dot)) {
            calculator.displayValue += dot;
        }
    }

    function handleOperator(nextOperator) {
        const { firstOperand, displayValue, operator } = calculator;
        const inputValue = parseFloat(displayValue);

        if (operator && calculator.waitingForSecondOperand) {
            calculator.operator = nextOperator;
            return;
        }

        if (firstOperand === null && !isNaN(inputValue)) {
            calculator.firstOperand = inputValue;
        } else if (operator) {
            const result = calculate(firstOperand, inputValue, operator);
            calculator.displayValue = `${parseFloat(result.toFixed(8))}`;
            calculator.firstOperand = result;
        }

        calculator.waitingForSecondOperand = true;
        calculator.operator = nextOperator;
    }

    function calculate(firstOperand, secondOperand, operator) {
        switch(operator) {
            case '+':
                return firstOperand + secondOperand;
            case '-':
                return firstOperand - secondOperand;
            case '*':
                return firstOperand * secondOperand;
            case '/':
                return secondOperand !== 0 ? firstOperand / secondOperand : 'Error';
            case '%':
                return (firstOperand * secondOperand) / 100;
            default:
                return secondOperand;
        }
    }

    function resetCalculator() {
        calculator.displayValue = '0';
        calculator.firstOperand = null;
        calculator.waitingForSecondOperand = false;
        calculator.operator = null;
    }

    function clearEntry() {
        calculator.displayValue = '0';
    }

    function updateDisplay() {
        const display = document.querySelector('.calculator-screen');
        display.value = calculator.displayValue;
    }

    document.querySelector('.calculator-keys').addEventListener('click', (event) => {
        const { target } = event;
        if (!target.matches('button')) return;

        if (target.classList.contains('operator')) {
            handleOperator(target.value);
            updateDisplay();
            return;
        }

        if (target.classList.contains('decimal')) {
            inputDecimal(target.value);
            updateDisplay();
            return;
        }

        if (target.classList.contains('all-clear')) {
            resetCalculator();
            updateDisplay();
            return;
        }

        if (target.classList.contains('clear-entry')) {
            clearEntry();
            updateDisplay();
            return;
        }

        if (target.classList.contains('equal-sign')) {
            handleOperator('=');
            updateDisplay();
            return;
        }

        inputDigit(target.value);
        updateDisplay();
    });

    // Add keyboard support
    document.addEventListener('keydown', (event) => {
        if ($('#calculator-modal').is(':visible')) {
            const key = event.key;
            
            // Number keys
            if (/\d/.test(key)) {
                event.preventDefault();
                inputDigit(key);
                updateDisplay();
            }
            
            // Operators
            if (['+', '-', '*', '/', '%'].includes(key)) {
                event.preventDefault();
                handleOperator(key);
                updateDisplay();
            }
            
            // Enter key as equals
            if (key === 'Enter') {
                event.preventDefault();
                handleOperator('=');
                updateDisplay();
            }
            
            // Decimal point
            if (key === '.') {
                event.preventDefault();
                inputDecimal(key);
                updateDisplay();
            }
            
            // Backspace as CE
            if (key === 'Backspace') {
                event.preventDefault();
                clearEntry();
                updateDisplay();
            }
            
            // Escape as AC
            if (key === 'Escape') {
                event.preventDefault();
                resetCalculator();
                updateDisplay();
            }
        }
    });

    // Initialize calculator when modal opens
    $('#calculator-modal').on('shown.bs.modal', function () {
        resetCalculator();
        updateDisplay();
    });

    document.getElementById('print-bill').addEventListener('click', function() {
        const now = new Date();
        const dateStr = now.toLocaleDateString();
        const timeStr = now.toLocaleTimeString();
        const billNumber = 'BILL-' + now.getTime().toString().slice(-6);
        const customerName = document.getElementById('customer-name').value || 'Walk-in Customer';
        const customerPhone = document.getElementById('customer-phone').value || 'N/A';

        let billContent = `
            <html>
            <head>
                <title>Cotton Street - Sales Bill</title>
                <style>
                    @page { size: 80mm 297mm; margin: 0; }
                    body { 
                        font-family: Arial, sans-serif;
                        margin: 0;
                        padding: 10px;
                        width: 80mm;
                        background: #fff;
                    }
                    .bill-header {
                        text-align: center;
                        border-bottom: 1px dashed #000;
                        padding-bottom: 10px;
                        margin-bottom: 10px;
                    }
                    .logo {
                        font-size: 24px;
                        font-weight: bold;
                        margin-bottom: 5px;
                    }
                    .address {
                        font-size: 12px;
                        margin-bottom: 5px;
                    }
                    .contact {
                        font-size: 12px;
                        margin-bottom: 5px;
                    }
                    .bill-details {
                        font-size: 14px;
                        margin-bottom: 10px;
                        border-bottom: 1px dashed #000;
                        padding-bottom: 10px;
                    }
                    .bill-details div {
                        display: flex;
                        justify-content: space-between;
                        margin-bottom: 5px;
                    }
                    table {
                        width: 100%;
                        font-size: 12px;
                        border-collapse: collapse;
                        margin-bottom: 10px;
                    }
                    th, td {
                        padding: 5px;
                        text-align: left;
                        border-bottom: 1px dotted #ccc;
                    }
                    .totals {
                        font-size: 14px;
                        border-top: 1px dashed #000;
                        padding-top: 10px;
                    }
                    .totals div {
                        display: flex;
                        justify-content: space-between;
                        margin-bottom: 5px;
                    }
                    .grand-total {
                        font-weight: bold;
                        font-size: 16px;
                        border-top: 1px dashed #000;
                        padding-top: 5px;
                        margin-top: 5px;
                    }
                    .footer {
                        text-align: center;
                        font-size: 12px;
                        margin-top: 20px;
                        border-top: 1px dashed #000;
                        padding-top: 10px;
                    }
                    .terms {
                        font-size: 10px;
                        margin-top: 10px;
                    }
                    @media print {
                        .no-print { display: none; }
                        button { display: none; }
                    }
                </style>
            </head>
            <body>
                <div class="bill-header">
                    <div class="logo">COTTON STREET</div>
                    <div class="address">123 Fashion Avenue, City Center</div>
                    <div class="contact">Tel: +1234567890 | Email: info@cottonstreet.com</div>
                    <div class="contact">GST No: XXXXXXXXXXXX</div>
                </div>

                <div class="bill-details">
                    <div>
                        <span>Bill No:</span>
                        <span>${billNumber}</span>
                    </div>
                    <div>
                        <span>Date:</span>
                        <span>${dateStr}</span>
                    </div>
                    <div>
                        <span>Time:</span>
                        <span>${timeStr}</span>
                    </div>
                    <div>
                        <span>Customer:</span>
                        <span>${customerName}</span>
                    </div>
                    <div>
                        <span>Phone:</span>
                        <span>${customerPhone}</span>
                    </div>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
        `;

        // Add items to bill
        document.querySelectorAll('#item-list tr').forEach(row => {
            const name = row.cells[0].textContent;
            const price = row.cells[1].textContent;
            const quantity = row.querySelector('.quantity-input').value;
            const discount = row.querySelector('.discount-input').value;
            const total = row.querySelector('.item-total').textContent;

            billContent += `
                <tr>
                    <td>${name}</td>
                    <td>${quantity}</td>
                    <td>${price}</td>
                    <td>${total}</td>
                </tr>
            `;
            if (discount > 0) {
                billContent += `
                    <tr>
                        <td colspan="3" style="text-align: right; color: #666;">Discount (${discount}%)</td>
                        <td style="color: #666;">-${((price * quantity * discount) / 100).toFixed(2)}</td>
                    </tr>
                `;
            }
        });

        billContent += `
                    </tbody>
                </table>

                <div class="totals">
                    <div>
                        <span>Sub Total:</span>
                        <span>${document.getElementById('sub-total').textContent}</span>
                    </div>
                    <div>
                        <span>Total Discount:</span>
                        <span>${document.getElementById('total-discount').textContent}</span>
                    </div>
                    <div class="grand-total">
                        <span>GRAND TOTAL:</span>
                        <span>${document.getElementById('grand-total').textContent}</span>
                    </div>
                    <div>
                        <span>Amount Received:</span>
                        <span>${document.getElementById('amount-received').value || '0.00'}</span>
                    </div>
                    <div>
                        <span>Change:</span>
                        <span>${document.getElementById('change').value || '0.00'}</span>
                    </div>
                    <div>
                        <span>Payment Method:</span>
                        <span>${document.getElementById('payment-method').value.toUpperCase()}</span>
                    </div>
                </div>

                <div class="footer">
                    <p>Thank you for shopping at Cotton Street!</p>
                    <p>Visit us again</p>
                    <div class="terms">
                        * Items once sold cannot be returned or exchanged<br>
                        * Please keep this bill for any future reference<br>
                        * This is a computer generated bill
                    </div>
                </div>

                <div class="no-print" style="text-align: center; margin-top: 20px;">
                    <button onclick="window.print()" style="padding: 10px 20px; margin: 5px;">Print</button>
                    <button onclick="window.close()" style="padding: 10px 20px; margin: 5px;">Close</button>
                </div>
            </body>
            </html>
        `;

        const printWindow = window.open('', 'Print Bill', 'height=600,width=800');
        printWindow.document.write(billContent);
        printWindow.document.close();
    });
</script>
@endsection
