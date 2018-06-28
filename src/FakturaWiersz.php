<?php

namespace Netborg\Jpk;

class FakturaWiersz
{

    public const KLUCZE = [
        'nazwa',
        'cenaJednostkowaNetto',
        'miara',
        'ilosc',
        'stawkaVat'
    ];

    protected static $domyslne = [
        'miara' => "szt",
        'ilosc' => 1,
        'stawkaVat' => 23
    ];

    protected $data = [];

    // zwolnione i 0 maja wartosc stawki 0 ale opis bedzie inny "zw" lub 0
    public $stawkaVatOpis;



    public function __construct(array $data=[])
    {
        $this->data = array_merge(self::$domyslne, $data);
        if($this->data['stawkaVat'] === 'zw') {
            $this->stawkaVatOpis = 'zw';
            $this->data['stawkaVat'] = 0;
        }
    }


    public function __set($name, $value)
    {
        if(in_array($name, self::KLUCZE)) {
            $this->data[$name] = $value;
        }
    }

    public function __get($name)
    {
        return $this->data[$name] ?? null;
    }





    public function nazwa(): ?string
    {
        return (string) $this->nazwa ?? null;
    }

    public function miara(): ?string
    {
        return (string) $this->miara ?? null;
    }

    public function ilosc()
    {
        return (double) $this->ilosc;
    }

    public function cenaJednostkowaNetto()
    {
        return (double) $this->cenaJednostkowaNetto;
    }

    public function sumaNetto()
    {
        return (double) $this->cenaJednostkowaNetto() * $this->ilosc();
    }

    public function sumaBrutto()
    {
        return (double) $this->sumaNetto() + $this->sumaPodatek();
    }

    public function sumaPodatek()
    {
        return (double) round(($this->sumaNetto() * $this->stawkaVat()/100), 2);
    }

    public function stawkaVat()
    {
        return (double) $this->stawkaVat;
    }

    public function stawkaVatOpis()
    {
        if ($this->stawkaVatOpis) {
            // mozliwosc ustawienia 'zw'
            return $this->stawkaVatOpis;
        } else {
            return $this->stawkaVat;
        }
    }
}
