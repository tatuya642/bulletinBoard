<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 50);
            $table->text('body');
            $table->timestamps();
            $table->integer('user_id')->nullable();
            $table->string('image_path')->nullable();
            
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
        $this->delete_post_use_image();
    }

    public function delete_post_use_image()
    {
        $dir = "storage/app/public/post";
        
        function remove_directory($dir) {
            $files = array_diff(scandir($dir), array('.','..'));
            foreach ($files as $file) {
                // ファイルかディレクトリによって処理を分ける
                if (is_dir("$dir/$file")) {
                    // ディレクトリなら再度同じ関数を呼び出す
                    remove_directory("$dir/$file");
                } else {
                    // ファイルなら削除
                    unlink("$dir/$file");
                    //echo "ファイル:" . $dir . "/" . $file . "を削除\n";
                }
            }
            // 指定したディレクトリを削除
            //echo "ディレクトリ:" . $dir . "を削除\n";
            rmdir($dir);
        }
        
        
        if(file_exists($dir)){
            remove_directory($dir);
        }
    }
}
