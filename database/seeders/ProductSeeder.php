<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); // Desactivamos la revision de claves foraneas
        DB::table('products')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;'); // Reactivamos la revision de claves foraneas

        DB::table('products')->insert([
            'brand_id' => 1,
            'category_id' => 1,
            'name' => 'MacBook Pro 13.3" Retina [MYD82] M1 Chip 256 GB - Space Gray',
            'description' => null,
            'image' => 'apple.com/v/macbook-pro/ac/images/overview/hero_13__d1tfa5zby7e6_large_2x.jpg',
            'price' => 2000,
            'price_sale' => 1950,
            'stock' => 5,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);


        DB::table('products')->insert([
            'brand_id' => 1,
            'category_id' => 2,
            'name' => 'MacBook Air con chip M1',
            'description' => 'El CPU del chip M1 no sólo es increíblemente rápido, sino que también combina núcleos de alto rendimiento y de eficiencia para realizar las tareas del día a día consumiendo mucha menos energía. Con este poder de procesamiento, la MacBook Air realiza fácilmente tareas tan exigentes como editar videos con calidad profesional y te permite disfrutar juegos llenos de acción.',
            'image' => 'https://www.apple.com/v/macbook-air-m1/b/images/overview/machine_learning__d8u6dxf5xawm_large.png',
            'price' => 2000,
            'price_sale' => 1950,
            'stock' => 5,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);



        DB::table('products')->insert([
            'brand_id' => 2,
            'category_id' => 3,
            'name' => 'Microsoft Designer Compact Keyboard',
            'description' => 'Tu nuevo teclado inalámbrico compacto Con su elegante diseño, acabado de primera calidad y ángulo bajo optimizado para una escritura más productiva, te sentirás cómodo al instante en este moderno teclado que ahorra espacio.',
            'image' => 'https://img-prod-cms-rt-microsoft-com.akamaized.net/cms/api/am/imageFileData/RE4GpiT?ver=2cb2&q=60&m=6&h=600&w=1399&b=%23FFFFFFFF&l=f&o=t&aim=true',
            'price' => 2000,
            'price_sale' => 1950,
            'stock' => 5,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);


        DB::table('products')->insert([
            'brand_id' => 2,
            'category_id' => 3,
            'name' => 'Microsoft Number Pad',
            'description' => 'Entrada numérica compacta e inteligente Si trabajas con números todo el tiempo, Microsoft Number Pad te ofrece el teclado numérico dedicado que necesitas para una mejor entrada más rápida.',
            'image' => 'https://img-prod-cms-rt-microsoft-com.akamaized.net/cms/api/am/imageFileData/RE4FJE5?ver=e9d7&q=60&m=6&h=600&w=1399&b=%23FFFFFFFF&l=f&o=t&aim=true',
            'price' => 2000,
            'price_sale' => 1950,
            'stock' => 5,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);


        DB::table('products')->insert([
            'brand_id' => 2,
            'category_id' => 4,
            'name' => 'Microsoft Ocean Plastic Mouse',
            'description' => 'Reciclamos los plásticos de los océanos para ayudar a mantenerlos limpios Microsoft Ocean Plastic Mouse es un pequeño paso hacia adelante en el viaje hacia la sostenibilidad de Microsoft. La carcasa está hecha de un 20% de plástico de los océanos reciclado, un gran avance en la tecnología de materiales que comienza por la eliminación de los desechos de plástico de los océanos y vías fluviales. Su pequeña caja es totalmente reciclable.',
            'image' => 'https://img-prod-cms-rt-microsoft-com.akamaized.net/cms/api/am/imageFileData/RWKkom?ver=59e5&q=90&m=8&h=472&w=1259&b=%23FFFFFFFF&l=f&x=53&y=341&s=1259&d=472&aim=true',
            'price' => 2000,
            'price_sale' => 1950,
            'stock' => 5,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);


        DB::table('products')->insert([
            'brand_id' => 2,
            'category_id' => 4,
            'name' => 'Microsoft Bluetooth Ergonomic Mouse',
            'description' => 'Comodidad ergonómica, diseño inalámbrico Trabaja con comodidad, todo el día con nuestro mouse ergonómico inalámbrico Premium. Navega con precisión gracias al desplazamiento de retén y accede a las características que más usas con dos botones programables.',
            'image' => 'https://img-prod-cms-rt-microsoft-com.akamaized.net/cms/api/am/imageFileData/RE4FRBD?ver=dd4c&q=60&m=6&h=600&w=1399&b=%23FFFFFFFF&l=f&o=t&aim=true',
            'price' => 2000,
            'price_sale' => 1950,
            'stock' => 5,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('products')->insert([
            'brand_id' => 3,
            'category_id' => 5,
            'name' => 'Zenbook Flip S13 OLED (UX371, 11th Gen Intel)',
            'description' => null,
            'image' => 'https://dlcdnwebimgs.asus.com/gain/ca4e8469-c3e1-4265-972b-8556a86b7df7/w184',
            'price' => 2000,
            'price_sale' => 1950,
            'stock' => 5,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('products')->insert([
            'brand_id' => 3,
            'category_id' => 5,
            'name' => 'Zenbook 13 OLED (UX325, 11th Gen Intel)',
            'description' => null,
            'image' => 'https://dlcdnwebimgs.asus.com/gain/1b7d52dd-1049-4de8-856c-abbf914dc051/w184',
            'price' => 2000,
            'price_sale' => 1950,
            'stock' => 5,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
