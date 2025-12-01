@extends("admin.layout.main")
@section('content')
<style>
    /* GENERAL STYLES */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
        background-color: #f5f7fa;
        color: #333;
        padding: 20px;
    }

    h1 {
        color: #2c3e50;
        margin-bottom: 24px;
        font-weight: 600;
        font-size: 1.75rem;
    }

    /* CARD STYLES */
    .card {
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        margin-bottom: 24px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }

    .card-body {
        padding: 16px 20px;
    }

    .card-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 12px;
    }

    /* GRID STYLES */
    .row {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -12px;
    }

    .col-12 {
        flex: 0 0 100%;
        max-width: 100%;
        padding: 0 12px;
    }

    .col-md-8 {
        flex: 0 0 100%;
        max-width: 100%;
    }

    .col-md-4 {
        flex: 0 0 100%;
        max-width: 100%;
    }

    @media (min-width: 768px) {
        .col-md-8 {
            flex: 0 0 66.666667%;
            max-width: 66.666667%;
        }

        .col-md-4 {
            flex: 0 0 33.333333%;
            max-width: 33.333333%;
        }
    }

    /* CHART CONTAINER */
    .chart-container {
        position: relative;
        height: 220px;
        width: 100%;
    }

    /* TOTAL SALES & COSTS BOX */
    .stats-box {
        flex: 1;
        border-radius: 10px;
        padding: 12px;
        text-align: center;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .stats-box .title {
        font-size: 16px;
        font-weight: 600;
        color: #2c3e50;
    }

    .stats-box .subtitle {
        font-size: 14px;
        color: #6c757d;
        margin-top: 4px;
    }

    .stats-box .amount {
        font-size: 28px;
        font-weight: 700;
        margin-top: 8px;
        color: #3498db;
    }

    .stats-box .change {
        font-size: 14px;
        margin-top: 6px;
        color: #2ecc71;
    }

    /* RESPONSIVE DESIGN FOR MOBILE */
    @media (max-width: 767px) {
        body {
            padding: 12px;
        }
        
        h1 {
            font-size: 1.5rem;
            margin-bottom: 16px;
        }
        
        .card-body {
            padding: 12px 16px;
        }
        
        .chart-container {
            height: 200px;
        }
        
        /* Stack elements vertically on mobile */
        .col-12 .card .card-body {
            flex-direction: column;
        }
        
        .stats-box {
            margin-bottom: 16px;
            text-align: center;
        }
    }

    @media (max-width: 480px) {
        .chart-container {
            height: 180px;
        }
        
        .stats-box .amount {
            font-size: 24px;
        }
        
        .stats-box .title {
            font-size: 14px;
        }
        
        .stats-box .subtitle {
            font-size: 12px;
        }
    }
</style>

<div class="main-content">

    <div class="main-content-inner">
            <h1>Dashboard</h1>

        <div class="row">

       <!-- LEFT CARD: Weekly Sales & Total Stats -->
<div class="col-12 col-md-8">
    <div class="card" style="height:220px;">
        <div class="card-body" style="display:flex; align-items:center; justify-content:space-between; padding:16px 20px;">
            
            <!-- TOTAL SALES & COSTS BOX -->
            <div class="stats-box" style="flex:0 0 260px; text-align:left;">
                <div class="card-title" style="font-size:16px; font-weight:600;">Total Sales & Costs</div>
                <div class="subtitle" style="font-size:14px; color:#6c757d; margin-top:4px;">Last 7 days</div>
                <div class="amount" style="font-size:28px; font-weight:700; margin-top:8px; color:#2c3e50;">Rs. 350K</div>
                <div class="change" style="font-size:14px; margin-top:6px; color:#2ecc71;">▲ 8.56K vs last 7 days</div>
            </div>

            <!-- WEEKLY SALES CHART -->
            <div class="chart-container" style="flex:1; height:100%;">
                <canvas id="weeklyChart"></canvas>
            </div>

        </div>
    </div>
</div>

<!-- CHART.JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctxWeekly = document.getElementById('weeklyChart').getContext('2d');

new Chart(ctxWeekly, {
    type: 'line',
    data: {
        labels: ['Mon','Tue','Wed','Thu','Fri','Sat','Sun'],
        datasets: [
            {
                label: 'Sales',
                data: [15, 16, 17, 18, 20, 21, 22],
                borderColor: 'rgba(54,162,235,1)',
                backgroundColor: 'rgba(54,162,235,0.1)',
                tension: 0.4,
                borderWidth: 3,
                fill: true,
                pointRadius: 0
            },
            {
                label: 'Cost',
                data: [12, 13, 14, 15, 16, 17, 18],
                borderColor: 'rgba(54,198,235,0.7)',
                backgroundColor: 'rgba(54,198,235,0.1)',
                tension: 0.4,
                borderWidth: 3,
                fill: true,
                pointRadius: 0
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: true,
                position: 'top',
                labels: {
                    boxWidth: 12,
                    boxHeight: 12,
                    padding: 15,
                    font: {
                        size: 12
                    }
                }
            },
            tooltip: {
                enabled: true,
                mode: 'index',
                intersect: false,
                callbacks: {
                    label: function(context) {
                        return context.dataset.label + ': ' + context.parsed.y;
                    }
                }
            }
        },
        scales: {
            x: {
                grid: { 
                    display: false 
                },
                ticks: {
                    font: {
                        size: 11
                    }
                }
            },
            y: {
                display: false, // Hide Y-axis completely
                grid: { 
                    display: false 
                }
            }
        },
        // Responsive behavior
        layout: {
            padding: {
                top: 10,
                right: 10,
                bottom: 10,
                left: 10
            }
        }
    }
});

// Handle window resize for better responsiveness
window.addEventListener('resize', function() {
    // Chart.js automatically handles resizing, but we can add custom logic if needed
});
</script>

@endsection