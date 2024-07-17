var tour = new Tour({
    steps: [{

            element: "#tStart",
            title: "Welcome to Course Search",
            content: "The course search gives you access to the complete course database and to estimated sales. Estimated sales are reflecting new enrollments over the last 30 days.",
            placement: "bottom"
        },
        {
            element: "#tFilter",
            title: "Filter Section",
            content: "The upper section contains a powerful filter capability. You can collapse the filter section by clicking on \"Search Filter\" (top left). Try it now.",
            placement: "right"
        },
        {
            element: "#tCategories",
            title: "Course Categories",
            content: "Udemy courses are aranged in categories and subcategory. Checking categories of your interest will filter the course list below immediatly to the selected categories.",
            placement: "top"
        },
        {
            element: "#data_1",
            title: "Free vs. Paid Courses",
            content: "Around 8% of courses are for free right now on Udemy. With this switch you can remove them from you selection and only show paid courses.",
            placement: "right"
        },
        {
            element: "#tDetailFilter",
            title: "Detail Filter",
            content: "This section allows you to filter for all kind of details. Selections in dropdowns and search can have multiple selectors. Slider on the right are pre-configure to smaller values and can once clicked also be moved with the keyword (right and left arrows).",
            placement: "top"
        },
        {
            element: "#inputIncludeTags",
            title: "Include Tags",
            content: "You can search course titles by keywords. Just type and press enter to activate the keyword.",
            placement: "top"
        },
        {
            element: "#tIncKeyRel",
            title: "And/Or Switch",
            content: "Sometime you want to find courses with different keywords. Thats the \"or\" configuration. Sometime you want the title to have several keywords. Press the switch. You need the \"and\" configuration.",
            placement: "top"
        },
        {
            element: "#inputExcludeTags",
            title: "Exclude Tags",
            content: "Sometime you want to exclude specific courses based on specific keywords. Also add more than one keyword to exclude any occurences",
            placement: "left"
        },
        {
            element: "#tCourseTable",
            title: "Course List Table",
            content: "Here you find all your filtered courses as search results",
            placement: "top"
        },
        {
            element: "#coursetable_info",
            title: "Course Table Info",
            content: "The course table info tells you how many records are shown, how many have been filtered (by you) out of how many courses available in total.",
            placement: "left"
        },
        {
            element: ".html5buttons",
            title: "Export Buttons",
            content: "The buttons on the right allow you to export your filtered data to csv or excel files.",
            placement: "left"
        },
        {
            element: "#coursetable",
            title: "Course Table",
            content: "You will see what each column means by hovering over the column header. A tooltip should appear. You can also sort the table by clicking on each column header.",
            placement: "top"
        },
        {
            element: "#coursetable_length",
            title: "Course Table Length",
            content: "If you want to see more records at a time. Change this option.",
            placement: "right"
        },
        {
            element: "ul[class='pagination']",
            title: "Pagination",
            content: "Because there are so many courses, you will often end up with several pages. Use the pagination feature to see following pages.",
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
