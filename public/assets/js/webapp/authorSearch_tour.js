var tour = new Tour({
    steps: [{

            element: "#tStart",
            title: "Welcome to Course Monitor",
            content: "The course monitor allows you to track your own and foreign courses over time. You can see how many enrollments the course had over time.",
            placement: "bottom"
        },
        {
            element: "#tSearch",
            title: "Course Search",
            content: "To add a course to your monitor simply type and search the course you are looking for. The search needs at least two letters to find you courses.",
            placement: "right"
        },
        {
            element: "#tAddDelete",
            title: "Add and delete courses",
            content: "After you have searched and selected a course simply press \"Add Course\" to add it. Here you can delete it later as well.",
            placement: "left"
        },
        {
            element: "#tMonitorTable",
            title: "Course Monitor Table",
            content: "When you have added courses they will appear with all their data in that table. You will see what each column means by hovering over the column header. A tooltip should appear. You can also sort the table by clicking on each column header.",
            placement: "top"
        },
        {
            element: "#tCourseChart",
            title: "Enrollment Chart",
            content: "Once you click on a course this chart shows course enrollments over the last 10 weeks (left axis) and compares its trent to the course topic (right axis).",
            placement: "top"
        },
        {
            element: "#tRatingChart",
            title: "Rating Chart",
            content: "This chart works similar and shows how the course rating based on all reviews has evolved over the last 10 weeks.",
            placement: "top"
        },
        {
            element: "#tKWRanking",
            title: "Keyword Rankings",
            content: "Finally and importantly this table shows you to which keywords the course is ranked on page one or page 2. Also you see whether the keyword is a highly searched (traffic) keyword. Mind that pager on the bottom right, if there are more than 10 keywords. You can sort the columns as well.",
            placement: "top"
        }
    ]});

// Initialize the tour
tour.init();

$('.startTour').click(function(){
    console.log("Starting Tour");
    tour.restart();

    // Start the tour
    // tour.start();
})
