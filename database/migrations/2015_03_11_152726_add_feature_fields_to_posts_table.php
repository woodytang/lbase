<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddFeatureFieldsToPostsTable extends Migration {

    /**
     * Make changes to the table.
     *
     * @return void
     */
    public function up()
    {   
        Schema::table('posts', function(Blueprint $table) {     
            
            $table->string('feature_file_name')->nullable();
            $table->integer('feature_file_size')->nullable();
            $table->string('feature_content_type')->nullable();
            $table->timestamp('feature_updated_at')->nullable();

        });

    }

    /**
     * Revert the changes to the table.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function(Blueprint $table) {

            $table->dropColumn('feature_file_name');
            $table->dropColumn('feature_file_size');
            $table->dropColumn('feature_content_type');
            $table->dropColumn('feature_updated_at');

        });
    }

}
