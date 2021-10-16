<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RealEstateType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('real_estate_type', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description', 500);
        });

        DB::statement("
            insert into real_estate_type (name, description) values ('Ház', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec cursus massa tellus, lobortis fringilla sapien condimentum in. Aenean neque massa, porttitor ac vestibulum vitae, rhoncus in nunc. Donec odio velit, dapibus et augue eget, pharetra facilisis quam.');
        ");
        DB::statement("
            insert into real_estate_type (name, description) values ('Apartman', 'Sed id dignissim leo. Quisque eleifend magna odio, ut porttitor mi facilisis sit amet. Praesent nisl leo, faucibus at tempor eu, viverra non lorem. Duis id porttitor lorem. In convallis, nisi at lobortis vehicula, ipsum ligula congue nulla, eleifend gravida elit justo ut mi. ');
        ");
        DB::statement("
            insert into real_estate_type (name, description) values ('Kunyhó', 'Integer fringilla nisl quis aliquam finibus. Vestibulum varius non dolor eu fringilla. Integer non feugiat magna. Maecenas est urna, elementum sit amet suscipit et, placerat sed metus.');
        ");


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('real_estate_type');
    }
}
