<?php
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'PublicController@index')->name('index')->name('home');
Route::get('/product', 'PublicController@product')->name('product');
Route::get('/course-database', 'PublicController@courseDatabase')->name('coursedatabase');
Route::get('/about', 'PublicController@about');
Route::get('/estimator', 'PublicController@estimator');
// Free Course//
Route::get('/free-udemy-courses', 'FreecourseController@freecourses')->name('freeudemycourses');
Route::get('/api/searchcategory', 'FreecourseController@searchcategory')->name('searchcategory');
//// coupon Code//

Route::get('/udemy-coupon-codes', 'FreecourseController@courseCoupons')->name('courseCoupons');
Route::get('/api/searchudemycoupon', 'FreecourseController@searchCouponcouse')->name('searchudemycoupon');
///////////////
Route::get('/api/searchauthors', 'FreecourseController@searchAuthors');
Route::get('/api/searchtopics', 'FreecourseController@searchTopic');
Route::get('/api/searchsubcats', 'FreecourseController@searchSubCat');
Route::get('/api/searchkeywords', 'FreecourseController@searchKeyword');


// Route::get('/home2', 'PublicController@index2')->name('index2')->name('home2');
// Route::get('/home3', 'PublicController@index3')->name('index3')->name('home3');
Route::get('/newsletter', 'PublicController@offer')->name('offer');
Route::get('/newsletter', 'PublicController@offer')->name('newsletter');
Route::get('/termsofuse', 'PublicController@termsofuse')->name('termsofuse');
Route::get('/affiliate', 'PublicController@affiliate')->name('affiliate');
Route::get('/privacyandpolicy', 'PublicController@privacyandpolicy')->name('privacyandpolicy');
Route::get('/braintree/token', 'BraintreeTokenController@token');

Route::get('/signup', 'SignUpController@signup')->name('signup');
Route::post('/signup', 'SignUpController@store')->name('store');
Route::post('/o', 'OfferController@getoffer')->name('getoffer');

Route::get('paypal','SignUpController@getPaymentStatus')->name('status');

Route::get('/contact-us', 'ContactUsController@contactUS')->name('contactus');
Route::post('contact-us', ['as'=>'contactus.store','uses'=>'ContactUsController@contactUSPost']);

Route::get('/thank-you', 'SignUpController@thankyou')->name('thankyou');
Route::get('/thank-you-offer', 'OfferController@thankyou')->name('thankyouoffer');
//Route::get('/passwordreset', 'HomeController@showResetForm')->name('resetPasswordManually');
Route::post('/changesubscription', 'SignUpController@changeSubscription')->name('changeSubscription');
Route::get('/cancelsubscription', 'SignUpController@cancelSubscription')->name('cancelSubscription');

Auth::routes();

Route::get('/account', 'MemberController@profile')->name('account');
Route::post('/account', 'MemberController@updateAccount')->name('updateAccount');
Route::get('/payment-status', 'MemberController@paymentStatus')->name('paymentStatus');
Route::get('/billing', 'MemberController@billing')->name('billing');
Route::get('/billing/updateCard', 'MemberController@updateCard')->name('updateCard');
Route::get('/invoice/{invoice}', function (Request $request, $invoiceId) {
    return $request->user()->downloadInvoice($invoiceId, [
        'vendor'  => 'teachinguide',
        'product' => 'Subscription',
    ]);
});

//Dashboards
Route::get('/dashboard', 'MemberController@home')->name('dashboardHome');
Route::get('/course-monitor', 'MemberController@courseMonitor')->name('dashboardCourseMonitor');

//Search
Route::get('/course-basic-search', 'MemberController@basicCourseSearch')->name('searchCourseBasic');
Route::get('/subcat-search', 'MemberController@searchSubCat')->name('searchSubCat');
Route::get('/course-search', 'MemberController@courseSearch')->name('searchCourse');
Route::get('/topic-search', 'MemberController@topicSearch')->name('searchTopic');
Route::get('/author-search', 'MemberController@authorSearch')->name('searchAuthor');
Route::get('/keyword-search', 'MemberController@keywordSearch')->name('keywordAnalytics');

Route::get('/filter', 'FilterController@index')->name('filterHome');


Route::post('/api/courseMonitorList', 'MonitorController@getMonitoredCourses')->name('courseMonitorList');
Route::get('/api/courseRankingList', 'MonitorController@getCourseRankings')->name('courseRankingList');
Route::get('/api/courseBacklinkList', 'MonitorController@getCourseLinks')->name('courseBacklinkList');

Route::post('/api/basicCourseData', 'CourseController@getData')->name('basicCourseData');
Route::post('/api/subcatData', 'SubCatController@getData')->name('subcatData');
Route::post('/api/courseData', 'CourseController@getData')->name('courseData');
Route::post('/api/authorData', 'AuthorController@getData')->name('authorData');
Route::post('/api/topicData', 'TopicController@getData')->name('topicData');
Route::post('/api/keywordData', 'KeywordController@getData')->name('keywordData');

Route::get('/api/courses', 'CourseController@searchCourse');
Route::get('/api/authors', 'AuthorController@searchAuthors');
Route::get('/api/topics', 'TopicController@searchTopic');
Route::get('/api/subcats', 'SubCatController@searchSubCat');
Route::get('/api/keywords', 'KeywordController@searchKeyword');

Route::get('/api/monitor-add-course', 'MonitorController@MonitorAddCourse');
Route::get('/api/monitor-del-course', 'MonitorController@MonitorDelCourse');
Route::get('/api/monitor-course-chart', 'MonitorController@MonitorCourseChart');
Route::get('/api/monitor-rating-chart', 'MonitorController@MonitorRatingChart');

Route::get('/api/dashboard-status', 'DashboardController@getDataStatus');
Route::get('/api/sub-status', 'DashboardController@getSubStatus');
Route::get('/api/dashboard-students', 'DashboardController@getSparklineStudentsData');
Route::get('/api/dashboard-courses', 'DashboardController@getSparklineCourseData');
Route::get('/api/dashboard-reviews', 'DashboardController@getSparklineReviewsData');
Route::get('/api/dashboard-topsubcategories', 'DashboardController@getTopSubcategories');
Route::get('/api/dashboard-topcourses', 'DashboardController@getTopCourses');
Route::get('/api/dashboard-toptopics', 'DashboardController@getTopTopics');
Route::get('/api/dashboard-topkeywords', 'DashboardController@getTopKeywords');

Route::get('/api/feedback-add', 'FeedbackController@AddFeedback');
Route::get('/api/check-coupon', 'CouponController@CheckCoupon');
Route::get('/api/signup-included', 'SignUpController@whatsIncluded');

Route::get('/api/filter-get', 'FilterController@getFilter');
Route::get('/api/filter-getSQL', 'FilterController@getSQL');
Route::get('/api/filter-list-course', 'FilterController@listCourseFilter');
Route::get('/api/filter-list-topic', 'FilterController@listTopicFilter');
Route::get('/api/filter-eval', 'FilterController@evalFilter');

Route::get('/api/settings-list', 'AppSettingsController@getConfigs');
Route::get('/api/settings-get', 'AppSettingsController@getConfig');

Route::get('/api/invoices-list', 'MemberController@listInvoices');
Route::post('/api/affiliate-getlink', 'AffiliateController@affiliateLink');

/* public api calls */
Route::get('/papi/courses', 'EstimatorController@searchCourse')->name('searchCourseByName');
Route::get('/papi/course-sales-estimate', 'EstimatorController@getCourseEstimate')->name('getCourseEstimate');
Route::get('/papi/instructors', 'EstimatorController@searchInstructor')->name('searchInstructorByName');
Route::get('/papi/instructor-sales-estimate', 'EstimatorController@getInstructorEstimate')->name('getInstructorEstimate');
Route::get('/papi/keywords', 'EstimatorController@searchKeyword')->name('searchKeyword');
Route::get('/papi/keyword-sales-estimate', 'EstimatorController@getKeywordEstimate')->name('getKeywordEstimate');


//Route::get('/papi/authors', 'AuthorController@searchAuthors');
//Route::get('/papi/topics', 'TopicController@searchTopic');
//Route::get('/papi/subcats', 'SubCatController@searchSubCat');
//Route::get('/papi/keywords', 'KeywordController@searchKeyword');



/* blog routes */
Route::resource('post', 'PostController');
Route::get('articles/{slug}', ['as' => 'articles.single', 'uses' => 'BlogController@getSingle'])->where('slug', '[\w\d\-\_]+');
Route::get('articles', ['uses' => 'BlogController@index', 'as' => 'articles.index']);
Route::delete('/post/destroy/{id}', 'PostController@destroy');
Route::post('/comment/{post_id}', 'CommentController@store');
Route::get('articles', 'BlogController@index')->name('articleindex');
Route::get('articles/form', 'BlogController@form')->name('form');
Route::post('articles/form', 'BlogController@saveForm')->name('saveForm');

/* filter routes */
Route::resource('filter', 'FilterController');
Route::get('filter', 'FilterController@index')->name('filterindex');
Route::post('filter/create', 'FilterController@createnew')->name('createfilter');
Route::delete('/filter/destroy/{id}', 'FilterController@destroy');


Route::get('/rnd', function () {
    return str_random(10);
});


Route::get('files/{filename}', 'FileController@getFile')->where('filename', '^[^/]+$');

Route::post(
    'braintree/webhook',
    '\Laravel\Cashier\Http\Controllers\WebhookController@handleWebhook'
);


Route::post('api/cloudjobs', 'CloudCrawlerController@postCLPJobs')->name('postCLPJobs');
Route::post('api/cloudjobs-receiver', 'CloudCrawlerController@receiveCLPJobs')->name('receiveCLPJobs');
Route::post('api/cloudjobs-check', 'CloudCrawlerController@checkTableStatus')->name('checkTableStatus');

//Route::post('webhook/apify-webhook', 'ApifyController@apifyWebhook')->name('apifyWebhook');
//Route::post('webhook/apify-receiver', 'ApifyController@apifyReceiver')->name('apify-receiver');
//Route::post('webhook/check-table-status', 'ApifyController@checkTableStatus')->name('check-table-status');
