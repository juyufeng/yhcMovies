<?php
/**
 * Frontend Controllers
 */
Route::get('/', 'FrontendController@index')->name('frontend.index');
Route::get('macros', 'FrontendController@macros')->name('frontend.macros');

Route::group(['namespace' => 'Cms'], function() {
    /**
     * 获取 详情
     */
    Route::get('detail/{id}', 'ArticleController@detail')
        ->where('id', '[0-9]+')
        ->name('cms.detail');
    /**
     * 最新列表
     */
    Route::get('news/{page?}', 'ArticleController@newsList')
        ->where('page', '[0-9]+')
        ->name('cms.news');

    Route::get('search/{keyword?}/{page?}', 'ArticleController@search')
        ->where('page', '[0-9]+')
        //->where('keyword', '')
        ->name('cms.search');

    Route::get('tag/{tag}/{page?}', 'ArticleController@searchTag')
        ->where('page', '[0-9]+')
        //->where('keyword', '')
        ->name('cms.search.tag');
});

/**
 * 测试列表
 */
Route::get('test_list', function (){
    return response()->json([
        'status' => 1,
        'data' => [
            [
                'id' => 1,
                'title' => '测试1',
                'content' => '测试内容1',
                'frontCover' => 'http://img1.mm131.com/pic/2601/9.jpg'
            ],
            [
                'id' => 2,
                'title' => '测试2',
                'content' => '测试内容2',
                'frontCover' => 'http://img1.mm131.com/pic/2603/6.jpg'
            ],
            [
                'id' => 3,
                'title' => '测试3',
                'content' => '测试内容3',
                'frontCover' => 'http://img1.mm131.com/pic/2608/16.jpg'
            ]
        ]
    ]);
});

Route::get('test', function (App\Repositories\Backend\Cms\Collection\ArticleRepositoryContract $articleRepositoryContract){


    $string = "我在马路边, 捡到一分钱. 不知道失主还要不要? 我很害怕!";
    //$re = '~([\[\]\,.?"\(\)+_*\/\\&\$#^@!%~`<>:;\{\}？，。·！￥……（）+｛｝【】、|《》]|(?!\s)\'\s+|\s+\'(?!\s))~u';
    //$m = preg_replace("/([:punct:])+/U", '', $string);
    //$re = '/[\\pP]/';
    //preg_match_all($re, $string, $m);
    $re = "/[[:punct:]]/i";
    /*$m = preg_replace_callback($re, function($matches){
        print_r($matches[0]);
        die;
    }, $string);*/
    preg_match_all($re, $string, $m);
    //preg_match_all($reg, $string, $m);
    print_r($m);
    die;

    /*$faker = new Faker\Generator();
    $faker->addProvider(new \App\Libraries\Random\Comment($faker));
    //$faker = Faker\Factory::create('zh_CN');
    print_r($faker->realText);
    die;*/
    /*$url = route('cms.detail', ['id' => 130 ]);
    $baidu = new App\Jobs\Baidu($url);

    print_r($baidu->handle());
    die;*/
    /*$omdb = new \App\Libraries\Omdb();
    print_r($omdb->search('Emma\'s Chance'));
    die;*/
    /*$job = (new App\Jobs\Test);
    //$job = (new App\Jobs\Baidu());
    dispatch($job);
    return 'Done!';

    $res = $articleRepositoryContract->checkArticle(66);
    print_r($res);
    die;*/

    /*$res = $articleRepositoryContract->checkArticle(117, true);
    print_r($res);
    die;*/

    /*preg_match_all("/(?:《)(.*)(?:》)/i", "2016高分剧情《魔兽》HD720P.中英双字", $alias);
    //$b = \App\Libraries\Douban::movie_search($alias[1][0]);
    $response = \App\Libraries\Douban::movie_search($alias[1][0]);
    if(isset($response->subjects[0]) && !empty($response->subjects[0])){
        $subject = \App\Libraries\Douban::movie_subject($response->subjects[0]->id);
        foreach ($subject->directors as $director){
            print_r($director);
            die;
        }

    }
    print_r($subject);
    die;*/
})->name('frontend.macros');

/**
 * These frontend controllers require the user to be logged in
 */
Route::group(['middleware' => 'auth'], function () {
    Route::group(['namespace' => 'User'], function() {
        Route::get('dashboard', 'DashboardController@index')->name('frontend.user.dashboard');
        Route::get('profile/edit', 'ProfileController@edit')->name('frontend.user.profile.edit');
        Route::patch('profile/update', 'ProfileController@update')->name('frontend.user.profile.update');
    });
});