<?php $this->load->view('templates/header'); ?>

<div class="p-2 md:p-4">
    <!-- Title and Description -->
    <div class="mb-6">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-800">Platform Statistics & Analysis</h2>
        <p class="text-gray-500 mt-1">Gambaran menyeluruh tentang pertumbuhan pengguna, pendapatan, dan keterlibatan.</p>
    </div>

    <!-- KPI Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <div class="rounded-xl bg-white shadow-sm border border-gray-100 p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Users</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1"><?= number_format($total_users); ?></p>
                </div>
                <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center">
                    <i class="fas fa-users text-blue-600"></i>
                </div>
            </div>
        </div>
        <div class="rounded-xl bg-white shadow-sm border border-gray-100 p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Revenue</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1">Rp <?= number_format($total_revenue, 0, ',', '.'); ?></p>
                </div>
                <div class="w-10 h-10 rounded-lg bg-emerald-100 flex items-center justify-center">
                    <i class="fas fa-sack-dollar text-emerald-600"></i>
                </div>
            </div>
        </div>
        <div class="rounded-xl bg-white shadow-sm border border-gray-100 p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Premium Enrollments</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1"><?= number_format($total_premium_enrollments); ?></p>
                </div>
                <div class="w-10 h-10 rounded-lg bg-purple-100 flex items-center justify-center">
                    <i class="fas fa-crown text-purple-600"></i>
                </div>
            </div>
        </div>
        <div class="rounded-xl bg-white shadow-sm border border-gray-100 p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Free Enrollments</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1"><?= number_format($total_free_enrollments); ?></p>
                </div>
                <div class="w-10 h-10 rounded-lg bg-orange-100 flex items-center justify-center">
                    <i class="fas fa-graduation-cap text-orange-600"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- User Growth Chart -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-800">User Growth (Last 30 days)</h3>
            </div>
            <div id="userGrowthPlot" class="w-full" style="height: 320px;"></div>
        </div>

        <!-- Revenue Trend Chart -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Revenue Trend (Last 30 days)</h3>
            </div>
            <div id="revenueTrendPlot" class="w-full" style="height: 320px;"></div>
        </div>

        <!-- Enrollments Trend (Premium vs Free) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 lg:col-span-2">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Enrollments Trend (Premium vs Free, Last 30 days)</h3>
            </div>
            <div id="enrollmentsTrendPlot" class="w-full" style="height: 360px;"></div>
        </div>

        <!-- Payment Status Distribution -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 lg:col-span-2">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Payment Status Distribution</h3>
            </div>
            <div id="paymentStatusPlot" class="w-full" style="height: 320px;"></div>
        </div>
    </div>
</div>

<?php $this->load->view('templates/footer'); ?>

<!-- Plotly.js -->
<script src="https://cdn.plot.ly/plotly-2.30.0.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Prepare data from PHP
        const labels = <?php echo $chart_labels ?? '[]'; ?>;
        const values = <?php echo $chart_data ?? '[]'; ?>;

        const trace = {
            x: labels,
            y: values,
            type: 'scatter',
            mode: 'lines+markers',
            line: { color: '#2563eb', width: 3 },
            marker: { color: '#3b82f6', size: 6 },
            name: 'New Users'
        };

        const layout = {
            margin: { l: 40, r: 10, t: 10, b: 40 },
            paper_bgcolor: 'white',
            plot_bgcolor: 'white',
            xaxis: {
                title: '',
                tickangle: -45,
                gridcolor: '#f1f5f9',
            },
            yaxis: {
                title: '',
                rangemode: 'tozero',
                gridcolor: '#f1f5f9',
            }
        };

        Plotly.newPlot('userGrowthPlot', [trace], layout, {displayModeBar: false, responsive: true});
        window.addEventListener('resize', () => Plotly.Plots.resize('userGrowthPlot'));

        // Revenue Trend
        const revLabels = <?php echo $rev_labels ?? '[]'; ?>;
        const revValues = <?php echo $rev_values ?? '[]'; ?>;
        const revTrace = {
            x: revLabels,
            y: revValues,
            type: 'bar',
            marker: { color: '#10b981' },
            name: 'Revenue'
        };
        Plotly.newPlot('revenueTrendPlot', [revTrace], {
            margin: { l: 40, r: 10, t: 10, b: 40 },
            paper_bgcolor: 'white', plot_bgcolor: 'white',
            xaxis: { tickangle: -45, gridcolor: '#f1f5f9' },
            yaxis: { rangemode: 'tozero', gridcolor: '#f1f5f9' }
        }, {displayModeBar: false, responsive: true});
        window.addEventListener('resize', () => Plotly.Plots.resize('revenueTrendPlot'));

        // Enrollments Trend (Premium vs Free)
        const enrollLabels = <?php echo $enroll_labels ?? '[]'; ?>;
        const enrollPremium = <?php echo $enroll_premium ?? '[]'; ?>;
        const enrollFree = <?php echo $enroll_free ?? '[]'; ?>;
        const premTrace = {
            x: enrollLabels, y: enrollPremium, type: 'scatter', mode: 'lines+markers',
            line: { color: '#7c3aed', width: 3 }, marker: { color: '#a78bfa', size: 6 }, name: 'Premium'
        };
        const freeTrace = {
            x: enrollLabels, y: enrollFree, type: 'scatter', mode: 'lines+markers',
            line: { color: '#f59e0b', width: 3 }, marker: { color: '#fbbf24', size: 6 }, name: 'Free'
        };
        Plotly.newPlot('enrollmentsTrendPlot', [premTrace, freeTrace], {
            margin: { l: 40, r: 10, t: 10, b: 40 },
            paper_bgcolor: 'white', plot_bgcolor: 'white',
            xaxis: { tickangle: -45, gridcolor: '#f1f5f9' },
            yaxis: { rangemode: 'tozero', gridcolor: '#f1f5f9' },
            legend: { orientation: 'h' }
        }, {displayModeBar: false, responsive: true});
        window.addEventListener('resize', () => Plotly.Plots.resize('enrollmentsTrendPlot'));

        // Payment Status Distribution
        const payLabels = <?php echo $pay_status_labels ?? '[]'; ?>;
        const payValues = <?php echo $pay_status_values ?? '[]'; ?>;
        const statusTrace = {
            labels: payLabels,
            values: payValues,
            type: 'pie',
            hole: 0.45,
            marker: { colors: ['#3b82f6','#10b981','#ef4444','#f59e0b','#8b5cf6'] }
        };
        Plotly.newPlot('paymentStatusPlot', [statusTrace], {
            margin: { l: 10, r: 10, t: 10, b: 10 },
            paper_bgcolor: 'white', plot_bgcolor: 'white'
        }, {displayModeBar: false, responsive: true});
        window.addEventListener('resize', () => Plotly.Plots.resize('paymentStatusPlot'));
    });
</script>
