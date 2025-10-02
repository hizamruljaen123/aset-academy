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
    <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
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

        <!-- Payment Status Distribution -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Payment Status Distribution</h3>
            </div>
            <div id="paymentStatusPlot" class="w-full" style="height: 320px;"></div>
        </div>

        <!-- Enrollments Trend (Premium vs Free) -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 xl:col-span-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Enrollments Trend (Premium vs Free, Last 30 days)</h3>
            </div>
            <div id="enrollmentsTrendPlot" class="w-full" style="height: 360px;"></div>
        </div>

        <!-- Enrollment Comparison -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Enrollment Status Comparison</h3>
            </div>
            <div id="enrollmentComparisonPlot" class="w-full" style="height: 320px;"></div>
        </div>

        <!-- Attendance Statistics -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Student Attendance Overview</h3>
            </div>
            <div id="attendancePlot" class="w-full" style="height: 320px;"></div>
        </div>

        <!-- User Role Distribution -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-800">User Roles Distribution</h3>
            </div>
            <div id="userRolesPlot" class="w-full" style="height: 320px;"></div>
        </div>

        <!-- Student Jurusan Distribution -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 xl:col-span-2">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Student Distribution by Major</h3>
            </div>
            <div id="jurusanPlot" class="w-full" style="height: 320px;"></div>
        </div>

        <!-- Revenue by Payment Method -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Revenue by Payment Method</h3>
            </div>
            <div id="revenueMethodPlot" class="w-full" style="height: 320px;"></div>
        </div>

        <!-- Class Level Distribution -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 xl:col-span-2">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Class Distribution by Level</h3>
            </div>
            <div id="classLevelPlot" class="w-full" style="height: 320px;"></div>
        </div>

        <!-- Monthly Revenue Comparison -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 xl:col-span-3">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Monthly Revenue Comparison (6 Months)</h3>
            </div>
            <div id="monthlyRevenuePlot" class="w-full" style="height: 320px;"></div>
        </div>
    </div>

    <!-- Tables Section -->
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mt-6">
        <!-- Top Classes by Enrollment -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Top Classes by Enrollment</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-gray-900">Class Name</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-900">Type</th>
                            <th class="px-4 py-3 text-center font-semibold text-gray-900">Enrollments</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php foreach ($top_classes as $class): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 text-gray-900 truncate max-w-64"><?php echo htmlspecialchars($class['class_name']); ?></td>
                            <td class="px-4 py-3 text-gray-900">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?php echo $class['type'] == 'Premium' ? 'bg-purple-100 text-purple-800' : 'bg-orange-100 text-orange-800'; ?>">
                                    <?php echo $class['type']; ?>
                                </span>
                            </td>
                            <td class="px-4 py-3 text-center text-gray-900 font-medium"><?php echo number_format($class['enrollments']); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Teacher Workload -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Teacher Workload</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-gray-900">Teacher</th>
                            <th class="px-4 py-3 text-center font-semibold text-gray-900">Classes</th>
                            <th class="px-4 py-3 text-center font-semibold text-gray-900">Schedules</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php foreach ($teacher_workload as $teacher): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 text-gray-900 truncate max-w-48"><?php echo htmlspecialchars($teacher['teacher_name']); ?></td>
                            <td class="px-4 py-3 text-center text-gray-900"><?php echo $teacher['total_classes']; ?></td>
                            <td class="px-4 py-3 text-center text-gray-900"><?php echo $teacher['total_schedules']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-6">
        <!-- Workshop Statistics -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Workshops</p>
                    <p class="text-2xl font-bold text-gray-900 mt-1"><?php echo number_format($workshop_stats['total_workshops']); ?></p>
                </div>
                <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center">
                    <i class="fas fa-calendar-check text-blue-600"></i>
                </div>
            </div>
            <div class="mt-2">
                <p class="text-xs text-gray-500">Published: <?php echo number_format($workshop_stats['published']); ?> | Completed: <?php echo number_format($workshop_stats['completed']); ?></p>
                <p class="text-xs text-gray-500">Participants: <?php echo number_format($workshop_stats['total_participants']); ?> | Guests: <?php echo number_format($workshop_stats['total_guests']); ?></p>
            </div>
        </div>

        <!-- Assignment Statistics -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Assignment Submissions</p>
                    <p class="text-2xl font-bold text-gray-900 mt-1"><?php echo number_format($assignment_stats['total_submissions']); ?>/<?php echo number_format($assignment_stats['total_assignments']); ?></p>
                </div>
                <div class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center">
                    <i class="fas fa-tasks text-green-600"></i>
                </div>
            </div>
            <div class="mt-2">
                <p class="text-xs text-gray-500">Submission Rate: <?php echo number_format($assignment_stats['submission_rate'], 1); ?>%</p>
                <p class="text-xs text-gray-500">Graded: <?php echo number_format($assignment_stats['graded']); ?> | Pending: <?php echo number_format($assignment_stats['pending']); ?></p>
            </div>
        </div>

        <!-- Forum Statistics -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Forum Activity</p>
                    <p class="text-2xl font-bold text-gray-900 mt-1"><?php echo number_format($forum_stats['total_threads']); ?> Threads</p>
                </div>
                <div class="w-10 h-10 rounded-lg bg-yellow-100 flex items-center justify-center">
                    <i class="fas fa-comments text-yellow-600"></i>
                </div>
            </div>
            <div class="mt-2">
                <p class="text-xs text-gray-500">Posts: <?php echo number_format($forum_stats['total_posts']); ?> | Likes: <?php echo number_format($forum_stats['total_likes']); ?></p>
                <p class="text-xs text-gray-500">Total Views: <?php echo number_format($forum_stats['total_views']); ?> | Pinned: <?php echo $forum_stats['pinned_threads']; ?></p>
            </div>
        </div>

        <!-- Daily Activity -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Recent Activity (7 Days)</p>
                    <p class="text-2xl font-bold text-gray-900 mt-1"><?php echo number_format(count($daily_activity['users'])); ?> Days</p>
                </div>
                <div class="w-10 h-10 rounded-lg bg-purple-100 flex items-center justify-center">
                    <i class="fas fa-chart-line text-purple-600"></i>
                </div>
            </div>
            <div class="mt-2">
                <p class="text-xs text-gray-500">New Registrations</p>
                <p class="text-xs text-gray-500">New Enrollments</p>
            </div>
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

        // Enrollment Comparison (Premium vs Free by Status)
        const enrollmentComparison = <?php echo json_encode($enrollment_comparison); ?>;
        const enrollmentData = [];

        ['Premium', 'Gratis'].forEach(type => {
            ['Enrolled', 'Completed', 'Dropped'].forEach(status => {
                const filteredData = enrollmentComparison.filter(item => item.type === type && item.status === status);
                const value = filteredData.length > 0 ? filteredData[0].total : 0;
                enrollmentData.push({
                    type: type,
                    status: status,
                    value: value
                });
            });
        });

        const enrolledPrem = enrollmentData.filter(item => item.type === 'Premium' && item.status === 'Enrolled').map(item => item.value)[0] || 0;
        const completedPrem = enrollmentData.filter(item => item.type === 'Premium' && item.status === 'Completed').map(item => item.value)[0] || 0;
        const droppedPrem = enrollmentData.filter(item => item.type === 'Premium' && item.status === 'Dropped').map(item => item.value)[0] || 0;

        const enrolledFree = enrollmentData.filter(item => item.type === 'Gratis' && item.status === 'Enrolled').map(item => item.value)[0] || 0;
        const completedFree = enrollmentData.filter(item => item.type === 'Gratis' && item.status === 'Completed').map(item => item.value)[0] || 0;
        const droppedFree = enrollmentData.filter(item => item.type === 'Gratis' && item.status === 'Dropped').map(item => item.value)[0] || 0;

        const comparisonTrace = [
            {
                x: ['Premium', 'Free'],
                y: [enrolledPrem, enrolledFree],
                name: 'Enrolled',
                type: 'bar',
                marker: { color: '#3b82f6' }
            },
            {
                x: ['Premium', 'Free'],
                y: [completedPrem, completedFree],
                name: 'Completed',
                type: 'bar',
                marker: { color: '#10b981' }
            },
            {
                x: ['Premium', 'Free'],
                y: [droppedPrem, droppedFree],
                name: 'Dropped',
                type: 'bar',
                marker: { color: '#ef4444' }
            }
        ];

        const comparisonLayout = {
            barmode: 'stack',
            margin: { l: 40, r: 10, t: 10, b: 40 },
            paper_bgcolor: 'white', plot_bgcolor: 'white',
            xaxis: { gridcolor: '#f1f5f9' },
            yaxis: { rangemode: 'tozero', gridcolor: '#f1f5f9' },
            showlegend: true,
            legend: { orientation: 'h', y: -0.2 }
        };

        Plotly.newPlot('enrollmentComparisonPlot', comparisonTrace, comparisonLayout, {displayModeBar: false, responsive: true});
        window.addEventListener('resize', () => Plotly.Plots.resize('enrollmentComparisonPlot'));

        // Attendance Statistics
        const attendanceStats = <?php echo json_encode($attendance_stats); ?>;
        const attendanceLabels = attendanceStats.map(item => item.status);
        const attendanceValues = attendanceStats.map(item => item.total);

        const attendanceTrace = {
            x: attendanceLabels,
            y: attendanceValues,
            type: 'bar',
            marker: {
                color: ['#10b981', '#3b82f6', '#ef4444', '#f59e0b']
            }
        };

        Plotly.newPlot('attendancePlot', [attendanceTrace], {
            margin: { l: 40, r: 10, t: 10, b: 40 },
            paper_bgcolor: 'white', plot_bgcolor: 'white',
            xaxis: { gridcolor: '#f1f5f9' },
            yaxis: { rangemode: 'tozero', gridcolor: '#f1f5f9' }
        }, {displayModeBar: false, responsive: true});
        window.addEventListener('resize', () => Plotly.Plots.resize('attendancePlot'));

        // User Role Distribution
        const userRoles = <?php echo json_encode($user_roles); ?>;
        const roleLabels = userRoles.map(item => item.role);
        const roleValues = userRoles.map(item => item.total);

        const roleTrace = {
            labels: roleLabels,
            values: roleValues,
            type: 'pie',
            hole: 0.4,
            marker: {
                colors: ['#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6']
            }
        };

        Plotly.newPlot('userRolesPlot', [roleTrace], {
            margin: { l: 10, r: 10, t: 10, b: 10 },
            paper_bgcolor: 'white', plot_bgcolor: 'white'
        }, {displayModeBar: false, responsive: true});
        window.addEventListener('resize', () => Plotly.Plots.resize('userRolesPlot'));

        // Student Jurusan Distribution
        const jurusanDist = <?php echo json_encode($jurusan_dist); ?>;
        const jurusanLabels = jurusanDist.map(item => item.jurusan);
        const jurusanValues = jurusanDist.map(item => item.total);

        const jurusanTrace = {
            x: jurusanValues,
            y: jurusanLabels,
            type: 'bar',
            orientation: 'h',
            marker: { color: '#7c3aed' }
        };

        Plotly.newPlot('jurusanPlot', [jurusanTrace], {
            margin: { l: 120, r: 10, t: 10, b: 40 },
            paper_bgcolor: 'white', plot_bgcolor: 'white',
            xaxis: { rangemode: 'tozero', gridcolor: '#f1f5f9' },
            yaxis: { gridcolor: '#f1f5f9' }
        }, {displayModeBar: false, responsive: true});
        window.addEventListener('resize', () => Plotly.Plots.resize('jurusanPlot'));

        // Revenue by Payment Method
        const revenueMethod = <?php echo json_encode($revenue_by_method); ?>;
        const methodLabels = revenueMethod.map(item => item.payment_method);
        const methodValues = revenueMethod.map(item => item.total);
        const methodCounts = revenueMethod.map(item => item.count);

        const methodTrace = [
            {
                x: methodLabels,
                y: methodValues,
                name: 'Revenue',
                type: 'bar',
                marker: { color: '#10b981', opacity: 0.7 },
                yaxis: 'y'
            },
            {
                x: methodLabels,
                y: methodCounts,
                name: 'Transaction Count',
                type: 'scatter',
                mode: 'markers+lines',
                marker: { color: '#3b82f6', size: 8 },
                line: { color: '#3b82f6' },
                yaxis: 'y2'
            }
        ];

        const methodLayout = {
            margin: { l: 40, r: 60, t: 10, b: 40 },
            paper_bgcolor: 'white', plot_bgcolor: 'white',
            xaxis: { gridcolor: '#f1f5f9' },
            yaxis: { title: 'Revenue', side: 'left', rangemode: 'tozero', gridcolor: '#f1f5f9' },
            yaxis2: { title: 'Transactions', side: 'right', overlaying: 'y', rangemode: 'tozero' },
            showlegend: true,
            legend: { orientation: 'h', y: -0.2 }
        };

        Plotly.newPlot('revenueMethodPlot', methodTrace, methodLayout, {displayModeBar: false, responsive: true});
        window.addEventListener('resize', () => Plotly.Plots.resize('revenueMethodPlot'));

        // Class Level Distribution
        const classLevels = <?php echo json_encode($class_levels); ?>;
        const levelLabels = Object.keys(classLevels);
        const levelValues = Object.values(classLevels);

        const levelTrace = {
            x: levelLabels,
            y: levelValues,
            type: 'bar',
            marker: {
                color: ['#3b82f6', '#10b981', '#7c3aed', '#f59e0b', '#ef4444', '#8b5cf6']
            }
        };

        Plotly.newPlot('classLevelPlot', [levelTrace], {
            margin: { l: 40, r: 10, t: 10, b: 40 },
            paper_bgcolor: 'white', plot_bgcolor: 'white',
            xaxis: { tickangle: -45, gridcolor: '#f1f5f9' },
            yaxis: { rangemode: 'tozero', gridcolor: '#f1f5f9' }
        }, {displayModeBar: false, responsive: true});
        window.addEventListener('resize', () => Plotly.Plots.resize('classLevelPlot'));

        // Monthly Revenue Comparison
        const monthlyRevenue = <?php echo json_encode($monthly_revenue); ?>;
        const monthLabels = monthlyRevenue.map(item => item.month);
        const monthValues = monthlyRevenue.map(item => parseFloat(item.total));

        const monthlyTrace = {
            x: monthLabels,
            y: monthValues,
            type: 'scatter',
            mode: 'lines+markers',
            line: { color: '#7c3aed', width: 3 },
            marker: { color: '#a78bfa', size: 8 },
            fill: 'tozeroy',
            fillcolor: 'rgba(124, 58, 237, 0.1)'
        };

        Plotly.newPlot('monthlyRevenuePlot', [monthlyTrace], {
            margin: { l: 40, r: 10, t: 10, b: 40 },
            paper_bgcolor: 'white', plot_bgcolor: 'white',
            xaxis: { gridcolor: '#f1f5f9', title: 'Month' },
            yaxis: { rangemode: 'tozero', gridcolor: '#f1f5f9', title: 'Revenue' }
        }, {displayModeBar: false, responsive: true});
        window.addEventListener('resize', () => Plotly.Plots.resize('monthlyRevenuePlot'));
    });
</script>
