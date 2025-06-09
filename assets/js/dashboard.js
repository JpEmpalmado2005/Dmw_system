// dashboard.js

let genderChartInstance = null;

//Sample Data
var dashboardData = {
    userStats: {
        totalUsers: 0,
        newUsers: 0,
        activeUsers: 0,
        returningUsers: 0
    },
    locationByYear: {
        labels: ['2019', '2020', '2021', '2022', '2023'],
        male: [550, 420, 710, 290, 690],
        female: [200, 650, 500, 750, 300]
    },
    WorkresumptionGender: {
        labels: ['Male', 'Female'],
        values: [600, 500],
        colors: ['#212A39', '#bb0027']
    },
    GovernmentToGovernmentGender: {
        labels: ['Male', 'Female'],
        values: [200, 900],
        colors: ['#212A39', '#bb0027']
    }
};

document.addEventListener('DOMContentLoaded', function() {
    // Initialize charts - these shouldn't affect links
    updateStats();
    renderLocationChart();
    renderGenderChart();
    renderGovToGovGender();
});


function updateStats() {
    const stats = dashboardData.userStats;
    document.getElementById('total-users').textContent = stats.totalUsers.toLocaleString();
    document.getElementById('new-users').textContent = stats.newUsers.toLocaleString();
    document.getElementById('active-users').textContent = stats.activeUsers.toLocaleString();
    document.getElementById('returning-users').textContent = stats.returningUsers.toLocaleString();
}

function renderLocationChart() {
    const ctx = document.getElementById('locationChart').getContext('2d');
    const locationData = dashboardData.locationByYear;

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: locationData.labels,
            datasets: [{
                    label: 'Male',
                    data: locationData.male,
                    backgroundColor: '#4C84FF'
                },
                {
                    label: 'Female',
                    data: locationData.female,
                    backgroundColor: '#212A39'
                }
            ]
        },
        options: {
            responsive: false, // Disable responsive
            maintainAspectRatio: false, // Allow custom dimensions
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        boxWidth: 12,
                        font: {
                            size: 10
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        font: {
                            size: 10
                        }
                    }
                },
                x: {
                    ticks: {
                        font: {
                            size: 10
                        }
                    }
                }
            }
        }
    });
}

function renderGenderChart() {
    const ctx = document.getElementById('genderChart').getContext('2d');
    const genderData = dashboardData.WorkresumptionGender;

    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: genderData.labels,
            datasets: [{
                data: genderData.values,
                backgroundColor: genderData.colors,
                borderWidth: 1
            }]
        },
        options: {
            responsive: false,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'right',
                    labels: {
                        boxWidth: 10,
                        font: {
                            size: 10
                        }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const label = context.label || '';
                            const value = Number(context.raw) || 0;
                            const chartData = context.chart.data.datasets[0].data;
                            const total = chartData.reduce((a, b) => Number(a) + Number(b), 0);
                            const percentage = Math.round((value / total) * 100);
                            return `${label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            },
            cutout: '70%'
        }
    });
}

function renderGovToGovGender() {
    const ctx = document.getElementById('officeAnalyticsChart').getContext('2d');
    const govGenderData = dashboardData.GovernmentToGovernmentGender;

    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: govGenderData.labels,
            datasets: [{
                data: govGenderData.values,
                backgroundColor: govGenderData.colors,
                borderWidth: 1
            }]
        },
        options: {
            responsive: false,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'right',
                    labels: {
                        boxWidth: 10,
                        font: {
                            size: 10
                        }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const label = context.label || '';
                            const value = Number(context.raw) || 0;
                            const chartData = context.chart.data.datasets[0].data;
                            const total = chartData.reduce((a, b) => Number(a) + Number(b), 0);
                            const percentage = Math.round((value / total) * 100);
                            return `${label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            },
            cutout: '70%',
            title: {
                display: true,
                text: 'Office Distribution',
                font: {
                    size: 12
                }
            }
        }
    });
}