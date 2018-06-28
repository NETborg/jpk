<?php

namespace Netborg\Jpk;

class Podmiot
{

    public const KLUCZE = [
        'pelnaNazwa',
        'nip',
        'regon',
        'ulica',
        'nrDomu',
        'nrLokalu',
        'wojewodztwo',
        'powiat',
        'miejscowosc',
        'gmina',
        'poczta',
        'kodPocztowy',
        'kodKraju',
        'prefixVat'
    ];

    protected $data = [];



    public function __construct(array $data=[])
    {
        if(count($data) > 0) {
            foreach($data as $klucz => $wartosc) {
                if(!in_array($klucz, self::KLUCZE)) continue;
                $this->data[$klucz] = $wartosc;
            }
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


    public function getAdres(): string
    {
        $adres = "{$this->kodPocztowy} {$this->miejscowosc}, ";
        $adres .= "{$this->ulica} {$this->nrDomu}";
        if ($this->nrLokalu) {
            $adres .= "/{$this->nrLokalu}";
        }

        return trim($adres);
    }

    public function nip()
    {
        return $this->nip;
    }

    public function pelnaNazwa()
    {
        return $this->pelnaNazwa;
    }

    public function regon()
    {
        return $this->regon;
    }

    public function wojewodztwo()
    {
        return $this->wojewodztwo;
    }

    public function powiat()
    {
        return $this->powiat;
    }

    public function gmina()
    {
        return $this->gmina;
    }

    public function poczta()
    {
        return $this->poczta;
    }

    public function ulica()
    {
        return $this->ulica;
    }

    public function nrDomu()
    {
        return $this->nrDomu;
    }

    public function nrLokalu()
    {
        return $this->nrLokalu;
    }

    public function miejscowosc()
    {
        return $this->miejscowosc;
    }

    public function kodPocztowy()
    {
        return $this->kodPocztowy;
    }

    public function prefixVat()
    {
        return $this->prefixVat;
    }

    public function kodKraju()
    {
        return $this->kodKraju;
    }
}
