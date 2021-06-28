<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRealEstateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('real_estate', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description', 500);
            $table->string('address');
            $table->string('img_uri');
            $table->double('price');
            $table->string('type');
            $table->timestamps();
        });

        DB::statement("
        insert into real_estate (name,img_uri, description, address,price,type, created_at) values ('candyland', '/images/candyland.PNG', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'Gödreszentmartón Szilágyi Erzsébet fasor 13.', 97000000, 'House', CURRENT_TIMESTAMP );
        ");

        DB::statement("
        insert into real_estate (name,img_uri, description, address,price,type, created_at) values ('diktator', '/images/diktator.PNG', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de limprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte.', 'Újmohács Kossuth Lajos u. 69.', 197000000, 'House', CURRENT_TIMESTAMP );
        ");

        DB::statement("
        insert into real_estate (name,img_uri, description, address,price,type, created_at) values ('elnoki', '/images/elnoki.PNG', 'Lorem Ipsum adalah text contoh digunakan didalam industri pencetakan dan typesetting. Lorem Ipsum telah menjadi text contoh semenjak tahun ke 1500an, apabila pencetak yang kurang terkenal mengambil sebuah galeri cetak dan merobakanya menjadi satu buku spesimen. Ia telah bertahan bukan hanya selama lima kurun, tetapi telah melonjak ke era typesetting elektronik, dengan tiada perubahan ketara.', 'Rákóczitelep Király u. 93.', 2345629742, 'Apartment', CURRENT_TIMESTAMP );
        ");

        DB::statement("
        insert into real_estate (name,img_uri, description, address,price,type, created_at) values ('generalis', '/images/generalis.PNG', 'Lorem Ipsum ist ein einfacher Demo-Text für die Print- und Schriftindustrie. Lorem Ipsum ist in der Industrie bereits der Standard Demo-Text seit 1500, als ein unbekannter Schriftsteller eine Hand voll Wörter nahm und diese durcheinander warf um ein Musterbuch zu erstellen. Es hat nicht nur 5 Jahrhunderte überlebt, sondern auch in Spruch in die elektronische Schriftbearbeitung geschafft (bemerke, nahezu unverändert).', 'Csorba Apor Péter u. 16.', 2345629742, 'Apartment', CURRENT_TIMESTAMP );
        ");

        DB::statement("
        insert into real_estate (name,img_uri, description, address,price,type, created_at) values ('pinkyboy', '/images/pinkyboy', 'Lorem Ipsum è un testo segnaposto utilizzato nel settore della tipografia e della stampa. Lorem Ipsum è considerato il testo segnaposto standard sin dal sedicesimo secolo, quando un anonimo tipografo prese una cassetta di caratteri e li assemblò per preparare un testo campione. È sopravvissuto non solo a più di cinque secoli, ma anche al passaggio alla videoimpaginazione, pervenendoci sostanzialmente inalterato.', 'Parádsavár Izabella u. 54.', 2345629742, 'House', CURRENT_TIMESTAMP );
        ");

        DB::statement("
        insert into real_estate (name,img_uri, description, address,price,type, created_at) values ('zoldfulu', '/images/zoldfulu', 'A Lorem Ipsum egy egyszerû szövegrészlete, szövegutánzata a betûszedõ és nyomdaiparnak. A Lorem Ipsum az 1500-as évek óta standard szövegrészletként szolgált az iparban; mikor egy ismeretlen nyomdász összeállította a betûkészletét és egy példa-könyvet vagy szöveget nyomott papírra, ezt használta. Nem csak 5 évszázadot élt túl, de az elektronikus betûkészleteknél is változatlanul megmaradt. ', 'Fenékpuszta Erzsébet tér 67.', 2345629742, 'Hut', CURRENT_TIMESTAMP );
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('real_estate');
    }
}
