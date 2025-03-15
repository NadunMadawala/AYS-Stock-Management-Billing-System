

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        
                        <div class="card-body">
                            <?php if(Session::has('message')): ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <?php echo e(Session::get('message')); ?>

                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif; ?>

                            <?php if(Session::has('error')): ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <?php echo e(Session::get('error')); ?>

                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif; ?>

                            <form method="POST" action="" class="form-horizontal" id="sale-form">
                                <?php echo csrf_field(); ?>
                                
                                <div class="row mb-4">
                                    <!-- Barcode Scanner Section -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="barcode"><i class="fas fa-barcode"></i> Barcode Scanner:</label>
                                            <input type="text" id="barcode" name="barcode" class="form-control" 
                                                placeholder="Scan or enter barcode" autocomplete="off">
                                        </div>
                                    </div>
                                    <!-- Manual Search Section -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="manual-search"><i class="fas fa-search"></i> Search Item:</label>
                                            <input type="text" id="manual-search" class="form-control" 
                                                placeholder="Search by item name">
                                        </div>
                                    </div>
                                </div>

                                <!-- Items Table -->
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Item Name</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Discount</th>
                                                <th>Total</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="item-list">
                                            <!-- Items will be added here dynamically -->
                                        </tbody>
                                        <tfoot>
                                            <tr class="table-info">
                                                <td colspan="3"></td>
                                                <td><strong>Sub Total:</strong></td>
                                                <td colspan="2"><span id="sub-total">0.00</span></td>
                                            </tr>
                                            <tr class="table-info">
                                                <td colspan="3"></td>
                                                <td><strong>Total Discount:</strong></td>
                                                <td colspan="2"><span id="total-discount">0.00</span></td>
                                            </tr>
                                            <tr class="table-success">
                                                <td colspan="3"></td>
                                                <td><strong>Grand Total:</strong></td>
                                                <td colspan="2"><span id="grand-total">0.00</span></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                                <!-- Payment Section -->
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="payment-method">Payment Method:</label>
                                            <select class="form-control" id="payment-method" name="payment_method">
                                                <option value="cash">Cash</option>
                                                <option value="card">Card</option>
                                                <option value="upi">UPI</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="amount-received">Amount Received:</label>
                                            <input type="number" class="form-control" id="amount-received" 
                                                name="amount_received" step="0.01">
                                        </div>
                                        <div class="form-group">
                                            <label for="change">Change:</label>
                                            <input type="text" class="form-control" id="change" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="customer-name">Customer Name (Optional):</label>
                                            <input type="text" class="form-control" id="customer-name" 
                                                name="customer_name">
                                        </div>
                                        <div class="form-group">
                                            <label for="customer-phone">Customer Phone (Optional):</label>
                                            <input type="tel" class="form-control" id="customer-phone" 
                                                name="customer_phone">
                                        </div>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <button type="button" id="open-calculator" class="btn btn-secondary">
                                            <i class="fas fa-calculator"></i> Calculator
                                        </button>
                                        <button type="button" class="btn btn-warning" id="clear-cart">
                                            <i class="fas fa-trash"></i> Clear Cart
                                        </button>
                                        <button type="button" class="btn btn-info" id="hold-sale">
                                            <i class="fas fa-pause"></i> Hold Sale
                                        </button>
                                        <button type="submit" class="btn btn-success" id="complete-sale">
                                            <i class="fas fa-check"></i> Complete Sale
                                        </button>
                                        <a class="btn btn-danger" href="/dashboard">
                                            <i class="fas fa-times"></i> Cancel
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
<style>
.calculator {
    background-color: #f8f9fa;
    padding: 10px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.calculator-screen {
    width: 100%;
    height: 60px;
    border: 1px solid #ddd;
    background-color: #fff;
    text-align: right;
    padding: 0 20px;
    font-size: 28px;
    font-family: 'Courier New', Courier, monospace;
    margin-bottom: 10px;
    border-radius: 4px;
    box-shadow: inset 0 1px 3px rgba(0,0,0,0.1);
}

.calculator-keys {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 8px;
}

.calculator-keys button {
    height: 50px;
    font-size: 18px;
    font-weight: bold;
    border: none;
    border-radius: 4px;
    transition: all 0.2s;
}

.calculator-keys button:hover {
    transform: translateY(-1px);
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
}

.calculator-keys button:active {
    transform: translateY(1px);
}

.btn-light {
    background-color: #fff !important;
    border: 1px solid #ddd !important;
}

.btn-light:hover {
    background-color: #f8f9fa !important;
}

.operator {
    font-weight: bold !important;
}

.equal-sign {
    font-weight: bold !important;
}

.all-clear, .clear-entry {
    font-weight: bold !important;
}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Update date and time
    function updateDateTime() {
        const now = new Date();
        document.getElementById('current-date').textContent = now.toLocaleDateString();
        document.getElementById('current-time').textContent = now.toLocaleTimeString();
    }
    setInterval(updateDateTime, 1000);
    updateDateTime();

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
            <td>
                <button type="button" class="btn btn-danger btn-sm remove-item">
                    <i class="fas fa-trash"></i>
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
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Cotton Street Stock Management\cotton-street-stock-management\resources\views/dashboard/sms-chemicals/add-chemicals.blade.php ENDPATH**/ ?>