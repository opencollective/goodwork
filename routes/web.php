<?php

namespace App\Core\Http\Controllers;

use Illuminate\Support\Facades\Route;

/**********************************
    Login
**********************************/

Route::get('login', [Auth\LoginController::class, 'showLoginForm']);

Route::post('login', [Auth\LoginController::class, 'login']);

Route::post('logout', [Auth\LoginController::class, 'logout']);

/**********************************
    Password
**********************************/

Route::post('password/email', [Auth\ForgotPasswordController::class, 'sendResetLinkEmail']);

Route::get('password/reset', [Auth\ForgotPasswordController::class, 'showLinkRequestForm']);

Route::post('password/reset', [Auth\ResetPasswordController::class, 'reset']);

Route::get('password/reset/{token}', [Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');

/**********************************
    Registration
**********************************/

Route::post('register/invite-link', [InvitationController::class, 'store'])->middleware(['auth', 'admin']);

Route::get('register/invite-link', [InvitationController::class, 'show'])->middleware(['auth', 'admin']);

Route::get('register/invite-link/{token}', [InvitationController::class, 'showRegistrationForm'])->middleware('guest');

Route::post('register/invite-link/{token}', [Auth\RegisterController::class, 'registerViaLink']);

Route::post('register/invite', [UserController::class, 'sentInvitationToRegister'])->middleware(['auth', 'admin']);

Route::get('register/{token}', [Auth\RegisterController::class, 'showRegistrationForm'])->middleware('guest');

Route::post('register/{token}', [Auth\RegisterController::class, 'confirmNewRegistration']);

/**********************************
    Impersonate User
**********************************/

Route::impersonate();

Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth');

    /**********************************
        Project
    **********************************/

Route::get('projects/{project}', [ProjectController::class, 'show']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('projects', [ProjectController::class, 'index']);

    Route::post('projects', [ProjectController::class, 'store']);

    Route::delete('projects/{project}', [ProjectController::class, 'delete']);

    Route::post('public-projects/{project}', [PublicProjectController::class, 'store']);

    Route::delete('public-projects/{project}', [PublicProjectController::class, 'delete']);
});

    /**********************************
        Team
    **********************************/

Route::get('teams/{team}', [TeamController::class, 'show']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('teams', [TeamController::class, 'index']);

    Route::post('teams', [TeamController::class, 'store']);

    Route::delete('teams/{team}', [TeamController::class, 'delete']);

    Route::post('public-teams/{team}', [PublicTeamController::class, 'store']);

    Route::delete('public-teams/{team}', [PublicTeamController::class, 'delete']);
});

    /**********************************
        Office
     **********************************/

Route::get('offices/{office}', [OfficeController::class, 'show']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('offices', [OfficeController::class, 'index']);

    Route::post('offices', [OfficeController::class, 'store']);

    Route::delete('offices/{office}', [OfficeController::class, 'delete']);

    Route::post('public-offices/{office}', [PublicOfficeController::class, 'store']);

    Route::delete('public-offices/{office}', [PublicOfficeController::class, 'delete']);
});

    /**********************************
        Group (Project/Team/Office)
     **********************************/

Route::group(['middleware' => 'auth'], function () {
    Route::get('groups/settings', [GroupSettingsController::class, 'index']);

    Route::put('groups/settings', [GroupSettingsController::class, 'update']);

    Route::get('groups/permissions', [GroupPermissionController::class, 'index']);

    Route::post('groups/permissions/{permission}/roles/{role}', [GroupPermissionController::class, 'store']);

    Route::delete('groups/permissions/{permission}/roles/{role}', [GroupPermissionController::class, 'delete']);

    Route::get('groups/tags', [GroupTagsController::class, 'index']);

    Route::post('groups/tags/{tag}', [GroupTagsController::class, 'store']);

    Route::delete('groups/tags/{tag}', [GroupTagsController::class, 'delete']);
});

    /**********************************
        Member
     **********************************/

Route::group(['middleware' => 'auth'], function () {
    Route::get('members', [MemberController::class, 'index']);

    Route::post('members', [MemberController::class, 'store']);

    Route::delete('members', [MemberController::class, 'destroy']);
});

    /**********************************
        Discussion
     **********************************/

Route::get('discussions', [DiscussionController::class, 'index']);

Route::group(['middleware' => 'auth'], function () {
    Route::post('discussions', [DiscussionController::class, 'store']);

    Route::get('discussions/{discussion}', [DiscussionController::class, 'show']);

    Route::patch('discussions/{discussion}', [DiscussionController::class, 'update']);

    Route::delete('discussions/{discussion}', [DiscussionController::class, 'delete']);
});

    /**********************************
        Event
     **********************************/

Route::group(['middleware' => 'auth'], function () {
    Route::get('events', [EventController::class, 'index']);

    Route::post('events', [EventController::class, 'store']);

    Route::get('events/{event}', [EventController::class, 'index']);
});

    /**********************************
        Task
    **********************************/

Route::get('tasks', [TaskController::class, 'index']);

Route::group(['middleware' => 'auth'], function () {
    Route::post('tasks', [TaskController::class, 'store']);

    Route::get('tasks/{task}', [TaskController::class, 'show']);

    Route::put('tasks/{task}', [TaskController::class, 'update']);

    Route::delete('tasks/{task}', [TaskController::class, 'delete']);

    Route::put('tasks/{task}/statuses/{status}', [TaskStatusController::class, 'update']);

    Route::get('tasks/{task}/steps/', [TaskProgressController::class, 'index']);

    Route::post('tasks/{task}/steps/', [TaskProgressController::class, 'store']);
});

    /**********************************
        File
    **********************************/

Route::get('files', [FileController::class, 'index']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('files/{file}', [FileController::class, 'index']);

    Route::post('files', [FileController::class, 'store']);

    Route::delete('files/{file}', [FileController::class, 'delete']);
});

    /**********************************
        Message
     **********************************/

Route::get('messages', [MessageController::class, 'index']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('direct-messages', [DirectMessageController::class, 'index']);

    Route::delete('direct-messages/{directMessage}', [DirectMessageController::class, 'delete']);

    Route::post('messages', [MessageController::class, 'store']);

    Route::put('messages/{message}', [MessageController::class, 'update']);

    Route::delete('messages/{message}', [MessageController::class, 'delete']);
});

    /**********************************
        Comment
    **********************************/

Route::get('/comments', [CommentController::class, 'index']);

Route::group(['middleware' => 'auth'], function () {
    Route::post('/comments', [CommentController::class, 'store']);

    Route::delete('/comments/{comment}', [CommentController::class, 'delete']);
});

/**********************************
    Cycle
**********************************/

Route::get('cycles', [CycleController::class, 'index']);

Route::post('cycles', [CycleController::class, 'store'])->middleware('auth');

/**********************************
    Status
**********************************/

Route::get('statuses', [StatusController::class, 'index']);

Route::post('statuses', [StatusController::class, 'store'])->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
    /**********************************
        Category
    **********************************/

    Route::get('categories', [CategoryController::class, 'index']);

    Route::post('categories', [CategoryController::class, 'store']);

    /**********************************
        Roadmap
    **********************************/

    Route::get('cycles/{cycle}/roadmap', [RoadmapController::class, 'show']);

    /**********************************
        Direct Message
     **********************************/

    Route::get('direct-messages', [DirectMessageController::class, 'index']);

    Route::post('direct-messages', [DirectMessageController::class, 'store']);

    Route::get('unread-direct-messages/users', [UserUnreadDirectMessageController::class, 'index']);

    Route::put('unread-direct-messages/{user}', [UserUnreadDirectMessageController::class, 'update']);

    /**********************************
        Tags
    **********************************/

    Route::get('tags', [TagController::class, 'index']);

    Route::post('tags', [TagController::class, 'store']);

    Route::post('tasks/{task}/tags', [TaskTagController::class, 'store']);

    Route::delete('tasks/{task}/tags/{tag}', [TaskTagController::class, 'delete']);

    /**********************************
        Notification
    **********************************/

    Route::get('notifications', [NotificationController::class, 'index']);

    Route::put('notifications', [NotificationController::class, 'update']);

    /**********************************
        User
    **********************************/

    Route::get('users', [UserController::class, 'index']);

    Route::get('users/{user}', [UserController::class, 'show']);

    Route::get('username', [UserController::class, 'checkUsername']);

    Route::put('users/{user}/account', [UserAccountController::class, 'update']);

    Route::put('users/{user}/profile', [UserProfileController::class, 'update']);

    Route::post('users/{user}/avatar', [UserAvatarController::class, 'store']);

    /**********************************
        Github Service
    **********************************/

    Route::get('services/github/repos', [GithubRepoController::class, 'index']);

    Route::get('services/github/connected-repos', [ConnectedGithubRepoController::class, 'index']);

    Route::post('services/github/connected-repos', [ConnectedGithubRepoController::class, 'store']);

    /**********************************
        Role
    **********************************/

    Route::get('roles', [RoleController::class, 'index']);

    Route::get('activities', [ActivityController::class, 'index']);

    /**********************************
        Settings
    **********************************/

    Route::get('settings', function () {
        return view('users.settings');
    });
});

    /**********************************
        Admin
    **********************************/

Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function () {
    Route::get('/', [AdminController::class, 'index']);

    Route::get('roles/{role}/permissions', [RolePermissionController::class, 'index']);

    Route::post('roles/{role}/permissions/{permission}', [RolePermissionController::class, 'store']);

    Route::delete('roles/{role}/permissions/{permission}', [RolePermissionController::class, 'delete']);

    Route::get('permissions', [PermissionController::class, 'index']);

    Route::get('activities', [ActivityController::class, 'index']);

    Route::get('services', [ServiceController::class, 'index']);

    Route::post('services', [ServiceController::class, 'store']);

    Route::put('services/{service}', [ServiceController::class, 'update']);

    Route::get('check-for-update', [AboutController::class, 'checkForUpdate']);
});
