<?php
class Impresso {

    private $prices;
    private $addPricePerKg;
    private $higherPrice;
    
    function __construct() {

        $html = DOMDocument::loadHTML(file_get_contents('https://www.correios.com.br/enviar-e-receber/marketing-direto/impressos/impresso-normal'));
        $xpath = new DOMXpath($html);
        $elements = $xpath->query("*//table[@class='conteudo-tabela']");
        $cont = 0;

        foreach ($elements[0]->childNodes[1]->childNodes as $node) {

            preg_match_all('/\d{1,5}/', $node->childNodes[0]->nodeValue, $peso);
            preg_match('/\d{1,2},\d{2}/', $node->childNodes[2]->nodeValue, $valor);

            if (strpos($node->childNodes[0]->nodeValue, 'Kg'))
                $this->addPricePerKg = $this->toFloatValue($valor[0]);
            elseif ($peso[0][1]) {
                $this->higherPrice = $this->toFloatValue($valor[0]);
                $this->prices[] = [$peso[0][0], $peso[0][1], $valor[0]];
            } elseif ($peso[0][0])
                $this->prices[] = ['0', $peso[0][0], $valor[0]];
                
        }

    }

    function getprices() {
        return $this->prices;
    }

    function getAddPricePerKg() {
        return $this->addPricePerKg;
    }

    function getHigherPrice() {
        return $this->higherPrice;
    }

    function calcPrice($weigth) {
        foreach ($this->prices as $price) {
            if($price[0] < $weigth and $weigth <= $price[1])
            return $price[2];
        }
         
        $intDiv = intdiv($weigth - 1000, 1000);

        if (($intDiv + 1) * 1000 < $weigth)
            $intDiv++;

        return $this->higherPrice + ($intDiv * $this->addPricePerKg);
    }

    function toFloatValue($value) {
        return str_replace(',', '.', $value);
    }
}
?>