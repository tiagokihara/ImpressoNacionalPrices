<?php
include("Impresso.php");

$impresso = new Impresso();

echo '<table><tr><td>Start weight</td><td>End weight</td><td>Price</td></tr>';
foreach ($impresso->getPrices() as $price) {
    echo '<tr><td>' . $price[0] . '</td><td>' . $price[1] . '</td><td>' . $price[2] . '</td></tr>';
}
echo '</table>';

echo '<p>Preço adicionar por Kg ou fração de Kg: ' . $impresso->getAddPricePerKg() . '<p/>';

echo 'Preço correspondente a 30 gramas: ' . $impresso->calcPrice(30) . '<br />';
echo 'Preço correspondente a 130 gramas: ' . $impresso->calcPrice(130) . '<br />';
echo 'Preço correspondente a 430 gramas: ' . $impresso->calcPrice(430) . '<br />';
echo 'Preço correspondente a 730 gramas: ' . $impresso->calcPrice(730) . '<br />';
echo 'Preço correspondente a 950 gramas: ' . $impresso->calcPrice(950) . '<br />';
echo 'Preço correspondente a 1750 gramas: ' . $impresso->calcPrice(1750) . '<br />';
echo 'Preço correspondente a 2150 gramas: ' . $impresso->calcPrice(2150) . '<br />';
echo 'Preço correspondente a 3000 gramas: ' . $impresso->calcPrice(3000) . '<br />';
echo 'Preço correspondente a 3001 gramas: ' . $impresso->calcPrice(3001) . '<br />';