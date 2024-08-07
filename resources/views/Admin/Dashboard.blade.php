@extends('Admin.Layout.baselayout')
@section('title')
    Dashboard
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-primary bubble-shadow-small">
                                <i class="fas fa-layer-group"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Kategori Kamar</p>
                                <h4 class="card-title">{{ $kategori_kamars }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-info bubble-shadow-small">
                                <i class="fas fa-th-list"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Fasilitas</p>
                                <h4 class="card-title">{{ $fasilitas }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-success bubble-shadow-small">
                                <i class="fas fa-pen-square"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Carousel</p>
                                <h4 class="card-title">{{ $carousels }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                <i class="fas fa-table"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Kamar</p>
                                <h4 class="card-title">{{ $kamars }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                <i class="fas fa-image"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Gallery</p>
                                <h4 class="card-title">{{ $galleries }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                <i class="fas fa-desktop"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Kontens</p>
                                <h4 class="card-title">{{ $konten }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                <i class="fas fa-credit-card"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">Diskons</p>
                                <h4 class="card-title">{{ $diskon }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-3">
            <div class="card card-stats card-round">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-icon">
                            <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                <i class="fa fa-users" aria-hidden="true"></i>
                            </div>
                        </div>
                        <div class="col col-stats ms-3 ms-sm-0">
                            <div class="numbers">
                                <p class="card-category">User Bookings</p>
                                <h4 class="card-title">{{ $bookings }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card card-round">
                <div class="card-header">
                    <div class="card-head-row">
                        <div class="card-title">User Statistics</div>
                        <div class="card-tools">
                            <select id="userYearFilter" class="form-select">
                                @foreach ($years as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                            <select id="userMonthFilter" class="form-select my-3">
                                <option value="all">All</option>
                                @foreach ($months as $month)
                                    <option value="{{ $month }}">{{ $month }}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-info" onclick="printChart('userStatisticsChart')">Print PDF</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-container" style="min-height: 375px">
                        <canvas id="userStatisticsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!-- Repeat for other charts with similar structure -->
        <!-- Booking Statistics -->
        <div class="col-md-6">
            <div class="card card-round">
                <div class="card-header">
                    <div class="card-head-row">
                        <div class="card-title">Booking Statistics</div>
                        <div class="card-tools">
                            <select id="bookingYearFilter" class="form-select">
                                @foreach ($years as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                            <select id="bookingMonthFilter" class="form-select my-3">
                                <option value="all">All</option>
                                @foreach ($months as $month)
                                    <option value="{{ $month }}">{{ $month }}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-info" onclick="printChart('bookingStatisticsChart')">Print
                                PDF</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-container" style="min-height: 375px">
                        <canvas id="bookingStatisticsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <!-- Revenue Statistics -->
        <div class="col">
            <div class="card card-round">
                <div class="card-header">
                    <div class="card-head-row">
                        <div class="card-title">Pendapatan Statistics</div>
                        <div class="card-tools">
                            <select id="revenueYearFilter" class="form-select">
                                @foreach ($years as $year)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endforeach
                            </select>
                            <select id="revenueMonthFilter" class="form-select my-3">
                                <option value="all">All</option>
                                @foreach ($months as $month)
                                    <option value="{{ $month }}">{{ $month }}</option>
                                @endforeach
                            </select>
                            <button class="btn btn-info" onclick="printChart('revenueStatisticsChart')">Print
                                PDF</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-container" style="min-height: 375px">
                        <canvas id="revenueStatisticsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.21/jspdf.plugin.autotable.min.js"></script>

    <script>
        // Prepare the data for the charts
        const userStatisticsData = @json($usersData);
        const bookingStatisticsData = @json($bookingsData);
        const revenueStatisticsData = @json($revenueData);

        function updateChart(chart, labels, data) {
            chart.data.labels = labels;
            chart.data.datasets[0].data = data;
            chart.update();
        }

        function filterData(data, year, month) {
            return data.filter(d => {
                const date = new Date(d.date);
                const dataYear = date.getFullYear();
                const dataMonth = date.getMonth() + 1;
                return dataYear === parseInt(year) && (month === 'all' || dataMonth === parseInt(month));
            });
        }

        function getFilteredLabelsAndData(data) {
            const labels = data.map(d => d.date);
            const counts = data.map(d => d.count || d.total);
            return {
                labels,
                counts
            };
        }

        const userChart = new Chart(document.getElementById('userStatisticsChart'), {
            type: 'line',
            data: {
                labels: userStatisticsData.map(data => data.date),
                datasets: [{
                    label: 'Users',
                    data: userStatisticsData.map(data => data.count),
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        display: true
                    },
                    y: {
                        display: true
                    },
                },
            }
        });

        const bookingChart = new Chart(document.getElementById('bookingStatisticsChart'), {
            type: 'line',
            data: {
                labels: bookingStatisticsData.map(data => data.date),
                datasets: [{
                    label: 'Bookings',
                    data: bookingStatisticsData.map(data => data.count),
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        display: true
                    },
                    y: {
                        display: true
                    },
                },
            }
        });

        const revenueChart = new Chart(document.getElementById('revenueStatisticsChart'), {
            type: 'line',
            data: {
                labels: revenueStatisticsData.map(data => data.date),
                datasets: [{
                    label: 'Revenue',
                    data: revenueStatisticsData.map(data => data.total),
                    borderColor: 'rgba(255, 206, 86, 1)',
                    backgroundColor: 'rgba(255, 206, 86, 0.2)',
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        display: true
                    },
                    y: {
                        display: true
                    },
                },
            }
        });

        document.getElementById('userYearFilter').addEventListener('change', function() {
            const year = this.value;
            const month = document.getElementById('userMonthFilter').value;
            const filteredData = filterData(userStatisticsData, year, month);
            const {
                labels,
                counts
            } = getFilteredLabelsAndData(filteredData);
            updateChart(userChart, labels, counts);
        });

        document.getElementById('userMonthFilter').addEventListener('change', function() {
            const month = this.value;
            const year = document.getElementById('userYearFilter').value;
            const filteredData = filterData(userStatisticsData, year, month);
            const {
                labels,
                counts
            } = getFilteredLabelsAndData(filteredData);
            updateChart(userChart, labels, counts);
        });

        document.getElementById('bookingYearFilter').addEventListener('change', function() {
            const year = this.value;
            const month = document.getElementById('bookingMonthFilter').value;
            const filteredData = filterData(bookingStatisticsData, year, month);
            const {
                labels,
                counts
            } = getFilteredLabelsAndData(filteredData);
            updateChart(bookingChart, labels, counts);
        });

        document.getElementById('bookingMonthFilter').addEventListener('change', function() {
            const month = this.value;
            const year = document.getElementById('bookingYearFilter').value;
            const filteredData = filterData(bookingStatisticsData, year, month);
            const {
                labels,
                counts
            } = getFilteredLabelsAndData(filteredData);
            updateChart(bookingChart, labels, counts);
        });

        document.getElementById('revenueYearFilter').addEventListener('change', function() {
            const year = this.value;
            const month = document.getElementById('revenueMonthFilter').value;
            const filteredData = filterData(revenueStatisticsData, year, month);
            const {
                labels,
                counts
            } = getFilteredLabelsAndData(filteredData);
            updateChart(revenueChart, labels, counts);
        });

        document.getElementById('revenueMonthFilter').addEventListener('change', function() {
            const month = this.value;
            const year = document.getElementById('revenueYearFilter').value;
            const filteredData = filterData(revenueStatisticsData, year, month);
            const {
                labels,
                counts
            } = getFilteredLabelsAndData(filteredData);
            updateChart(revenueChart, labels, counts);
        });

        const {
            jsPDF
        } = window.jspdf;

        function printChart(chartId) {
            const canvas = document.getElementById(chartId);
            const chartTitle = canvas.parentNode.parentNode.parentNode.querySelector('.card-title').innerText;
            const imgData = canvas.toDataURL('image/png');
            const pdf = new jsPDF();

            pdf.setFontSize(20);
            pdf.text(chartTitle, 20, 20);
            pdf.addImage(imgData, 'PNG', 20, 30, 160, 90); // Adjust the dimensions as needed
            pdf.save(`${chartTitle}.pdf`);
        }
    </script>
@endpush
