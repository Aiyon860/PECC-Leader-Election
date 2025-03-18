import "./bootstrap";
import "flowbite/dist/flowbite.min.js";
import ApexCharts from "apexcharts/dist/apexcharts.min.js";
import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

import.meta.glob(["../assets/**"]);

const getChartOptions = () => {
    return {
        series: [52.8, 47.2],
        colors: ["#EC4F52", "#4680FF"],
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
        labels: ["Direct", "Referrals"],
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
        getChartOptions()
    );
    chart.render();
}

const options = {
    colors: ["#EC4F52", "#4680FF"],
    series: [
        {
            name: "Organic",
            color: "#EC4F52",
            data: [
                { x: "Candidates", y: 231 },
            ],
        },
        {
            name: "Social media",
            color: "#4680FF",
            data: [
                { x: "Candidates", y: 232 },
            ],
        },
    ],
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
    },
    legend: {
        show: true,
    },
    xaxis: {
        floating: false,
        labels: {
            show: false,
            style: {
                fontFamily: "Inter, sans-serif",
                cssClass:
                    "text-xs font-normal fill-gray-500 dark:fill-gray-400",
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
    },
    fill: {
        opacity: 1,
    },
};

if (
    document.getElementById("column-chart") &&
    typeof ApexCharts !== "undefined"
) {
    const chart = new ApexCharts(
        document.getElementById("column-chart"),
        options
    );
    chart.render();
}