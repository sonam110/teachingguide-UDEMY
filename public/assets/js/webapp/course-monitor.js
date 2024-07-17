var chart1Options, chart2Options;
var chart1Data, chart2Data;
//Flot Bar Chart
$(function () {
    chart1Options = {
        series: {
            bars: {
                show: true,
                barWidth: 0.6,
                fill: true,
                fillColor: {
                    colors: [{
                        opacity: 0.8
                    }, {
                        opacity: 0.8
                    }]
                }
            }
        },
        xaxis: {
            tickDecimals: 0
        },
        yaxis: {
            tickDecimals: 1,
            min: 1
        },
        colors: ["#1ab394"],
        grid: {
            color: "#999999",
            hoverable: true,
            clickable: true,
            tickColor: "#D4D4D4",
            borderWidth: 0
        },
        legend: {
            show: true
        },
        tooltip: true,
        tooltipOpts: {
            content: "rating: %y, week: %x"
        }
    };

});

$(function () {
    var position = "right";
    chart2Options = {
        series: {
            lines: {
                show: true,
                lineWidth: 2,
                fill: true,
                fillColor: {
                    colors: [{
                        opacity: 0.0
                    }, {
                        opacity: 0.0
                    }]
                }
            }
        },
        xaxis: {
            tickDecimals: 0
        },
        yaxes: [{}, { position: "right", min: 20 }],
        colors: [["#1ab394"], ["2f4050"]],
        grid: {
            color: "#999999",
            hoverable: true,
            clickable: true,
            tickColor: "#D4D4D4",
            borderWidth: 0
        },
        legend: {
            show: true
        },
        tooltip: true,
        tooltipOpts: {
            content: "enrollments: %y, week: %x"
        }
    };

});

function reloadChart1(course_id) {
    chart1Data = {
        label: "Rating",
        data: []
    };
    $.get("/api/monitor-rating-chart?course_id=" + course_id, function (data, status) {
        chart1Data.data = [];
        chart1Options.xaxis.ticks = [];
        var obj = JSON.parse(data);
        var firstWeek = obj[0].week;
        var lastWeek;
        c = 0;
        for (i in obj) {
            //var item = [obj[i].week, obj[i].rating];
            var item = [c, obj[i].rating];
            chart1Data.data.push(item);
            lastWeek = obj[i].week
            //var label = [obj[i].week, "CW " + obj[i].week];
            var label = [c, "CW " + obj[i].week];
            chart1Options.xaxis.ticks.push(label);
            c = c + 1;
        }

        var title = "Ratings Course - 2018 (CW" + firstWeek + "  - CW" + lastWeek + ")";
        $("#ratingChartTitle").text(title);

        $.plot($("#flot-bar-chart"), [chart1Data], chart1Options);

    });


}


function reloadChart2(course_id) {
    chart2Data = {
        label: "Course Enrollments",
        data: []
    };
    chart3Data = {
        label: "Topic",
        data: [],
        yaxis: 2
    };

    $.get("/api/monitor-course-chart?course_id=" + course_id, function (data, status) {
        chart2Data.data = [];
        chart3Data.data = [];
        var obj = JSON.parse(data);
        var ttrend = obj.ttrend.split(",");
        var ws = obj.weeks;

        c = 0;
        for (i in obj.data) {
            //var item = [obj.data[i].week, obj.data[i].students];
            //var item2 = [obj.data[i].week, ttrend[i]];
            var item = [c, obj.data[i].students];
            var item2 = [c, ttrend[i]];
            chart2Data.data.push(item);
            chart3Data.data.push(item2);
            c = c + 1;
        }
        chart2Options.xaxis.ticks = [];
        c = 0;
        for (w in ws) {
            //var item = [ws[w].week, "CW " + ws[w].week];
            var item = [c, "CW " + ws[w].week];
            chart2Options.xaxis.ticks.push(item);
            c = c + 1;
        }
        chart2Options.yaxes = [];
        var yaxis1 = new Object, yaxis2 = new Object;
        yaxis1.min = obj.minCourse;
        yaxis1.max = obj.maxCourse;
        yaxis1.position = "left";
        chart2Options.yaxes.push(yaxis1);

        yaxis2.min = obj.minTrend;
        yaxis2.max = obj.maxTrend;
        yaxis2.position = "right";
        chart2Options.yaxes.push(yaxis2);

        $.plot($("#flot-line-chart"), [{
            data: chart2Data.data,
            label: "Enrollments",
            yaxis: 1
        }, {
            data: chart3Data.data,
            label: obj.topic,
            yaxis: 2
        }],
            chart2Options
        );
        //set chartTitle
        var title = "Enrollments Course vs. Topic - 2018 (CW" + ws[1].week + "  - CW" + ws[ws.length - 1].week + ")";
        $("#chartTitle").text(title);
    });
}

$('#coursetable tbody').on('click', 'tr', function () {
    if ($(this).hasClass('active')) {
        $(this).removeClass('active');
        $('#delCourseBtn').removeClass('btn-danger');
        $("#delCourseBtn").attr("disabled", "disabled");
    }
    else {
        table.$('tr.active').removeClass('active');
        $(this).addClass('active');
        selMCourse = table.row(this).data();
        selTitle = $(selMCourse.title).text()
        $('#blTableTile').html('Backlinks for Course Landing Page - "' + selTitle + '"');
        if (selMCourse != null) {
            $('#delCourseBtn').addClass('btn-danger');
            $("#delCourseBtn").removeAttr('disabled');
            //reload charts
            reloadChart1(selMCourse.id);
            reloadChart2(selMCourse.id);
        } else {
        }
        if (tableRanking) {
            tableRanking.ajax.reload();
        } else {
            tableRanking = $('#rankingtable').DataTable({
                "processing": true,
                "serverSide": true,
                "dom": '<"top"i>t<"bottom"p>',
                "buttons": [],
                "ajax": {
                    "url": "/api/courseRankingList",
                    "dataType": "json",
                    "type": "GET",
                    "data": function (d) {
                        d._token = "{{ csrf_token() }}";
                        d.course_id = selMCourse.id;
                    }
                },
                "language": {
                    "infoFiltered": ""
                },
                "order": [[5, "desc"]],
                "columns": [
                    { "data": "keyword" },
                    { "data": "topic" },
                    { "data": "rank" },
                    { "data": "chg" },
                    { "data": "rank_date" },
                    { "data": "traffic_category" }
                ]
            });

            $('#rankingtable th').each(function () {
                var title = $(this).text();
                var tooltip = '';
                switch (title) {
                    case 'Keyword': tooltip = 'The keyword being searched for on Udemy.'; break;
                    case 'Topic': tooltip = 'The dominant topic for this keyword.'; break;
                    case 'Traffic': tooltip = 'The estimated traffic category based on expected search volumes. 5 being the most frequently searched for.'; break;
                    case 'Rank': tooltip = 'The last know rank for the course and keyword.'; break;
                    case 'Date': tooltip = 'The date when the rank for that keyword was determined.'; break;
                    case 'Change': tooltip = 'How did the ranking changed from last check. Usually on a weekly basis.'; break;
                }

                this.setAttribute('title', tooltip);
            });
            toggleAddingCourses();
        }

        if (backlinkTable) {
            backlinkTable.ajax.reload();
        } else {
            backlinkTable = $('#backlinktable').DataTable({
                "processing": true,
                "serverSide": true,
                "dom": '<"top"i>t<"bottom"p>',
                "buttons": [],
                "ajax": {
                    "url": "/api/courseBacklinkList",
                    "dataType": "json",
                    "type": "GET",
                    "data": function (d) {
                        d._token = "{{ csrf_token() }}";
                        d.course_id = selMCourse.id;
                    }
                },
                "language": {
                    "infoFiltered": ""
                },
                "order": [[1, "desc"]],
                "columns": [
                    { "data": "link" },
                    { "data": "ur" },
                    { "data": "dr" },
                    { "data": "domains" },
                    { "data": "bl" },
                    { "data": "ext" },
                    { "data": "int" },
                    { "data": "traffic" },
                    { "data": "kw" },
                    { "data": "type" },
                    { "data": "age" }
                ],
                "columnDefs": [
                    { "orderSequence": ["desc", "asc"], "targets": [1, 2, 3, 4, 5, 6, 7, 8, 10] },
                ]
            });

            $('#backlinktable th').each(function () {
                var title = $(this).text();
                var tooltip = '';
                switch (title) {
                    case 'Link': tooltip = 'The backlink referring the course landingpage.'; break;
                    case 'UR': tooltip = 'URL Rating (UR) shows the strength of the URL\'s backlink profile on a 100 - point logarithmic scale(higher = stronger). Both internal and external links influence this metric.NOTE: UR has a clear positive correlation with Google rankings, meaning that high - UR pages tend to rank higher in the organic search results.'; break;
                    case 'DR': tooltip = 'Domain Rating (DR) shows the relative "backlink popularity" of the referring website compared to all other websites in our database on a 100-point logarithmic scale (higher = stronger). Ahrefs.com calculates DR based on the number of websites linking to the domain’s URLs and their backlink profile strength.'; break;
                    case 'Domains': tooltip = 'Shows the number of unique referring domains linking to a referring page.'; break;
                    case 'BL': tooltip = 'The number of backlinks this referencing page gives to this and other courses.'; break;
                    case 'Ext': tooltip = 'Shows the number of external links from the referring page.'; break;
                    case 'Int': tooltip = 'Shows the number of internal links the referring page has on its website.'; break;
                    case 'Traffic': tooltip = 'Ahrefs.com estimate of monthly organic search traffic (across all countries) coming to a referring page. Ahrefs.com calculates it based on country-specific monthly search volumes of each keyword it ranks for and its organic search positions for these keywords.'; break;
                    case 'KW': tooltip = 'Shows the number of keywords a referring page is ranking for in organic search results across all countries.'; break;
                    case 'Type': tooltip = 'The defined link-type from the referring page to the course landing page.'; break;
                    case 'Age': tooltip = 'How long in days has this backlink been known to ahrefs.'; break;
                }

                this.setAttribute('title', tooltip);
            });
        }
    }
});
