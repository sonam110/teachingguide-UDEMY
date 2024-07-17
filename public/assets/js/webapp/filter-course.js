var rules_course = {
  condition: 'AND',
  rules: [{
    id: 'title',
    operator: 'contains',
    value: 'Python'
  },
  {
      id: 'category',
      operator: 'equal',
      value: 'Development'
  }]
};
var rules_topic = {
  condition: 'AND',
  rules: [
  {
      id: 'category',
      operator: 'equal',
      value: 'Development'
  }]
};
var filter_course = [
    {
      id: 'title',
      label: 'Title',
      type: 'string',
      description: 'This filter is "unique", it can be used only once',
  	operators: ['equal', 'contains', 'not_equal', 'not_contains']
    },
    {
      id: 'subtitle',
      label: 'Subtitle',
      type: 'string',
      description: 'This filter is "unique", it can be used only once',
  	operators: ['equal', 'contains', 'not_equal', 'not_contains']
    },
    {
      id: 'category',
      label: 'Category',
      type: 'string',
      input: 'select',
      values: {
        'Development': 'Development',
        'Business': 'Business',
        'IT & Software': 'IT & Software',
        'Office Productivity': 'Office Productivity',
        'Personal Development': 'Personal Development',
        'Design': 'Design',
        'Marketing': 'Marketing',
        'Lifestyle': 'Lifestyle',
        'Photography': 'Photography',
        'Health & Fitness': 'Health & Fitness',
        'Teacher Training': 'Teacher Training',
        'Music': 'Music',
        'Academics': 'Academics',
        'Language': 'Language',
        'Test Prep': 'Test Prep'
      },
      color: 'primary',
      description: 'This filter uses Awesome Bootstrap Checkboxes',
      operators: ['equal', 'not_equal', 'in', 'not_in']
    },
    {
      id: 'subcategory',
      label: 'Subcategory',
      type: 'string',
      description: 'Please enter a text and use contain to filter specific sub-categories.',
  	operators: ['equal', 'contains', 'not_equal', 'not_contains']
    },
    {
      id: 'subcategory_rank',
      label: 'Subcategory Rank',
      type: 'integer',
      validation: {
        min: 1,
        step: 1
      },
      description: 'Please enter a text and use contain to filter specific sub-categories.'
    },
    {
      id: 'author',
      label: 'Author',
      type: 'string',
      description: 'This filter is "unique", it can be used only once',
  	  operators: ['equal', 'contains', 'not_equal', 'not_contains']
    },
    {
      id: 'level',
      label: 'Level',
      type: 'string',
      input: 'checkbox',
      values: {
        'All': 'All',
        'Beginner': 'Beginner',
        'Intermediate': 'Intermediate',
        'Expert': 'Expert'
      },
      color: 'primary',
      description: 'This filter uses Awesome Bootstrap Checkboxes',
      operators: ['equal', 'not_equal', 'in', 'not_in']
    },
    {
      id: 'badge',
      label: 'Badge',
      type: 'string',
      input: 'checkbox',
      values: {
        'Best Seller': 'Best Seller',
        'Highest Rated': 'Highest Rated',
        'Hot & New': 'Hot & New',
        'New': 'New'
      },
      color: 'primary',
      description: 'This filter uses Awesome Bootstrap Checkboxes',
      operators: ['equal', 'not_equal', 'in', 'not_in']
    },
    {
      id: 'topic',
      label: 'Topic',
      type: 'string',
      description: 'This filter is "unique", it can be used only once',
  	  operators: ['equal', 'contains', 'not_equal', 'not_contains']
    },
    {
      id: 'price',
      label: 'Price',
      type: 'double',
      validation: {
        min: 1,
        step: 0.1
      },
      description: 'Please enter a text and use contain to filter specific sub-categories.'
    },
    {
      id: 'discounted',
      label: 'Is Discounted',
      type: 'integer',
      input: 'radio',
  	  unique: true,
      values: {
        1: 'Yes',
        0: 'No'
      },
      colors: {
        1: 'success',
        0: 'danger'
      },
      description: 'The course or the courses are free.',
      operators: ['equal']
    },
    {
      id: 'is_free',
      label: 'Is Free',
      type: 'integer',
      input: 'radio',
  	  unique: true,
      values: {
        1: 'Yes',
        0: 'No'
      },
      colors: {
        1: 'success',
        0: 'danger'
      },
      description: 'The course or the courses are free.',
      operators: ['equal']
    },
    {
      id: 'reviews',
      label: 'Reviews',
      type: 'integer',
      validation: {
        min: 0,
        step: 1
      },
      description: 'Please enter a text and use contain to filter specific sub-categories.'
    },
    {
      id: 'rating',
      label: 'Rating',
      type: 'double',
      validation: {
        min: 1,
        step: 0.1,
        max: 5
      },
      description: 'Please enter a text and use contain to filter specific sub-categories.'
    },
    {
      id: 'students',
      label: 'Students',
      type: 'integer',
      validation: {
        min: 0,
        step: 1
      },
      description: 'Please enter a text and use contain to filter specific sub-categories.'
    },
    {
      id: 'last_updated',
      label: 'Last Updated',
      type: 'date',
      validation: {
        format: 'YYYY/MM/DD'
      },
      plugin: 'datepicker',
      plugin_config: {
        format: 'yyyy/mm/dd',
        todayBtn: 'linked',
        todayHighlight: true,
        autoclose: true
      }
    },
    {
      id: 'created',
      label: 'Created',
      type: 'date',
      validation: {
        format: 'YYYY/MM/DD'
      },
      plugin: 'datepicker',
      plugin_config: {
        format: 'yyyy/mm/dd',
        todayBtn: 'linked',
        todayHighlight: true,
        autoclose: true
      }
    },
    {
      id: 'sales',
      label: 'Sales',
      type: 'integer',
      validation: {
        min: 0,
        step: 1
      },
      description: 'Please enter a text and use contain to filter specific sub-categories.'
    }
  ]
var filter_topic = [
    {
      id: 'topic',
      label: 'Topic Name',
      type: 'string',
      description: 'Name of the Topic',
  	operators: ['equal', 'contains', 'not_equal', 'not_contains']
    },
    {
      id: 'category',
      label: 'Category',
      type: 'string',
      input: 'select',
      values: {
        'Development': 'Development',
        'Business': 'Business',
        'IT & Software': 'IT & Software',
        'Office Productivity': 'Office Productivity',
        'Personal Development': 'Personal Development',
        'Design': 'Design',
        'Marketing': 'Marketing',
        'Lifestyle': 'Lifestyle',
        'Photography': 'Photography',
        'Health & Fitness': 'Health & Fitness',
        'Teacher Training': 'Teacher Training',
        'Music': 'Music',
        'Academics': 'Academics',
        'Language': 'Language',
        'Test Prep': 'Test Prep'
      },
      color: 'primary',
      description: 'This filter uses Awesome Bootstrap Checkboxes',
      operators: ['equal', 'not_equal', 'in', 'not_in']
    },
    {
      id: 'free_ratio',
      label: 'Free Course Ratio in Percent',
      type: 'double',
      validation: {
        min: 0,
        step: 1,
        max: 100
      },
      description: 'Please enter a text and use contain to filter specific sub-categories.'
    },
    {
      id: 'course_anz',
      label: 'Courses in Topic',
      type: 'integer',
      validation: {
        min: 0,
        step: 1
      },
      description: 'Please enter a amount of courses you want to see, or not to see in topics.'
    },
    {
      id: 'sum_competitors',
      label: 'Competitor Amount',
      type: 'integer',
      validation: {
        min: 0,
        step: 1
      },
      description: 'Please enter a amount of courses you want to see, or not to see in topics.'
    },
    {
      id: 'sum_students',
      label: 'Students in Topic (Sum)',
      type: 'integer',
      validation: {
        min: 0,
        step: 1
      },
      description: 'Please enter a text and use contain to filter specific sub-categories.'
    },
    {
      id: 'avg_students',
      label: 'Students in Topic (Avg)',
      type: 'integer',
      validation: {
        min: 0,
        step: 1
      },
      description: 'Please enter a text and use contain to filter specific sub-categories.'
    },
    {
      id: 'sum_new_students',
      label: 'Students new (Sum)',
      type: 'integer',
      validation: {
        min: 0,
        step: 1
      },
      description: 'Please enter a text and use contain to filter specific sub-categories.'
    },
    {
      id: 'avg_new_students',
      label: 'Students new (Avg)',
      type: 'integer',
      validation: {
        min: 0,
        step: 1
      },
      description: 'Please enter a text and use contain to filter specific sub-categories.'
    },
    {
      id: 'avg_reviews',
      label: 'Reviews (Avg)',
      type: 'integer',
      validation: {
        min: 0,
        step: 1
      },
      description: 'Please enter a text and use contain to filter specific sub-categories.'
    },
    {
      id: 'sum_new_reviews',
      label: 'Reviews new (Sum)',
      type: 'integer',
      validation: {
        min: 0,
        step: 1
      },
      description: 'Please enter a text and use contain to filter specific sub-categories.'
    },
    {
      id: 'avg_new_reviews',
      label: 'Reviews new (Avg)',
      type: 'integer',
      validation: {
        min: 0,
        step: 1
      },
      description: 'Please enter a text and use contain to filter specific sub-categories.'
    },
    {
      id: 'avg_rating',
      label: 'Rating (Avg)',
      type: 'double',
      validation: {
        min: 1,
        step: 0.1,
        max: 5
      },
      description: 'Please enter a text and use contain to filter specific sub-categories.'
    },
    {
      id: 'avg_engagement',
      label: 'Engagement (Avg)',
      type: 'double',
      validation: {
        min: 1,
        step: 1,
        max: 100
      },
      description: 'Please enter a text and use contain to filter specific sub-categories.'
    },
    {
      id: 'ttrend_cat',
      label: 'Udemy Trend',
      type: 'integer',
      input: 'checkbox',
      values: {
        '2': 'Strong Growth',
        '1': 'Growth',
        '0': 'Neutral',
        '-1': 'Decline',
        '-2': 'Strong Decline'
      },
      color: 'primary',
      description: 'This filter uses Awesome Bootstrap Checkboxes',
      operators: ['equal', 'not_equal', 'in', 'not_in']
    },
    {
      id: 'gtrend_cat',
      label: 'Google Trend',
      type: 'integer',
      input: 'checkbox',
      values: {
        '2': 'Strong Growth',
        '1': 'Growth',
        '0': 'Neutral',
        '-1': 'Decline',
        '-2': 'Strong Decline'
      },
      color: 'primary',
      description: 'This filter uses Awesome Bootstrap Checkboxes',
      operators: ['equal', 'not_equal', 'in', 'not_in']
    },
  ]

$('#filtertype').on('change', function() {
  var ftype = $('#filtertype').val();
  reloadFilterDef(ftype);
});

function reloadFilterDef(ftype = 'course_filter', ruleSet = rules_course) {
    if (ftype == "course_filter") {
        console.log(ftype);
        $('#builder-basic').queryBuilder({
            plugins: {
                'bt-tooltip-errors': { delay: 100 }
            },
            filters: filter_course,
            rules: ruleSet
        });
        $('#builder-basic').queryBuilder('setFilters', true, filter_course);
        $('#evalText').text('');
    } else if (ftype == "topic_filter") {
        console.log(ftype);
        $('#builder-basic').queryBuilder({
            plugins: {
                'bt-tooltip-errors': { delay: 100 }
            },
            filters: filter_topic,
            rules: ruleSet
        });
        $('#builder-basic').queryBuilder('setFilters', true, filter_topic);
        $('#evalText').text('');
    }
}

$('#evalFilter').on('click', function() {
    var sql_raw = $('#builder-basic').queryBuilder('getSQL', false, false);
    var sql = encodeURIComponent(JSON.stringify(sql_raw));
    var ftype = $('#filtertype').val();

    $.ajax({
            type: 'GET',
            url: '/api/filter-eval?ftype='+ftype+'&sql='+sql,
            dataType: 'text'
        }).done(function(data){
            $('#evalText').text(data);
    });
});

var form = document.getElementById('filterform');
form.addEventListener('submit', function(event) {
    event.preventDefault();

    var filterName = $('#filtername').val();
    if (filterName == '') {
        alert("Please enter a filter name first.");
        return;
    }
    var ftype = $('#filtertype').val();
    var result = $('#builder-basic').queryBuilder('getRules');
    var sql_raw = $('#builder-basic').queryBuilder('getSQL', false, true);

    if (!$.isEmptyObject(result)) {
      var rules = JSON.stringify(result, null, 2);
      var sql =  JSON.stringify(sql_raw, null, 2);

      var hiddenInput = document.createElement('input');
      hiddenInput.setAttribute('type', 'hidden');
      hiddenInput.setAttribute('name', 'ruleset');
      hiddenInput.setAttribute('value', rules);
      form.appendChild(hiddenInput);

      var hiddenInput = document.createElement('input');
      hiddenInput.setAttribute('type', 'hidden');
      hiddenInput.setAttribute('name', 'ftype');
      hiddenInput.setAttribute('value', ftype);
      form.appendChild(hiddenInput);

      var hiddenInput = document.createElement('input');
      hiddenInput.setAttribute('type', 'hidden');
      hiddenInput.setAttribute('name', 'sql_where');
      hiddenInput.setAttribute('value', sql);
      form.appendChild(hiddenInput);

      // Submit the form
      form.submit();
    }
});
