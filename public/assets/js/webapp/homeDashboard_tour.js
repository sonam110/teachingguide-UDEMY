var tour = new Tour({
    steps: [{

            element: "#tsideMenu",
            title: "Side Bar Navigation",
            content: "On the left you find the side menu for profile informations and the general navigation to all dashboards and reports.",
            placement: "right"
        },
        {
            element: "#ttgStatus",
            title: "TeachinGuide Status",
            content: "In this section you get current information about teachinguide, its status and important announcements.",
            placement: "right"
        },
        {
            element: "#tdataStatus",
            title: "Data Status",
            content: "The data status is very important and tells you when the data has been acquired and how current all informations are.",
            placement: "bottom"
        },
        {
            element: "#tsubStatus",
            title: "Subsription Status",
            content: "This section show your current plan and offers upgrades if applicable.",
            placement: "left"
        },
        {
            element: "#tnavTiles",
            title: "Application Navigation Tiles",
            content: "You can jump right to your most important reports using this big navigation tiles.",
            placement: "top"
        },
        {
            element: "#tNewStudents",
            title: "New Students Last Week",
            content: "This little chart show how many new course enrollments and therefore course sales have been in the last 10 weeks. Basically this give you an overall trend for the learning platform.",
            placement: "right"
        },
        {
            element: "#ttopSubCat",
            title: "Top Selling Sub-Categories",
            content: "Each course is assigned to a category and a sub-category. The best sub-categories in terms of new enrollments (sales) can be seen here and include free course enrollments.",
            placement: "right"
        },
        {
            element: "#tnewCourses",
            title: "New Courses in last week",
            content: "Every week we check for new course offerings. This little chart gives you an indication on how many new courses have been added to the platform.",
            placement: "top"
        },
        {
            element: "#ttopCourses",
            title: "Top Selling Courses",
            content: "There are courses that really rock in terms of enrollments. Here you see the top courses by enrollments, incuding free courses right now.",
            placement: "top"
        },
        {
            element: "#tlastReviews",
            title: "Amount of new Reviews",
            content: "The new review chart is similar to the new enrollment chart and shows how many new feedback has been given on courses. This should strongly correlate with enrollments.",
            placement: "left"
        },
        {
            element: "#ttopTopics",
            title: "Top Selling Topics",
            content: "In the end one big question is...what are the best topics to teach. This list gives you a sneak preview into the hot topics with most enrollments.",
            placement: "left"
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
