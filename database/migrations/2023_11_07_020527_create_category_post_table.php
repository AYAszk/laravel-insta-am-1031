<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void //*
    {
        Schema::create('category_post', function (Blueprint $table) {
            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('category_id');

            //Foreign Key -> Primary Key -> table
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_post');
    }
};

//🐳11.7 * category_post という名前の中間テーブルを作成。これは多対多の関係を定義するためのもので、post_id と category_id の2つの外部キーを持つ。また、post_id 列と category_id 列の両方に外部キー制約が設定されており、post_id 列は 'posts' テーブルの 'id' 列を参照し、category_id 列は 'categories' テーブルの 'id' 列を参照。それぞれの外部キー制約は、関連する親レコードが削除された場合に、中間テーブルの関連するレコードも削除するように設定されている（onDelete('cascade')）。

// *このコードは、多対多の関係を実装するために使用されます。例えば、1つの投稿が複数のカテゴリに属する場合などに使用。