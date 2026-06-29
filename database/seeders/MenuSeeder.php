<?php

namespace Database\Seeders;

use App\Models\MenuCategory;
use App\Models\MenuItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MenuSeeder extends Seeder
{
    /**
     * Converts menu price strings like "38K", "1.450K", "87.5K" to Rupiah integers.
     * A dot followed by exactly 3 digits is a thousands separator (European style);
     * any other dot is a decimal point. Returns null for blank values.
     */
    private function price(?string $raw): ?float
    {
        if ($raw === null || $raw === '') {
            return null;
        }

        $numeric = rtrim(trim($raw), 'Kk');

        if (preg_match('/^\d+\.\d{3}$/', $numeric)) {
            $numeric = str_replace('.', '', $numeric);
        }

        return (float) $numeric * 1000;
    }

    public function run(): void
    {
        $data = [
            'drinks' => [
                'Signature' => [
                    ['SUMATERA ISLAND', null, null, null, '38K', null, null],
                    ['STRAWBERRY LATTE', null, null, null, '38K', null, null],
                    ['MYSTICAL BEET', null, null, null, '35K', null, null],
                    ['CINNAMON COFFEE', null, null, null, '35K', null, null],
                ],
                'Tea' => [
                    ['REGULAR TEA', null, null, '18K', '22K', null, null],
                    ['ROSEMARY TEA', null, null, '20K', '24K', null, null],
                    ['DAUN SIRIH TEA', null, null, '20K', '24K', null, null],
                    ['CIKALA TEA', null, null, '20K', '24K', null, null],
                    ['PINEAPPLE TEA', null, null, '20K', '24K', null, null],
                    ['MARKISA TEA', null, null, '21K', '25K', null, null],
                    ['CINNAMON TEA', null, null, '20K', '24K', null, null],
                ],
                'Non Coffee' => [
                    ['CHOCOLATE LATTE', null, null, '38K', '38K', null, null],
                    ['GREEN TEA LATTE', null, null, '38K', '38K', null, null],
                    ['TARO LATTE', null, null, '38K', '38K', null, null],
                    ['MILO', null, null, '38K', '40K', null, null],
                    ['THAI TEA LATTE', null, null, '38K', '38K', null, null],
                ],
                'Coffee Based' => [
                    ['COLD BREW', null, null, null, '45K', null, null],
                    ['ESPRESSO', null, null, '30K', null, null, null],
                    ['SANGER', null, null, '30K', '32K', null, null],
                    ['AMERICANO', null, null, '23K', '25K', null, null],
                    ['PICOLLO', null, null, '38K', null, null, null],
                    ['COFFEE MILK', null, null, '35K', '35K', null, null],
                    ['REMPAH COFFEE', null, null, '27K', '29K', null, null],
                    ['REMPAH MILK COFFEE', null, null, '32K', '34K', null, null],
                    ['PALM SUGAR COFFEE', null, null, '35K', '35K', null, null],
                    ['COFFEE LATTE', null, null, '35K', '38K', null, null],
                    ['CAPPUCCINO', null, null, '35K', '38K', null, null],
                    ['CINNAMON COFFEE', null, null, '27K', null, null, null],
                    ['MOCCACINO', null, null, '38K', '38K', null, null],
                    ['WHITE MOCCA', null, null, '38K', '38K', null, null],
                    ['CARAMEL LATTE', null, null, '38K', '38K', null, null],
                    ['CARAMEL MACHIATO', null, null, '38K', '38K', null, null],
                    ['VANILLA LATTE', null, null, '38K', '38K', null, null],
                    ['HAZELNUT LATTE', null, null, '38K', '38K', null, null],
                    ['TIRAMISU LATTE', null, null, '38K', '38K', null, null],
                ],
                'Coffee Dessert' => [
                    ['AFFOGATO', null, null, null, '35K', null, null],
                    ['AVOCADO', null, null, null, '41K', null, null],
                ],
                'Smoothies' => [
                    ['BANANA', null, null, null, '50K', null, null],
                    ['STRAWBERRY', null, null, null, '50K', null, null],
                    ['PINEAPPLE', null, null, null, '50K', null, null],
                    ['TAMARILLO', null, null, null, '50K', null, null],
                ],
                'MilkShakes' => [
                    ['VANILLA', null, null, null, '38K', null, null],
                    ['CHOCOLATE', null, null, null, '38K', null, null],
                    ['STRAWBERRY', null, null, null, '38K', null, null],
                ],
                'Blended' => [
                    ['TARO BLENDED', null, null, null, '45K', null, null],
                    ['TAMARILLO COOKIES', null, null, null, '45K', null, null],
                    ['MARKISA COOKIES', null, null, null, '45K', null, null],
                    ['OREO BLENDED', null, null, null, '45K', null, null],
                    ['CHOCO BROWNIE', null, null, null, '45K', null, null],
                    ['MILO DINO BROWNIE', null, null, null, '45K', null, null],
                    ['GREEN TEA BLENDED', null, null, null, '45K', null, null],
                ],
                'Frappe' => [
                    ['CHOCO CHIP FRAPPUCCINO', null, null, null, '45K', null, null],
                    ['FROZEN CAPPUCCINO', null, null, null, '45K', null, null],
                    ['BANANA CAPPUCCINO', null, null, null, '45K', null, null],
                ],
                'Milk' => [
                    ['FRESH MILK', null, null, '35K', '35K', null, null],
                    ['HONEY FRESH MILK', null, null, '38K', '40K', null, null],
                    ['GINGER FRESH MILK', null, null, '38K', '40K', null, null],
                    ['HONEY GINGER FRESH MILK', null, null, '38K', '40K', null, null],
                    ['FRESH MILK TEA', null, null, '38K', '40K', null, null],
                    ['CINNAMON MILK TEA', null, null, '38K', '40K', null, null],
                ],
                'Beer' => [
                    ['BEER BINTANG LARGE', null, '70K', null, null, null, null],
                    ['BEER HEINEKEN LARGE', null, '95K', null, null, null, null],
                    ['BEER HEINEKEN SMALL', null, '58K', null, null, null, null],
                ],
                'Cocktail' => [
                    ['WISKY SOUR', null, '100K', null, null, null, null],
                    ['GIN TONIC', null, '95K', null, null, null, null],
                    ['SCREWDRIVER', null, '80K', null, null, null, null],
                ],
                'Wine' => [
                    ['LINDEMANS CHARDONNAY', null, '667K', null, null, null, null],
                    ['LINDEMANS SAUVIGNON BLANC', null, '667K', null, null, null, null],
                    ['LINDEMANS SHIRAZ', null, '667K', null, null, null, null],
                    ['LINDEMANS MOSCATO', null, '667K', null, null, null, null],
                    ["JACOB'S CREEK CABERNET SAUVIGNON", null, '667K', null, null, null, null],
                    ["JACOB'S CREEK SHIRAZ", null, '667K', null, null, null, null],
                    ['COCKBURN PORT', null, '1.450K', null, null, null, null],
                    ['NEDERBRUG CUVEE BRUT', null, '754K', null, null, null, null],
                    ['OBIKWA SHIRAZ', null, '638K', null, null, null, null],
                    ['OBIKWA PINOTAGE', null, '638K', null, null, null, null],
                    ["SARAH'S CREEK CABERNET SAUVIGNON", null, '928K', null, null, null, null],
                ],
            ],
            'foods' => [
                'Appetizer' => [
                    ['CAPRESE SALAD', 'Bocconcini, Sliced Tomato, Basil, Extra Virgin Olive Oil, Balsamic Vinegar (Seasonal)', '40K', null, null, null, null],
                    ['HOUSE SALAD', 'Mixed Garden Greens, Mozzarella Cubes, Onion, Tomatoes, Cikala Vinaigrette', '35K', null, null, null, null],
                    ['GRILLED CHICKEN SALAD', 'Grilled Chicken Breast, Romain Lettuce, Half Avocado, Garlic Crouton, Pastrami Chips, In-House Cheese Dressing', '50K', null, null, null, null],
                    ['MORTADELLA SANDWICH', 'A Grilled Sliced Mortadella with Green Lettuce, Onions, Avocadoes, Tomatoes, a Spread of Mustard and Focaccia Bread', '50K', null, null, null, null],
                    ['SMOKED CHICKEN SANDWICH', 'A Grilled Smoked Chicken with Green Lettuce, Onions, Avocadoes, Tomatoes, a Spread of Mustard and Focaccia Bread', '50K', null, null, null, null],
                    ['SMOKED SALMON SALAD', 'Smoked Salmon, Roman Lettuce, Half Avocado, Garlic Cruton, Poached Egg and Mayonaise Mustard Sauce', '70K', null, null, null, null],
                    ['BAKED CHEESE WITH HONEY', 'Our Baked Camembert Cheese served with Honey', '50K', null, null, null, null],
                ],
                'Snack' => [
                    ['GUNDALING CHEESE PLATTER', "Gundaling Farmstead Mozzarella, Tomme, Provolone and Camembert Cheese with Condiments", '185K', null, null, null, null],
                    ['GUNDALING CHEESE FONDUE', "Deliciously Gooey Cheese Dip made from Gundaling Farmstead's Tomme, Caciocavallo and Mozzarella Cheese. Served with Sausage, Tortilla Chips and Croutons", '235K', null, null, null, null],
                    ['MIXED PLATTER', 'Gundaling Farmstead Artisan Sausage and fried Mozzarella Stick, Fried Tortilla, Deep-Fried Berastagi Redskin Potato and Chicken Wings Served with Coleslaw and Dipping', '150K', null, null, null, null],
                    ['BBQ CHICKEN WINGS', 'Deep-fried Chicken Wings BBQ Sauce mixed with Passion Fruit Sauce Served with Mayonaise Sauce', '55K', null, null, null, null],
                    ['POPCORN CHICKEN', 'A Basket of Breaded Chicken served with Tar-tar sauce', '55K', null, null, null, null],
                    ['POUTINE', 'A Thick Cut Deep Fried Fries served with Mozzarella and Hot Brown Gravy', '55K', null, null, null, null],
                    ['POTATO WEDGES', 'Deep-Fried Berastagi Redskin Potato, served with Chilli Sauce', '45K', null, null, null, null],
                    ['PASTRAMI CHIPS', 'Deep Fried Sliced Pastrami Served with Mayonaise Mustard Dip', '45K', null, null, null, null],
                    ['CHIPS AND SALSA', 'A Basket of Crispy Flour Tortilla, served with Avocado Guacamole and Tomato Salsa', '40K', null, null, null, null],
                    ['SINGKONG GORENG', 'Deepfried Garlic Flavour Cassava served with Sambal Terasi', '45K', null, null, null, null],
                    ['CRISPY EDAMAME', 'Deep Fried Battered Edamame with a Touch of Chilli Flake', '30K', null, null, null, null],
                    ['FRIED MUSHROOM', 'Deepfried Oyster Mushrooms served with Spicy Mayonaise Sauce', '45K', null, null, null, null],
                    ['MOZZARELLA STICK', 'Deepfried breaded Mozzarella Stick Served with Tomato Basil Dip', '115K', null, null, null, null],
                ],
                'Soup' => [
                    ['PUMPKIN CREAM SOUP', 'A Cream Soup Consist of Pumpkin Puree', '40K', null, null, null, null],
                    ['MUSHROOM CREAM SOUP', 'A Cream Soup Consist of Mushrooms', '50K', null, null, null, null],
                    ['POTATOES CREAM SOUP', 'A Cream Soup Consist of Chunk Potatoes', '50K', null, null, null, null],
                ],
                'Taste of Karo' => [
                    ['BAKARAN KARO', 'Gundaling Local Steak, Free Range Chicken and Gundaling Farmstead Artisan Arsik Sausage Served with Arsik Fried Rice, Vegetables and Condiments', '100K', null, null, null, null],
                    ['NASI CAMPUR KARO', 'Steamed Rice Served with Essential Karo Dishes, Grilled Chicken Arsik, Artisan Arsik Sausage, Vegetables and Egg Balado', '90K', null, null, null, null],
                    ['SAPI PANGGANG KARO', 'Our Halal Version of Lokal Karo Favourite Dish Served with Steamed Rice, Gatgat Karo Vegetables, Kecombrang Clear Soup and Sambal Andaliman', '100K', null, null, null, null],
                    ['LIDAH SAPI BAKAR', 'Grill Arsik Beef Tounge, Served with Vegetables and Steamed Rice', '95K', null, null, null, null],
                    ['IGA BAKAR KARO', 'Grill Beef Ribs with Authentic Karo Seasoning Served with Steamed Rice', '160K', null, null, null, null],
                    ['TASAK TELU', '"Cooked Three Ways" Served with the Chicken Rice of Karo, Boiled Chicken, Traditional Cipera and Cassava Leaves', '87K', null, null, null, null],
                    ['NASI AYAM BAKAR ARSIK', 'Grill Arsik Chicken, Served with Vegetables and Steamed Rice', '87K', null, null, null, null],
                    ['SOP IGA', 'Beef Ribs in Clear Soup Served with Vegetables, Crackers, Steamed Rice and Condiments', '95K', null, null, null, null],
                    ['LAKSA KARO', 'Spicy Coconut broth, Sliced Beef, Tofu, Boiled Egg, Beansprout, Pumpkin, Served on a bed of Noodles', '65K', null, null, null, null],
                    ['IKAN ARSIK', 'Dori Fish Fillet Poached on Arsik Broth, Served with Steamed Rice and Condiments', '87K', null, null, null, null],
                    ['NASI AYAM CIKALA', 'Soup Chicken with Traditional Karo Spiced Served with Steamed Rice and Condiments', '87K', null, null, null, null],
                    ['NASI GORENG ARSIK', 'Taste of Karo Fried Rice Served with Fried Chicken, Fried Egg and Condiments', '65K', null, null, null, null],
                    ['AYAM NIRA', 'Free-Range Chicken Marinated Over Night in Nira, Slow Cooked in Spicy Arsik Coconut Milk, Served with Vegetables, Steamed Rice and Condiments', '87K', null, null, null, null, 'Kampung chicken is used in all of our Karo dishes'],
                ],
                'Fried Rice' => [
                    ['GUNDALING STEAK FRIED RICE', 'Grilled Local Steak with Oriental Fried Rice Served with Sunny Side Up, Mixed Green and Condiments', '85K', null, null, null, null],
                    ['GRILLED SALMON FRIED RICE', 'Grilled Salmon with Oriental Fried Rice, Sunny Side Up Egg, Mixed Greens and Condiments', '95K', null, null, null, null],
                    ['BEEF KECOMBRANG FRIED RICE', 'Karo Smoked Beef with Oriental Fried Rice, Served with Mixed Green and Condiments', '85K', null, null, null, null],
                ],
                'Western' => [
                    ['GUNDALING FARMSTEAD STEAK', '250gr Grilled to Perfection Imported Beef, Served with Mashed Pumpkin, Homefried Potatoes and Backyard Greens with Choices of Sauce', '348K', null, null, null, null],
                    ['GRILLED CHICKEN MUSTARD', 'Half Chicken Marinated in Mustard, Served with Backyard Mixed Greens, Homefried Potatoes and Tar-tar Sauce', '120K', null, null, null, null],
                    ['BBQ BEEF RIBS', 'Farmer Style BBQ Ribs, Served with Coleslaw, Homefried Potatoes, Mixed Greens and Passion Fruit BBQ Sauce', '255K', null, null, null, null],
                    ['CRUMB CHICKEN STEAK', 'Fried Breaded Chicken Breast Served with Tomato Basil and Melted Mozzarella, Coleslaw, Potato Salad and Tar-tar Sauce', '100K', null, null, null, null],
                    ['LEMON BUTTER SALMON', 'Pan-Fried Salmon Fillet Served with Mashed Pumpkin, Potato Salad, Mixed Greens and Lemon Butter Sauce', '170K', null, null, null, null],
                    ['GUNDALING HOT DOG', 'Gundaling Homemade Sausage Served with Onion, Backyard Greens, Coleslaw and Homemade Potato Fries on the Side', '70K', null, null, null, null],
                    ['GUNDALING PAN FRIED DORY', '150gr Dory Fillet, Mashed Pumpkin, Potato Salad, Coleslaw, Mixed Greens served with Lemon Butter Sauce', '87K', null, null, null, null],
                    ['GRILLED SMOKE PLATTER', 'Gundaling Farmstead Smoked Dish Consist of Chicken Sausage, Beef Sausage, Beef Pastrami, Chicken Ham and Mortadella Served with Mixed Greens, Coleslaw, Potato Salad and Brown Gravy', '120K', null, null, null, null, 'All Western dishes can change side dishes, based on Vegetables Season on our Farm'],
                ],
                'Pasta' => [
                    ['AGLIO E OLIO CHICKEN PASTA', 'A Classic Pasta recipe Cooked with Olive Oil and Garlic Served with Sliced Chicken and Garlic Bread', '80K', null, null, null, null],
                    ['AGLIO E OLIO SALMON PASTA', 'A Classic Pasta recipe Cooked with Olive Oil and Garlic Served with Diced Salmon and Garlic Bread', '90K', null, null, null, null],
                    ['GRILLED CHICKEN PASTA', 'Creamy Mushroom Spaghetti Served with Grilled Chicken Mustard and Garlic Bread', '90K', null, null, null, null],
                    ['SAPI PANGGANG KARO PASTA', 'A Pasta Recipe Cooked with Olive Oil and Garlic Served with Smoked Beef, Sambal Kecombrang and Garlic Bread', '100K', null, null, null, null],
                    ['CREAMY CHICKEN PASTA', 'A Sauce Consist of Cream and Parmesan Cheese Served with Sliced Chicken and Garlic Bread', '90K', null, null, null, null],
                    ['CREAMY SALMON PASTA', 'A Sauce Consist of Cream and Parmesan Cheese Served with Diced Salmon and Garlic Butter', '100K', null, null, null, null],
                    ['CREAMY TOMATO PASTA', 'A Combination of Tomato and Cream Sauce, Served with Sliced Beef, Oyster Mushroom and Garlic Bread', '80K', null, null, null, null],
                    ['SMOKED CHICKEN PASTA', 'Aglio E Olio Style Cooked with Smoked Chicken and Served with Garlic Bread', '80K', null, null, null, null],
                    ['CREAMY CHICKEN PESTO PASTA', 'A Combination of Pesto and Cream Sauce, Served with Sliced Chicken and Garlic Bread', '90K', null, null, null, null],
                    ['SMOKED SALMON PASTA', 'Aglio E Olio Style Cooked with Smoked Salmon and Served with Garlic Bread', '90K', null, null, null, null],
                    ['PEPPERONI PASTA', 'Aglio E Olio Style Cooked with Pepperoni and Served with Garlic Bread', '90K', null, null, null, null],
                    ['BOLOGNESE PASTA', 'A Sauce Made from Tomatoes, Minced Beef, Garlic and Herbs Served with Garlic Bread', '80K', null, null, null, null, 'Choice of pasta: spaghetti or fettuccine'],
                ],
                'Pizza' => [
                    ['THREE CHEESE', 'Tomato Sauce, Mixed Hard Cheese and Mozzarella Cheese', '120K', null, null, null, null],
                    ['MARGHERITA', 'Tomato Sauce, Basil, Mixed Hard Cheese and Mozzarella Cheese', '105K', null, null, null, null],
                    ['CARNIVORE', 'Tomato Sauce, Beef, Chicken Sausage, Arsik Smoked Chicken, Mixed Hard Cheese and Mozzarella Cheese', '130K', null, null, null, null],
                    ['SAPI PANGGANG KARO', 'Tomato Sauce, Smoked Beef, Sambal Kecombrang, Mixed Hard Cheese and Mozzarella Cheese', '140K', null, null, null, null],
                    ['BEEF TONGUE', 'Tomato Sauce, Beef Tounge, Onion, Oven Dried Tomato, Mushroom, Mixed Hard Cheese and Mozzarella Cheese', '120K', null, null, null, null],
                    ['BEEF AND MUSHROOM', 'Tomato Sauce, Beef, Mushroom, Mixed Hard Cheese and Mozzarella Cheese', '120K', null, null, null, null],
                    ['CHICKEN HAM AND CHEESE', 'Bechamel, Chicken Ham, Mixed Hard Cheese and Mozzarella Cheese', '100K', null, null, null, null],
                    ['ARSIK SMOKED CHICKEN', 'Arsik Basting Sauce, Onion, Tomato Sauce, Slices Smoked Chicken Arsik, Mixed Hard Cheese and Mozzarella Cheese', '100K', null, null, null, null],
                    ['SAUSAGE AND MUSHROOM', 'Tomato Sauce, Chicken Sausage, Mushroom, Mixed Hard Cheese and Mozzarella Cheese', '120K', null, null, null, null],
                    ['MUSHROOM', 'Bechamel, Oyster Mushroom, Mixed Hard Cheese and Mozzarella Cheese', '95K', null, null, null, null],
                    ['FARMERS VEGETARIAN', 'Tomato Sauce, Carrot, Pumpkin, Onion, Mushroom, Mixed Hard Cheese and Mozzarella Cheese', '90K', null, null, null, null],
                    ['CHICKEN AND MUSHROOM', 'Tomato Sauce, Arsik Smoked Chicken, Mushroom, Mixed Hard Cheese and Mozzarella Cheese', '120K', null, null, null, null],
                    ['SMOKED SALMON', 'Tomato Sauce, Smoked Salmon, Mixed Hard Cheese and Mozzarella Cheese', '130K', null, null, null, null],
                    ['MORTADELLA', 'Tomato Sauce, Mortadella, Mixed Hard Cheese and Mozzarella Cheese', '110K', null, null, null, null],
                    ['PEPPERONI', 'Tomato Sauce, Pepperoni, Mixed Hard Cheese and Mozzarella Cheese', '110K', null, null, null, null, 'All pizza sauce bases are interchangeable'],
                ],
                'Desserts' => [
                    ['PANNACOTTA', 'Vanilla Milk Pudding with a Choice of Tamarillo Sauce or Passion Fruit Sauce', '40K', null, null, null, null],
                    ['BREAD BUTTER PUDDING', 'A Classic Comfort Dessert, Custardy on the Inside of Our Fresh Baked Bread, Golden and Buttery on Top Served with 3 Choices of Gelato', '40K', null, null, null, null],
                    ['PINEAPPLE CRUMBLE', 'Compound Pineapple and Raisin with Herbs, Served with 3 Choices of Gelato', '40K', null, null, null, null],
                    ['TANAH BERASTAGI', 'Chocolate Mousse with Brownies Served with Crumble and A Choice of Gelato', '50K', null, null, null, null],
                    ['AVOCADO MOUSSE', 'A Dessert of Creamy Avocado with Cookie Layers, Crumble and Ganache Chocolate on Top', '45K', null, null, null, null],
                    ['CREME BRULEE', 'A Rich Custard and Sugar on Top, Served with Chunky Strawberry and Meringue', '40K', null, null, null, null],
                ],
                'Cake' => [
                    ['KLEPON CAKE', null, null, null, null, '300K', '47K'],
                    ['NASTAR CAKE', null, null, null, null, '300K', '47K'],
                    ['CHEESE CAKE', null, null, null, null, '395K', '55K'],
                    ['POUND CAKE GULA AREN', null, '85K', null, null, null, null],
                    ['POUND CAKE PUMPKIN', null, '85K', null, null, null, null],
                    ['POUND CAKE CARROT', null, '85K', null, null, null, null],
                    ['MOO ROLL CAKE MARKISAH', null, '100K', null, null, null, null],
                    ['MOO ROLL CAKE PANDAN', null, '100K', null, null, null, null],
                    ['LAPIS MOO', null, '70K', null, null, null, null],
                ],
            ],
            'retail' => [
                'Frozen Food' => [
                    ['BAKSO URAT - 20 PCS', 'Category: 90% Local Meatball; Storing: 0-5 Celsius', '116K', null, null, null, null],
                    ['BAKSO HALUS - 30 PCS', 'Category: 90% Local Meatball; Storing: 0-5 Celsius', '125K', null, null, null, null],
                    ['SOSIS AYAM - 5 PCS', 'Category: Sausage; Storing: 0-5 Celsius', '70K', null, null, null, null],
                    ['SOSIS SAPI - 5 PCS', 'Category: Sausage; Storing: 0-5 Celsius', '85K', null, null, null, null],
                    ['CHICKEN MEATLOAF - 250 GR', 'Category: Ham; Storing: 0-5 Celsius', '87.5K', null, null, null, null],
                    ['BEEF PASTRAMI - 250 GR', 'Category: Ham; Storing: 0-5 Celsius', '117.5K', null, null, null, null],
                    ['BEEF MORTADELLA - 250 GR', 'Category: Sausage; Storing: 0-5 Celsius', '87.5K', null, null, null, null],
                    ['PEPPERONI - 250 GR', 'Category: Dry Sausage; Storing: 0-5 Celsius', '100K', null, null, null, null],
                ],
                'Paste' => [
                    ['CIKALA PASTE', '150 ML. Our Homemade Paste using natural ingredients', '25K', null, null, null, null],
                    ['ARSIK PASTE', '150 ML. Our Homemade Paste using natural ingredients', '20K', null, null, null, null],
                    ['TOMATO BASIL SAUCE', '150 ML. Our Homemade Paste using natural ingredients', '25K', null, null, null, null],
                ],
                'Cheese' => [
                    ['ANDALIMAN CHEESE - 250 GR', 'Style: Tomme Andaliman Style; Category: Hard Cheese; Storing: 5-10 Celsius; Age: 8 Months - 3 Years', '158K', null, null, null, null],
                    ['GUNDALING CHEESE - 250 GR', 'Style: Tomme Style; Category: Hard Cheese; Storing: 5-10 Celsius; Age: 8 Months - 3 Years', '128K', null, null, null, null],
                    ['SINABUNG CHEESE - 250 GR', 'Style: Tomme Style; Category: Semi-Hard Cheese; Storing: 5-10 Celsius; Age: 8 Months - 2 Years', '128K', null, null, null, null],
                    ['MOZZARELLA CHEESE - 250GR', 'Style: Mozzarella; Category: Soft Cheese; Storing: 5-10 Celsius; Age: 3 Months - 6 Months', '118K', null, null, null, null],
                    ['CAMEMBERT - 250 GR', 'Style: Camembert; Category: Soft Cheese; Storing: 5-10 Celsius; Age: 2 Weeks - 2 Months', '87K', null, null, null, null],
                ],
                'Gelato' => [
                    ['GELATO CHOCOLATE', null, '40K', null, null, null, null],
                    ['GELATO STRAWBERRY', null, '40K', null, null, null, null],
                    ['GELATO MILK HONEY', null, '40K', null, null, null, null],
                    ['GELATO MATCHA', null, '40K', null, null, null, null],
                    ['GELATO SWEET POTATO', null, '40K', null, null, null, null],
                    ['GELATO CORN', null, '40K', null, null, null, null],
                    ['GELATO CHEESE', null, '45K', null, null, null, null],
                    ['GELATO PEANUT BUTTER', null, '45K', null, null, null, null],
                    ['GELATO COFFEE', null, '40K', null, null, null, null],
                    ['SORBET STRAWBERRY', null, '40K', null, null, null, null],
                    ['SORBET PASSION FRUIT', null, '40K', null, null, null, null],
                    ['SORBET MANGO', null, '40K', null, null, null, null],
                    ['SORBET MARTABE', null, '40K', null, null, null, null],
                ],
                'Jams' => [
                    ['STRAWBERRY JAM', '150 ML. Our Homemade Jams using natural ingredients', '45K', null, null, null, null],
                    ['PASSIONFRUIT JAM', '150 ML. Our Homemade Jams using natural ingredients', '45K', null, null, null, null],
                    ['TAMMARILLO JAM', '150 ML. Our Homemade Jams using natural ingredients', '45K', null, null, null, null],
                    ['PINNEAPPLE JAM', '150 ML. Our Homemade Jams using natural ingredients', '45K', null, null, null, null],
                ],
            ],
        ];

        // Drink photos with descriptive filenames that confidently map to a real item.
        $drinkImageMatches = [
            'COFFEE LATTE' => 'Gundaling farmstead-192-coffe latte.png',
            'GREEN TEA LATTE' => 'Gundaling farmstead-199-green tea latte.png',
            'CHOCOLATE LATTE' => 'Gundaling farmstead-200-choco latte.png',
            'REMPAH MILK COFFEE' => 'Gundaling farmstead-207-kopi susu rempah.png',
            'AFFOGATO' => 'Gundaling farmstead-216-affogato.png',
            'CIKALA TEA' => 'Gundaling farmstead-228-ice tea cikala.png',
            'CINNAMON TEA' => 'Gundaling farmstead-229-cinnamon tea.png',
            'THAI TEA LATTE' => 'Gundaling farmstead-313-thai tea.png',
            'TAMARILLO COOKIES' => 'Gundaling farmstead-319-tamarilo cookies.png',
            'OREO BLENDED' => 'Gundaling farmstead-323-oreo blended.png',
            'MARKISA COOKIES' => 'Gundaling farmstead-325-markisa cookies.png',
        ];

        $categorySort = 0;

        foreach ($data as $department => $categories) {
            foreach ($categories as $categoryName => $items) {
                $categorySort++;

                $category = MenuCategory::create([
                    'department' => $department,
                    'name' => $categoryName,
                    'name_id' => $categoryName,
                    'slug' => Str::slug($department . '-' . $categoryName),
                    'sort_order' => $categorySort,
                    'is_active' => true,
                ]);

                $itemSort = 0;

                foreach ($items as $item) {
                    $itemSort++;

                    [$name, $description, $price, $hot, $cold, $whole, $slice] = $item;
                    $notes = $item[7] ?? null;

                    $image = isset($drinkImageMatches[$name]) && $department === 'drinks'
                        ? '/images/menu/drinks/' . $drinkImageMatches[$name]
                        : null;

                    MenuItem::create([
                        'category_id' => $category->id,
                        'name' => $name,
                        'name_id' => $name,
                        'description' => $description,
                        'description_id' => $description,
                        'price' => $this->price($price),
                        'hot_price' => $this->price($hot),
                        'cold_price' => $this->price($cold),
                        'whole_price' => $this->price($whole),
                        'slice_price' => $this->price($slice),
                        'notes' => $notes,
                        'image' => $image,
                        'is_available' => true,
                        'is_featured' => in_array($name, ['GUNDALING CHEESE PLATTER', 'GUNDALING FARMSTEAD STEAK', 'BAKARAN KARO', 'TASAK TELU']),
                        'is_sold_out' => false,
                        'sort_order' => $itemSort,
                    ]);
                }
            }
        }

        $this->assignAdditionalPhotos();
    }

    /**
     * Photo assignments confirmed against real menu photography. Entries with a
     * 'category' key disambiguate item names that are reused across categories
     * (e.g. "Cinnamon Coffee" exists in both Signature and Coffee Based).
     */
    private function assignAdditionalPhotos(): void
    {
        $assignments = [
            ['name' => 'POTATOES CREAM SOUP', 'image' => '/images/menu/appetizers/Gundaling farmstead-152-Edit.png'],
            ['name' => 'MUSHROOM CREAM SOUP', 'image' => '/images/menu/appetizers/Gundaling farmstead-155-Edit.png'],
            ['name' => 'MIXED PLATTER', 'image' => '/images/menu/appetizers/Gundaling farmstead-mixed platter-004.png'],
            ['name' => 'SINABUNG CHEESE - 250 GR', 'image' => '/images/menu/cheese/Gundaling farmstead new menu-278-Edit.png'],
            ['name' => 'GUNDALING CHEESE - 250 GR', 'image' => '/images/menu/cheese/Gundaling farmstead new menu-285-Edit.png'],
            ['name' => 'ANDALIMAN CHEESE - 250 GR', 'image' => '/images/menu/cheese/Gundaling farmstead new menu-293-Edit.png'],
            ['name' => 'CHEESE CAKE', 'image' => '/images/menu/desserts/Gundaling farmstead-268.png'],
            ['name' => 'MOO ROLL CAKE MARKISAH', 'image' => '/images/menu/desserts/Gundaling farmstead-285.png'],
            ['name' => 'CREME BRULEE', 'image' => '/images/menu/desserts/Gundaling farmstead-307.png'],
            ['name' => 'KLEPON CAKE', 'image' => '/images/menu/desserts/Gundaling farmstead-357.png'],
            ['name' => 'ROSEMARY TEA', 'image' => '/images/menu/drinks/Gundaling farmstead new menu-190.png'],
            ['name' => 'GINGER FRESH MILK', 'image' => '/images/menu/drinks/Gundaling farmstead new menu-206-Edit.png'],
            ['name' => 'STRAWBERRY', 'category' => 'Smoothies', 'image' => '/images/menu/drinks/Gundaling farmstead-326.png'],
            ['name' => 'SAPI PANGGANG KARO PASTA', 'image' => '/images/menu/pasta/Gundaling farmstead-067.png'],
            ['name' => 'CREAMY TOMATO PASTA', 'image' => '/images/menu/pasta/Gundaling farmstead-075.png'],
            ['name' => 'ARSIK SMOKED CHICKEN', 'image' => '/images/menu/pizza/Gundaling farmstead-117-Edit.png'],
            ['name' => 'BEEF AND MUSHROOM', 'image' => '/images/menu/pizza/Gundaling farmstead-127-Edit.png'],
            ['name' => 'FARMERS VEGETARIAN', 'image' => '/images/menu/pizza/Gundaling farmstead-128-Edit.png'],
            ['name' => 'MARGHERITA', 'image' => '/images/menu/pizza/Gundaling farmstead-144-Edit.png'],
            ['name' => 'GRILLED SMOKE PLATTER', 'image' => '/images/menu/western/Gundaling farmstead new menu-036.png'],
            ['name' => 'GUNDALING CHEESE PLATTER', 'image' => '/images/promo/promo-cheese.jpg'],
            ['name' => 'TASAK TELU', 'image' => '/images/menu/karo/Gundaling farmstead new menu-221-Edit.png'],
            ['name' => 'BBQ BEEF RIBS', 'image' => '/images/menu/western/Gundaling farmstead new menu-238.png'],
            ['name' => 'GUNDALING FARMSTEAD STEAK', 'image' => '/images/menu/western/Gundaling farmstead new menu-260-Edit.png'],
            ['name' => 'IGA BAKAR KARO', 'image' => '/images/menu/karo/Gundaling farmstead new menu-265.png'],
            ['name' => 'GUNDALING STEAK FRIED RICE', 'image' => '/images/menu/karo/Gundaling farmstead new menu-274.png'],
            ['name' => 'SAPI PANGGANG KARO', 'category' => 'Taste of Karo', 'image' => '/images/menu/karo/Gundaling farmstead-101.png'],
            ['name' => 'LAKSA KARO', 'image' => '/images/menu/karo/Gundaling farmstead new menu-019.png'],
            ['name' => 'CINNAMON COFFEE', 'category' => 'Signature', 'image' => '/images/menu/drinks/DSC09160-Edit.png'],
            ['name' => 'GIN TONIC', 'image' => '/images/menu/drinks/Gin tonic.png'],
            ['name' => 'MYSTICAL BEET', 'image' => '/images/menu/drinks/Mystical beet.png'],
            ['name' => 'SCREWDRIVER', 'image' => '/images/menu/drinks/Screwdriver.png'],
            ['name' => 'SUMATERA ISLAND', 'image' => '/images/menu/drinks/Sumatra island.png'],
        ];

        foreach ($assignments as $assignment) {
            MenuItem::where('name', $assignment['name'])
                ->when(
                    isset($assignment['category']),
                    fn ($query) => $query->whereHas('category', fn ($q) => $q->where('name', $assignment['category']))
                )
                ->update(['image' => $assignment['image']]);
        }
    }
}
