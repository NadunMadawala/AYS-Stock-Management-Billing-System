    <?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts/dist/apexcharts.css">
<style>
    :root {
        --primary: #1a237e;
        --secondary: #283593;
        --success: #00c853;
        --warning: #ffd600;
        --danger: #d50000;
        --background: #f8f9fa;
        --card-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    .dashboard-container {
        padding: 1rem;
        background: var(--background);
    }

    .stat-card {
        background: white;
        border-radius: 8px;
        box-shadow: var(--card-shadow);
        padding: 1rem;
        height: 100px;
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
        position: relative;
        overflow: hidden;
    }

    .stat-icon {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
    }

    .stat-icon i {
        font-size: 1.2rem;
        color: white;
    }

    .stat-content {
        flex: 1;
    }

    .stat-value {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 0.2rem;
        color: var(--primary);
    }

    .stat-label {
        font-size: 0.8rem;
        color: #666;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .trend {
        position: absolute;
        top: 0.5rem;
        right: 0.5rem;
        font-size: 0.75rem;
        padding: 0.2rem 0.5rem;
        border-radius: 4px;
    }

    .trend.up {
        background: rgba(0, 200, 83, 0.1);
        color: var(--success);
    }

    .trend.down {
        background: rgba(213, 0, 0, 0.1);
        color: var(--danger);
    }

    .chart-card {
        background: white;
        border-radius: 8px;
        box-shadow: var(--card-shadow);
        margin-bottom: 1rem;
    }

    .chart-header {
        padding: 1rem;
        border-bottom: 1px solid #eee;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .chart-title {
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--primary);
        margin: 0;
    }

    .chart-container {
        padding: 1rem;
        height: 300px;
    }

    .table-card {
        background: white;
        border-radius: 8px;
        box-shadow: var(--card-shadow);
    }

    .compact-table {
        font-size: 0.85rem;
    }

    .compact-table th {
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        color: #666;
        padding: 0.75rem;
    }

    .compact-table td {
        padding: 0.75rem;
        vertical-align: middle;
    }

    .status-badge {
        padding: 0.25rem 0.5rem;
        border-radius: 4px;
        font-size: 0.75rem;
        font-weight: 500;
    }

    .status-badge.low {
        background: rgba(213, 0, 0, 0.1);
        color: var(--danger);
    }

    .status-badge.medium {
        background: rgba(255, 214, 0, 0.1);
        color: var(--warning);
    }

    .status-badge.good {
        background: rgba(0, 200, 83, 0.1);
        color: var(--success);
    }

    .period-selector {
        background-color: #fff;
        border: 1px solid #e0e0e0;
        border-radius: 6px;
        padding: 4px 12px;
        font-size: 0.875rem;
        color: var(--primary);
        cursor: pointer;
        transition: all 0.2s ease;
        outline: none;
        min-width: 100px;
    }

    .period-selector:hover {
        border-color: var(--primary);
    }

    .period-selector:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 2px rgba(26, 35, 126, 0.1);
    }

    .chart-title-wrapper {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .chart-subtitle {
        font-size: 0.75rem;
        color: #666;
        margin: 0;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="dashboard-container">
    <!-- Stats Row -->
    <div class="row g-3 mb-3">
        <div class="col-md-3 col-sm-6">
            <div class="stat-card">
                <div class="stat-icon" style="background: var(--primary)">
                    <i class="fas fa-shopping-bag"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-value">Rs <span id="todaySales">0</span></div>
                    <div class="stat-label">Today's Sales</div>
                </div>
                <div class="trend up">
                    <i class="fas fa-arrow-up"></i> 12.5%
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="stat-card">
                <div class="stat-icon" style="background: var(--secondary)">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-value">Rs <span id="monthlyRevenue">0</span></div>
                    <div class="stat-label">Monthly Revenue</div>
                </div>
                <div class="trend up">
                    <i class="fas fa-arrow-up"></i> 8.3%
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="stat-card">
                <div class="stat-icon" style="background: var(--success)">
                    <i class="fas fa-receipt"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-value">Rs <span id="avgOrder">0</span></div>
                    <div class="stat-label">Avg Order Value</div>
                </div>
                <div class="trend up">
                    <i class="fas fa-arrow-up"></i> 5.2%
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6">
            <div class="stat-card">
                <div class="stat-icon" style="background: var(--warning)">
                    <i class="fas fa-tshirt"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-value"><span id="itemsSold">0</span></div>
                    <div class="stat-label">Items Sold Today</div>
                </div>
                <div class="trend down">
                    <i class="fas fa-arrow-down"></i> 2.1%
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row mb-3">
        <div class="col-md-8">
            <div class="chart-card">
                <div class="chart-header">
                    <div class="chart-title-wrapper">
                        <div>
                            <h6 class="chart-title">Sales Performance</h6>
                            <p class="chart-subtitle">Daily revenue overview</p>
                        </div>
                    </div>
                    <select class="period-selector" id="salesPeriod">
                        <option value="7">Last 7 Days</option>
                        <option value="30">Last 30 Days</option>
                        <option value="90">Last 90 Days</option>
                    </select>
                </div>
                <div class="chart-container">
                    <div id="salesChart"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="chart-card">
                <div class="chart-header">
                    <h6 class="chart-title">Category Distribution</h6>
                </div>
                <div class="chart-container">
                    <div id="categoryChart"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Inventory Table -->
    
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Counter Animation
    function animateValue(id, start, end, duration) {
        const obj = document.getElementById(id);
        const range = end - start;
        const minTimer = 50;
        const stepTime = Math.abs(Math.floor(duration / range));
        const startTime = new Date().getTime();
        const endTime = startTime + duration;
        let timer;

        function run() {
            const now = new Date().getTime();
            const remaining = Math.max((endTime - now) / duration, 0);
            const value = Math.round(end - (remaining * range));
            obj.innerHTML = value.toLocaleString();
            if (value == end) {
                clearInterval(timer);
            }
        }

        timer = setInterval(run, stepTime);
        run();
    }

    // Initialize Counters with Realistic Values
    animateValue("todaySales", 0, <?php echo e($total_Sales); ?>, 1500);
    animateValue("monthlyRevenue", 0, <?php echo e($total_Sales_month); ?>, 1500);
    animateValue("avgOrder", 0, 2250, 1500); // Average order value
    animateValue("itemsSold", 0, 185, 1500); // Daily items sold

    // Sales Chart with Real Sales Pattern
    const salesChartOptions = {
        series: [{
            name: 'Daily Sales',
            data: [125000, 138000, 142500, 157000, 162000, 178000, 149000]
        }, {
            name: 'Target',
            data: [130000, 140000, 145000, 155000, 160000, 170000, 150000]
        }],
        chart: {
            height: 280,
            type: 'area',
            toolbar: {
                show: false
            }
        },
        colors: ['#1a237e', '#7986cb'],
        fill: {
            type: 'gradient',
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.45,
                opacityTo: 0.05,
                stops: [50, 100]
            }
        },
        stroke: {
            curve: 'smooth',
            width: 2
        },
        xaxis: {
            categories: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            labels: {
                style: { fontSize: '12px' }
            }
        },
        yaxis: {
            labels: {
                formatter: function(value) {
                    return 'Rs ' + (value/1000) + 'K'
                },
                style: { fontSize: '12px' }
            }
        },
        tooltip: {
            y: {
                formatter: function(value) {
                    return 'Rs ' + value.toLocaleString()
                }
            }
        }
    };

    const salesChart = new ApexCharts(document.querySelector("#salesChart"), salesChartOptions);
    salesChart.render();

    // Category Distribution with Realistic Percentages
    const categoryChartOptions = {
        series: [42, 28, 15, 10, 5],
        chart: {
            type: 'donut',
            height: 280
        },
        labels: ['Casual Wear', 'Ethnic Wear', 'Western Wear', 'Accessories', 'Others'],
        colors: ['#1a237e', '#283593', '#3949ab', '#5c6bc0', '#7986cb'],
        plotOptions: {
            pie: {
                donut: {
                    size: '75%',
                    labels: {
                        show: true,
                        total: {
                            show: true,
                            label: 'Total Sales',
                            formatter: function(w) {
                                return 'Rs ' + w.globals.seriesTotals.reduce((a, b) => a + b, 0).toLocaleString();
                            }
                        }
                    }
                }
            }
        },
        legend: {
            position: 'bottom',
            fontSize: '12px'
        },
        dataLabels: {
            enabled: true,
            formatter: function(val) {
                return val.toFixed(1) + '%';
            }
        }
    };

    const categoryChart = new ApexCharts(document.querySelector("#categoryChart"), categoryChartOptions);
    categoryChart.render();

    // Low Stock Table with Real Product Data
    const lowStockData = [
        {
            product: 'Men\'s Cotton Casual T-Shirt',
            category: 'Casual Wear',
            stock: 25,
            sales: 120,
            status: 'low',
            sku: 'CT-' + Math.random().toString(36).substr(2, 6).toUpperCase()
        },
        {
            product: 'Women\'s Designer Kurti',
            category: 'Ethnic Wear',
            stock: 18,
            sales: 85,
            status: 'low',
            sku: 'EW-' + Math.random().toString(36).substr(2, 6).toUpperCase()
        },
        {
            product: 'Men\'s Slim Fit Jeans',
            category: 'Western Wear',
            stock: 30,
            sales: 95,
            status: 'medium',
            sku: 'WW-' + Math.random().toString(36).substr(2, 6).toUpperCase()
        },
        {
            product: 'Women\'s Casual Palazzo',
            category: 'Ethnic Wear',
            stock: 15,
            sales: 75,
            status: 'low',
            sku: 'EW-' + Math.random().toString(36).substr(2, 6).toUpperCase()
        },
        {
            product: 'Unisex Cotton Hoodie',
            category: 'Casual Wear',
            stock: 22,
            sales: 88,
            status: 'medium',
            sku: 'CH-' + Math.random().toString(36).substr(2, 6).toUpperCase()
        }
    ];

    // const lowStockTable = document.getElementById('lowStockTable');
    // lowStockData.forEach(item => {
    //     const row = document.createElement('tr');
    //     row.innerHTML = `
    //         <td>
    //             <div class="fw-medium">${item.product}</div>
    //             <div class="text-muted small">#${item.sku}</div>
    //         </td>
    //         <td>${item.category}</td>
    //         <td>${item.stock} units</td>
    //         <td>${item.sales} units</td>
    //         <td>
    //             <span class="status-badge ${item.status}">
    //                 ${item.status.charAt(0).toUpperCase() + item.status.slice(1)}
    //             </span>
    //         </td>
    //         <td>
    //             <button class="btn btn-sm btn-outline-primary">Reorder</button>
    //         </td>
    //     `;
    //     lowStockTable.appendChild(row);
    // });

    // Update period selector
    document.getElementById('salesPeriod').addEventListener('change', function(e) {
        // Here you would typically fetch new data based on the selected period
        // For demo purposes, we'll just show different random data
        const newData = generateRandomSalesData(parseInt(e.target.value));
        salesChart.updateSeries([{
            name: 'Daily Sales',
            data: newData.sales
        }, {
            name: 'Target',
            data: newData.target
        }]);
    });

    function generateRandomSalesData(days) {
        const sales = [];
        const target = [];
        const baseValue = 140000;

        for(let i = 0; i < days; i++) {
            const randomSale = baseValue + Math.random() * 50000 - 25000;
            sales.push(Math.round(randomSale));
            target.push(baseValue + 10000);
        }

        return { sales, target };
    }
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Cotton Street Stock Management\cotton-street-stock-management\resources\views/dashboard/cs-main-dashboard/dashboard.blade.php ENDPATH**/ ?>