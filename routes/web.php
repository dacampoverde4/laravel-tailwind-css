<?php

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

use Illuminate\Support\Facades\Route;

Route::get('gourlcallbackproducturl', 'TestcbController@gourlcallbackproducturl')->name('gourlcallbackproducturl');

Route::get('faq', 'FaqController@userIndex')->name('faq');
Route::post('faq-search', 'FaqController@searchfaq')->name('faq-search');
Route::get('/get-faq/{name}', 'FaqController@showfaq')->name('faq.get-faq');
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
//Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
//Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::post(
    '\Laravel\Cashier\Http\Controllers\WebhookController@handleWebhook'
);

Route::get('/send/email', 'HomeController@mail');
Route::get('/', 'HomeController@welcome')->name('welcome');

/* Account Setup Start */

Route::group(['middleware' => ['auth']], function () {
    Route::get('/account-setup', 'AccountSetupController@accountSetupStepOne')->name('account-setup');
    Route::get('/account-setup/profile-info', 'AccountSetupController@accountSetupStepTwo')->name('account-setup-profile-info');
    Route::post('/account-setup/profile-info', 'AccountSetupController@updateAccountSetupStepTwo')->name('account-setup-step-2-update');
    Route::post('account-setup/profile-image-by-string', 'AccountSetupController@uploadProfileImageByString');
    Route::post('/account-setup', 'AccountSetupController@updateAccountSetupStepOne')->name('account-setup-update');
});
Route::get('/account-setup/token/{token}', 'AccountSetupController@accountSetupGetUserByToken')->name('account-setup-get-user-by-token');

/* Account Setup End */

Route::get('/about', 'HomeController@about')->name('about');
Route::get('/team', 'HomeController@team')->name('team');
Route::get('/donate', 'HomeController@support')->name('team');
Route::get('/blog', 'BlogsController@blog')->name('blog');
Route::get('/myBlogs', 'BlogsController@myBlogs')->name('myBlogs');
Route::get('/bloggerAdd', 'BlogsController@bloggerAdd')->name('bloggerAdd');
Route::post('blogger/store', 'BlogsController@store')->name('blogger.store');
Route::post('blogSettings', 'BlogsController@blogSettings')->name('blogSettings');
Route::get('/share/{id}', 'BlogsController@share');
Route::get('/blog/category/{id}', 'BlogsController@blogfilter')->name('blogfilter');
Route::get('/blogview/{id}', 'BlogsController@blogview')->name('blogview');
Route::get('/blogApprove/{id}', 'BlogsController@blogApprove')->name('blog.approve');
Route::post('/blog/commentstore', 'BlogsController@commentstore')->name('commentstore');
Route::get('comment/{id}', 'BlogsController@commentdestroy')->name('delete.comment');
Route::get('/team/category/{id}', 'HomeController@teamview')->name('teams');
Route::get('/events', 'EventController@events')->name('events');
Route::get('/events/search', 'EventController@searchEvent')->name('event.search');
Route::get('/event/{id}', 'EventController@eventsingle')->name('event.single');
Route::post('/event-payment/{id}', 'EventController@eventBuy')->name('event.buy');
Route::get('/testfile', 'HomeController@testfunction')->name('testfile');
Route::get('/browse', 'UserSearchController@newBrowse')->name('browse');
Route::get('/featured-members', 'UserSearchController@featuredmembers')->name('featuredmembers');
Route::get('featured-members-new', 'UserSearchController@newBrowse')->name('featuredmembersnew');
Route::get('/jobs/', 'JobListingController@jobPage')->name('jobs');
Route::get('jobs/category/{id}', 'JobListingController@jobPages')->name('jobPages');
Route::get('/userapply', 'UserApplyController@index')->name('userapply');
Route::post('/userapply/store', 'UserApplyController@store')->name('userapply.store');
Route::post('/newsletter', 'UserSearchController@newsletter')->name('newsletter');
Route::post('/userapply/store', 'UserApplyController@store')->name('userapply.store');
//privacy and terms routes
Route::get('cms/{slug}', 'PageController@allPages')->name('pages');
Route::get('terms', 'PageController@terms')->name('terms');
Route::get('policy', 'PageController@policy')->name('policy');
Route::post('seekingroles', 'UserSearchController@userSeekingroleDrop')->name('seekingroles');
Route::post('seeking-huds', 'UserSearchController@userSeekingHudsDrop')->name('seekinghuds');


Route::get('/registration-success', function () {
    return view('auth.registration-success');
})->name('registration-success');

//mail
Route::get('/testmail/sendmain', 'NotificationController@testmail');
// Auth::routes();

/* route for creating or edit user */
Route::group(['prefix' => 'jobs'], function () {
    Route::get('/{id}', 'JobListingController@singleJob')->name('job.single');
});

/* route for added securitypin for recovery email */

Route::group(['prefix' => 'securitypin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@pin')->name('securitypin');
    Route::post('/store', 'HomeController@update')->name('store');
});

Route::group(['prefix' => 'screenname', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@screenname')->name('screen.name');
    Route::post('/store', 'HomeController@screennameupdate')->name('screenname.store');
});
Route::get('/securitypin/show', 'HomeController@showpin')->name('password.security');
Route::post('/securitypin/check', 'HomeController@check')->name('password.store');
Route::get('/securitypin/mail/{email}', 'HomeController@recovery')->name('password.recovery');
Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');
Route::get('userprofile/{id}', 'ProfileController@frontuserprofile')->name('viewprofile');
Route::post('userprofile/album/delete/{id}', 'ProfileController@albumdestroy');
Route::post('profile/verifyRequest/{id}', 'ProfileController@verifyuser');

Route::resource('reviews', 'ReviewController');
Route::post('/reviews/comment', 'ReviewController@comment')->name('review.comment');
Route::post('/reviews/abuse', 'ReviewController@abuse')->name('review.abuse');
Route::any('user/reviews/{id}', 'ReviewController@allReviews')->name('reviews.all');

/* route for role CRUD */
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/dashboard', 'HomeController@admin')->name('admin.dashboard');
    Route::get('/roles', 'RolesController@index')->name('admin.roles');
    Route::get('/species', 'SpeciesController@index')->name('admin.species.index');
    Route::get('/species/create', 'SpeciesController@create')->name('admin.species.create');
    Route::post('/species/store', 'SpeciesController@store')->name('admin.species.store');
    Route::get('/species/edit/{id}', 'SpeciesController@edit')->name('admin.species.edit');
    Route::post('/species/update/{id}', 'SpeciesController@update')->name('admin.species.update');
    Route::delete('/species/delete/{id}', 'SpeciesController@destroy')->name('admin.species.delete');
    Route::get('/create/role', 'RolesController@create')->name('admin.create.role');
    Route::post('/store', 'RolesController@store')->name('role.store');
    Route::get('/edit/{id}', 'RolesController@edit')->name('edit.role');
    Route::post('/update/{id}', 'RolesController@update')->name('role.update');
    Route::get('/delete/{id}', 'RolesController@destroy')->name('role.delete');

    Route::get('/credit-tokens', 'PaymentController@creditTokens')->name('credit.tokens');
    Route::post('/getcredittokens', 'PaymentController@getCreditTokens')->name('getcredit.tokens');

    Route::get('/register-labels', 'WebsiteSettingController@registerLabels')->name('register.labels');
    Route::get('/removeprofile/{id}', 'UserController@removeProfile')->name('removeprofile');
    Route::resource('pushnotifications', 'Admin\PushNotificationController');

    /* Email Notifications */
    Route::group(['prefix' => 'emails'], function () {
        Route::get('/', 'EmailNotificationsController@index')->name('email.display');
        Route::get('/edit/{id}', 'EmailNotificationsController@edit')->name('edit.email.notify');
        Route::post('/update/{id}', 'EmailNotificationsController@update')->name('update.email.notify');
    });

    /* route for creating or edit user */
    Route::group(['prefix' => 'events'], function () {
        Route::get('/', 'EventController@index')->name('event.index');
        Route::get('/create', 'EventController@create')->name('event.create');
        Route::post('/store', 'EventController@store')->name('event.store');
        Route::get('/edit/{id}', 'EventController@edit')->name('event.edit');
        Route::post('/update/{id}', 'EventController@update')->name('event.update');
        Route::get('/delete/{id}', 'EventController@delete')->name('event.delete');
        Route::get('/suspend/{id}', 'EventController@suspend')->name('event.suspend');
        Route::get('/active/{id}', 'EventController@active')->name('event.active');
        Route::get('/feature/{id}', 'EventController@feature')->name('event.feature');
        Route::get('/unfeature/{id}', 'EventController@unfeature')->name('event.unfeature');
        Route::post('/invitations', 'EventController@sentInvitations')->name('event.invitations');
        /* route for creating events category */
        Route::group(['prefix' => 'category'], function () {
            Route::get('/all', 'EventsCategoryController@index')->name('event.category.all');
            Route::get('/create', 'EventsCategoryController@create')->name('event.category.create');
            Route::post('/store', 'EventsCategoryController@store')->name('event.category.store');
            Route::get('/edit/{id}', 'EventsCategoryController@edit')->name('event.category.edit');
            Route::post('/update/{id}', 'EventsCategoryController@update')->name('event.category.update');
            Route::get('/delete/{id}', 'EventsCategoryController@delete')->name('event.category.delete');
        });
    });

    /* route for creating or edit user */
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', 'UserController@index')->name('admin.user');
        Route::get('/incomplete-users', 'UserController@incompleteUsers')->name('admin.incomplete.user');
        Route::get('subscibedusers', 'Admin\SubscribedUserController@index')->name('admin.subscibed_users');
        Route::get('employee', 'UserController@employee')->name('users.employee');
        Route::get('createemployee', 'UserController@createemployee')->name('users.createemployee');
        Route::post('storeemployee', 'UserController@storeemployee')->name('users.storeemployee');
        Route::get('editemployee/{id}', 'UserController@editemployee')->name('users.editemployee');
        Route::post('editemployee/{id}', 'UserController@updateemployee')->name('users.updateemployee');
        Route::get('deleteemployee/{id}', 'UserController@deleteemployee')->name('users.deleteemployee');
        Route::get('edit/{id}', 'UserController@edit')->name('users.edit');
        Route::post('edit/{id}', 'UserController@update')->name('users.update');
        Route::get('create', 'UserController@create')->name('users.create');
        Route::post('store', 'UserController@store')->name('users.store');
        Route::get('delete/{id}', 'ProfileController@deleteaccount')->name('users.delete');
        Route::get('permanantdelete/{id}', 'ProfileController@permanentDeleteAccount')->name('users.permanantdelete');
        Route::get('massmessage', 'UserController@getuserformass')->name('users.msgusers');
        Route::post('storemassmessage', 'UserController@storeuserformass')->name('users.storemsgusers');
        Route::post('getUsers','UserController@getUserOnGroup')->name('getUsers');
    });

    /* route for creating or edit blog */
    Route::group(['prefix' => 'blogs'], function () {
        Route::get('/', 'BlogsController@index')->name('blogs');
        Route::post('blogs/store', 'BlogsController@store')->name('blog.store');
        Route::get('blogs/edit/{id}', 'BlogsController@edit')->name('blog.edit');
        Route::post('blogs/update/{id}', 'BlogsController@update')->name('blog.update');
        Route::get('blogs/delete/{id}', 'BlogsController@destroy')->name('blog.delete');
        Route::get('/categories', 'BlogsController@categories')->name('blogs.categories');
        Route::get('/addcategory', 'BlogsController@createcategory')->name('blogs.addcategory');
        Route::post('store', 'BlogsController@addcategory')->name('blogs.store');
        Route::get('create', 'BlogsController@create')->name('blogs.create');
        Route::get('categoriesedit/{id}', 'BlogsController@categoriesedit')->name('categoriesedit.blogs');
        Route::post('/categoriesupdate/{id}', 'BlogsController@categoriesupdate')->name('categoriesupdate.blogs');
        Route::get('/destroycategories/{id}', 'BlogsController@destroycategories')->name('destroycategories.blogs');
    });

    /* route for creating or edit user */
    Route::group(['prefix' => 'tokens'], function () {
        Route::get('/', 'TokensController@index')->name('tokens');
        Route::get('edit/{id}', 'TokensController@edit')->name('token.edit');
        Route::post('edit/{id}', 'TokensController@update')->name('token.update');
        Route::get('create', 'TokensController@create')->name('token.create');
        Route::post('store', 'TokensController@store')->name('token.store');
        Route::get('delete/{id}', 'TokensController@destroy')->name('token.delete');
    });

    /* route for creating or edit user */
    Route::group(['prefix' => 'feature-setting'], function () {
        Route::get('/', 'FeatureSettingController@index')->name('admin.feature.setting');
        Route::get('/create', 'FeatureSettingController@create')->name('admin.feature.setting.create');
        Route::post('/store', 'FeatureSettingController@store')->name('admin.feature.setting.store');
        Route::get('/edit/{id}', 'FeatureSettingController@edit')->name('admin.feature.setting.edit');
        Route::post('/update/{id}', 'FeatureSettingController@update')->name('admin.feature.setting.update');
        Route::get('/delete/{id}', 'FeatureSettingController@destroy')->name('admin.feature.setting.delete');
    });

    /* route for creating or edit user */
    Route::group(['prefix' => 'applicants'], function () {
        Route::get('/', 'UserApplyController@displayApplicants')->name('admin.applicants');
        Route::get('/view/{id}', 'UserApplyController@view')->name('admin.view');
        Route::get('/delete/{id}', 'UserApplyController@deleteApplicant')->name('delete.applicant');
    });

    /* route for Tags */
    Route::group(['prefix' => 'tags'], function () {
        Route::get('/', 'TagsController@index')->name('tags');
        Route::get('/create', 'TagsController@create')->name('create.tag');
        Route::post('/store', 'TagsController@store')->name('store.tag');
        Route::get('/edit/{id}', 'TagsController@edit')->name('edit.tag');
        Route::post('/update/{id}', 'TagsController@update')->name('update.tag');
        Route::get('/delete/{id}', 'TagsController@destroy')->name('delete.tag');
    });

    /* route for Words */
    Route::group(['prefix' => 'words'], function () {
        Route::get('/', 'WordsSecurityController@index')->name('words');
        Route::get('/create', 'WordsSecurityController@create')->name('create.word');
        Route::post('/store', 'WordsSecurityController@store')->name('store.word');
        Route::get('/edit/{id}', 'WordsSecurityController@edit')->name('edit.word');
        Route::post('/update/{id}', 'WordsSecurityController@update')->name('update.word');
        Route::get('/delete/{id}', 'WordsSecurityController@destroy')->name('delete.word');
    });

    /* route for Tags */
    Route::group(['prefix' => 'reasons'], function () {
        Route::get('/', 'ReasonController@index')->name('tags');
        Route::get('/create', 'ReasonController@create')->name('create.reason');
        Route::post('/store', 'ReasonController@store')->name('store.reason');
        Route::get('/edit/{id}', 'ReasonController@edit')->name('edit.reason');
        Route::post('/update/{id}', 'ReasonController@update')->name('update.reason');
        Route::get('/delete/{id}', 'ReasonController@destroy')->name('delete.reason');
    });

    /* route for Tags */
    Route::group(['prefix' => 'myfun'], function () {
        Route::get('/', 'MyFunController@index')->name('myfuns');
        Route::get('/create', 'MyFunController@create')->name('create.myfun');
        Route::post('/store', 'MyFunController@store')->name('store.myfun');
        Route::get('/edit/{id}', 'MyFunController@edit')->name('edit.myfun');
        Route::post('/update/{id}', 'MyFunController@update')->name('update.myfun');
        Route::get('/delete/{id}', 'MyFunController@destroy')->name('delete.myfun');
    });

    /* route for Jobs */
    Route::group(['prefix' => 'jobs'], function () {
        Route::get('/', 'JobListingController@index')->name('jobs');
        Route::get('/forms', 'JobListingController@forms')->name('forms');
        Route::get('/categories', 'JobListingController@category')->name('categories');
        Route::get('/create', 'JobListingController@create')->name('create.jobs');
        Route::get('/createcategories', 'JobListingController@createcategories')->name('createcategories.jobs');
        Route::post('/store', 'JobListingController@store')->name('store.jobs');
        Route::post('/storecategories', 'JobListingController@storecategories')->name('storecategories.jobs');
        Route::get('/edit/{id}', 'JobListingController@edit')->name('edit.jobs');
        Route::get('/categoriesedit/{id}', 'JobListingController@categoriesedit')->name('categoriesedit.jobs');
        Route::post('/update/{id}', 'JobListingController@update')->name('update.jobs');
        Route::post('/categoriesupdate/{id}', 'JobListingController@categoriesupdate')->name('categoriesupdate.jobs');
        Route::get('/delete/{id}', 'JobListingController@destroy')->name('delete.jobs');
        Route::get('/destroycategories/{id}', 'JobListingController@destroycategories')->name('destroycategories.jobs');
        Route::get('/formscreate', 'JobListingController@formscreate')->name('forms.jobs');
        Route::post('/storeforms', 'JobListingController@storeforms')->name('storeforms.jobs');
        Route::get('/formedit/{id}', 'JobListingController@formedit')->name('formedit.jobs');
        Route::get('/formdelete/{id}', 'JobListingController@formdelete')->name('formdelete.jobs');
        Route::post('/formsupdate/{id}', 'JobListingController@formsupdate')->name('formsupdate.jobs');
    });

    /* route for creating or edit features */
    Route::group(['prefix' => 'announcements'], function () {
        Route::get('/', 'AnnouncementsController@index')->name('admin.announcement');
        Route::get('/create', 'AnnouncementsController@create')->name('announcement.create');
        Route::post('/store', 'AnnouncementsController@store')->name('announcement.store');
        Route::get('/edit/{id}', 'AnnouncementsController@edit')->name('announcement.edit');
        Route::get('/delete/{id}', 'AnnouncementsController@destroy')->name('announcement.delete');
        Route::post('/update/{id}', 'AnnouncementsController@update')->name('announcement.update');
    });

    /* route for creating or edit features */
    Route::group(['prefix' => 'features'], function () {
        Route::get('/', 'FeaturesController@index')->name('index.feature');
        Route::get('/create', 'FeaturesController@create')->name('create.feature');
        Route::post('/store', 'FeaturesController@store')->name('store.feature');
        Route::get('/edit/{id}', 'FeaturesController@edit')->name('edit.feature');
        Route::get('/setting/{id}', 'FeaturesController@setting')->name('setting.feature');
        Route::post('/update/{id}', 'FeaturesController@update')->name('update.feature');
        Route::get('/delete/{id}', 'FeaturesController@destroy')->name('delete.feature');
    });

    /* Create Plan */
    Route::group(['prefix' => 'subscriptionplans'], function () {
        Route::get('/', 'SubscriptionController@index');
        Route::get('/create', 'SubscriptionController@create');
        Route::post('/create', 'SubscriptionController@store');
        Route::get('/delete/{id}', 'SubscriptionController@destroy')->name('plan.destroy');
        Route::get('/edit/{id}', 'SubscriptionController@edit')->name('plan.edit');
        Route::post('/update/{id}', 'SubscriptionController@update')->name('plan.update');
        Route::post('/updatePlanStatus','SubscriptionController@updateStatus')->name('updatePlanStatus');
    });
 /* Create trial Plan */
    Route::group(['prefix' => 'trialPlans'], function () {
        Route::get('/', 'TrialPlansController@index');
        Route::get('/create', 'TrialPlansController@create');
        Route::post('/create', 'TrialPlansController@store');
        Route::get('/edit/{id}', 'TrialPlansController@edit')->name('trialPlans.edit');
        Route::post('/update/{id}', 'TrialPlansController@update')->name('trialPlans.update');
        Route::get('/delete/{id}', 'TrialPlansController@destroy')->name('trialPlans.destroy');
        Route::post('/trialPlanStatus','TrialPlansController@updateStatus')->name('trialPlanStatus');
    });

    /* Website Setting */
    Route::get('feature-pricing/{id}', 'WebsiteSettingController@featurePricing')->name('feature.pricing');

    Route::get('settingtoken', 'WebsiteSettingController@websitesettingtoken')->name('websitesetting.token');
    Route::get('membershipSettings', 'WebsiteSettingController@getMembershipSettings')->name('websitesetting.membership');
    Route::post('saveWebsiteSetting', 'WebsiteSettingController@saveWebsiteSetting')->name('saveWebsiteSetting');
    Route::post('saveWebsiteSetting/{id}', 'WebsiteSettingController@saveWebsiteSetting')->name('saveFeaturesSetting');
    Route::get('setting-screen-name', 'WebsiteSettingController@websitesettingScreenName')->name('websitesetting.screenname');
    Route::get('free-members-setting', 'WebsiteSettingController@freeUsersFeatureSetting')->name('websitesetting.free');

    /* Create */

    Route::group(['prefix' => 'questionnaires'], function () {
        Route::get('/', 'QuestionnairesController@init')->name('questionnaires.init');
        Route::get('/create', 'QuestionnairesController@create')->name('questionnaires.create');
        Route::post('/submit', 'QuestionnairesController@store')->name('question.store');
        Route::get('/delete/{id}', 'QuestionnairesController@destroy')->name('question.destroy');
        Route::get('/edit/{id}', 'QuestionnairesController@edit')->name('question.edit');
        Route::post('/update/{id}', 'QuestionnairesController@update')->name('question.update');
        Route::get('/{groupId}', 'QuestionnairesController@index')->name('questionnaires.index');
    });
    Route::resource('matchquestcategories', 'MatchQuestCategoryController');

    /* Route for report users */
    Route::group(['prefix' => 'reports'], function () {
        Route::get('/', 'UserController@reportUserDisplay')->name('user.reports');
        Route::post('/change-status/{id}', 'UserController@changeReportStatus')->name('admin.reports.change-status');
        Route::delete('/delete/{id}', 'UserController@destroyUserReport')->name('admin.reports.delete');
    });

    /* Route for block users */
    Route::group(['prefix' => 'blocks'], function () {
        Route::get('/', 'UserController@blockUserDisplay')->name('user.blocks');
        Route::get('/delete/{id}', 'UserController@destroyUserBlock')->name('admin.blocks.delete');
    });

    /* route for creating Gender Role */
    Route::get('/gender', 'GenderRoleController@index')->name('admin.gender');
    Route::get('/create/genderrole', 'GenderRoleController@create')->name('admin.create.gender');
    Route::post('/genderstore', 'GenderRoleController@store')->name('gender.store');
    Route::get('/genderedit/{id}', 'GenderRoleController@edit')->name('gender.edit');
    Route::post('/genderupdate/{id}', 'GenderRoleController@update')->name('gender.update');
    Route::get('/genderdelete/{id}', 'GenderRoleController@destroy')->name('gender.delete');

    /* route for creating UserGroup Registeration */
    Route::group(['prefix' => 'usergroup'], function () {
        Route::get('/', 'UsergroupController@index')->name('admin.usergroup');
        Route::get('/create', 'UsergroupController@create')->name('usergroup.create');
        Route::post('/store', 'UsergroupController@store')->name('usergroup.store');
        Route::get('/edit/{id}', 'UsergroupController@edit')->name('usergroup.edit');
        Route::get('/browse/{id}', 'UsergroupController@browseSearch')->name('usergroup.browse');
        Route::post('/store/{id}', 'UsergroupController@browseStore')->name('store.browse');
        Route::post('/update/{id}', 'UsergroupController@update')->name('usergroup.update');
        Route::get('/delete/{id}', 'UsergroupController@destroy')->name('usergroup.delete');
        Route::get('/membership/{id}', 'WebsiteSettingController@getMembershipSettings')->name('usergroup.membership');

        Route::group(['prefix' => 'tags'], function () {
            Route::get('/', 'UsergroupTagController@index')->name('admin.usergroup.tag');
            Route::get('/create', 'UsergroupTagController@create')->name('admin.usergroup.tag.create');
            Route::post('/store', 'UsergroupTagController@store')->name('admin.usergroup.tag.store');
            Route::get('/edit/{id}', 'UsergroupTagController@edit')->name('admin.usergroup.tag.edit');
            Route::post('/update/{id}', 'UsergroupTagController@update')->name('admin.usergroup.tag.update');
            Route::get('/delete/{id}', 'UsergroupTagController@destroy')->name('admin.usergroup.tag.delete');
        });
    });

    /*subscription-plan-usergroup*/
    // Route::get('/subscription-plan-usergroup', 'UsergroupController@subscriptionPlanUsergroup')->name('admin.subscription-plan-usergroup');
    Route::post('/usergroupsdrop', 'UsergroupController@userGroupsDrop')->name('admin.usergroupsdrop');

    Route::resource('subscription-plan-usergroup', 'Admin\SubscriptionPlanUserGroupConteroller');

    /* Route for create note */
    Route::group(['prefix' => 'notes'], function () {
        Route::get('/{groupId}', 'NoteController@index')->name('usergroup.notes');
        Route::get('/{groupId}/create', 'NoteController@create')->name('note.create');
        Route::post('/store', 'NoteController@store')->name('note.store');
        Route::get('/delete/{id}', 'NoteController@destroy')->name('note.delete');
        Route::get('/{groupId}/edit/{id}', 'NoteController@edit')->name('note.edit');
        Route::post('/update/{id}', 'NoteController@update')->name('note.update');
    });

    //privacy and routes pages for admin
    Route::group(['prefix' => 'pages'], function () {
        Route::get('/', 'PageController@index')->name('pages.index');
        Route::view('/create', 'admin/pages/create')->name('pages.create');
        Route::post('/store', 'PageController@store')->name('pages.store');
        Route::get('/edit/{id}', 'PageController@edit')->name('pages.edit');
        Route::post('/update/{id}', 'PageController@update')->name('pages.update');
        Route::get('/delete/{id}', 'PageController@destroy')->name('pages.destroy');
    });

    //privacy and routes coupons for admin
    Route::resource('coupons', 'Admin\CouponsController');
    Route::resource('terminal', 'Admin\TerminalInfosController');

    Route::group(['prefix' => 'faq'], function () {
        Route::get('/', 'FaqController@index')->name('faq.index');
        Route::get('/create', 'FaqController@create')->name('faq.create');
        Route::post('/store', 'FaqController@store')->name('faq.store');
        Route::get('/show/{id}', 'FaqController@show')->name('faq.show');
        Route::get('/edit/{id}', 'FaqController@edit')->name('faq.edit');
        Route::post('/update/{id}', 'FaqController@update')->name('faq.update');
        Route::get('/delete/{id}', 'FaqController@destroy')->name('faq.delete');
    });

    // User verification questionaries
    Route::group(['prefix' => 'userverification'], function () {
        Route::get('/', 'Admin\UserVerificationController@init')->name('userverification.index');
        Route::get('/create', 'Admin\UserVerificationController@index')->name('userverification.create');
        Route::post('/submit', 'Admin\UserVerificationController@createQuestions')->name('userverification.submit');
        Route::get('/delete/{id}', 'Admin\UserVerificationController@destroy')->name('userverification.destroy');
        Route::get('/edit/{id}', 'Admin\UserVerificationController@edit')->name('userverification.edit');
        Route::post('/update/{id}', 'Admin\UserVerificationController@update')->name('userverification.update');
        // Route::get('/{groupId}', 'Admin\UserVerificationController@index')->name('userverification.index');
    });
});

Route::group(['middleware' => ['auth', 'check.user.data']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('matchquests', 'ProfileController@matchquests')->name('matchquests');
    Route::get('viewmatchquests/{encrypted_id}', 'ProfileController@viewOtherUserMatchQuests')->name('viewmatchquests');
    Route::post('matchquests', 'ProfileController@matchquestsSubmit')->name('matchquests_submit');
    Route::get('buy-tokens', 'TokensController@buyTokens')->name('buy-tokens');
    Route::post('buy-tokens', 'TokensController@purchaseTokens')->name('token.purchase');
    Route::post('checkout', 'TokensController@checkoutToken')->name('token.checkouttoken');
    Route::post('/paywithwallet', 'TokensController@payTokenwithwallet')->name('token.paytokenwithwallet');
    Route::post('/paywithinworld', 'TokensController@payTokenwithinworld')->name('token.paytokenwithinworld');
    Route::get('/pricing', 'SubscriptionController@getpricing')->name('pricing');
    Route::any('/schedule/{user_id}', 'HomeController@schedule')->name('schedule');
    Route::get('/parcel', 'ParcelsController@index')->name('parcel.index');
    Route::get('/certificate', 'HomeController@certificate')->name('certificate');
    Route::get('/certificate/{id}', 'HomeController@adoptionCertificate')->name('adoptionCertificate');
    Route::get('/saved-events', 'EventController@getSavedEvents')->name('saved.events.index');
    Route::delete('/saved-events/delete/{id}', 'EventController@deleteSavedEvent')->name('saved.event.delete');

    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', 'ProfileController@index')->name('profile');
        Route::get('edit', 'ProfileController@edit')->name('edit.profile');
        Route::get('accountsetting', 'ProfileController@accountSetting')->name('account.setting');
        Route::post('update/{id}', 'ProfileController@update')->name('profile.update');
        Route::post('picture', 'ProfileController@profilePicupdate')->name('profile.picture');
        Route::post('uploadprofile', 'ProfileController@UploadProfilePicture')->name('profile.uploadprofile');
        Route::post('uploadselectedprofile', 'ProfileController@UploadSelectedProfilePicture')->name('profile.uploadselected');
        Route::post('/album/delete/{id}', 'ProfileController@albumdestroy');
        Route::post('answerupdate/{id}', 'ProfileController@updateAnswer')->name('update.answer');
        Route::post('warning/{id}', 'ProfileController@warning')->name('profile.warning');
        Route::get('suspenduser', 'ProfileController@suspendUsers')->name('profile.suspenduser');
        Route::post('suspend', 'ProfileController@suspend')->name('profile.suspend');
        Route::get('verifyusers', 'ProfileController@verifyUsers')->name('profile.verifyusers');
        Route::post('verifydecline', 'ProfileController@verifyDeclined')->name('profile.decline');
        Route::get('verifyaccept/{id}', 'ProfileController@verifyAccepted')->name('profile.accept');
        Route::get('active/{id}', 'ProfileController@active')->name('profile.active');
        Route::post('updateaccount/{id}', 'ProfileController@updateaccount')->name('updateaccount.setting');
        Route::post('blockreport', 'ProfileController@blockreport')->name('profile.blockreport');
        Route::post('removewarning/delete/{id}', 'ProfileController@removewarning');
        Route::get('permanentdelete', 'ProfileController@permanentDeleteAccount')->name('profile.permanentdelete');
        Route::get('delete', 'ProfileController@deleteaccount')->name('profile.delete');
        Route::get('profile/blocked/users', 'ProfileController@getBlockedUsers')->name('profile.blocked.users');

        Route::get('deleteuid', 'ProfileController@deleteuid')->name('profile.deleteuid');
        
    });

    Route::group(['prefix' => 'trials'], function () {
        Route::post('/store', 'TrialsController@store')->name('trials.store');
        Route::any('/', 'TrialsController@index')->name('trials.index');
        Route::get('/decline/{id}', 'TrialsController@decline')->name('trials.decline');
        Route::get('/accept/{id}', 'TrialsController@accept')->name('trials.accept');
        Route::get('/maybe/{id}', 'TrialsController@maybe')->name('trials.maybe');
        Route::get('/reschedule/{id}', 'TrialsController@reschedule')->name('trials.reschedule');
        Route::post('/success/{id}', 'TrialsController@success')->name('trials.success');
        Route::post('/unsuccess/{id}', 'TrialsController@unsuccess')->name('trials.unsuccess');
        Route::post('/trialEnded', 'TrialsController@endTrial')->name('trials.trialEnded');
        Route::get('/cancelrequest/{id}', 'TrialsController@cancelrequest')->name('trials.cancelrequest');
        /** Trials pages **/
        Route::any('/sent-trials', 'TrialsController@sentTrialsIndex')->name('trials.sentTrialsIndex');
        Route::any('/active-trials', 'TrialsController@activeTrialsIndex')->name('trials.activeTrialsIndex');
        Route::any('/expire-trials', 'TrialsController@expiredTrialsIndex')->name('trials.expiredTrialsIndex');
    });
    Route::group(['prefix' => 'messages'], function () {
        Route::get('/', 'UserMessageController@index')->name('messages');
        Route::post('/store', 'UserMessageController@store')->name('messages.store');
        Route::get('/inbox', 'UserMessageController@inbox');
        Route::post('/delete', 'UserMessageController@deletemessages')->name('messages.delete');
        Route::post('/reply', 'UserMessageController@replyMessage')->name('messages.reply');
        Route::get('/deletesinglemsg/{id}', 'UserMessageController@deletesinglemsg')->name('messages.singlemsgdelete');
    });

    Route::group(['prefix' => 'subscription'], function () {
        Route::get('/', 'SubscriptionController@getpricing');
        Route::post('/charge', 'SubscriptionController@charge');
        Route::post('/upgrade', 'SubscriptionController@upgrade');
        Route::post('/checkout', 'SubscriptionController@checkout')->name('checkout');
        Route::post('/downgrade', 'SubscriptionController@downgrade')->name('downgrade');
        Route::post('/downgradeconfirm', 'SubscriptionController@downgradeConfirm')->name('downgradeconfirm');
        Route::post('applycoupon', 'SubscriptionController@applyCoupon')->name('applycoupon');
        Route::post('/paywithwallet', 'SubscriptionController@paywithwallet');
        Route::post('/paywithwalletfeature', 'SubscriptionController@paywithwalletfeature');
        Route::post('/paywithinworld', 'SubscriptionController@paywithinworld');
        Route::post('/cancel', 'SubscriptionController@cancel');
        Route::get('/success', 'SubscriptionController@success');
        Route::get('/failed', 'SubscriptionController@failed');
        Route::post('/featureupgrade', 'SubscriptionController@featureupgrade');
        Route::post('/featurecancel', 'SubscriptionController@featurecancel');
        Route::post('/feturecharge', 'SubscriptionController@feturecharge')->name('plan.feturecharge');
    });
    Route::group(['prefix' => 'wallet'], function () {
        Route::get('/', 'PaymentController@index')->name('wallet');
        Route::get('/credit', 'PaymentController@create')->name('wallet.credit');
        Route::post('/credit', 'PaymentController@charge')->name('wallet.charge');
        Route::post('/checkout', 'PaymentController@checkoutCredit')->name('wallet.checkoutcredit');
        Route::post('/paywithwalletdonation', 'PaymentController@paywithwalletDonation')->name('wallet.paywithwalletdonation');
        Route::get('/success', 'PaymentController@checkoutSucess')->name('wallet.checkoutsuccess');
        Route::get('/failed', 'PaymentController@checkoutFailed')->name('wallet.checkoutfailed');
        Route::post('/debit-tokens', 'PaymentController@debitTokens')->name('debit.tokens');
    });

    Route::get('/all-notifications', 'ProfileController@allNotifications')->name('allnotifications');
    Route::get('/notification/{id}', 'ProfileController@deleteNotification')->name('notification.delete');
    Route::post('/notification/removeAll', 'ProfileController@removeAllNotification')->name('notification.removeAll');
    Route::get('blocks', 'ProfileController@displayBlocksToUser')->name('display.blocks');
    Route::get('unblock/{id}', 'ProfileController@unblockUser')->name('user.unblock');
    Route::get('notes', 'ProfileController@profileNotes')->name('profile.note');
    Route::get('/mymatches', 'MatchController@index')->name('user.matches');
    Route::get('/mylikes', 'LikeController@index')->name('user.likes');
    Route::get('/visitors', 'HomeController@visitors')->name('visitors');
    Route::get('/myhearts', 'HeartController@index')->name('user.hearts');
    Route::get('/certificates', 'certificateController@index')->name('user.certificate');
    Route::post('albumUploadFile', array('as' => 'dropzone.uploadfile', 'uses' => 'ProfileController@dropzoneUploadFile'));

    Route::get('/manageads', 'UserAdsController@index')->name('manageads');
    Route::get('/createuseradvertise', 'UserAdsController@create')->name('createuseradvertise.manageads');
    Route::post('/saveuseradvertise', 'UserAdsController@store')->name('saveuseradvertise.manageads');
    Route::get('/checkoutads/{id}', 'UserAdsController@checkoutads')->name('checkoutads.manageads');
    Route::post('/paywithwalletads', 'UserAdsController@paywithwalletads')->name('paywithwalletads.manageads');
    Route::get('/adspackages', 'UserAdsController@adspackages')->name('adspackages.manageads');
    Route::get('/uploadbanners/{id}', 'UserAdsController@uploadbanners')->name('uploadbanners.manageads');
    Route::post('/saveuserbanners', 'UserAdsController@saveuserbanners')->name('saveuserbanners.manageads');
    Route::get('/editbanners/{id}', 'UserAdsController@editbanners')->name('editbanners.manageads');
    Route::post('/updateuserbanners/{id}', 'UserAdsController@updateuserbanners')->name('updateuserbanners.manageads');
    Route::get('/deletesubads/{id}', 'UserAdsController@deletesubads')->name('deletesubads.manageads');
});

Route::group(['prefix' => 'ajaxrequest'], function () {
    Route::group(['middleware' => ['auth']], function () {

        Route::post('/adopt-request-accept', 'AdoptsController@ajax_accept');
        Route::post('/like', 'LikeController@dolike');
        Route::post('/addtowishlist', 'HeartController@store');
        Route::post('/removeAnnouncement', 'ProfileController@removeAnnouncement');
        Route::post('/notificationSeen', 'ProfileController@notificationSeen');
        Route::post('/envelopeMessageSeen', 'ProfileController@envelopeMessageSeen');
        Route::post('/heartSeen', 'ProfileController@heartSeen');
        Route::post('/matchSeen', 'ProfileController@matchSeen');
        Route::post('/usermessage', 'UserMessageController@usermessage');
        Route::post('/draftmessage', 'UserMessageController@draftmessage');
        Route::post('/savesearchresult', 'UserSearchController@saveSearchResult');
        Route::post('/save-event-in-user-list', 'EventController@saveEventInUserList');
        Route::post('/profile/{id}/users-who-liked', 'ProfileController@usersWhoLiked')->name('users_who_liked_profile');
        Route::post('/profile/{profile_id}/match/me', 'ProfileController@matchWithMe')->name('match_with_me');
        Route::post('/sort-items', 'UsergroupController@sortUsergroups')->name('sort_usergroup');
        Route::post('/sort-match-quests', 'QuestionnairesController@sortMatchQuests')->name('sort_match_quest');
        Route::post('/parcels', 'ParcelsController@getParcels')->name('ajaxrequest.get_parcels');
        Route::post('/adopt-request', 'AdoptsController@adoptAdopteeRequest');
        Route::post('/save-certificate', 'HomeController@savecertificate')->name('savecertificate');
        Route::post('/trial-family-roles-check', 'HomeController@checkTrialFamilyRole')->name('checkTrialFamilyRole');
    });
    Route::post('/filteruser', 'UserSearchController@filteruser');
    Route::get('auth_check', 'Auth\LoginController@authCheck');

    Route::post('/user-availability-check', 'AccountSetupController@userAvailabilityCheck');
    Route::get('/user-availability-check', 'AccountSetupController@userAvailabilityCheck');

});

Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
});

Route::group(['prefix' => 'admin/family-role'], function () {
    Route::get('/', 'FamilyroleController@index')->name('admin.familyrole');
    Route::get('/create', 'FamilyroleController@create')->name('familyrole.create');
    Route::post('/store', 'FamilyroleController@store')->name('familyrole.store');
    Route::get('/edit/{id}', 'FamilyroleController@edit')->name('familyrole.edit');
    Route::post('/update/{id}', 'FamilyroleController@update')->name('familyrole.update');
    Route::get('/delete/{id}', 'FamilyroleController@destroy')->name('familyrole.delete');
    Route::post('/sort-items', 'FamilyroleController@sortFamilyRoles')->name('sort_familyrole');
});

Route::group(['prefix' => 'admin/trial-location'], function () {
    Route::get('/', 'TrialLocationController@index')->name('admin.triallocation');
    Route::get('/create', 'TrialLocationController@create')->name('triallocation.create');
    Route::post('/store', 'TrialLocationController@store')->name('triallocation.store');
    Route::get('/edit/{id}', 'TrialLocationController@edit')->name('triallocation.edit');
    Route::post('/update/{id}', 'TrialLocationController@update')->name('triallocation.update');
    Route::get('/delete/{id}', 'TrialLocationController@destroy')->name('triallocation.delete');
    Route::post('/sort-items', 'TrialLocationController@sortFamilyRoles')->name('sort_triallocation');
});

Route::group(['prefix' => 'admin/trial-reasons'], function () {
    Route::get('/', 'CreateReasonsController@index')->name('admin.trialreasons');
    Route::get('/create', 'CreateReasonsController@create')->name('trialreasons.create');
    Route::post('/store', 'CreateReasonsController@store')->name('trialreasons.store');
    Route::get('/edit/{id}', 'CreateReasonsController@edit')->name('trialreasons.edit');
    Route::post('/update/{id}', 'CreateReasonsController@update')->name('trialreasons.update');
    Route::get('/delete/{id}', 'CreateReasonsController@destroy')->name('trialreasons.delete');
    Route::post('/sort-items', 'CreateReasonsController@sortTrialreasons')->name('sort_trialreasons');
});

/* route for Advertisement */
Route::group(['prefix' => 'admin/advertisement'], function () {
    Route::get('/', 'AdvertisementController@index')->name('admin.advertisement');
    Route::get('/create', 'AdvertisementController@create')->name('advertisement.create');
    Route::post('/store', 'AdvertisementController@store')->name('advertisement.store');
    Route::get('/edit/{id}', 'AdvertisementController@edit')->name('advertisement.edit');
    Route::post('/update/{id}', 'AdvertisementController@update')->name('advertisement.update');
    Route::get('/show/{id}', 'AdvertisementController@show')->name('advertisement.show');
    Route::get('/approve/{id}', 'AdvertisementController@approveads')->name('advertisement.approveads');
    Route::get('/active', 'AdvertisementController@activeads')->name('admin.advertisement.active');
    Route::get('/paid', 'AdvertisementController@paidads')->name('admin.advertisement.paid');
    Route::get('/ended', 'AdvertisementController@endedAds')->name('admin.advertisement.ended');
    Route::get('/monthlyearned', 'AdvertisementController@monthlyEarned')->name('admin.advertisement.monthlyearned');

    Route::post('suspend', 'AdvertisementController@suspendAdvertisement')->name('advertisement.suspend');
    Route::post('delete', 'AdvertisementController@deleteAdvertisement')->name('advertisement.delete');
    Route::post('paid/delete', 'AdvertisementController@deletePaidAdvertisement')->name('advertisement.paid.delete');
    Route::get('/banners', 'AdvertisementController@showbanners')->name('showbanners.advertisement');
    Route::get('/addbanner', 'AdvertisementController@addbanner')->name('addbanner.advertisement');
    Route::post('/savebanner', 'AdvertisementController@savebanner')->name('savebanner.advertisement');
    Route::get('/editbanner/{id}', 'AdvertisementController@editbanner')->name('editbanner.advertisement');
    Route::post('/updatebanner/{id}', 'AdvertisementController@updatebanner')->name('updatebanner.advertisement');
    Route::get('/deletebanner/{id}', 'AdvertisementController@deletebanner')->name('deletebanner.advertisement');
    Route::get('/targetaudiances', 'AdvertisementController@showtargetaudiances')->name('showtargetaudiances.advertisement');
    Route::get('/addtargetaudiance', 'AdvertisementController@addtargetaudiance')->name('addtargetaudiance.advertisement');
    Route::post('/savetargetaudiance', 'AdvertisementController@savetargetaudiance')->name('savetargetaudiance.advertisement');
    Route::get('/edittargetaudiance/{id}', 'AdvertisementController@edittargetaudiance')->name('edittargetaudiance.advertisement');
    Route::post('/updatetargetaudiance/{id}', 'AdvertisementController@updatetargetaudiance')->name('updatetargetaudiance.advertisement');
    Route::get('/deletetargetaudiance/{id}', 'AdvertisementController@deletetargetaudiance')->name('deletetargetaudiance.advertisement');
});

Route::any('admin/trial-request', 'TrialsController@adminindex')->name('admin.trialrequest');
Route::get('/adminCancelRequest/{id}', 'TrialsController@adminCancelRequest')->name('trials.adminCancelRequest');

Route::group(['prefix' => 'admin/seeking-role'], function () {
    Route::get('/', 'SeekingroleController@index')->name('admin.seekingrole');
    Route::get('/create', 'SeekingroleController@create')->name('seekingrole.create');
    Route::post('/store', 'SeekingroleController@store')->name('seekingrole.store');
    Route::get('/edit/{id}', 'SeekingroleController@edit')->name('seekingrole.edit');
    Route::post('/update/{id}', 'SeekingroleController@update')->name('seekingrole.update');
    Route::get('/delete/{id}', 'SeekingroleController@destroy')->name('seekingrole.delete');
    Route::post('/sort-items', 'SeekingroleController@sortSeekingRoles')->name('sort_seekingrole');
});

Route::group(['prefix' => 'frontend'], function () {
    Route::post('/getGroup/{id}', 'UsergroupController@getGroup');
});

Route::group(['prefix' => 'chat'], function () {
    Route::get('/', 'ChatsController@index')->name('chatindex');
    Route::get('/messages/{reciever}', 'ChatsController@fetchMessages');
    Route::get('/currentUserId', 'ChatsController@getCurrntuserdata');
    Route::get('/users', 'ChatsController@fetchusers');
    Route::get('/chattedusers', 'ChatsController@fetchchattingusers');
    Route::get('/staffadmins', 'ChatsController@fetchstaffadmins');
    Route::post('/messages', 'ChatsController@sendMessage');
    Route::post('/attachments', 'ChatsController@messageAttachments');
    Route::post('/delete', 'ChatsController@deleteChat');
    Route::post('/blockreport', 'ChatsController@userBlock');
});
Route::get('/test', 'ChatsController@testfunction');

Route::group(['prefix' => 'admin/ethnicity-group'], function () {
    Route::get('/', 'EthnicityGroupController@index')->name('admin.ethnicity.group');
    Route::get('/create', 'EthnicityGroupController@create')->name('admin.ethnicity.group.create');
    Route::post('/store', 'EthnicityGroupController@store')->name('admin.ethnicity.group.store');
    Route::get('/edit/{id}', 'EthnicityGroupController@edit')->name('admin.ethnicity.group.edit');
    Route::post('/update/{id}', 'EthnicityGroupController@update')->name('admin.ethnicity.group.update');
    Route::get('/delete/{id}', 'EthnicityGroupController@destroy')->name('admin.ethnicity.group.delete');
    Route::post('/sort-items', 'EthnicityGroupController@sortEthnicityGroups')->name('sort_ethnicitygroup');
});

Route::group(['prefix' => 'adoptions', 'middleware' => ['auth']], function () {
    Route::any('/', 'AdoptsController@index')->name('adoptions.index');
    Route::get('/decline/{id}', 'AdoptsController@decline')->name('adoptions.decline');
    Route::get('/accept/{id}', 'AdoptsController@accept')->name('adoptions.accept');
    Route::get('/reschedule/{id}', 'AdoptsController@reschedule')->name('adoptions.reschedule');
    Route::post('/success/{id}', 'AdoptsController@success')->name('adoptions.success');
    Route::get('/cancelrequest/{id}', 'AdoptsController@cancelrequest')->name('adoptions.cancelrequest');
    Route::get('/dissolverequest/{id}', 'AdoptsController@dissolverequest')->name('adoptions.dissolverequest');
    Route::get('/certificates', 'AdoptsController@certificates')->name('adoptions.certificates');
    Route::any('/my-adoptions', 'AdoptsController@myAdoptions')->name('adoptions.my-adoptions');
});

Route::group(['prefix' => 'admin/hud'], function () {
    Route::get('/', 'HudController@index')->name('admin.hud');
    Route::get('/create', 'HudController@create')->name('admin.hud.create');
    Route::post('/store', 'HudController@store')->name('admin.hud.store');
    Route::get('/edit/{id}', 'HudController@edit')->name('admin.hud.edit');
    Route::post('/update/{id}', 'HudController@update')->name('admin.hud.update');
    Route::get('/delete/{id}', 'HudController@destroy')->name('admin.hud.delete');
    Route::post('/sort-items', 'HudController@sortHuds')->name('sort_hud');
});

Route::group(['prefix' => 'admin/relationship'], function () {
    Route::get('/', 'RelationshipController@index')->name('admin.relationship');
    Route::get('/create', 'RelationshipController@create')->name('admin.relationship.create');
    Route::post('/store', 'RelationshipController@store')->name('admin.relationship.store');
    Route::get('/edit/{id}', 'RelationshipController@edit')->name('admin.relationship.edit');
    Route::post('/update/{id}', 'RelationshipController@update')->name('admin.relationship.update');
    Route::get('/delete/{id}', 'RelationshipController@destroy')->name('admin.relationship.delete');
    Route::post('/sort-items', 'RelationshipController@sortRelationships')->name('sort_relationship');
});

Route::group(['prefix' => 'admin/occupation'], function () {
    Route::get('/', 'OccupationController@index')->name('admin.occupation');
    Route::get('/create', 'OccupationController@create')->name('admin.occupation.create');
    Route::post('/store', 'OccupationController@store')->name('admin.occupation.store');
    Route::get('/edit/{id}', 'OccupationController@edit')->name('admin.occupation.edit');
    Route::post('/update/{id}', 'OccupationController@update')->name('admin.occupation.update');
    Route::get('/delete/{id}', 'OccupationController@destroy')->name('admin.occupation.delete');
    Route::post('/sort-items', 'OccupationController@sortOccupations')->name('sort_occupation');
});

Route::any('admin/adoptions-request', 'AdoptsController@adminindex')->name('admin.adoptrequest')->middleware('auth');
Route::get('/adminCancelAdoptRequest/{id}', 'AdoptsController@adminCancelRequest')->name('adopts.adminCancelAdoptRequest');

