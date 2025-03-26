import "./bootstrap";
import "flowbite/dist/flowbite.min.js";
import ApexCharts from "apexcharts";
import Alpine from "alpinejs";

import.meta.glob(["../assets/**"]);

if (window.Livewire) {
    window.Livewire.start();
}

window.Alpine = Alpine;
Alpine.start();

// Pie Chart
const getChartOptions = async () => {
    // Mengambil data kandidat dan jumlah votes dari endpoint
    const response = await fetch("/candidates/votes");
    const candidates = await response.json();

    // Menghitung total votes dari semua kandidat
    const totalVotes = candidates.reduce(
        (sum, candidate) => sum + candidate.votes_count,
        0
    );

    // Menyiapkan array untuk series (persentase votes), labels (nama kandidat), dan colors
    const series = [];
    const labels = [];
    const colors = [];

    // Mengisi array dengan data dari setiap kandidat
    candidates.forEach((candidate) => {
        // Menghitung persentase votes untuk kandidat ini
        const percentage =
            totalVotes > 0
                ? parseFloat(
                      ((candidate.votes_count / totalVotes) * 100).toFixed(1)
                  )
                : 0;

        // Menambahkan data ke array
        series.push(percentage);
        labels.push(candidate.name);
        colors.push(candidate.color);
    });

    // Mengembalikan konfigurasi chart dengan data yang sudah disiapkan
    return {
        series: series,
        colors: colors,
        chart: {
            height: 420,
            width: "100%",
            type: "pie",
        },
        stroke: {
            colors: ["white"],
            lineCap: "",
        },
        plotOptions: {
            pie: {
                labels: {
                    show: true,
                },
                size: "100%",
                dataLabels: {
                    offset: -25,
                },
            },
        },
        labels: labels,
        dataLabels: {
            enabled: true,
            style: {
                fontFamily: "Inter, sans-serif",
            },
        },
        legend: {
            position: "bottom",
            fontFamily: "Inter, sans-serif",
        },
        yaxis: {
            labels: {
                formatter: function (value) {
                    return value + "%";
                },
            },
        },
        xaxis: {
            labels: {
                formatter: function (value) {
                    return value + "%";
                },
            },
            axisTicks: {
                show: false,
            },
            axisBorder: {
                show: false,
            },
        },
    };
};

if (document.getElementById("pie-chart") && typeof ApexCharts !== "undefined") {
    const chart = new ApexCharts(
        document.getElementById("pie-chart"),
        await getChartOptions()
    );
    chart.render();
}

// Bar Chart
// Bar Chart
async function getBarChartOptions() {
    // Mengambil data kandidat dan jumlah votes dari endpoint
    const response = await fetch("/candidates/votes");
    const candidates = await response.json();

    // Menyiapkan series data dari kandidat
    const seriesData = candidates.map((candidate) => {
        return {
            name: candidate.name,
            color: candidate.color,
            data: [{ x: "Votes", y: candidate.votes_count }],
        };
    });

    // Mengambil warna dari kandidat
    const colors = candidates.map((candidate) => candidate.color);

    // Konfigurasi chart
    return {
        colors: colors,
        series: seriesData,
        chart: {
            type: "bar",
            height: "420px",
            fontFamily: "Inter, sans-serif",
            toolbar: {
                show: false,
            },
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: "70%",
                borderRadiusApplication: "end",
                borderRadius: 8,
            },
        },
        tooltip: {
            shared: true,
            intersect: false,
            style: {
                fontFamily: "Inter, sans-serif",
            },
        },
        states: {
            hover: {
                filter: {
                    type: "darken",
                    value: 1,
                },
            },
        },
        stroke: {
            show: true,
            width: 25,
            colors: ["transparent"],
        },
        grid: {
            show: true,
            strokeDashArray: 4,
            padding: {
                left: 2,
                right: 2,
                top: -14,
            },
        },
        dataLabels: {
            enabled: true,
            formatter: function (val) {
                return val + " votes";
            },
        },
        legend: {
            show: true,
            position: "bottom",
            fontFamily: "Inter, sans-serif",
        },
        xaxis: {
            floating: false,
            categories: ["Candidates"],
            labels: {
                show: true,
                style: {
                    fontFamily: "Inter, sans-serif",
                    cssClass: "text-xs font-normal fill-gray-500",
                },
            },
            axisBorder: {
                show: true,
            },
            axisTicks: {
                show: false,
            },
        },
        yaxis: {
            show: true,
            title: {
                text: "Number of Votes",
                style: {
                    fontFamily: "Inter, sans-serif",
                },
            },
        },
        fill: {
            opacity: 1,
        },
    };
}

if (
    document.getElementById("column-chart") &&
    typeof ApexCharts !== "undefined"
) {
    const chart = new ApexCharts(
        document.getElementById("column-chart"),
        await getBarChartOptions()
    );
    chart.render();
}
